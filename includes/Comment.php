<?php

require_once(LIB_PATH.DS.'database.php');

class Comment extends DatabaseObject{
    
    protected static $table_name="aboutus";
    protected static $db_fields=array('abcontent','username');
    
    public $abid;
    public $abcontent;
    public $username;
    
   
    
    
    
    
    public static function find_by_id($id=0){
        global $database;
        $result_array= self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE abid={$id} LIMIT 1");
        return !empty($result_array)?array_shift($result_array): false;
    }
    
    public static function find_comments_on($photo_id=0){
        global $database;
        $sql = "SELECT * FROM " .self::$table_name;
        $sql .= " WHERE photograph_id=" .$database->escape_value($photo_id);
        $sql .= " ORDER BY created ASC";
        return self::find_by_sql($sql);
    }
    
    public function try_to_send_notification(){
        $mail= new PHPMailer();
        
        $mail->IsSMTP();
        $mail->Host ="localhost";
        $mail->Port = 25;
        $mail->SMTPAuth = false;
        $mail->Username="johnmasht@gmail.com";
        $mail->Password="johnght9186";
        
        $mail->FromName="Photo Gallery";
        $mail->From = "johnmasht@gmail.com";
        $mail->AddAddress("roxjayanath@gmail.com","Photo Gallery Admin");
        $mail->Subject = "New Photo Gallery Comment";
        $mail->Body = "A new comment has been reciverd";
        
        $result= $mail->Send();
        return $result;
    }
    
    
    public static function find_all(){
        return self::find_by_sql("SELECT * FROM ".self::$table_name);
    
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
    
    public function abupdate($abcontent,$username){
         global $database;
         
         $sql = "UPDATE aboutus SET  abcontent =  '{$abcontent}' , username = '{$username}' WHERE  abid =1";
         
         $database->query($sql);
        return ($database->affected_rows()==1)? true : false;
    }
    
    
    public function update(){
        
        global $database;
        $attributes = $this->sanitized_attributes();
        $attribute_pairs= array();
        foreach($attributes as $key=>$value){
            $attribute_pairs[]="{$key}='{$value}'";
        }
        
        $sql = "UPDATE ".self::$table_name." SET ";
        $sql .= join(", ", array_keys($attributes));
        $sql .= " WHERE abid= 1";
        
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
    
    
}


?>