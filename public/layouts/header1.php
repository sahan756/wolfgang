<?php require_once("../../includes/initialize.php"); 
//var_dump($session);
if (!empty($session)) {
    $user = User::find_by_id($session->user_id);
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Wolfgang Admin Pannel</title>
<link rel="stylesheet"  type="text/css" href="css/style_admin_profile.css" />
</head>

<body>
<center><div  class="logo"><br/><img src="images/logo-02-01 small-01.png"/></div></center>
 <div id="wrap">
 		<br/>
        <p class="para">Hello <?php 
        $user = User::find_by_id($session->user_id);
        echo $user->username;
 ?>, <a href="logout.php" class="logout">Logout</a></p>