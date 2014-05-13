<ol></ol><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Wolfgang-Men</title>
<link rel="stylesheet" type="text/css" href="css/supper.css"/>
<link rel="stylesheet" type="text/css" href="css/shoe_page.css"/>

	<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
		
   <script src="js/ajax.js"></script>
    <script src="js/example.js"></script>
    <script src="js/jquery.color-RGBa-patch.js"></script>
    
    <script src='js/jquery-1.8.3.min.js'></script>
	<script src='js/jquery.elevatezoom.js'></script> 
</head>

<?php require_once('/layouts/pheader.php'); ?>
    
     <p class="tag_direction2"><a class="readmore" href="index.html">Home</a> > <a class="readmore" href="men.html">Men</a> > Dark Brown office shoe
     <br/> 
     <h2 class="product_head2">Dark Brown office shoe</h2> </p>
     
     
     <!--Zoom Slider-->
     <div class="galerry_are">
     	<!--<img class="shoe_image" src="images/shoe 01/Wolfgang_shoe1.jpg">-->
        
<div id="gallery_01">
<img id="img_01" src="public/images/1.jpg" data-zoom-image="public/images/adventure-time-cool-poster-1366x768-wallpaper-14585.jpg"/>
<br />

<div id="gal1" align="center">
 
  <a class="thumb_link" href="#" data-image="images/small/sm1.jpg" data-zoom-image="images/large/m1.jpg">
    <img id="img_01" src="images/thumb/m1.jpg" border="1"  />
  </a>

  <a class="thumb_link" href="#" data-image="images/small/sm2.jpg" data-zoom-image="images/large/m2.jpg">
    <img id="img_01" src="images/thumb/m2.jpg" border="1"  />
  </a>

  <a class="thumb_link" href="#" data-image="images/small/sm3.jpg" data-zoom-image="images/large/m3.jpg">
    <img id="img_01" src="images/thumb/m3.jpg"  border="1" />
  </a>

<a class="thumb_link" href="#" data-image="images/small/sm4.jpg" data-zoom-image="images/large/m4.jpg">
    <img id="img_01" src="images/thumb/m4.jpg" border="1" />
  </a>
  </div>

</div>
<script>
//initiate the plugin and pass the id of the div containing gallery images
$("#img_01").elevateZoom({gallery:'gallery_01', cursor: 'pointer', galleryActiveClass: 'active', imageCrossfade: true, scrollZoom : true, easing : true, cursor: "crosshair", loadingIcon: 'http://www.elevateweb.co.uk/spinner.gif'}); 

//pass the images to Fancybox
$("#img_01").bind("click", function(e) {  
  var ez =   $('#img_01').data('elevateZoom');	
	$.fancybox(ez.getGalleryList());
  return false;
});
	</script>

           
     </div>

     <div class="discr">
     	<p class="details">Original Napa Leather shoes only from wolfgang. Great Finish and confurteble. Save your budget also.</p>
        <p class="status_topic">Availability : </p><p class="status"> In stock</p>
        <p class="price">LKR 2,399.99</p>
        <p class="p_code">Product Code : </p><p class="code">WLF25412084S</p>
        <p class="media"><a href="#"><img src="images/social media/social_facebook_box_blue_16.png" style="padding-right:6px;"></a><a href="#"><img src="images/social media/social_google_box_16.png" style="padding-right:6px;"></a><a href="#"><img src="images/social media/social_twitter_box_blue_16.png"></a></p>
     <br>
     <div class="choice">
     	<p class="select_size"><p class="requerd">*</p>Select Your Size</p>
        <select name="size" style="background-color:#E6F4FF;">
        <option value="defolt">Select your size</option>
        <option value="40">40</option>
        <option value="41">41</option>
        <option value="42">42</option>
        <option value="43">43</option>
        <option value="44">44</option>
        <option value="45">45</option>
        </select>              
     </div>
     <br/>
     
     <p class="qty">QTY : </p>
        <select class="qty_drop" name="qty" style="background-color:#E6F4FF;">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        </select>
        
     	<p class="cart_to"><a class="cart_link" href="#"><img src="images/shopping7.png"> ADD TO CART</a></p>
        <p class="wish_to"><a class="wish_link" href="#">ADD TO Wish List</a></p>
     
     </div>
                              
      
    
</div>

<?php require_once('/layouts/footer.php'); ?>



</body>
</html>
