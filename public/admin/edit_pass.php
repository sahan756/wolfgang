<?php
    require_once("../../includes/initialize.php");

    if (!$session->is_logged_in()) {
        redirect_to("index.php");
    }

    ?>
     <?php
    
    $photo = User::find_by_id($session->user_id);
    //$photo = User::find_by_id($_REQUEST['id']);
    
    
   if (isset($_POST['commit'])) {

   
        if ($photo->id == 1) {
            $session->message("The admin {$photo->username} cant update");
            redirect_to('edit_pass.php');
        } else {
		
            $photo->extra = array(
                'old_password' => $_POST['oldpassword'],
                'new_password' => $_POST['password'],
                'conf_password' => $_POST['cpassword']
            );
            
            
            
	       if ($photo->update_password()) {
                //$new_comment->try_to_send_notification();
                $session->message("The admin {$photo->username} updated");
                redirect_to("edit_pass.php");
            } else {
                //$session->message("there is error updating admin");
                if(!empty($photo->errors)){
                    foreach ($photo->errors as $error) {
                        $message .= $error . "<br/>";
                    }
                }
                
            }
        }
    }
    
    
    
    
    ?>



<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Edit Your Password Please</title>
<link rel="stylesheet" href="css/popup_style.css" type="text/css">
</head>

<body>

	<center><div  class="logo"><img src="images/logo-02-01 small-01.png"/></div></center><br/>
   
   <?php echo output_message($message); ?>
   <form method="post" action="edit_pass.php">
   
   <div class="content">
   <br/>
    <center><h1 class="topic">Enter Your Currunt Password</h1><input class="text_box" name="oldpassword" type="password"></center>
    <br/>
    <center><h1 class="topic">Enter Your New Password</h1><input class="text_box2" name="password" type="password"></center>
    <br/>
    <center><h1 class="topic">Confirm Your New Password</h1><input class="text_box3" name="cpassword"  type="password"></center>
    <br/>
   
    <center><input class="buttons"  type="submit" name="commit" value="Change" onclick="return confirm('Are you shure you want to Edit');">
        <input class="buttons" type="button" name="cancel" value="Close" onclick="window.close();"></center>
    <br/>
    </div>
   </form>

</body>
</html>
