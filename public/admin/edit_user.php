<?php
    require_once("../../includes/initialize.php");

    if (!$session->is_logged_in()) {
        redirect_to("index.php");
    }

    ?>
     <?php
    
    $user = User::find_by_id($session->user_id);
    //$photo = User::find_by_id($_REQUEST['id']);
    $oldUsername = $user->username;
    
    
    if (isset($_POST['commit'])) {


        if ($user->id == 1) {
            $session->message("The admin {$user->username} cant update");
            redirect_to('edit_user.php');
        } else {


            $username = trim($_POST['login']);
            

//    $photo->username = trim($_POST['login']);
//    $photo->password = trim($_POST['password']);
            $user->username = $username;
            

            //$update_username = $user->update();
            $update_username = $user->update_username();
            //var_dump($update_product);

            if ($update_username) {
                //$new_comment->try_to_send_notification();
                //$session->message("The admin {$user->username} updated");
                $message = "The admin {$user->username} updated";
                //redirect_to("editadmin.php");
            } else {
                //$session->message("there is error updating admin");
                $message = !empty($user->errors['username']) ? $user->errors['username'] : '';
                $user->username = $oldUsername;
                //var_dump($user->errors);
            }
            //redirect_to('edit_user.php');
        }
    }
    
    
    
    
    ?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Edit Your Username</title>
<link rel="stylesheet" href="css/popup_style.css" type="text/css">
</head>

<body>

	<center><div  class="logo"><img src="images/logo-02-01 small-01.png"/></div></center><br/>
	<?php echo output_message($message); ?>
   <form method="post" action="edit_user.php">
	
   <div class="content">
   <br/>
    <center><h1 class="topic">Your Current Name</h1>
        <input style="margin-left: 24px;" class="text_box" type="text" value="<?php echo $user->username; ?>" disabled="true"/>
    </center>
    <br/>
    <center><h1 class="topic">Enter Your New Name</h1>
        <input class="text_box2" name="login"  type="text" />
    </center>
    <br/>
   
    <center><input class="buttons"  type="submit" name="commit" value="Change" onclick="return confirm('Are you sure you want to edit?');">
    <input class="buttons" type="button" name="cancel" value="Close" onclick="window.close();"></center>
    <br/>
    </div>
   </form>

</body>
</html>
