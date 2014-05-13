<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php require_once("../../includes/initialize.php");
if(!$session->is_logged_in()){
    redirect_to("index.php");
}
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Wolfgang Admin Pannel</title>
<link rel="stylesheet"  type="text/css" href="css/style_admin_home.css" />
</head>

<body>
 <div id="wrap">
       <center><img src="images/logo-02-01 small.png" /></center><br/>
       <p class="para"><a href="#" style="color:#069;">Logout</a></p>
   
      <div id="tile_wrap">
      
      	<div id="my_profile" class="my_style">
        	<a href="editadmin.php" class="profile_link"><img src="images/no_image.png" class="image_in" />
            <p class="toc">Edit My Profile</p></a>
        
        </div>
        
        <div id="password" class="my_style">
        	<a href="#" class="profile_link"><img src="images/change-password.png" class="image_in_02" />
            <p class="toc2">Change Password</p></a>
        
        </div>
        
        <div id="new_admin" class="my_style">
        	<a href="create_newadmin.php" class="profile_link"><img src="images/Admin-icon.png" class="image_in_02" />
            <p class="toc3">New Admin</p></a>
        
        </div>
        
        <div id="invoice" class="my_style">
        	<a href="#" class="profile_link"><img src="images/involer.png" class="image_in_02" />
            <p class="toc3">Viwe Invoice</p></a>
        
        </div>
        
        <div id="add_product" class="my_style">
        	<a href="admin_page.php" class="profile_link"><img src="images/add-item-icon.png" class="image_in" />
            <p class="toc">Add New Product</p></a>
        
        </div>
        
        <div id="edit_product" class="my_style">
        	<a href="edit_product.php" class="profile_link"><img src="images/edit-notes.png" class="image_in_02" />
            <p class="toc2">Edit Product</p></a>
        
        </div>
        
        <div id="remove_product" class="my_style">
        	<a href="list_photos.php" class="profile_link"><img src="images/f02a629829e9.png" class="image_in_02" />
            <p class="toc2">Remove Product</p></a>
        
        </div>
        
        <div id="customer" class="my_style">
        	<a href="#" class="profile_link"><img src="images/user-group-icon.png" class="image_in" />
            <p class="toc">Viwe Customer</p></a>
        
        </div>

      
      </div>
    
 </div>

</body>
</html>
