<?php
require_once("../../includes/initialize.php");
if (!$session->is_logged_in()) {
    redirect_to("index.php");
}



$photo= Comment::find_by_id(1);


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
            <div class="author">
                <?php echo $photo->username; ?> Last Edited :
                
            </div>
	    </br>
</br>
</br>
</br>
            <div class="body">
                <?php echo strip_tags($photo->abcontent,'<strong><em><p>'); ?>
            </div>
	    </br>
	    <div>
	     <a href="editingabout.php">Edit Content</a>
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
