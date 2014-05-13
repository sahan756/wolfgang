<?php
require_once(LIB_PATH.DS.'database.php');

class Contacts extends DatabaseObject{
    
    protected static $table_name="contact";
    protected static $db_fields = array('contitle','confname','conlname','conemail','contel','conmass');
    public $conid;
    public $condate;
    public $contitle;
    public $confname;
    public $conlname;
    public $conemail;
    public $contel;
    public $conmass;
    
    //public $first_name;
   // public $last_name;
    
    
    //public function full_name(){
      //  if(isset($this->first_name)&&isset($this->last_name)){
      //      return $this->first_name." ".$this->last_name;
        
      //  }else{
       //     return "";
       // }
  //  }
    
    
   // public static function authentucate($cemail="",$cpassword=""){
       // global $database;
       // $cemail = $database->escape_value($cemail);
       // $cpassword = $database->escape_value($cpassword);
        //$password = self::get_encrypted_password($password);
        
        //$sql = "SELECT * FROM contact ";
       // $sql .= "WHERE cemail = '{$cemail}' ";
       // $sql .="And cpassword = '{$cpassword}' ";
       // $sql .= "LIMIT 1";
        
       // $result_array= self::find_by_sql($sql);
       // return !empty($result_array)?array_shift($result_array): false;
        
   // }
    
    public static function find_all(){
        return self::find_by_sql("SELECT * FROM ".self::$table_name);
    
    }
    
    public static function find_by_id($id=0){
        global $database;
        $result_array= self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE id={$id} LIMIT 1");
        return !empty($result_array)?array_shift($result_array): false;
    }
    
    public static function find_by_sql($sql=""){
        global $database;
        $result_set= $database->query($sql);
        $object_array= array();
        while($row=$database->fetch_array($result_set)){
            $object_array[]=self::instantiate($row);
        }
        return $object_array;
    }
    
    
    public static function count_all(){
     global $database;
     $sql = "SELECT COUNT(*) FROM ".self::$table_name;
     $result_set = $database->query($sql);
     $row= $database->fetch_array($result_set);
     return array_shift($row);
     
    }
    
    
    
    
    private static function instantiate($record){
        $object = new self();

      //  $object->id=$record['id'];
      //   $object->username=$record['username'];
      //     $object->password=$record['password'];
      //     $object->first_name=$record['first_name'];
       //   $object->last_name=$record['last_name'];

    foreach($record as $attribute=>$value){
        if($object->has_attribute($attribute)){
            $object->$attribute= $value;
        }
    }
    
    
           return $object;
    }
    
    private function has_attribute($attribute){
        $object_vars = $this->attributes();
        
        return array_key_exists($attribute,$object_vars);
    }
    
    public function attributes(){
       $attributes= array();
       foreach(self::$db_fields as $field){
        if(property_exists($this,$field)){
            $attributes[$field]=$this->$field;
        }
       }
       return $attributes;
        
       }
    
    protected function sanitized_attributes(){
        global $database;
        $clean_attributes= array();
        
        foreach($this->attributes()as $key => $value){
            $clean_attributes[$key]=$database->escape_value($value);
        }
        return $clean_attributes;
    }
    
    
    
    public function save(){
        return isset($this->id)? $this->update() : $this->create();
    }
    
    public function create_user(){
        global $database;
        
        $attributes = $this->attributes();
        
        $sql="INSERT INTO ".self::$table_name." (";
        $sql .= join(", ", array_keys($attributes));
        $sql .= ") VALUES ('";
        $sql .= join("', '",array_values($attributes));
        $sql .= "')";
        
        if($database->query($sql)){
            $this->id=$database->insert_id();
            return true;
        
        }else{
            return false;
        } 
    } 
    
    public function create(){
        global $database;
        
        $attributes = $this->attributes();
        
        $sql="INSERT INTO ".self::$table_name." (";
        $sql .= join(", ", array_keys($attributes));
        $sql .= ") VALUES ('";
        $sql .= join("', '",array_values($attributes));
        $sql .= "')";
        
        if($database->query($sql)){
            $this->id=$database->insert_id();
            return true;
        
        }else{
            return false;
        } 
    } 
    
    public function update(){
        
        global $database;
        $attributes = $this->sanitized_attributes();
        $attribute_pairs= array();
        foreach($attributes as $key=>$value){
            $attribute_pairs[]="{$key}='{$value}'";
        }
        
        $sql = "UPDATE ".self::$table_name." SET ";
        $sql .= join(", ", $attribute_pairs);
        $sql .= " WHERE id=". $database->escape_value($this->id);
        
        $database->query($sql);
        return ($database->affected_rows()==1)? true : false;
    }
    public function delete(){
        global $database;
        
        $sql = "DELETE FROM ".self::$table_name." ";
        $sql .= "WHERE id=". $database->escape_value($this->id);
        $sql .= " LIMIT 1";
        
        $database->query($sql);
        return($database->affected_rows()==1)? true : false;
    }
    
    static function get_encrypted_password($password){
        return md5($password);
    }
}


?>