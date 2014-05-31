<?php require_once("includes/initialize.php"); ?>
<?php
if (!isset($session->cusid)) {
    redirect_to("registern.php");
    exit;
}

 $photo = Customers::find_by_id(2);
 
 if(isset($_POST['submit'])){
	redirect_to('index.php');
 }
?>





<ol></ol><!doctype html>
<?php require_once('layouts/header.php'); ?>
    
     <p class="tag_direction2"><a class="readmore" href="index.html">Home</a> > <a class="readmore" href="#">Contact</a> > Contact</p>
     <?php echo output_message($message); ?>
     <br/>
     <h2 class="product_head2">Contact Wolfgang</h2> </p>
     <hr class="separate_line">
     <br/>
     <div class="holething">
         

<div class="contact_form">
	<form name=sa_htmlform style="margin:0px" onsubmit="return sa_contactform()" method="POST">
<table>

<tr><td> Name: <span style="color:#D70000"><?php echo $photo->ctitle . " ". $photo->cfname ." ". $photo->clname; ?></span><br></td></tr>
<tr><td>Billing Address: <span style="color:#D70000"><?php echo $photo->cadress1 . " ". $photo->cadress2 ; ?></span><br></td></tr>
<tr><td>Billing City: <span style="color:#D70000"><?php echo $photo->ccity; ?></span><br></td></tr>
<tr><td>Billing Province <span style="color:#D70000"><?php echo $photo->cprovince; ?></span><br></td></tr>
<tr><td>Billing Postal Code <span style="color:#D70000"><?php echo $photo->cpcode; ?></span><br></td></tr>
<tr><td>Billing Country <span style="color:#D70000"><?php echo $photo->ccounty; ?></span><br></td></tr>

<tr><td>Shipping Address: <span style="color:#D70000"><?php echo $photo->csadress1 . " ". $photo->csadress2 ; ?></span><br></td></tr>
<tr><td>Shipping City: <span style="color:#D70000"><?php echo $photo->cscity; ?></span><br></td></tr>
<tr><td>Shipping Province <span style="color:#D70000"><?php echo $photo->csprovince; ?></span><br></td></tr>
<tr><td>Shipping Postal Code <span style="color:#D70000"><?php echo $photo->cspcode; ?></span><br></td></tr>
<tr><td>Shipping Country <span style="color:#D70000"><?php echo $photo->cscounty; ?></span><br></td></tr>
<tr><td>Email: <span style="color:#D70000"><?php echo $photo->cemail; ?></span><br></td></tr>
<!--<tr><td>Phone Number: <span style="color:#D70000"><?php echo $photo->product_name; ?></span><br></td></tr>
<tr><td>Message: <span style="color:#D70000"><?php echo $photo->product_name; ?></span><br></td></tr> -->
<tr><td><input type="submit" value="Home" style="font-weight:bold" name="submit"></td></tr>
</table>
</form>

</div>
	</div>

         </div>

<?php require_once('layouts/footer.php'); ?>



</body>
</html>
