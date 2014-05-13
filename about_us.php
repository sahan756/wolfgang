<?php

require_once('includes/initialize.php');
$photo= Comment::find_by_id(1);
?>

<ol></ol><!doctype html
<?php require_once('/layouts/header.php'); ?>
    
    
     <p class="tag_direction2"><a class="readmore" href="index.html">Home</a> > <a class="readmore" href="#">About us</a> > About us</p>
    
     <br/>
     <h2 class="product_head2">About Wolfgang</h2> </p>
     <hr class="separate_line" >
     
     <img src="images/small/sm3.jpg" style="float:left;">
         <div class="company_detail">
         	<p class="full_detail"> <?php echo strip_tags($photo->abcontent,'<strong><em><p>'); ?></p>
</div>
         </div>

<?php require_once('/layouts/footer.php'); ?>



</body>
</html>
