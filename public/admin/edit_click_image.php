<?php
require_once("../../includes/initialize.php");
?>

<?php
if (empty($_GET['id'])) {
    $session->message("No photograp ID was provided");
    // redirect_to('index.php');
}
( $photo = Photograph::find_by_id($_REQUEST['id']));
$max_file_size = 1048576;

//$photos= new Photograph();


if (isset($_POST['submit'])) {
//   if($photo->destroy_pic()){
//    $photo->attach_file($_FILES['file_upload']);
//    //$update_product = $photo->update();
//    //$session->message("The photo {$photo->filename} was deleted");
//    if($photo->update()){
//    redirect_to('edit_product_image.php');
//    $massage="sucess";
//    }
//   }else{
//    $session->message("The photo cound not be deleted");
//   // redirect_to('edit_product.image.php');
//   }
    $photo->attach_file($_FILES['file_upload']);
    if ($photo->update()) {
        redirect_to('edit_product_image.php');
        $massage = "sucess";
    }
}
?>



<?php //include_layout_template('header.php');
 //var_dump($_SERVER);
 require_once('../layouts/header1.php');
 ?>
 <center><h1 class="main_toc">Edit Product Image</h1></center>
 <?php require_once('../layouts/header2.php'); ?>
 


<a href="edit_product_image.php">&laquo; Back</a><br/>
<br/>
<div style="margin-left: 20px;">
    <img src="../<?php echo $photo->image_path(); ?>" width="400"/>
    </br>Product Name :<?php echo $photo->product_name; ?>
    </br>Product Category :<?php echo $photo->pcategory; ?>
    </br>Size :<?php echo $photo->psize; ?>
    </br>Colour :<?php echo $photo->pcolor; ?>
    </br>Price :<?php echo $photo->pprize; ?>
    </br>Type :<?php echo $photo->ptype; ?>
    
</div>
<?php echo output_message($message); ?>
<form action="edit_click_image.php" enctype="multipart/form-data" method="post">
    <input type="hidden" name="id" value="<?php echo $_REQUEST['id']; ?>" />
    <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size; ?>" />
    <p class="title">Chose your Image : <input type="file" name="file_upload" value="<?php echo $photo->filename ?>" /> </p> 
    <p class="title">Product Name :  <?php echo $photo->product_name; ?> </p>



    <br/>
    <input type="submit" value="Update to new picture" name="submit"><input type="reset" value="Cancel" name="cancel">
</form>





<?php include_layout_template('footer.php'); ?>