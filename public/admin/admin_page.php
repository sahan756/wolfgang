<?php
require_once("../../includes/initialize.php");
if (!$session->is_logged_in()) {
    redirect_to("index.php");
}
?>

<?php
$max_file_size = 1048576;

//$message="";
if (isset($_POST['submit'])) {
//    $photo = new Photograph();
//    $photo->attach_file($_FILES['file_upload']);
//    $photo->product_name = $_POST['product_name'];
//    $photo->pcategory = $_POST['category'];
//    $photo->psize = $_POST['size'];
//    $photo->pcolor = $_POST['color'];
//    $photo->pprize = $_POST['product_price'];
//    $photo->ptype = $_POST['type'];
//
//
//
//
//    if ($photo->save()) {
//        $session->message("Photograph upload successfully.{$username}");
//        redirect_to('admin_page.php');
//    } else {
//        $message = join("<br/>", $photo->errors);
//        echo $message;
//    }

    $product = new Product();
    $product->attach_file($_FILES['image_1'], 1, TRUE);
    $product->attach_file($_FILES['image_2'], 2);
    $product->attach_file($_FILES['image_3'], 3);
    $product->attach_file($_FILES['image_4'], 4);
    $product->title = $_POST['product_name'];
    $product->cat_id = $_POST['category'];
    $product->size_id = isset($_POST['size_' . $product->cat_id]) ? $_POST['size_' . $product->cat_id] : 0;
    $product->color_id = isset($_POST['color_' . $product->cat_id]) ? $_POST['color_' . $product->cat_id] : 0;
    $product->type_id = isset($_POST['type_' . $product->cat_id]) ? $_POST['type_' . $product->cat_id] : 0;
    $product->price = $_POST['product_price'];
    $product->quan = $_POST['quan'];

    $product->save();

    //var_dump($product->errors);
}

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
?>





<?php
//include_layout_template('header.php');
//var_dump($_SERVER);
require_once('../layouts/header1.php');
?>
<center><h1 class="main_toc5">Add Product</h1></center>
<?php require_once('../layouts/header2.php'); ?>

<style>
    .create_button{
        width: 100px;
    }
    
/*    .error_msg{
        color: #FF0000; 
        float: left;
        clear: right;
    }*/
</style>
<script src="../javascripts/jquery-1.8.3.min.js" ></script>
<script>
    $(function() {
        showCategoryOptions();

        $("select[name=category]").change(function() {
            showCategoryOptions();
        });
    });

    function showCategoryOptions() {
        var catId = $("select[name=category]").val();
        $("select[name^=size_], select[name^=color_], select[name^=type_]").hide();
        $("select[name=size_" + catId + "], select[name=color_" + catId + "], select[name=type_" + catId + "]").show();
    }
</script>

