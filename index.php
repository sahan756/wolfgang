<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<!doctype html>
<?php require_once('/layouts/header.php'); ?>
    </div>
    <div class="container">	
			<header class="clearfix">
				<h1>Be Simple to select your Shoe <span>Category in various as you want</span></h1>
			</header>
			<div class="main">
				<div id="mi-slider" class="mi-slider">
					<ul>
						<li><a href="#"><img src="images/1.jpg" alt="img01"><h4>Boots</h4></a></li>
						<li><a href="#"><img src="images/2.jpg" alt="img02"><h4>Oxfords</h4></a></li>
						<li><a href="#"><img src="images/3.jpg" alt="img03"><h4>Loafers</h4></a></li>
						<li><a href="#"><img src="images/4.jpg" alt="img04"><h4>Sneakers</h4></a></li>
					</ul>
					<ul>
						<li><a href="#"><img src="images/5.jpg" alt="img05"><h4>Belts</h4></a></li>
						<li><a href="#"><img src="images/6.jpg" alt="img06"><h4>Hats &amp; Caps</h4></a></li>
						<li><a href="#"><img src="images/7.jpg" alt="img07"><h4>Sunglasses</h4></a></li>
						<li><a href="#"><img src="images/8.jpg" alt="img08"><h4>Scarves</h4></a></li>
					</ul>
					<ul>
						<li><a href="#"><img src="images/9.jpg" alt="img09"><h4>Casual</h4></a></li>
						<li><a href="#"><img src="images/10.jpg" alt="img10"><h4>Luxury</h4></a></li>
						<li><a href="#"><img src="images/11.jpg" alt="img11"><h4>Sport</h4></a></li>
					</ul>
					<ul>
						<li><a href="#"><img src="images/12.jpg" alt="img12"><h4>Carry-Ons</h4></a></li>
						<li><a href="#"><img src="images/13.jpg" alt="img13"><h4>Duffel Bags</h4></a></li>
						<li><a href="#"><img src="images/14.jpg" alt="img14"><h4>Laptop Bags</h4></a></li>
						<li><a href="#"><img src="images/15.jpg" alt="img15"><h4>Briefcases</h4></a></li>
					</ul>
					<nav>
						<a href="#">Shoes</a>
						<a href="#">Accessories</a>
						<a href="#">Watches</a>
						<a href="#">Bags</a>
					</nav>
				</div>
			</div>
		</div><!-- /container -->
		<script src="js/jquerylibrarry.js"></script>
		<script src="js/jquery.catslider.js"></script>
		<script>
			$(function() {

				$( '#mi-slider' ).catslider();

			});
		</script>
    
       
    <div id="wrap">

     <br/>
    
    <a href="#"><img src="images/footerbanner2.jpg" style="float:left;"></a>
    <a href="#"><img src="images/footerbanner1.jpg" style="float:left;"></a>
    <a href="#"><img src="images/footerbanner3.jpg"></a>
    
    <br/>
    <br/>
    
    <a href="#"><img src="images/footerbanner6.jpg" style="float:left;"></a>
    <a href="#"><img src="images/footerbanner4.jpg" style="float:left;"></a>
    <a href="#"><img src="images/footerbanner5.jpg"></a>
    
    <br/>
    <br/>
    
    <h2 class="free_dilevery">Free Dilevery</h2>
    <p class="dilevery">The Wolfgang always ready to dilever arround of the Islend. Dilevery chargers free for enywhere in Sri Lanka. <a href="#" class="readmore">more...</a></p>
    <img class="dilevery_image" src="images/Delivery Icon Vector Set-02.jpg">
    
    <img class="verticale_line" src="images/vertical line.jpg">
    
    
        <h2 class="gift_wrap">Gift Voucher</h2>
        <p class="gift">The Wolfgang always ready to dilever arround of the Islend. Dilevery chargers free for enywhere in Sri Lanka. <a href="#" class="readmore">more...</a></p>
        <img class="gift_image" src="images/Green_gift_cards1 [Converted]-01.jpg">
            
    <img class="verticale_line2" src="images/vertical line.jpg">
    
    <h2 class="subscribe">Send me News Latteres</h2>
    <p class="subscribe_holder"> <form action='/search' id='subscribe-form' method='get' target='_top'>
    <input id='subscribe-text' name='q' placeholder='Enter Your E-mail Address' type='text'/>
    <button id='subscribe-button' type='submit'><span>Subscribe</span></button>
  </form></p>  
  <br/>  
    
</div>

<?php require_once('/layouts/footer.php'); ?>



</body>
</html>
