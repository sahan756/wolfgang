<?php
require_once('includes/initialize.php');
$page = !empty($_GET['page']) ? (int) $_GET['page'] : 1;


//category and type filter
$prod_cat = !empty($_REQUEST['cat']) ? $_REQUEST['cat'] : CAT_MEN;
$prod_typ = !empty($_REQUEST['type']) ? $_REQUEST['type'] : '0';

//$product_types = array(
//    0 => NULL,
//    'Men' => array(
//        'Office' => 'Office',
//        'Wedding' => 'Wedding',
//        'Casual' => 'Casual',
//        'Party' => 'Party',
//        'Fashion' => 'Fashion'
//    ),
//    'Kids' => array(
//        'NewBorn' => 'New Born',
//        'BabyCasual' => 'Baby Casual',
//        'College' => 'College',
//        'Party' => 'Party',
//        'Teenagers' => 'Teenagers',
//        'Fashion' => 'Fashion'
//    )
//);
$product_types = CategoryType::find_all_by_cat_id($prod_cat);

$colors = CategoryColor::find_all_by_cat_id($prod_cat);

$sizes = CategorySize::find_all_by_cat_id($prod_cat);
?>
<!DOCTYPE html>
<?php require_once('/layouts/header.php'); ?>

<style>
    .item{
        height: 317px;
    }

    #pagination{
        margin-left: 280px;
    }

    a{
        cursor: pointer;
        color: blue;                
    }

    p.cart{
        margin-top: -8px;
    }

    .selection_option{
        height: 630px;
    }
</style>
<script>
    $(function() {
        getProductList();
        $("form[name=ajax_param] input[type=checkbox]").click(function() {
            getProductList();
        });
    });

    function getProductList(page) {
        if (page)
            $("form[name=ajax_param] input[name=page]").val(page);
        var formData = $("form[name=ajax_param]").serialize();
        //console.log(formData);
        $.post("ajax_product_list.php", formData, function(result) {
            $("#product_list_div").html(result);
        });
    }
</script>

<p class="tag_direction"><a class="readmore" href="#">Home</a> > <a class="readmore" href="#">Men</a> > Men
    <br/> 
