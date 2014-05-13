<?php

require_once(LIB_PATH . DS . 'database.php');

class Photograph extends DatabaseObject {

    protected static $table_name = "add_product";
    protected static $db_fields = array('id', 'filename', 'type', 'size', 'product_name', 'pcategory', 'psize', 'pcolor', 'pprize', 'ptype');
    public $id;
    public $filename;
    public $type;
    public $size;
    //public $caption;
    public $product_name;
    public $pcategory;
    public $psize;
    public $pcolor;
    public $pprize;
    public $ptype;
    private $temp_path;
    protected $upload_dir = "images";
    public $errors = array();
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
    public $is_attached = FALSE;

    public static $price_ranges = array(
       1 => 1500,
       2500,
       3500,
       4500
    );

    public function attach_file($file) {

        if (!$file || empty($file) || !is_array($file)) {
            $this->errors[] = "No file was uploaded";
            return false;
        } elseif ($file['error'] != 0) {
            $this->errors[] = $this->upload_errors[$file['error']];
            return false;
        } else {
            $this->destroy_pic();
            $this->temp_path = $file['tmp_name'];
            $this->filename = basename($file['name']);
            $this->type = $file['type'];
            $this->size = $file['size'];
            $this->is_attached = TRUE;
            return true;
        }
    }

    public static function make($photo_id) {
        if (!empty($photo_id) && !empty($author) && !empty($body)) {
            $comment = new Comment();
            $comment->photograph_id = (int) $photo_id;
            $comment->created = strftime("%Y-%m-%d %H:%M:%S", time());
            $comment->author = $author;
            $comment->body = $body;
            return $comment;
        } else {
            return false;
        }
    }

    public function save() {
        if (isset($this->id)) {
            return $this->update();
        } else {

            if (!empty($this->errors)) {
                return false;
            }

            //if(strlen($this->caption)>225){
            //  $this->errors[]="the caption can only be 225 characters long";
            //  return false;
            //  }

            $target_path = SITE_ROOT . DS . 'public' . DS . $this->upload_dir . DS . $this->filename;

            if (file_exists($target_path)) {
                $this->errors[] = "The file {$this->filename} already exists";
                return false;
            }

            if (move_uploaded_file($this->temp_path, $target_path)) {
                if ($this->create()) {
                    unset($this->temp_path);
                    return true;
                }
            } else {
                $this->errors[] = "file upload fail , possiblity due to inceorrent permissions on the upload folder";
                return false;
            }
        }
    }

    public function destroy_pic() {
        $target_path = SITE_ROOT . DS . 'public' . DS . $this->image_path();
        return unlink($target_path) ? true : false;
    }

    public function destroy() {

        if ($this->delete()) {
            $target_path = SITE_ROOT . DS . 'public' . DS . $this->image_path();
            return unlink($target_path) ? true : false;
        } else {
            return false;
        }
    }

    public function image_path() {
        return $this->upload_dir . DS . $this->filename;
    }

    public function size_as_text() {
        if ($this->size < 1024) {
            return "{$this->size} bytes";
        } elseif ($this->size < 1048576) {
            $size_kb = round($this->size / 1024);
            return "{$size_kb} KB";
        } else {
            $size_mb = round($this->size / 1048576, 1);
            return "{$size_mb} MB";
        }
    }

    public function comments() {
        return Comment::find_comments_on($this->id);
    }

    public function full_name() {
        if (isset($this->first_name) && isset($this->last_name)) {
            return $this->first_name . " " . $this->last_name;
        } else {
            return "";
        }
    }

    public static function authentucate($username = "", $password = "") {
        global $database;
        $username = $database->escape_value($username);
        $password = $database->escape_value($password);

        $sql = "SELECT * FROM users ";
        $sql .= "WHERE username = '{$username}' ";
        $sql .="And password = '{$password}' ";
        $sql .= "LIMIT 1";

        $result_array = self::find_by_sql($sql);
        return !empty($result_array) ? array_shift($result_array) : false;
    }

