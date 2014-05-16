<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once(LIB_PATH . DS . 'database.php');

class Product extends DatabaseObject {

    protected static $table_name = "product";
    protected static $db_fields = array('id', 'title', 'image_1', 'image_2', 'image_3', 'image_4', 'cat_id', 'size_id', 'color_id', 'type_id', 'price','quan');
    public $id;
    public $title;
    public $image_1;
    public $image_2;
    public $image_3;
    public $image_4;
    public $cat_id;
    public $size_id;
    public $color_id;
    public $type_id;
    public $price;
     public $quan;
    public $errors = array();
    public $files = array();
    protected $upload_errors = array(
        UPLOAD_ERR_OK => "No errors.",
        UPLOAD_ERR_INI_SIZE => "larger than upload max fils size",
        UPLOAD_ERR_FORM_SIZE => "larfer than form max file size.",
        UPLOAD_ERR_PARTIAL => "partial upload",
        UPLOAD_ERR_NO_FILE => "No file",
        UPLOAD_ERR_NO_TMP_DIR => "No temporarary directory",
        UPLOAD_ERR_CANT_WRITE => "cant write to disk",
        UPLOAD_ERR_EXTENSION => "file upload stopped by extension"
    );
    public static $price_ranges = array(
        1 => 1500,
        2500,
        3500,
        4500
    );
    public $upload_dir = '/public/images/products/';

    public function attach_file($file, $img_no, $required = FALSE) {

        if (!$file || empty($file) || !is_array($file)) {
            $this->errors['file'] = "No, file was uploaded";
            return false;
        } elseif ($file['error'] != UPLOAD_ERR_OK) {
            if (!$required && $file['error'] == UPLOAD_ERR_NO_FILE) {
                return true;
            } else {
                $this->errors['file'] = $this->upload_errors[$file['error']];
                return false;
            }
        } else {
            $this->files[] = array(
                'upload' => $file,
                'img_no' => $img_no
            );
            return true;
        }
    }

    private static function instantiate($record) {
        $object = new self();

        foreach ($record as $attribute => $value) {
            if ($object->has_attribute($attribute)) {
                $object->$attribute = $value;
            }
        }
        return $object;
    }

    public function save() {
        $this->validate_save();
        if (empty($this->errors)) {
            return isset($this->id) ? $this->update() : $this->create();
        } else {
            return FALSE;
        }
    }
    
    function validate_save(){        
        $validation = new Validation();
        if($validation->isEmpty($this->title)){
            $this->errors['title'] = "Title cannot be empty";
        } else if($validation->isTooLong($this->title, 100)){
            $this->errors['title'] = "Title cannot be emptyis too long";
        }
        if($validation->isEmpty($this->price)){
            $this->errors['price'] = "Price cannot be empty";
        } else if($validation->isInvalidAmount($this->price)){
            $this->errors['price'] = "Invalid amount";
        } 
        if($validation->isEmpty($this->quan)){
            $this->errors['quan'] = "Quantity cannot be empty";
        } else if($validation->isNotWholeNumber($this->quan)){
            $this->errors['quan'] = "Quantity must be a whole number";
        }
        
    }

