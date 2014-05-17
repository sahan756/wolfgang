<?php
require_once('includes/initialize.php');
$page = !empty($_REQUEST['page']) ? (int) $_REQUEST['page'] : 1;
$per_page = 6;

//category and type filter
$prod_cat = !empty($_REQUEST['cat']) ? $_REQUEST['cat'] : '';
$prod_typ = !empty($_REQUEST['type']) ? $_REQUEST['type'] : '';

$color = !empty($_REQUEST['color']) ? $_REQUEST['color'] : '';
$size = !empty($_REQUEST['size']) ? $_REQUEST['size'] : '';
$price = !empty($_REQUEST['price']) ? $_REQUEST['price'] : '';
//var_dump($price);

$searchString = Product::get_search_string('', $prod_cat, $prod_typ, $color, $size, $price);
//var_dump($searchString);


$total_count = Product::count_all($searchString);

$pagination = new Pagination($page, $per_page, $total_count);

$sql = "SELECT * FROM product ";
//filter
$sql .= $searchString;
$sql .= "LIMIT {$per_page} ";
$sql .= "OFFSET {$pagination->offset()}";

$products = Product::find_by_sql($sql);

$wishlist = new Wishlist();
$wish_list = $wishlist->get_wishlist();

//$wish_list = Wishlist::get_wishlist();
//var_dump($wish_list);
?>


<div class="product_list">
    <?php if (!empty($products)) { ?>
        <ul class="products">
            <?php foreach ($products as $product) { ?>
                <li class="item">
                    <a href="shoe_page.php?id=<?php echo $product->id; ?>"><img class="imageofproduct" src="public/<?php echo $product->image_path(); ?>"></a><br/>
                    <p class="p_title">
                        <a href="#" class="P_titlelink"><?php echo $product->title; ?></a>
                    </p><br/><h2 class="price"><b>LKR <?php echo number_format($product->price, 2); ?></b></h2><br/>
                    <p class="cart">
                        <a href="my_cart.php?cart=add&item=<?php echo $product->id ?>&qty=1" class="addtocart"><img src="images/shopping7.png"> Add To Cart</a>
                    </p><p class="wishlist">
                        <?php if(empty($wish_list[$product->id])){ ?> 
                        <a href="add_wishlist.php?item=<?php echo $product->id; ?>" class="wishlist_link">Add to wishlist</a>
                        <?php } else {
                            ?>
                           <a class="wishlist_link">In wishlist</a>     
                                <?php
                        } ?>
                    </p>
                </li>
            <?php } ?>
        </ul>
        <?php
    } else{
        ?>
    <h3 class="selection_head">No products found!</h3> 
            <?php
    }
    ?>
    <br/><br/>    
</div> 
<br/>                     

 <!--pagination--> 
<div id="pagination" style="clear: both;">
    <?php
    if ($pagination->total_pages() > 1) {
//        $urlArray = array(
//            'cat' => $prod_cat,
//            'type' => $prod_typ,
//        );
//        $prepend_url = http_build_query($urlArray) . '&';
//    $current_url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
//    $prepend_url = (!empty($current_url)) ? $current_url . '&' : '';
        if ($pagination->has_previous_page()) {
            echo " <a onclick='getProductList({$pagination->previous_page()})' >&laquo; Previous</a>";            
        }
        for ($i = 1; $i <= $pagination->total_pages(); $i++) {
            if ($i == $page) {
                echo " <span class=\"selected\">{$i}</span> ";
            } else {
                echo " <a onclick='getProductList({$i})' >{$i}</a> ";
            }
        }


        if ($pagination->has_next_page()) {
            echo " <a onclick='getProductList({$pagination->next_page()})' >Next &raquo;</a>";
        }
    }
    ?>

</div>
