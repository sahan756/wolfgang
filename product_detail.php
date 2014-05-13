<?php
require_once('includes/initialize.php');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$productId = !empty($_REQUEST['id']) ? (int) $_REQUEST['id'] : 0;

$product = Product::find_by_id($productId);
//var_dump($product);

if (!empty($product)) {
    $cat = ProductCategory::find_by_id($product->cat_id);
    $sizes = CategorySize::find_all_by_cat_id($product->cat_id);
}
?>
<!doctype html>
<?php require_once('/layouts/header.php'); ?>
<p class="tag_direction2"><a class="readmore" href="#">Home</a> > <a class="readmore" href="#"><?php echo $cat->category ?></a> > <?php echo $product->title ?>
    <br/> 
<h2 class="product_head2"><?php echo $product->title ?></h2> </p>


<!--Zoom Slider-->
<div class="galerry_are">
   <!--<img class="shoe_image" src="images/shoe 01/Wolfgang_shoe1.jpg">-->

    <div id="gallery_01">
        <img id="img_01" src="images/small/sm1.jpg" data-zoom-image="images/large/m1.jpg"/>
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
        $("#img_01").elevateZoom({gallery: 'gallery_01', cursor: 'pointer', galleryActiveClass: 'active', imageCrossfade: true, scrollZoom: true, easing: true, cursor: "crosshair", loadingIcon: 'http://www.elevateweb.co.uk/spinner.gif'});

    //pass the images to Fancybox
        $("#img_01").bind("click", function(e) {
            var ez = $('#img_01').data('elevateZoom');
            $.fancybox(ez.getGalleryList());
            return false;
        });
        
        function addToCart(itemId){
            var qty = $("select[name=qty]").val();
            location.href = "my_cart.php?cart=add&item=" + itemId + "&qty=" + qty;
        }
    </script>


</div>

<div class="discr">
    <p class="details">Original Napa Leather shoes only from wolfgang. Great Finish and confurteble. Save your budget also.</p>
    <p class="status_topic">Availability : </p><p class="status"> In stock</p>
    <p class="price">LKR <?php echo number_format($product->price, 2) ?></p>
    <p class="p_code">Product Code : </p><p class="code">WLF25412084S</p>
    <p class="media"><a href="#"><img src="images/social media/social_facebook_box_blue_16.png" style="padding-right:6px;"></a><a href="#"><img src="images/social media/social_google_box_16.png" style="padding-right:6px;"></a><a href="#"><img src="images/social media/social_twitter_box_blue_16.png"></a></p>
    <br>
    <div class="choice">
        <p class="select_size"><p class="requerd">*</p>Select Your Size</p>
        <select name="size" style="background-color:#E6F4FF;">
            <option value="0">Select your size</option>

            <?php
            if (!empty($sizes)) {
                foreach ($sizes as $val) {
                    ?>
                    <option value="<?php echo $val->id ?>"><?php echo $val->size ?></option>
                    <?php
                }
            }
            ?>
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

    <p class="cart_to"><a class="cart_link" href="#" onclick="addToCart(<?php echo $product->id ?>)"><img src="images/shopping7.png"> ADD TO CART</a></p>
    <p class="wish_to"><a class="wish_link" href="#">ADD TO Wish List</a></p>

</div>



</div>

<?php require_once('/layouts/footer.php'); ?>



</body>
</html>