    public static function count_all($searchString = '') {
        global $database;
        $sql = "SELECT COUNT(*) FROM " . self::$table_name;
        $sql .= $searchString;
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    public static function find_all() {
        return self::find_by_sql("SELECT * FROM " . self::$table_name);
    }

    public static function find_by_id($id = 0) {
        global $database;
        $result_array = self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE id=" . $database->escape_value($id) . " LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : false;
    }

    public static function find_all_by_cat_id($id = 0) {
        global $database;
        return self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE cat_id=" . $database->escape_value($id));
    }

    public static function find_by_sql($sql = "") {
        global $database;
        $result_set = $database->query($sql);
        $object_array = array();
        while ($row = $database->fetch_array($result_set)) {
            $object_array[] = self::instantiate($row);
        }
        return $object_array;
    }

    private function has_attribute($attribute) {
        $object_vars = $this->attributes();

        return array_key_exists($attribute, $object_vars);
    }

    public function attributes() {
        $attributes = array();
        foreach (self::$db_fields as $field) {
            if (property_exists($this, $field)) {
                $attributes[$field] = $this->$field;
            }
        }
        return $attributes;
    }

    protected function sanitized_attributes() {
        global $database;
        $clean_attributes = array();

        foreach ($this->attributes()as $key => $value) {
            if (!empty($value))
                $clean_attributes[$key] = $database->escape_value($value);
        }
        return $clean_attributes;
    }

    function assign_files() {
        if (!empty($this->files)) {
            foreach ($this->files as $file) {
                $field = "image_" . $file['img_no'];
                $fileName = $file['img_no'] . '_' . time() . '.' . pathinfo($file['upload']['name'], PATHINFO_EXTENSION);
                $this->$field = $fileName;
            }
        }
        //var_dump($this->files);
    }

    function save_files($path) {
        if (!empty($this->files)) {
            if (!is_dir($path)) {
                mkdir($path, 0777, TRUE);
            }
            foreach ($this->files as $file) {
                $field = "image_" . $file['img_no'];
                move_uploaded_file($file['upload']['tmp_name'], $path . "/" . $this->$field);
            }
        }
    }

    public function create() {
        global $database;

        $this->assign_files(); //assign filenames to db_fields

        $attributes = $this->sanitized_attributes();

        $sql = "INSERT INTO " . self::$table_name . " (";
        $sql .= join(", ", array_keys($attributes));
        $sql .= ") VALUES ('";
        $sql .= join("', '", array_values($attributes));
        $sql .= "')";

        //echo $sql;

        if ($database->query($sql)) {
            $this->id = $database->insert_id();
            $path = SITE_ROOT . $this->upload_dir . $this->id;
            //upload files
            $this->save_files($path);

            return true;
        } else {
            return false;
        }
    }

    public function update() {

        global $database;
        $this->assign_files(); //assign filenames to db_fields
        $attributes = $this->sanitized_attributes();
        $attribute_pairs = array();
        foreach ($attributes as $key => $value) {
            $attribute_pairs[] = "{$key}='{$value}'";
        }
        //var_dump($attributes);
        $sql = "UPDATE " . self::$table_name . " SET ";
        $sql .= join(", ", $attribute_pairs);
        $sql .= " WHERE id=" . $database->escape_value($this->id);

//        if ($this->uploadFile()) {
//            $database->query($sql);
//            return ($database->affected_rows() == 1) ? true : false;
//        }
        //echo $sql;
        $database->query($sql);
        $path = SITE_ROOT . $this->upload_dir . $this->id;
        //upload files
        $this->save_files($path);
        return ($database->affected_rows() == 1) ? true : false;

        return FALSE;
    }

    public function delete() {
        global $database;

        $sql = "DELETE FROM " . self::$table_name . " ";
        $sql .= "WHERE id=" . $database->escape_value($this->id);
        $sql .= " LIMIT 1";

        $database->query($sql);
        return($database->affected_rows() == 1) ? true : false;
    }

    public static function get_search_string($title = '', $cat_id = '', $type_id = '', $color_id = '', $size_id = '', $price = '') {
        $params = array();
        global $database;
        if (!empty($title))
            $params['title'] = $title;
        if (!empty($cat_id))
            $params['cat_id'] = $cat_id;

        if (!empty($type_id))
            $params['type_id'] = $type_id;

        if (!empty($color_id)) {
            $params['color_id'] = $color_id;
        }

        if (!empty($size_id)) {
            $params['size_id'] = $size_id;
        }

        if (!empty($price)) {
            $params['price'] = $price;
        }

        $i = 0;
        $query = '';
        foreach ($params as $key => $value) {
            $i++;
            if ($i == 1)
                $query .= " WHERE ";
            else
                $query .= " AND ";
            if (in_array($key, array('title'))) {
                $query .= " LOWER($key) like LOWER('%$value%') ";
            } else if (in_array($key, array('price'))) {
                if (is_array($value)) {
                    $j = 0;
                    foreach ($value as $val) {
                        $j++;
                        $price = self::get_price_range($val);
                        if ($j == 1)
                            $query .= $database->where_between($key, $price['min'], $price['max']);
                        else
                            $query .= $database->where_between($key, $price['min'], $price['max'], 'OR');
                    }
                } else {
                    $price = self::get_price_range($value);
                    $query .= $database->where_between($key, $price['min'], $price['max']);
                }
            } else if (is_array($value)) {
                $query .= $key . " IN('" . implode("', '", $value) . "')";
            } else {
                $query .= " $key = '$value' ";
            }
        }
        return $query;
    }
    public function destroy() {

        if ($this->delete()) {
            //$target_path = SITE_ROOT . DS . 'public' . DS . $this->image_path();
             $path = SITE_ROOT . $this->upload_dir . $this->id;
         unlink($path.'/'.$this->image_1) ;
         unlink($path.'/'.$this->image_2) ;
         unlink($path.'/'.$this->image_3) ;
         unlink($path.'/'.$this->image_4) ;
         return true;
        } else {
            return false;
        }
    }

    public static function get_price_range($range_id) {
        $price = array();
        $price['min'] = self::$price_ranges[$range_id];
        if (!empty(self::$price_ranges[$range_id + 1])) {
            $price['max'] = self::$price_ranges[$range_id + 1] - 1;
        } else {
            $price['max'] = 0;
        }
        return $price;
    }

    public function image_path($image_no = 1) {
        $field = 'image_' . $image_no;
        return 'images/products/' . $this->id . '/' . $this->$field;
    }

}

