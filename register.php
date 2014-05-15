<?php require_once("includes/initialize.php"); ?>




<?php

if(isset($_POST['esign'])){
     
    
    
    $username=trim($_POST['semail']);
    $password=trim($_POST['spass']);
    $session->message("Username / password wrong");
   // $hashed_password=sha1($password);
    
    $found_user=Customers::authentucate($username,$password);
    
    if($found_user){
     //   var_dump($found_user);
        //$session->login($found_user);
       // log_action('Login',"{$found_user->username} logged in .");
	$session->message("Login successfull {$found_user->cfname} {$found_user->clname}");
        redirect_to("register.php");
	
    }else{
        $message="Username / password wrong";
	$session->message("Username / password wrong");
    }
    
}else{
    $username="";
    $password="";
}




 
 
 //$message="";
 if(isset($_POST['submit'])){
    $photo= new Customers();
    
    $photo->ctitle=$_POST['ctitle'];
    $photo->cfname=$_POST['cfname'];
    $photo->clname=$_POST['clname'];
    $photo->cadress1=$_POST['cadress1'];
    $photo->cadress2=$_POST['cadress2'];
    $photo->cadress3=$_POST['cadress3'];
    $photo->ccity=$_POST['ccity'];
    $photo->cemail=$_POST['cemail'];
    $photo->cpassword=$_POST['cpassword'];
    $ccpassword=$_POST['ccpassword'];
   
    
    if($ccpassword==$photo->cpassword)
    {
    if($photo->save()){
        $session->message("Registration successfully.{$photo->cfname}. .{$photo->clname}");
        redirect_to('register.php');
    }else{
        $message=join("<br/>",$photo->errors);
    }
    }
    else{
	$session->message("Password ddn't match");
    }
 }
 


?>




<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Wolfgang-Men</title>
<link rel="stylesheet" type="text/css" href="css/supper.css"/>
<link rel="stylesheet" type="text/css" href="css/register.css"/>
</head>

