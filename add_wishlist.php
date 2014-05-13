<?php

require_once('includes/initialize.php');
if (!isset($session->cusid)) {
    redirect_to("registern.php");
    exit;
}

if(!empty($_REQUEST['item'])){
    $item = new Wishlist();
    $item->cus_id = $session->cusid;
    $item->item_id = intval($_REQUEST['item']);
    
    if($item->save()){
        redirect_to($_SERVER['HTTP_REFERER']);
    }
}
?>
