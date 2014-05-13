<?php
require_once("../../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to("index.php");
}
?>

<?php
if (empty($_GET['id'])) {
    $session->message("No product ID was provided");
}

$photo = Product::find_by_id($_REQUEST['id']);

if (!$photo) {
    $session->message("The product could not be located");
    redirect_to('edit_product.php');
}

//populate lists
$categories = ProductCategory::find_all();
//var_dump($categories);

$cat_color = array();
$cat_type = array();
$cat_size = array();

if (!empty($categories)) {
    foreach ($categories as $cat) {
        $cat_color[$cat->id] = CategoryColor::find_all_by_cat_id($cat->id);
        $cat_type[$cat->id] = CategoryType::find_all_by_cat_id($cat->id);
        $cat_size[$cat->id] = CategorySize::find_all_by_cat_id($cat->id);
    }
}
//end

$product_cat = ProductCategory::find_by_id($photo->cat_id);
$product_size = CategorySize::find_by_id($photo->size_id);
$product_color = CategoryColor::find_by_id($photo->color_id);
$product_type = CategoryType::find_by_id($photo->type_id);


if (isset($_POST['submit'])) {
    $photo->attach_file($_FILES['image_1'], 1);
    $photo->attach_file($_FILES['image_2'], 2);
    $photo->attach_file($_FILES['image_3'], 3);
    $photo->attach_file($_FILES['image_4'], 4);
    $photo->title = trim($_POST['title']);
    $photo->cat_id = trim($_POST['cat_id']);
    $photo->size_id = trim($_POST['size_' . $photo->cat_id]);
    $photo->color_id = trim($_POST['color_' . $photo->cat_id]);
    $photo->price = trim($_POST['product_price']);
    $photo->type_id = trim($_POST['type_' . $photo->cat_id]);
    $photo->quan = trim($_POST['quan']);

    //$update_product = Photograph::save($photo->id,$photo->filename,$photo->type,$photo->size,$product_name,$pcategory,$psize,$pcolor,$pprize,$ptype);
    $update_product = $photo->save();
    //var_dump($update_product);

    if ($update_product) {
        //$new_comment->try_to_send_notification();
        $message = "sucess";
        redirect_to("edit_click.php?id={$photo->id}");
    } else {
        $message = "there is error updating product";
    }
} else {
    //$message="there is error updating product";
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

        $("select[name=cat_id]").change(function() {
            showCategoryOptions();
        });
    });

    function showCategoryOptions() {
        var catId = $("select[name=cat_id]").val();
        $("select[name^=size_], select[name^=color_], select[name^=type_]").hide();
        $("select[name=size_" + catId + "], select[name=color_" + catId + "], select[name=type_" + catId + "]").show();
    }
</script>

<style>
    .large_img_container{
        float: left;
        width: 300px;
    }

    .small_img_container{
        float:left;
        width: 100px;
    }

    .no_img_div{
        border: 1px solid #000;
        width: 100px;
        height: 100px;
    }

    .border_right_none{
        border-right: none;
    }
</style>

<a href="edit_product.php">&laquo; Back</a><br/>
<br/>
<div style="margin-left: 20px;">
    <div style="height:225px">
        <div class="large_img_container">
            <img src="../<?php echo $photo->image_path(); ?>" width="300"/>
        </div>

        <div class="small_img_container">
            <?php if (!empty($photo->image_2)) {
                ?>
                <img src="../<?php echo $photo->image_path(2); ?>" width="100"/>
                <a href="#">Delete</a>
            <?php } else {
                ?>
                <div class="no_img_div border_right_none"></div>
                <?php
            }
            ?>
        </div>


        <div class="small_img_container">
            <?php if (!empty($photo->image_3)) {
                ?>
                <img src="../<?php echo $photo->image_path(3); ?>" width="100"/>
                <a href="#">Delete</a>
            <?php } else {
                ?>
                <div class="no_img_div border_right_none"></div> 
                <?php
            }
            ?>
        </div>


        <div class="small_img_container">
            <?php if (!empty($photo->image_4)) {
                ?>
                <img src="../<?php echo $photo->image_path(4); ?>" width="100"/>
                <a href="#">Delete</a>
            <?php } else {
                ?>
                <div class="no_img_div"></div>   
                <?php
            }
            ?>
        </div>


    </div>
    <div>
        <br/>Product Name :<?php echo $photo->title; ?>
        <br>Product Category :<?php echo $product_cat->category; ?>
        <br>Size :<?php echo !empty($product_size) ? $product_size->size : ''; ?>
        <br>Colour :<?php echo !empty($product_color) ? $product_color->color : ''; ?>
        <br>Price :<?php echo $photo->price; ?>
        <br>Type :<?php echo !empty($product_type) ? $product_type->type : ''; ?>
        <br>Quantity :<?php echo $photo->quan; ?>
    </div>
