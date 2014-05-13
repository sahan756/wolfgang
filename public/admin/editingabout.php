<?php
require_once("../../includes/initialize.php");
if (!$session->is_logged_in()) {
    redirect_to("index.php");
}


$user = User::find_by_id($session->user_id);
$photo= Comment::find_by_id(1);

if(isset($_POST['submit'])){
    //$photo= Photograph::find_by_id($_GET['id']);
   // var_dump($photo->id);
   
    $username=trim($user->username);
    $abcontent=trim($_POST['abcontent']);
    
    
    $photo->username = trim($user->username);
    $photo->abcontent = trim($_POST['abcontent']);
    
    
    //$update_product = Photograph::save($photo->id,$photo->filename,$photo->type,$photo->size,$product_name,$pcategory,$psize,$pcolor,$pprize,$ptype);
    $update_product = $photo->abupdate($abcontent,$username);
    var_dump($update_product);
    
    if($update_product){
        //$new_comment->try_to_send_notification();
            $message="sucess";
         redirect_to("edit_aboutus.php");
    }else{
        $message="there is error updating product";
    }
    
    
 }else{
    $message="there is error updating product";
 }
   



?>


<?php
//include_layout_template('header.php');
//var_dump($_SERVER);
require_once('../layouts/header1.php');
?>
<center><h1 class="main_toc5">Edit About Us </h1></center>
<?php require_once('../layouts/header2.php'); ?>

<style>
    .create_button{
        width: 100px;
    }
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

           <form method="POST">
         <div id ="comments">
        <?php //foreach($comments as $comment): ?>
        <div class="comment" style="margin-bottom: 2em;">
            
	    </br>
</br>
</br>
</br><div>
            <p>Content: <br/>
                            <textarea name="abcontent" rows="8" cols="60">
                                <?php echo $photo->abcontent; ?> 
                            </textarea>
                        </p>
	    </br>
	    </div>
	    <div>
	     <input type="submit" name="submit" value="Update" />
	    </div>
            
        </div>
        <?php// endforeach;?>
        <?php if(empty($photo)){
            echo "No Comments " ;
            }
            ?>
    </div>
</form>
</body>
</html>
