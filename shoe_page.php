<!doctype html>
<?php require_once('/layouts/header.php'); 

$productId = !empty($_REQUEST['id']) ? (int) $_REQUEST['id'] : 0;

$product = Product::find_by_id($productId);
//var_dump($product);

if (!empty($product)) {
    $cat = ProductCategory::find_by_id($product->cat_id);
    $sizes = CategorySize::find_all_by_cat_id($product->cat_id);
}

?>

<br/>    
<br/>
<p class="tag_direction2"><a class="readmore" href="index.html">Home</a> > <a class="readmore" href="product_list.php?cat=<?php echo !empty($cat) ? $cat->id : ''; ?>"><?php echo !empty($cat) ? $cat->category : ''; ?></a> > <?php echo $product->title; ?>
    <br/> 
<h2 class="product_head2"><?php echo $product->title; ?></h2> </p>


<!--Zoom Slider-->
<div class="galerry_are">
   <!--<img class="shoe_image" src="images/shoe 01/Wolfgang_shoe1.jpg">-->

    <div id="gallery_01">   
        <img id="img_01" src="public/<?php echo $product->image_path(); ?>" data-zoom-image="images/large/m1.jpg" style="width: 370px;height: 350px;" />        
        <br />

        <div id="gal1" align="center">

            <a class="thumb_link" href="#" data-image="public/<?php echo $product->image_path(); ?>" data-zoom-image="images/large/m1.jpg">
                <img  src="public/<?php echo $product->image_path(); ?>" border="1" style="width: 82px;" />
            </a>

            <a class="thumb_link" href="#" data-image="public/<?php echo $product->image_path(2); ?>" data-zoom-image="images/large/m2.jpg">
                <img  src="public/<?php echo $product->image_path(2); ?>" border="1" style="width: 82px;" />
            </a>

            <a class="thumb_link" href="#" data-image="public/<?php echo $product->image_path(3); ?>" data-zoom-image="images/large/m3.jpg">
                <img  src="public/<?php echo $product->image_path(3); ?>"  border="1" style="width: 82px;" />
            </a>

            <a class="thumb_link" href="#" data-image="public/<?php echo $product->image_path(4); ?>" data-zoom-image="images/large/m4.jpg">
                <img  src="public/<?php echo $product->image_path(4); ?>" border="1" style="width: 82px;" />
            </a>
        </div>

    </div>
    <script>
    //initiate the plugin and pass the id of the div containing gallery images
        //$("#img_01").elevateZoom({gallery: 'gallery_01', galleryActiveClass: 'active', imageCrossfade: true, scrollZoom: true, easing: true, cursor: "crosshair", loadingIcon: 'http://www.elevateweb.co.uk/spinner.gif'});

    //pass the images to Fancybox
//        $("#img_01").bind("click", function(e) {
//            var ez = $('#img_01').data('elevateZoom');
//            $.fancybox(ez.getGalleryList());
//            return false;
//        });

        $("#gal1 a").click(function(){            
            var imgPath = $(this).data("image");
            $("#img_01").fadeOut(200, function(){
                $("#img_01").attr("src", imgPath);
                $("#img_01").fadeIn(200);
            });
            return false;
        });
        
        function addToCart(itemId){
            var qty = $("select[name=qty]").val();
            location.href = "my_cart.php?cart=add&item=" + itemId + "&qty=" + qty;
            return false;
        }
    </script>
    <style>
        .price{
            font-size: 24px;
            color: #000000;
            font-weight: 800;
            margin-bottom: -5px;
            margin-top: 0;
        }
    </style>


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
        <?php 
        $quantity = intval($product->quan);
        for ($i = 1; $i < $quantity; $i++) {
            echo '<option value="' . $i . '">'. $i .'</option>';
        }
        ?>        
    </select>

    <p class="cart_to"><a class="cart_link" href="#" onclick="addToCart(<?php echo $product->id; ?>);"><img src="images/shopping7.png">ADD TO CART</a></p>
    <p class="wish_to"><a class="wish_link" href="add_wishlist.php?item=<?php echo $product->id; ?>">ADD TO Wish List</a></p>

</div>



</div>

<?php require_once('/layouts/footer.php'); ?>



</body>
</html>
