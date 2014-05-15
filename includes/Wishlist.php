<?php
//require_once 'database_object.php';
require_once(LIB_PATH . DS . 'database.php');
class Wishlist {

    protected static $table_name = "wishlist";
    protected static $db_fields = array('id', 'cus_id', 'item_id', 'date_time');
    public $id;
    public $cus_id;
    public $item_id;
    public $date_time;
    public $errors = array();
    public $product;
    
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
        if (empty($this->errors)) {
            return isset($this->id) ? $this->update() : $this->create();
        } else {
            return FALSE;
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
    
    public static function find_by_cus_id($id = 0) {
        global $database;
        return self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE cus_id=" . $database->escape_value($id));
        //return !empty($result_array) ? array_shift($result_array) : false;
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
    
    public function create() {
        global $database;

        //$this->assign_files(); //assign filenames to db_fields

        $attributes = $this->sanitized_attributes();

        $sql = "INSERT INTO " . self::$table_name . " (";
        $sql .= join(", ", array_keys($attributes));
        $sql .= ") VALUES ('";
        $sql .= join("', '", array_values($attributes));
        $sql .= "')";

        //echo $sql;

        if ($database->query($sql)) {            
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
        
        return ($database->affected_rows() == 1) ? true : false;

        //return FALSE;
    }

    public function delete() {
        global $database;

        $sql = "DELETE FROM " . self::$table_name . " ";
        $sql .= "WHERE id=" . $database->escape_value($this->id);
        $sql .= " LIMIT 1";

        $database->query($sql);
        return($database->affected_rows() == 1) ? true : false;
    }    
    
    public static function get_wishlist(){
        global $session;
//        if(!empty($session->cusid)){
//            $list = self::find_by_cus_id($session->cusid);
//            //$this->wishlist = $list;
//            //var_dump($list);
//            if(!empty($list)){
//                $session->wishlist = array();
//                foreach ($list as $value) {
//                    //var_dump($value);
//                    $session->wishlist[$value->item_id] = $value;
//                }
//            }
//        }
        $items = array();        
        if(!empty($session->cusid)){
            $list = self::find_by_cus_id($session->cusid);            
            if(!empty($list)){                
                foreach ($list as $value) {
                    //var_dump($value);
                    $items[$value->item_id] = $value;
                }
            }
        }
        return $items;
    }
}

?>