<h2 class="product_head">Men Shoes</h2> </p>
<div class="selection_option">
    <h3 class="selection_head">SELECT AS YOU WANT</h3>
    <hr class="head_line">
    <form name="ajax_param">
        <input type="hidden" name="cat" value="<?php echo $prod_cat ?>" />
        <!--<input type="hidden" name="type" value="<?php //echo $prod_typ   ?>" />-->
        <input type="hidden" name="page" value="<?php echo $page ?>" />
        <?php if (!empty($colors)) { ?>
            <p class="category_select">COLOUR</p>
            <br/> 
            <div class="color">
        <!--        <p class="value_first"><input type="checkbox" name="color[]" value="Black">Black</p><br/>
                <p class="value"><input type="checkbox" name="color[]" value="Brown">Brown</p><br/>
                <p class="value"><input type="checkbox" name="color[]" value="Light Brown">Light Brown</p><br/>
                <p class="value"><input type="checkbox" name="color[]" value="Greay">Greay</p><br/>
                <p class="value_last"><input type="checkbox" name="color[]" value="Red">Red</p><br/>-->
                <?php
                $i = 0;
                $last = count($colors);
                foreach ($colors as $value) {
                    $i++;
                    if ($i == 1)
                        $type_class = 'value_first';
                    else if ($i == $last)
                        $type_class = 'value_last';
                    else
                        $type_class = 'value';

                    //$checked = ($value->id == $prod_typ) ? 'checked' : '';
                    ?>
                    <p class="<?php echo $type_class ?>"><input type="checkbox" name="color[]" value="<?php echo $value->id ?>" <?php //echo $checked  ?>><?php echo $value->color ?></p><br/>
                <?php } ?>
            </div>
            <br/>
        <?php }
        ?>
        <?php if (!empty($product_types)) { ?>
            <hr class="head_line">    
            <p class="category_select">TYPE</p>
            <br/>     
            <div class="color">
                <?php
                $i = 0;
                $last = count($product_types);
                foreach ($product_types as $value) {
                    $i++;
                    if ($i == 1)
                        $type_class = 'value_first';
                    else if ($i == $last)
                        $type_class = 'value_last';
                    else
                        $type_class = 'value';

                    $checked = ($value->id == $prod_typ) ? 'checked' : '';
                    ?>
                    <p class="<?php echo $type_class ?>"><input type="checkbox" name="type[]" value="<?php echo $value->id ?>" <?php echo $checked ?>><?php echo $value->type ?></p><br/>
                <?php } ?>
    <!--        <p class="value"><input type="checkbox" name="type[]" value="Wedding">Wedding</p><br/>
            <p class="value"><input type="checkbox" name="type[]" value="Casual">Casual</p><br/>
            <p class="value"><input type="checkbox" name="type[]" value="Party">Party</p><br/>
            <p class="value_last"><input type="checkbox" name="type[]" value="Fasion">Fasion</p><br/>-->
            </div>
            <br/>
        <?php }
        ?>
        <hr class="head_line"> 
        <p class="category_select">YOUR SIZE</p>
        <br/> 
        <div class="color">
    <!--        <p class="value_first"><input type="checkbox" name="size[]" value="40">40</p><br/>
            <p class="value"><input type="checkbox" name="size[]" value="41">41</p><br/>
            <p class="value"><input type="checkbox" name="size[]" value="42">42</p><br/>
            <p class="value"><input type="checkbox" name="size[]" value="43">43</p><br/>
            <p class="value"><input type="checkbox" name="size[]" value="44">44</p><br/>
            <p class="value_last"><input type="checkbox" name="size[]" value="45">45</p><br/>-->
            <?php
            $i = 0;
            $last = count($sizes);
            foreach ($sizes as $value) {
                $i++;
                if ($i == 1)
                    $type_class = 'value_first';
                else if ($i == $last)
                    $type_class = 'value_last';
                else
                    $type_class = 'value';

                //$checked = ($value->id == $prod_typ) ? 'checked' : '';
                ?>
                <p class="<?php echo $type_class ?>"><input type="checkbox" name="size[]" value="<?php echo $value->id ?>" <?php //echo $checked  ?>><?php echo $value->size ?></p><br/>
            <?php } ?>
        </div>
        <br/>
        <hr class="head_line"> 
        <p class="category_select">PRICE</p>
        <br/> 
        <div class="color">
            <?php
            $i = 0;
            $priceArray = Photograph::$price_ranges;
            $last = count($priceArray);
            foreach ($priceArray as $key => $value) {
                $i++;
                if ($i == 1)
                    $price_class = 'value_first';
                else if ($i == $last)
                    $price_class = 'value_last';
                else
                    $price_class = 'value';
                $priceRange = Photograph::get_price_range($key);
                $minPrice = number_format($priceRange['min'], 2);
                $maxPrice = !empty($priceRange['max']) ? number_format($priceRange['max'], 2) : 'and above';
                ?>
                <p class="<?php echo $price_class ?>"><input type="checkbox" name="price[]" value="<?php echo $key ?>">LKR <?php echo $minPrice ?> - LKR <?php echo $maxPrice ?></p><br/>
        <!--        <p class="value"><input type="checkbox" name="41" value="41">LKR 2500.00 - LKR 3499.00</p><br/>
                <p class="value"><input type="checkbox" name="42" value="42">LKR 3500.00 - LKR 4499.00</p><br/>
                <p class="value_last"><input type="checkbox" name="43" value="43">LKR 4500.00 and above</p><br/>-->
            <?php } ?>
        </div>
    </form>
</div> 

<div id="product_list_div">

</div>        
</div>

<?php require_once('/layouts/footer.php'); ?>



</body>
</html>
