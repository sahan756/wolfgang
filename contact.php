<?php require_once("includes/initialize.php"); ?>


<?php

 //$message="";
 if(isset($_POST['submit'])){
    $photo= new Contacts();
    
    //$photo->condate=$_POST['condate'];
    $photo->contitle=$_POST['contitle'];
    $photo->confname=$_POST['confname'];
    $photo->conlname=$_POST['conlname'];
    $photo->conemail=$_POST['conemail'];
    $photo->contel=$_POST['contel'];
    $photo->conmass=$_POST['conmass'];
    
    
    $status = sendMail($photo->conemail, "Wolfgang "," {$photo->contitle} {$photo->confname} {$photo->conlname} THANK FOR YOUR REVIEW . WE WILL REPLY TO YOUR EMAIL SOON . KEEP SHOPPING");
   
   
    if($photo->save()){
        $session->message(" successfully Enter");
        redirect_to('contact.php');
    }else{
        $message=join("<br/>",$photo->errors);
    }
 }
 


?>


<ol></ol><!doctype html>
<?php require_once('/layouts/header.php'); ?>
    
     <p class="tag_direction2"><a class="readmore" href="index.html">Home</a> > <a class="readmore" href="#">Contact</a> > Contact</p>
     <?php echo output_message($message); ?>
     <br/>
     <h2 class="product_head2">Contact Wolfgang</h2> </p>
     <hr class="separate_line">
     <br/>
     <div class="holething">
         <div class="contact_info">
        
<pre><strong>Head Office</strong>     
WOLFGANG,
Nawala, 
Dehiwala, 
Sri Lanka
Telephone : +94-11-458712
Fax : +94-11-124853</pre><br/>

<pre><strong>Online Inquiries and Orders</strong>
Telephone : +94-11-4512078
Email : customercare@wolfgang.lk
Working Hours : 10am - 8pm (GMT 5.30+)</pre><br/>


<pre><strong>Gift Voucher Inquiries</strong>
Email : giftvoucher@wolfgang.lk</pre>

</div>

<div class="contact_form">
	<form name=sa_htmlform style="margin:0px" onsubmit="return sa_contactform()" method="POST">
<table>
<tr><td>Title:<br><select name="contitle" size="1"><option value="">Select</option><option value="Mr.">Mr.</option><option value="Mrs.">Mrs.</option><option value="Miss">Miss</option><option value="Ms.">Ms.</option><option value="Dr.">Dr.</option><option value="Prof.">Prof.</option><option value="Other">Other</option></select></td></tr>
<tr><td>First Name: <span style="color:#D70000">*</span><br><input type="text" name="confname" required /></td></tr>
<tr><td>Second Name: <span style="color:#D70000">*</span><br><input type="text" name="conlname" required /></td></tr>
<tr><td>E-mail Address: <span style="color:#D70000">*</span><br><input type="text" name="conemail" required /></td></tr>
<tr><td>Phone Number: <span style="color:#D70000">*</span><br><input type="text" name="contel" required /></td></tr>
<tr><td>Message: <span style="color:#D70000">*</span><br><textarea name="conmass" cols="42" rows="9" required></textarea></td></tr>
<tr><td><input type="submit" value="Send Message" style="font-weight:bold" name="submit"></td></tr>
</table>
</form>

</div>
	</div>

         </div>

<?php require_once('/layouts/footer.php'); ?>



</body>
</html>
