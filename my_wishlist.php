<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('includes/initialize.php');
if (!isset($session->cusid)) {
    redirect_to("registern.php");
    exit;
}

if(isset($_REQUEST['list']) && $_REQUEST == "remove"){
//    if(!empty($_REQUEST['item'])){
//        $itemId = intval($_REQUEST['item']);
//        Wishlist::
//    }
}

$wishlist_items = Wishlist::get_wishlist();

$products = array();
if(!empty($wishlist_items)){
    foreach ($wishlist_items as $value) {
        $products[] = Product::find_by_id($value->item_id);        
    }
}
?>

<!doctype html>
<?php require_once('/layouts/header.php'); ?>

<?php ?>

<h1 class="cart_head">My Wishlist</h1>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>" >
    <div style="clear: both;"></div>
    <table class="cart_inside">
        <tr class="c_t_head">
            <th>Item Description</th>
            <th>Product ID</th>
            <th>Unit Price</th>    
            <th></th>
        </tr>
        <?php
        if (!empty($products)) {
            foreach ($products as $item) {
                //$item = $product['item'];
                ?>
                <tr class="content_cart">
                <input type="hidden" name="item[]" value="<?php echo $item->id ?>" />
                <input type="hidden" name="prize[]" value="<?php echo $item->price ?>" />
                <td><img src="public/<?php echo $item->image_path() ?>" align="left" width="75"><p class="name_shoe"><?php echo $item->title ?></p></td>
                <th>WLF0512484AD42</th>
                <th>LKR <?php echo number_format($item->price, 2); ?></th>   
                <th><a href="?list=remove&item=<?php echo $item->id ?>" ><img src="images/recycle2.png"></a></th>
                </tr>
            <?php
            }
        }
        ?>

    </table>


    <div id="table_footer">
        <a href="#"><div class="continue">Countinue Shopping</div></a>
        <!--        <a href="#"><div class="clear_cart">Clear Cart</div></div></a>-->
        <!--                <a href="#"><div class="update_cart">Update Cart</div></a>-->
        <!--<input type="submit" name="clear" value="Clear Cart" class="clear_cart" />-->
<!--        <a class="update_cart" style="margin-top: 0;text-decoration: none;" href="my_cart.php">Update cart</a>-->
    </div>


    <div class="bottam_sec">
        <div class="empty"></div>
    </div>

</div>
</form>
<?php require_once('/layouts/footer.php'); ?>


</body>
</html>