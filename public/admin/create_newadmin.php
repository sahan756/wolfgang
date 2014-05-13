<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->



<?php require_once("../../includes/initialize.php");

if(!$session->is_logged_in()){
    redirect_to("index.php");
}

?>

<?php

if(isset($_POST['commit'])){
     
    $new_admin= new User();
    
     //$photo->caption=$_POST['caption'];
    
    $new_admin->username=$_POST['login'];
    $new_admin->password=$_POST['password'];
    
    if($new_admin->create_user()){
        $session->message(" successfully.{$username}");
        redirect_to('create_newadmin.php');
    }else{
        //$message=join("<br/>",$new_admin->errors);
        $message="Fail";
    }
        
        
    }
    
    
    if(isset($_POST['commitback'])){
        redirect_to('index.php');
    }

?>




<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Wolfgang Login Form</title>
  <link rel="stylesheet" href="css/style_login_panel.css">
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>
  <section class="container">
  <center><img src="images/logo-02-01 small.png"/></center>
  <br/>
 
    <div class="login">
      <h1>Create New Admin </h1>
      
            <?php echo output_message($message);?>

      
      <form method="post" action="create_newadmin.php">
        <p>User Name :
        <p><input type="text" name="login" value="" placeholder="Username or Email"></p>
        </p>
        <p>Password :
        <p><input type="password" name="password" value="" placeholder="Password"></p>
        </p>
        
        <p class="submit"><input type="submit" name="commit" value="Create"></p>
        <p class="submit"><input type="submit" name="commitback" value="Back"></p>
      </form>
    </div>
    

    <div class="login-help">
      
    </div>
    </section>
</body>
</html>