<div id="admin_content">
    <!--<center><h3>Add Product</h3></center>-->
    <form action="admin_page.php" enctype="multipart/form-data" method="post">
        <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size; ?>" />
        <p class="line">
        <p class="detail">Image 1 (required):</p>
        <p class="about_user2">
            <input type="file" name="image_1" class="box" />
	    <?php if(!empty($product->errors['file']))
	 { echo $product->errors['file'];} ?>
        </p> 
         <p class="command"><a href="#" class="delete">Reset</a></p>
	
        </p>
        <p class="line">
        <p class="detail">Image 2:</p>
        <p class="about_user2">
            <input type="file" name="image_2" class="box" />
        </p>
        <p class="command"><a href="#" class="delete">Reset</a></p>
        </p>
        <p class="line">
        <p class="detail">Image 3:</p>
        <p class="about_user2">
            <input type="file" name="image_3" class="box"  />
        </p>
        <p class="command"><a href="#" class="delete">Reset</a></p>
        </p>
        <p class="line">
        <p class="detail">Image 4:</p>
        <p class="about_user2">
            <input type="file" name="image_4" class="box" />
        </p>
        <p class="command"><a href="#" class="delete">Reset</a></p>
        </p>
        <p class="line">
        <p class="detail">Product Name : </p>
        <p class="about_user2"> 
            <input type="text" name="product_name" class="box" />
	     <?php if(!empty($product->errors['title']))
	 { echo $product->errors['title'];} ?>
        </p>
        <p class="command"><a href="#" class="delete">Reset</a></p>
       
	
        <p class="error_msg"><?php //echo !empty($product->errors['title']) ? $product->errors['title'] : '' ?></p>
        </p>
        <p class="line">
        <p class="detail">Category: </p>
        <p class="about_user2">
            <select name="category" class="box">
                <?php
                if (!empty($categories)) {
                    foreach ($categories as $cat) {
                        ?>
                        <option value="<?php echo $cat->id ?>"><?php echo $cat->category ?></option>
                        <?php
                    }
                }
                ?>
                <!--                <option value="Men">Men</option>
                                <option value="Kids">Kids</option>-->
            </select>
        </p>
        <p class="command"><a href="#" class="delete">Reset</a></p>
        </p>
        </p>
        <p class="line">
        <p class="detail">Type : </p>
        <p class="about_user2">
           <?php
            if (!empty($cat_type)) {
                $i = 0;
                foreach ($cat_type as $key => $value) {
                    $i++;
                    $style = $i > 1 ? 'style="display:none"' : '';
                    ?>
                    <select name="type_<?php echo $key ?>" class="box" <?php echo $style ?>> 
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
        </p>
        <p class="command"><a href="#" class="delete">Reset</a></p>
        </p>
        <p class="line">
        <p class="detail">Size :</p>
        <p class="about_user2"> 
            <?php
            if (!empty($cat_size)) {
                $i = 0;
                foreach ($cat_size as $key => $value) {
                    $i++;
                    $style = $i > 1 ? 'style="display:none"' : '';
                    ?>
                    <select name="size_<?php echo $key ?>" class="box" <?php echo $style ?>> 
                        <?php
                        if (!empty($value)) {
                            foreach ($value as $val) {
                                ?>
                                <option value="<?php echo $val->id ?>"><?php echo $val->size ?></option>
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
        <p class="command"><a href="#" class="delete">Reset</a></p>
        </p>
        </p>
        <p class="line">
        <p class="detail">Color : </p>
        <p class="about_user2">
            <?php
            if (!empty($cat_color)) {
                $i = 0;
                foreach ($cat_color as $key => $value) {
                    $i++;
                    $style = $i > 1 ? 'style="display:none"' : '';
                    ?>
                    <select name="color_<?php echo $key ?>" class="box" <?php echo $style ?>> 
                        <?php
                        if (!empty($value)) {
                            foreach ($value as $val) {
                                ?>
                                <option value="<?php echo $val->id ?>"><?php echo $val->color ?></option>
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
        <p class="command"><a href="#" class="delete">Reset</a></p>
        </p>
        </p>
        <p class="line">
        <p class="detail">Price :</p>
        <p class="about_user2">
            <input type="text" name="product_price" class="box" type="text"/>
	    <?php if(!empty($product->errors['price']))
	 { echo $product->errors['price'];} ?>
        </p>
        <p class="command"><a href="#" class="delete">Reset</a></p>
        </p>
        </p>
	
	
	
        </p>
        </p>
	
        <p class="line">
        <p class="detail">Quantity : </p>
        <p class="about_user2"> 
            <input type="text" name="quan" class="box" />
	    <?php if(!empty($product->errors['quan']))
	 { echo $product->errors['quan'];} ?>
        </p>
	<p class="command"><a href="#" class="delete">Reset</a></p>
        
        <br/>
        <center>
            <p class="line">
            <p class="detail2">
            <p >
                <input type="submit" value="Add" name="submit" class="create_button">
            </p>
            <p >
                <input type="reset" value="Cancel" name="cancel" class="create_button">
            </p>
            </p></p>
        </center>

    </form>
</div>

</div>

</body>
</html>
