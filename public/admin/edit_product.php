<?php
require_once("../../includes/initialize.php");
if (!$session->is_logged_in()) {
    redirect_to("index.php");
}

//    $prod_cat_array = array(
//    '0' => 'All',
//    'Men' => 'Men',
//    'Kids' => 'Kids'
//);
    
    $cat_all = new ProductCategory();
    $cat_all->id = 0;
    $cat_all->category = "All";
    
 $prod_cat_array = ProductCategory::find_all();
//$prod_typ_array = array(
//                        '0' => 'All',
//                        'Office' => 'Office',
//                        'Wedding' => 'Wedding',
//                        'Casual' => 'Casual'
//                        ); 
 
 $cat_type = array();
 if (!empty($prod_cat_array)) {
     array_unshift($prod_cat_array, $cat_all);
    foreach ($prod_cat_array as $cat) {
        $cat_type[$cat->id] = CategoryType::find_all_by_cat_id($cat->id);
        $cat_type_all = new CategoryType();
        $cat_type_all->id = 0;
        $cat_type_all->type = "All";
        array_unshift($cat_type[$cat->id], $cat_type_all);
    }
    
}

?>


<?php
//include_layout_template('header.php');
//var_dump($_SERVER);
require_once('../layouts/header1.php');
?>
<center><h1 class="main_toc">Edit Product</h1></center>
    <?php require_once('../layouts/header2.php'); ?>

<script src="../javascripts/jquery-1.8.3.min.js" ></script>
<script>
    $(function() {
        showCategoryOptions();
        getProductList();
        $("select[name=prod_cat]").change(function() {
            showCategoryOptions();
        });
    });

    function showCategoryOptions() {
        var catId = $("select[name=prod_cat]").val();
        $("select[name^=prod_typ_]").hide();
        $("select[name=prod_typ_" + catId + "]").show();
    }

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
<style>
     a{
                cursor: pointer;
                color: blue;                
            }
</style>

<form method="POST" name="ajax_param">
    <input type="hidden" name="page" value="1" />
    <span>
        Name
        <input type="text" name="prod_name" value="<?php //echo $prod_name ?>" />
    </span>
    <span>
        Category
        <select name="prod_cat">
            <?php
            foreach ($prod_cat_array as $cat) {
                $selected = ($cat->id == $prod_cat) ? 'selected' : '';
                echo "<option value='$cat->id' $selected>$cat->category</option>";
            }
            ?>
            <!--                    <option value="0">All</option>
                                <option value="Men">Men</option>
                                <option value="Kids">Kids</option>-->
        </select>
    </span>

    <span>
        Type
<!--                <select name="prod_typ">
        <?php
//                    foreach($prod_typ_array as $val => $name){
//                        $selected = ($val == $prod_typ) ? 'selected' : '';
//                        echo "<option value='$val' $selected>$name</option>";                        
//                    }                    
        ?>
            <option value="0">All</option>
            <option value="Men">Men</option>
            <option value="Kids">Kids</option>
        </select>-->
        <?php
        if (!empty($cat_type)) {
            $i = 0;
            foreach ($cat_type as $key => $value) {
                $i++;
                $style = $i > 1 ? 'style="display:none"' : '';
                ?>
                <select name="prod_typ_<?php echo $key ?>" <?php echo $style ?>> 
                    <?php
                    if (!empty($value)) {
                        foreach ($value as $val) {
                            ?>
                            <option value="<?php echo $val->id ?>"><?php echo $val->type ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
                <?php
            }
        }
        ?>
    </span>     

    <span>
        <input type="button" name="submit" value="Search" onclick="getProductList()" />
    </span>
<!--            <span>
        <input type="button" value="Clear" name="reset"/>
    </span>-->
</form>

<div id="product_list_div">
    
</div>




<?php include_layout_template('footer.php'); ?>