</div>

<div id="admin_content">
    <form action="edit_click.php" enctype="multipart/form-data" method="post">
        <input type="hidden" name="id" value="<?php echo $_REQUEST['id']; ?>" /><!--
        <p class="title">Chose your Image : <input type="file" name="file_upload" /> </p> -->

        <p class="title">
            Image 1 : <input type="file" name="image_1" class="box" />
        </p>
        <p class="title">
            Image 2 : <input type="file" name="image_2" class="box" />
        </p>
        <p class="title">
            Image 3 : <input type="file" name="image_3" class="box" />
        </p>
        <p class="title">
            Image 4 : <input type="file" name="image_4" class="box" />
        </p>

        <p class="title">Product Name :  <input type="text" name="title" value="<?php echo $photo->title; ?>"/> </p>
        <p class="title">Catogery: 
            <select name="cat_id" >
                <?php
                if (!empty($categories)) {
                    foreach ($categories as $cat) {
                        $selected = ($photo->cat_id == $cat->id) ? 'selected' : '';
                        ?>
                        <option value="<?php echo $cat->id ?>" <?php echo $selected ?>><?php echo $cat->category ?></option>
                        <?php
                    }
                }
                ?>
            </select>
        </p>
        <p class="title">Size : 
            <?php
            if (!empty($cat_size)) {
                $i = 0;
                foreach ($cat_size as $key => $value) {
                    $i++;
                    $style = $i > 1 ? 'style="display:none"' : '';
                    ?>
                    <select name="size_<?php echo $key ?>" <?php echo $style ?>> 
                        <?php
                        if (!empty($value)) {
                            foreach ($value as $val) {
                                $selected = ($photo->size_id == $val->id) ? 'selected' : '';
                                ?>
                                <option value="<?php echo $val->id ?>" <?php echo $selected ?>><?php echo $val->size ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                    <?php
                }
            }
            ?>
        </p>
        <p class="title">Color : 
            <?php
            if (!empty($cat_color)) {
                $i = 0;
                foreach ($cat_color as $key => $value) {
                    $i++;
                    $style = $i > 1 ? 'style="display:none"' : '';
                    ?>
                    <select name="color_<?php echo $key ?>"  <?php echo $style ?>> 
                        <?php
                        if (!empty($value)) {
                            foreach ($value as $val) {
                                $selected = ($photo->color_id == $val->id) ? 'selected' : '';
                                ?>
                                <option value="<?php echo $val->id ?>" <?php echo $selected ?>><?php echo $val->color ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                    <?php
                }
            }
            ?>
        </p>
        <p class="title">Price : 
            <input type="text" name="product_price" value="<?php echo $photo->price; ?>" /> 
        </p>
        <p class="title">Type : 
            <?php
            if (!empty($cat_type)) {
                $i = 0;
                foreach ($cat_type as $key => $value) {
                    $i++;
                    $style = $i > 1 ? 'style="display:none"' : '';
                    ?>
                    <select name="type_<?php echo $key ?>"  <?php echo $style ?>> 
                        <?php
                        if (!empty($value)) {
                            foreach ($value as $val) {
                                $selected = ($photo->type_id == $val->id) ? 'selected' : '';
                                ?>
                                <option value="<?php echo $val->id ?>" <?php echo $selected ?>><?php echo $val->type ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                    <?php
                }
            }
            ?>
        </p>

    <p class="title">Quantity :  <input type="text" name="quan" value="<?php echo $photo->quan; ?>"/> </p>

        <br/>
        <input type="submit" value="Edit" name="submit"><input type="reset" value="Cancel" name="cancel">
    </form>
</div>




<?php include_layout_template('footer.php'); ?>