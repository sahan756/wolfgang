<?php

require_once(LIB_PATH.DS."constants.php");

class MySQLDatabase {
    
   private $connection;
   public $last_query;
   
   private $magic_quotes_active;
   private $real_escape_string;
   
   
   function __construct(){
    $this->open_connection();
     
        $this->magic_quotes_active=get_magic_quotes_gpc();
        $this->real_escape_string=function_exists("mysql_real_escape_string");
        
   }
   
   public function open_connection(){
        $this->connection = mysql_connect(DB_SERVER,DB_USER,DB_PASS);
        if(!$this->connection){
            die("Database connection failed :".mysql_error());
            
        }else{
            $db_select = mysql_select_db(DB_NAME,$this->connection);
            if(!$db_select){
                die("Database selection failed ".mysql_error());
            }
            
        }
    }
   public function close_connection(){
    
    if(isset($this->connection)){
        mysql_close($this->connection);
        unset($this->connection);
    }
    
   }
   
   public function query($sql){
    $this->last_query=$sql;
    $result = mysql_query($sql,$this->connection);
    $this->comfirm_query($result);
    return $result;
   }
   
  public function escape_value($value){
       
        if($this->real_escape_string){
            if($this->magic_quotes_active){
                $value=stripcslashes($value);
            }
            $value=mysql_real_escape_string($value);
        }else{
            if(!$this->magic_quotes_active){
                $value=addcslashes($value);
            }
        }
        return $value;
        }  
   
   public function num_rows($result_set){
    return mysql_num_rows($result_set);
   }
   
   public function insert_id(){
    return mysql_insert_id($this->connection);
    
   }
   
   public function affected_rows(){
    return mysql_affected_rows($this->connection);
   }
   
   
   
   
   
   public function fetch_array($result_set){
    return mysql_fetch_array($result_set);
   }
   
  private function comfirm_query($result){
    if(!$result){
        $output = "Database query failed: ".mysql_error()."<br/><br/>";
        $output .="Last SQL query: ".$this->last_query;
        die($output);
    }
   }
   
   public function where_between($field, $min, $max, $connector = FALSE){
       $between = $connector ? " {$connector} " : '';
       $between .= "({$field} >= '{$min}' ";
       if(!empty($max)){
       $between .= "AND {$field} <= '{$max}'";
       }
       $between .= ')';
       return $between;
   }

}

$database = new MySQLDatabase();

$db =& $database;

?>