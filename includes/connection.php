<?php

  require("constants.php");
  
  $connection = mysql_connect(DB_SERVER,DB_USER);
  
    if(!$connection){
        die("Database Connection failed".mysql_error());
    }
    $db_select = mysql_select_db(DB_NAME,$connection);
    
    if(!$db_select){
        die("database selection fail : ".mysql_error());
    }
    
  ?>