<?php
require_once('includes/initialize.php');
//if (!isset($session->cusid)) {
//    redirect_to("registern.php");
//}

if (isset($_REQUEST['cart'])) {
    if ($_REQUEST['cart'] == 'add' && !empty($_REQUEST['item']) && !empty($_REQUEST['qty'])) {
        $session->add_to_cart($_REQUEST['item'], $_REQUEST['qty']);
    } else if($_REQUEST['cart'] == 'remove' && !empty ($_REQUEST['item'])){
        $session->remove_from_cart($_REQUEST['item']);
        redirect_to("my_cart.php");
    }
} else if (isset($_REQUEST['update'])) {
    //var_dump($_REQUEST['item']);
    //var_dump($_REQUEST['qty']);
    
    if(!empty($_REQUEST['item'])){
        foreach ($_REQUEST['item'] as $key => $value) {
            $session->add_to_cart($value, $_REQUEST['qty'][$key]);
        }
    }
} else if(isset($_REQUEST['clear'])) {
    $session->clear_cart();
    redirect_to("my_cart.php");
}
//var_dump($session);
$products = array();
$finalsubtotal=0;
if (!empty($session->cart)) {
    foreach ($session->cart as $itemId => $qty) {
	
        $item = array();
        $item['item'] = Product::find_by_id($itemId);
        $item['quantity'] = $qty;
        $products[] = $item;
	$finalsubtotal += $item['item']->price*$qty;
    }
}


if (isset($_POST['purch'])) {
	
	
	if(!empty($_REQUEST['item'])){
        foreach ($_REQUEST['item'] as $key => $value) {
          
	   $product = new Purchase();
	
	$product->customerid =$session->cusid;
	$product->productid = $value;
	$product->quantity = $_REQUEST['qty'][$key];
	$product->prize = $_POST['prize'][$key];
	
	
	$product->save();
	var_dump($product->errors);
        }
    }
	
	
}











?>
<ol></ol><!doctype html>
<?php require_once('/layouts/header.php'); ?>

<?php

?>

<h1 class="cart_head">My Shopping Cart</h1>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>" >
    <div style="clear: both;"></div>
    <table class="cart_inside">
        <tr class="c_t_head">
            <th>Item Description</th>
            <th>Product ID</th>
            <th>Unit Price</th>
            <th>QTY</th>
            <th>Sub Total</th>
            <th></th>
        </tr>

<!--    <tr class="content_cart">
<td><img src="images/a_4__2.jpg" align="left"><p class="name_shoe">Black office shoes</p></td>
<th>WLF0512484AD42</th>
<th>LKR 2549.99</th>
<th><input class="qty" type="text" name="1" value="1" width="10px"></th>
<th>LKR 2549.99</th>
<th><img src="images/recycle2.png"></th>
</tr>-->


        <?php
        foreach ($products as $product) {
            $item = $product['item'];
            $subTotal = $item->price * $product['quantity'];
            ?>
            <tr class="content_cart">
            <input type="hidden" name="item[]" value="<?php echo $item->id ?>" />
	    <input type="hidden" name="prize[]" value="<?php echo $item->price ?>" />
            <td><img src="public/<?php echo $item->image_path() ?>" align="left" width="75"><p class="name_shoe"><?php echo $item->title ?></p></td>
            <th>WLF0512484AD42</th>
            <th>LKR <?php echo number_format($item->price, 2); ?></th>
            <th><input class="qty" type="text" name="qty[]" value="<?php echo $product['quantity'] ?>" width="10px"></th>
            <th>LKR <?php echo number_format($subTotal, 2); ?></th>
            <th><a href="?cart=remove&item=<?php echo $item->id ?>" ><img src="images/recycle2.png"></a></th>
            </tr>
        <?php }
        ?>

    </table>


    <div id="table_footer">
        <a href="#"><div class="continue">Countinue Shopping</div></a>
<!--        <a href="#"><div class="clear_cart">Clear Cart</div></div></a>-->
<!--                <a href="#"><div class="update_cart">Update Cart</div></a>-->
<input type="submit" name="clear" value="Clear Cart" class="clear_cart" />
        <input type="submit" name="update" value="Update Cart" class="update_cart" style="margin-top: 0;" />
    </div>


<div class="bottam_sec">
    <div class="empty"></div>

    <div class="tot_area">
        <table class="grand_tot">
            <tr>
                <td class="grand_tot_cel">Subtotal</td><td class="grand_tot_cel">LKR <?php echo number_format($finalsubtotal, 2);?></td>
            </tr>
            <tr>
                <td class="grand_tot_cel"><h4>GRAND TOTAL</h4></td><td class="grand_tot_cel"><h4>LKR <?php echo number_format($finalsubtotal, 2);?></h4></td>
            </tr>
        </table>
	
<!--	<input type="submit" name="purch" value="Proceed Checkuot" class="update_cart" style="margin-top: 0;" />-->
        <a class="update_cart" style="margin-top: 0;text-decoration: none;" href="review_cart.php">Proceed to checkout</a>

       <!-- <a href="https://checkout.google.com/buttons/checkout.gif?merchant_id=&w=160&h=43&style=white&variant=text&loc=en_US" class="pros_link"><h2 class="procead">Proceed checkuot</h2></a>    
    
    --></div>
</div>

</div>
</form>
<?php require_once('/layouts/footer.php'); ?>


</body>
</html>