<body>
<div id="wrap">
	<img class="logo" src="images/logo-02-01 small.jpg">
    <p class="headsec"><a class="headsec_link" href="register.php">Sign in or Register</a> | <a class="headsec_link" href="#">My Account</a> | <a class="headsec_link" href="#"><strong><img src="images/shopping7.png"> My Cart</strong></a></p><br/>
    <p class="headsec">Help Line <strong><span class="hotline">+94 77 600 1 600</span></strong></p><br/>
    <p class="headsec"><span style="font-size:10px;">( open 24 hourse evereyday )</span></p><br/>
    
    <p class="headsec"> <form action='/search' id='search-form' method='get' target='_top'>
    <input id='search-text' name='q' placeholder='Enter Your Keyword or Product code' type='text'/>
    <button id='search-button' type='submit'><span>Go</span></button>
  </form></p>
 
 	<ul class="maintab">
    	<li class="tab"><a class="tablink1" href="index.php">Home</a></li>
        <li class="tabinsub"><a class="tablink" href="product_list.php?cat=Men">Men</a>
        	<ul class="mensub">
            	<li class="subtab"><a class="subtablink" href="product_list.php?cat=Men&type=Office">Office<p class="arrow"> > </p></a></li>
                <li class="subtab"><a class="subtablink" href="product_list.php?cat=Men&type=Wedding">Wedding<p class="arrow"> > </p></a></li>
                <li class="subtab"><a class="subtablink" href="product_list.php?cat=Men&type=Casual">Casual<p class="arrow"> > </p></a></li>
                <li class="subtab"><a class="subtablink" href="product_list.php?cat=Men&type=Party">Party<p class="arrow"> > </p></a></li>
                <li class="subtab1"><a class="subtablink" href="product_list.php?cat=Men&type=Fashion">Fashion<p class="arrow"> > </p></a></li>
            </ul>
        </li>
        <li class="tabinsub"><a class="tablink" href="product_list.php?cat=Kids">Kids</a>
        	<ul class="mensub">
            	<li class="subtab"><a class="subtablink" href="product_list.php?cat=Kids&type=NewBorn">New Born<p class="arrow"> > </p></a></li>
                <li class="subtab"><a class="subtablink" href="product_list.php?cat=Kids&type=BabyCasual">Baby Casual<p class="arrow"> > </p></a></li>
                <li class="subtab"><a class="subtablink" href="product_list.php?cat=Kids&type=College">College<p class="arrow"> > </p></a></li>
                <li class="subtab"><a class="subtablink" href="product_list.php?cat=Kids&type=Party">Party<p class="arrow"> > </p></a></li>
                <li class="subtab"><a class="subtablink" href="product_list.php?cat=Kids&type=Teenagers">Teenagers<p class="arrow"> > </p></a></li>
                <li class="subtab1"><a class="subtablink" href="product_list.php?cat=Kids&type=Fashion">Fashion<p class="arrow"> > </p></a></li>
            </ul>        
        </li>
        <li class="tabinsub"><a class="tablink" href="#">Accessorice</a>
        	<ul class="mensub">
            	<li class="subtab"><a class="subtablink" href="#">Shokes<p class="arrow"> > </p></a></li>
                <li class="subtab"><a class="subtablink" href="#">Polishes<p class="arrow"> > </p></a></li>
                <li class="subtab1"><a class="subtablink" href="#">Otheres<p class="arrow"> > </p></a></li>
            </ul>
        </li>
        <li class="tab"><a class="tablink_notsub" href="#">Gift voucher</a></li>
        <li class="tab"><a class="tablink_notsub" href="#">About Wolfgang</a></li>
        <li class="tab"><a class="tablink_notsub" href="#">Contact us</a></li>
        <li class="tab"><a class="tablink2" href="#">Dilevery</a></li>
    </ul>   
    <br/>    
    <br/>
    <?php echo output_message($message); ?>
    
    <?php 
       // $user = Customers::find_by_id($session->user_id);
       // echo $user->username;
 ?>
    
    <h1 class="register_head">REGISTER WITH US OR SIGN IN</h1>
    <hr color="#E8E8E8" size="1px" style="margin-top:-10px;"><br>
    
    <div class="register_today">
    	<h1 class="inner_head">NEW USERS - CREAT AN ACCOUNT</h1>
        <hr color="#E8E8E8" width="450px" size="1px" style="margin-top:-8px; float:left; margin-left:10px;"><br>
        <form class="formsec" method="POST">
        	<p class="rawone"><span class="requerd">*</span><span class="main-Toc">Name :</span>
            
	    
	    <select name="ctitle" style="background-color:#E6F4FF;">
            <option value="Title">Title</option>
            <option value="Mr">Mr</option>
            <option value="Mrs">Mrs</option>
            <option value="Miss">Miss</option>
            <option value="dr">Dr</option>
            </select>
            First Name : <input type="text" class="textsec" name="cfname">
	    Last Name : <input type="text" class="textsec" name="clname"></p><br/>
            
            <p class="rawone"><span class="requerd">*</span><span class="main-Toc">
	    Address : </span><input type="text" class="textsec" name="cadress1"><span class="space"> </span>
	    Address Line 2 : <input type="text" class="textsec" name="cadress2"></p><br/>
            <p class="rawtwo">Address Line 3 : <input type="text" class="textsec"  name="cadress3"></p><br/>
            
            <p class="rawone"><span class="requerd">*</span><span class="main-Toc">
	    City : </span><input type="text" class="textsec" name="ccity"></p><br/>      	
        <p class="rawone"><span class="requerd">*</span><span class="main-Toc">
	E - Mail : </span><input type="email" class="textsec" name="cemail"></p><br/> 
        <p class="rawone"><span class="requerd">*</span><span class="main-Toc">
	Password : </span><input type="password" class="textsec" name="cpassword"></p><br/> 
        
        <p class="rawone"><span class="requerd">*</span><span class="main-Toc">
	Confirm Password : </span><input type="password" class="textsec" name="ccpassword"></p><br/> 
        
        <center><input type="submit" name="submit" value="Submit" class="s_button"></center>
        
        </form>
                
    </div>
      <form class="formsec" method="POST">
    <div class="sign_in">
    	<h1 class="inner_head">REGISTERED USERS - SIGN IN</h1>
        <hr color="#E8E8E8" width="275px" size="1px" style="margin-top:-8px; float:left; margin-left:10px;"><br>
        
        <p class="info">Please sign in using your user name and E-mail address</p><br/>
        <p class="topic"><span class="requerd">*</span>E-mail Address</p><br/>
        <input class="textarea" type="email" name="semail"><br/>
        <p class="topic2"><span class="requerd" >*</span>Password</p><br/>
         <input class="textarea2" type="password" name="spass"><br/>
         <center><input type="submit" name="esign" value="Sign In" class="s_button"></center><br/>
         <a href="#" class="forget">Forget my Password</a>
    </div>
      </form>
    
</div>

