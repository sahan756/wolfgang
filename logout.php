<?php
require_once('includes/initialize.php');

if(!empty($session->cusid)){
    $session->cu_logout();
    redirect_to("index.php");
}
?>
