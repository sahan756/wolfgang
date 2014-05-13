 <?php
    require_once("../../includes/initialize.php");

    if (!$session->is_logged_in()) {
        redirect_to("index.php");
    }
    
   
    ?>
    
    
    <?php
    
    $photo = User::find_by_id($session->user_id);
    //$photo = User::find_by_id($_REQUEST['id']);
    ?>

<?php //include_layout_template('header.php');
 //var_dump($_SERVER);
 require_once('../layouts/header1.php');
 ?>
 <center><h1 class="main_toc">Edit My Admin</h1></center>
 <?php require_once('../layouts/header2.php'); ?>
      
      <div id="admin_content">
      
      <script type="text/javascript">
		// Popup window code
		function newPopup(url) {
			popupWindow = window.open(
				url,'popUpWindow','height=350,width=400,left=400,top=400,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
		}
		</script>
      
      	<p class="line"><p class="detail">Name </p><p class="about_user"><?php echo $photo->username; ?></p><p class="command"><a href="JavaScript:newPopup('edit_user.php');" class="edit">Edit</a></p> 
      	
        <p class="line"><p class="detail">Password </p><p class="about_user"><?php echo $photo->password; ?></p><p class="command"><a href="JavaScript:newPopup('edit_pass.php');" class="edit">Edit</a></p> 
      
      
        
      </div>
    
 </div>
 
 <center><div  class="logo2"><br/></div></center>

</body>
</html>