<div class="footer">

	<div class="footer_wrap">
    
    <img src="images/shipping.png" style="float:left;"> <p class="top_dileveryicon"><b>FREE HOME DILEVERY</b></p> 
    <img src="images/tele.png" style="float:left;"> <p class="top_dileveryicon"><b>HOT LINE : +94 77 600 1 600</b></p>
    <img src="images/gift.png" style="float:left;"> <p class="top_dileveryicon"><b>WRAP YOUR GIFT</b></p> 
    <img src="images/policy.png" style="float:left;"> <p class="top_dileveryicon4"><b>OUR WARENTY</b></p>
    
    
    	<div class="first_set">
    	<h4 class="footer_title">About Wolfgang</h4>
        <ul class="tags">
			<li class="footer_tags"><a class="footer_link" href="#">Wolfgang</a></li>
            <li class="footer_tags"><a class="footer_link" href="#">Contact us</a></li>
            <li class="footer_tags"><a class="footer_link" href="#">Map</a></li>
            <li class="footer_tags"><a class="footer_link" href="#">Store locater</a></li>
            <li class="footer_tags"><a class="footer_link" href="#">Terms and conditions</a></li>
            <li class="footer_tags"><a class="footer_link" href="#">Gift card</a></li>
            <li class="footer_tags"><a class="footer_link" href="#">Dilevery</a></li>
            <li class="footer_tags"><a class="footer_link" href="#">FAQs</a></li>
            <li class="footer_tags"><a class="footer_link" href="#">Policy</a></li>
        </ul>
        </div>
        
        
        <div class="second_set">
    	<h4 class="footer_title">Our Stores</h4>
        <ul class="tags">
			<li class="footer_tags"><a class="footer_link" href="#">Colombo</a></li>
            <li class="footer_tags"><a class="footer_link" href="#">Wattale</a></li>
            <li class="footer_tags"><a class="footer_link" href="#">Malabe</a></li>
            <li class="footer_tags"><a class="footer_link" href="#">Nugegoda</a></li>
            <li class="footer_tags"><a class="footer_link" href="#">Panadure</a></li>
            <li class="footer_tags"><a class="footer_link" href="#">Maharagama</a></li>
            <li class="footer_tags"><a class="footer_link" href="#">Rathnapura</a></li>
            <li class="footer_tags"><a class="footer_link" href="#">Kandy</a></li>
            <li class="footer_tags"><a class="footer_link" href="#">Jaffna</a></li>
        </ul>
        </div>
     
        <div class="third_set">
    	<h4 class="footer_title">Shopping Guid</h4>
        <ul class="tags">
			<li class="footer_tags"><a class="footer_link" href="#">How to shopping</a></li>
            <li class="footer_tags"><a class="footer_link" href="#">Benifites</a></li>
            <li class="footer_tags"><a class="footer_link" href="#">Our Garantee</a></li>
            <li class="footer_tags"><a class="footer_link" href="#">Wolfgang History</a></li>
            <li class="footer_tags"><a class="footer_link" href="#">Supper Services</a></li>
            <li class="footer_tags"><a class="footer_link" href="#">Wolfgang Online payment</a></li>
        </ul>
        </div>
        
        <div class="card_set">
    	<h4 class="footer_title">Payment Type</h4>
        	<img src="images/yoo_icons_credit_cards/48/visa_48.png">
            <img src="images/yoo_icons_credit_cards/48/mastercard_48.png"><br/>
            <img src="images/yoo_icons_credit_cards/48/amex_48.png">
            <img src="images/yoo_icons_credit_cards/48/paypal_48.png"><br/>
            <img src="images/yoo_icons_credit_cards/48/gift_white_48.png">
        </div>
        
        <div class="media_set">
    	<h4 class="footer_title">You Can Follow Us</h4>
        	<a href="#"><img class="media_link" src="images/social media/Social Media Buttons [Converted]-12.png"></a>
            <a href="#"><img class="media_link2" src="images/social media/Social Media Buttons [Converted]-13.png"></a><br/>
            <a href="#"><img class="media_link3" src="images/social media/Social Media Buttons [Converted]-08.png"></a>
            <a href="#"><img class="media_link4" src="images/social media/Social Media Buttons [Converted]-09.png"></a><br/>
            <a href="#"><img class="media_link5" src="images/social media/Social Media Buttons [Converted]-10.png"></a>
            <a href="#"><img class="media_link6" src="images/social media/Social Media Buttons [Converted]-11.png"></a>
        </div>
        
        <br/>
        
        <p class="allright">Copyright © 2013 WOLFGANG. All Rights Reserved. | wolfgang | Feedback</p>
        
    </div>
	
</div>



</body>
</html>
