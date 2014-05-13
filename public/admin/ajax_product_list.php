<?php
require_once("../../includes/initialize.php");

   
    $page=!empty($_REQUEST['page'])?(int)$_REQUEST['page'] : 1;
    
    $per_page= 6;
    
    





$prod_name = !empty($_REQUEST['prod_name']) ? $_REQUEST['prod_name'] : '';
$prod_cat = !empty($_REQUEST['prod_cat']) ? $_REQUEST['prod_cat'] : '';
$prod_typ = !empty($_REQUEST["prod_typ_{$prod_cat}"]) ? $_REQUEST["prod_typ_{$prod_cat}"] : '';

$searchString = Product::get_search_string($prod_name, $prod_cat,$prod_typ);
    
    
    $total_count= Product::count_all($searchString);
    



  //  $photos= Photograph::find_all();
  
  $pagination = new Pagination($page,$per_page,$total_count);
  
  $sql = "SELECT * FROM product ";
  $sql .= $searchString;
  $sql .= "LIMIT {$per_page} ";
  $sql .= "OFFSET {$pagination->offset()}";
  
  $photos = Product::find_by_sql($sql);
 
 
 ?>
<?php
    foreach($photos as $photo): 
 ?>
 <div style="float: left; margin-left: 20px;">
    <a href="edit_click.php?id=<?php echo $photo->id; ?>">
    <img src="../<?php echo $photo->image_path();?>" width="200" />
    </a>

      <p><?php echo $photo->title;?></p>   
 </div>
 <?php endforeach;?>
 
<div id="pagination" style="clear: both; margin-left: 250px">
    <?php
//        if($pagination->total_pages()>1){
//            
//            if($pagination->has_previous_page()){
//                echo " <a href=\"edit_product.php?page=";
//                echo $pagination->previous_page();
//                echo "\">&laquo; Previous</a> ";
//            }
//            for($i=1;$i<=$pagination->total_pages();$i++){
//               if($i==$page){
//                echo " <span class=\"selected\">{$i}</span> ";
//               }else{
//                echo " <a href=\"edit_product.php?page={$i}\">{$i}</a> ";
//               }
//            }
//            
//            
//            if($pagination->has_next_page()){
//                echo " <a href=\"edit_product.php?page=";
//                echo $pagination->next_page();
//                echo "\">Next &raquo;</a> ";
//            }
//            }    
    
    ?>
    <?php
    if ($pagination->total_pages() > 1) {
//        $urlArray = array(
//            'cat' => $prod_cat,
//            'type' => $prod_typ,
//        );
//        $prepend_url = http_build_query($urlArray) . '&';
//    $current_url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
//    $prepend_url = (!empty($current_url)) ? $current_url . '&' : '';
        if ($pagination->has_previous_page()) {
            echo " <a onclick='getProductList({$pagination->previous_page()})' >&laquo; Previous</a>";            
        }
        for ($i = 1; $i <= $pagination->total_pages(); $i++) {
            if ($i == $page) {
                echo " <span class=\"selected\">{$i}</span> ";
            } else {
                echo " <a onclick='getProductList({$i})' >{$i}</a> ";
            }
        }


        if ($pagination->has_next_page()) {
            echo " <a onclick='getProductList({$pagination->next_page()})' >Next &raquo;</a>";
        }
    }
    ?>
</div>
