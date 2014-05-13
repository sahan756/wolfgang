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
   
   $photo=Product::find_by_id($_GET['id']);
   if($photo&& $photo->destroy()){
    $session->message("The Product was deleted");
    redirect_to('remove_product.php');
    
   }else{
    $session->message("The photo cound not be deleted");
    redirect_to('index.php');
   }
   
?>
<?php if(isset($database)){
    $database->close_connection();
}
    ?>