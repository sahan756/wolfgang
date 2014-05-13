<?php
require_once("../../includes/initialize.php");


?>
<?php
   
    $page=!empty($_GET['page'])?(int)$_GET['page'] : 1;
    
    $per_page= 6;
    
    
     $prod_cat_array = array(
    '0' => 'All',
    'Men' => 'Men',
    'Kids' => 'Kids'
);

$prod_typ_array = array(
                        '0' => 'All',
                        'Office' => 'Office',
                        'Wedding' => 'Wedding',
                        'Casual' => 'Casual'
                        ); 




$prod_name = !empty($_REQUEST['prod_name']) ? $_REQUEST['prod_name'] : '';
$prod_cat = !empty($_REQUEST['prod_cat']) ? $_REQUEST['prod_cat'] : '';
$prod_typ = !empty($_REQUEST['prod_typ']) ? $_REQUEST['prod_typ'] : '';

$searchString = Photograph::get_search_string($prod_name, $prod_cat,$prod_typ);
    
    $total_count= Photograph::count_all();
    



  //  $photos= Photograph::find_all();
  
  $pagination = new Pagination($page,$per_page,$total_count);
  
  $sql = "SELECT * FROM add_product ";
  $sql .= $searchString;
  $sql .= "LIMIT {$per_page} ";
  $sql .= "OFFSET {$pagination->offset()}";
  
  $photos = Photograph::find_by_sql($sql);
 
 
 ?>

 <?php //include_layout_template('header.php');
 //var_dump($_SERVER);
 require_once('../layouts/header1.php');
 ?>
 <center><h1 class="main_toc">Edit Product Image</h1></center>
 <?php require_once('../layouts/header2.php'); ?>
 
 
 <form method="POST">
            <span>
                Name
                <input type="text" name="prod_name" value="<?php echo $prod_name ?>" />
            </span>
            <span>
                Category
                <select name="prod_cat">
                    <?php 
                    foreach($prod_cat_array as $val => $name){
                        $selected = ($val == $prod_cat) ? 'selected' : '';
                        echo "<option value='$val' $selected>$name</option>";                        
                    }                    
                    ?>
<!--                    <option value="0">All</option>
                    <option value="Men">Men</option>
                    <option value="Kids">Kids</option>-->
                </select>
            </span>
            
            <span>
                Type
                <select name="prod_typ">
                    <?php 
                    foreach($prod_typ_array as $val => $name){
                        $selected = ($val == $prod_typ) ? 'selected' : '';
                        echo "<option value='$val' $selected>$name</option>";                        
                    }                    
                    ?>
<!--                    <option value="0">All</option>
                    <option value="Men">Men</option>
                    <option value="Kids">Kids</option>-->
                </select>
            </span>     
            
            <span>
                <input type="submit" name="submit" value="Search" />
            </span>
<!--            <span>
                <input type="button" value="Clear" name="reset"/>
            </span>-->
        </form>


 <?php
    foreach($photos as $photo): 
 ?>
 <div style="float: left; margin-left: 20px;">
    <a href="edit_click_image.php?id=<?php echo $photo->id; ?>">
    <img src="../<?php echo $photo->image_path();?>" width="200" />
    </a>

      <p><?php echo $photo->product_name;?></p>   
 </div>
 <?php endforeach;?>
 
<div id="pagination" style="clear: both;">
    <?php
        if($pagination->total_pages()>1){
            
            if($pagination->has_previous_page()){
                echo " <a href=\"edit_product_image.php?page=";
                echo $pagination->previous_page();
                echo "\">&laquo; Previous</a> ";
            }
            for($i=1;$i<=$pagination->total_pages();$i++){
               if($i==$page){
                echo " <span class=\"selected\">{$i}</span> ";
               }else{
                echo " <a href=\"edit_product_image.php?page={$i}\">{$i}</a> ";
               }
            }
            
            
            if($pagination->has_next_page()){
                echo " <a href=\"edit_product_image.php?page=";
                echo $pagination->next_page();
                echo "\">Next &raquo;</a> ";
            }
            }    
    ?>
    
</div>
 

            
        
<?php include_layout_template('footer.php'); ?>