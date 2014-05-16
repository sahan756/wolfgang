<?php
require_once("../../includes/initialize.php");



if(!$session->is_logged_in()){
redirect_to("login.php");
}
?>


<?php
   if(empty($_GET['id'])){
    $session->message("No photograph ID was provided");
    redirect_to('index.php');
   }
   
   $Product= new Product();
   $Product->id=$_GET['id'];
   
   $Product=Product::find_by_id($_GET['id']);
 // $deleted =  $Product->delete_one();
  
  
   
   if($Product->destroyone()){
    $session->message("The Image was deleted");
    redirect_to('edit_click.php?id='.$Product->id);
    
   }else{
    $session->message("The photo cound not be deleted");
    redirect_to('edit_click.php?id='.$Product->id);
   }
   
?>
<?php if(isset($database)){
    $database->close_connection();
}
    ?>