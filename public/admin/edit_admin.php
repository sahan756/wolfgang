<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->




    <?php
    require_once("../../includes/initialize.php");

    if (!$session->is_logged_in()) {
        redirect_to("index.php");
    }
    ?>


    <?php
    if (empty($_GET['id'])) {
        $session->message("No photograp ID was provided");
        // redirect_to('index.php');
    }

    $photo = User::find_by_id($_REQUEST['id']);


    if (isset($_POST['commit'])) {


        if ($photo->id == 1) {
            $session->message("The admin {$photo->username} cant update");
            redirect_to('editadmin.php');
        } else {


            $username = trim($_POST['login']);
            $password = trim($_POST['password']);

//    $photo->username = trim($_POST['login']);
//    $photo->password = trim($_POST['password']);
            $photo->username = $username;
            $photo->password = User::get_encrypted_password($password);

            $update_username = $photo->update();
            //var_dump($update_product);

            if ($update_username) {
                //$new_comment->try_to_send_notification();
                $session->message("The admin {$photo->username} updated");
                redirect_to("editadmin.php");
            } else {
                $session->message("there is error updating admin");
            }
        }
    }

    if (isset($_POST['commitback'])) {
        redirect_to('editadmin.php');
        $session->message("this work");
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
                <h1>Update Admin </h1>


                <br/>User Id : <?php echo $photo->id; ?>
                <br/>User Name : <?php echo $photo->username; ?>
                <br/>Password : <?php //echo $photo->password; ?>
                <br/>
                <br/>

<?php echo output_message($message); ?>


                <form method="post" action="edit_admin.php">

                    <input type="hidden" name="id" value="<?php echo $_REQUEST['id']; ?>" />
                    <p>New User Name :
                    <p><input type="text" name="login" value="<?php echo $photo->username; ?>" placeholder="Username or Email"></p>
                    </p>
                    <p>New Password :
                    <p><input type="password" name="password" value="<?php echo $photo->password; ?>" placeholder="Password"></p>
                    </p>

                    <p class="submit"><input type="submit" name="commit" value="Update"></p>
                    <p class="submit"><input type="submit" name="commitback" value="Back"></p>
                </form>
            </div>


            <div class="login-help">

            </div>
        </section>
    </body>
</html>