    public static function find_all() {
        return self::find_by_sql("SELECT * FROM " . self::$table_name);
    }

    public static function find_by_id($id = 0) {
        global $database;
        $result_array = self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE id=" . $database->escape_value($id) . " LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : false;
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

    public static function count_all($searchString = '') {
        global $database;
        $sql = "SELECT COUNT(*) FROM " . self::$table_name;
        $sql .= $searchString;
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    public static function get_search_string($prod_name = '', $prod_cat = '', $prod_typ = '', $color = '', $size = '', $price = '') {
        $params = array();
        global $database;
        if (!empty($prod_name))
            $params['product_name'] = $prod_name;
        if (!empty($prod_cat))
            $params['pcategory'] = $prod_cat;

        if (!empty($prod_typ))
            $params['ptype'] = $prod_typ;

        if (!empty($color)) {
            $params['pcolor'] = $color;
        }
        
        if (!empty($size)) {
            $params['psize'] = $size;
        }
        
        if (!empty($price)) {
            $params['pprize'] = $price;
        }
        
        $i = 0;
        $query = '';
        foreach ($params as $key => $value) {
            $i++;
            if ($i == 1)
                $query .= " WHERE ";
            else
                $query .= " AND ";
            if (in_array($key, array('product_name'))) {
                $query .= " LOWER($key) like LOWER('%$value%') ";
            } else if (in_array($key, array('pprize'))) {
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
    
    public static function get_price_range($range_id){
        $price = array();
        $price['min'] = self::$price_ranges[$range_id];
        if(!empty(self::$price_ranges[$range_id+1])){
            $price['max'] = self::$price_ranges[$range_id+1] - 1;
        } else {
            $price['max'] = 0;
        }
        return $price;
    }

    private static function instantiate($record) {
        $object = new self();

        //  $object->id=$record['id'];
        //   $object->username=$record['username'];
        //     $object->password=$record['password'];
        //     $object->first_name=$record['first_name'];
        //   $object->last_name=$record['last_name'];

        foreach ($record as $attribute => $value) {
            if ($object->has_attribute($attribute)) {
                $object->$attribute = $value;
            }
        }


        return $object;
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
            $clean_attributes[$key] = $database->escape_value($value);
        }
        return $clean_attributes;
    }

    public function save2() {
        return isset($this->id) ? $this->update() : $this->create();
    }

    public function create() {
        global $database;

        $attributes = $this->attributes();

        $sql = "INSERT INTO " . self::$table_name . " (";
        $sql .= join(", ", array_keys($attributes));
        $sql .= ") VALUES ('";
        $sql .= join("', '", array_values($attributes));
        $sql .= "')";
         
        if ($database->query($sql)) {
            $this->id = $database->insert_id();           
            return true;
        } else {
            return false;
        }
    }

    public function update() {

        global $database;
        $attributes = $this->sanitized_attributes();
        $attribute_pairs = array();
        foreach ($attributes as $key => $value) {
            $attribute_pairs[] = "{$key}='{$value}'";
        }
        //var_dump($attributes);
        $sql = "UPDATE " . self::$table_name . " SET ";
        $sql .= join(", ", $attribute_pairs);
        $sql .= " WHERE id=" . $database->escape_value($this->id);

        if ($this->uploadFile()) {
            $database->query($sql);
            return ($database->affected_rows() == 1) ? true : false;
        }
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

    function uploadFile() {
        if ($this->is_attached) {
            $target_path = SITE_ROOT . DS . 'public' . DS . $this->upload_dir . DS . $this->filename;
            if (move_uploaded_file($this->temp_path, $target_path)) {
                unset($this->temp_path);
                //return true;
            } else {
                $this->errors[] = "file upload fail , possiblity due to inceorrent permissions on the upload folder";
                return false;
            }
        }
        return TRUE;
    }

}

?>