<?php require_once("includes/initialize.php"); ?>

<?php

if(isset($_POST['esign'])){
     
    
    
    $username=trim($_POST['semail']);
    //$password=trim($_POST['spass']);
    //$session->message("Username / password wrong");
   // $hashed_password=sha1($password);
    
    $found_user=Customers::recoverpass($username);
    
    if($found_user){
     //   var_dump($found_user);
        //$session->cu_login($found_user);
	
	$status = sendMail($found_user->cemail, "Wolfgang ", "recover your email address  click this link : ");
	
	if($status){
    
        //log_action('Login',"{$found_user->username} logged in .");
	$session->message(" {$found_user->cfname} {$found_user->clname}  , your password recover email has been send . check your inbox");
        redirect_to("forgetpass.php");
	}else{
	    $session->message("Somthing wrong (internet conenction ). insert your email again and try");
	}
	
    }else{
        $message="The email you enter is wrong";
	$session->message("The email you enter is wrong");
    }
    
}else{
    $username="";
    //$password="";
}




 
 
 //$message="";
 
 
// $user= new User();

?>

<ol></ol><!doctype html>
<?php require_once('/layouts/header.php'); ?>     
    <br/>    
    <br/>
     
    <h1 class="register_head">Enter Your email address to get new password</h1>
    <?php echo output_message($message); ?>
    <hr color="#E8E8E8" size="1px" style="margin-top:-10px;"><br>
    
    
      <form class="formsec" method="POST">
    <div class="sign_in">
    	<h1 class="inner_head">Recover your password </h1>
        <hr color="#E8E8E8" width="275px" size="1px" style="margin-top:-8px; float:left; margin-left:10px;"><br>
        
        <p class="info">Please enter your E-mail address</p><br/>
        <p class="topic"><span class="requerd">*</span>E-mail Address</p><br/>
        <input class="textarea" type="email" name="semail"><br/>
        
         <center><input type="submit" name="esign" value="Get New Password" class="s_button"></center><br/>
         
      </form>
    
</div>

<?php require_once('/layouts/footer.php'); ?>



</body>
</html>
