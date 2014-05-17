<?php require_once("includes/initialize.php"); 

if(!empty($_REQUEST['code'])){
    $customer = Customers::find_by_code(trim($_REQUEST['code']));
}

if(isset($_POST['submit']) && !empty($customer)){
    if($customer->reset_password()){
        $message = "Password reset successfully";
    } else {
        if(!empty($customer->errors)){
            $message = "";
            foreach ($customer->errors as $error){
                $message .= $error . "<br/>";
            }
        }
    }
}

?>
<!doctype html>
<?php require_once('/layouts/header.php'); ?>     
    <br/>    
    <br/>
    <style>
        .info{
            margin-top: 0;
        }
        
        .sign_in{
            float: left;
            margin-bottom: 25px;
        }
    </style>
     
    <h1 class="register_head">Reset password</h1>
    <?php echo output_message($message); ?>
    <hr color="#E8E8E8" size="1px" style="margin-top:-10px;"><br>
    
    
      <form class="formsec" method="POST">
    <div class="sign_in">
    	<h1 class="inner_head">Reset your password </h1>
        <hr color="#E8E8E8" width="275px" size="1px" style="margin-top:-8px; float:left; margin-left:10px;"><br>
        
        <input type="hidden" name="code" value="<?php echo !empty($_REQUEST['code']) ? trim($_REQUEST['code']) : '' ?>" />
        
        <p class="info">Email</p><br/>        
        <input class="textarea" type="text" disabled="true" value="<?php echo !empty($customer) ? $customer->cemail : '' ?>" /><br/>
        
        <p class="info">New password</p><br/>        
        <input class="textarea" type="password" name="pass" /><br/>
        
        <p class="info">Confirm new password</p><br/>        
        <input class="textarea" type="password" name="conf_pass" /><br/>
        
         <center><input type="submit" name="submit" value="Reset password" class="s_button"></center><br/>
         
      </form>
    
</div>

<?php require_once('/layouts/footer.php'); ?>



</body>
</html>
