<?php
require_once('includes/initialize.php');
if (!isset($session->cusid)) {
    redirect_to("registern.php");
}
//var_dump($session);
$products = array();
$finalsubtotal = 0;
if (!empty($session->cart)) {
    foreach ($session->cart as $itemId => $qty) {

        $item = array();
        $item['item'] = Product::find_by_id($itemId);
        $item['quantity'] = $qty;
        $products[] = $item;
        $finalsubtotal += $item['item']->price * $qty;
    }
}


if (isset($_POST['purch'])) {
    if (!empty($products)) {
        foreach ($products as $value) {

            $product = new Purchase();

            $product->customerid = $session->cusid;
            $product->productid = $value['item']->id;
            $product->quantity = $value['quantity'];
            $product->prize = $value['item']->price * $value['quantity'];


            $product->save();
            var_dump($product->errors);
        }
    }
}
?>
<ol></ol><!doctype html>
<?php require_once('/layouts/header.php'); ?>

<?php ?>

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
        if (!empty($products)) {
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
                <th><?php echo $product['quantity'] ?></th>
                <th>LKR <?php echo number_format($subTotal, 2); ?></th>            
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
        <a class="update_cart" style="margin-top: 0;text-decoration: none;" href="my_cart.php">Update cart</a>
    </div>


    <div class="bottam_sec">
        <div class="empty"></div>

        <div class="tot_area">
            <table class="grand_tot">
                <tr>
                    <td class="grand_tot_cel">Subtotal</td><td class="grand_tot_cel">LKR <?php echo number_format($finalsubtotal, 2); ?></td>
                </tr>
                <tr>
                    <td class="grand_tot_cel"><h4>GRAND TOTAL</h4></td><td class="grand_tot_cel"><h4>LKR <?php echo number_format($finalsubtotal, 2); ?></h4></td>
                </tr>
            </table>

            <input type="submit" name="purch" value="Checkout" class="update_cart" style="margin-top: 0;" />

            <!-- <a href="https://checkout.google.com/buttons/checkout.gif?merchant_id=&w=160&h=43&style=white&variant=text&loc=en_US" class="pros_link"><h2 class="procead">Proceed checkuot</h2></a>    
         
            --></div>
    </div>

</div>
</form>
<?php require_once('/layouts/footer.php'); ?>


</body>
</html>
