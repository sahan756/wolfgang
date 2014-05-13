<?php
require_once("../../includes/initialize.php");

if(!$session->is_logged_in()){
    redirect_to("login.php");}
?>

<?php
   
    $page=!empty($_GET['page'])?(int)$_GET['page'] : 1;
    
    $per_page= 10;
    
    $total_count= Customers::count_all();
    



  //  $photos= Photograph::find_all();
  
  $pagination = new Pagination($page,$per_page,$total_count);
  
  $sql = "SELECT * FROM coustomer ";
  $sql .= "LIMIT {$per_page} ";
  $sql .= "OFFSET {$pagination->offset()}";
  
  $photos = Customers::find_by_sql($sql);
 
 
 ?>



<?php //include_layout_template('header.php');
 //var_dump($_SERVER);
 require_once('../layouts/header1.php');
 ?>
 <center><h1 class="main_toc">View Customers</h1></center>
 <?php require_once('../layouts/header2.php'); ?>
 
      
      <div id="admin_content">
      
      <script type="text/javascript">
		// Popup window code
		function newPopup(url) {
			popupWindow = window.open(
				url,'popUpWindow','height=450,width=400,left=400,top=400,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
		}
		</script>
      
           <?php echo output_message($message);?>
	   
	   
	 <center>  <table class="customer" cellpadding="6px" cellspacing="10px">
            <tr class="head_row">
                <th class="head_toc">ID</th>
                <th class="head_toc">Customer Name</th>
                <th class="head_toc">Billing Address</th>
		

                <th class="head_toc">Shipping Address</th>
		
                <th class="head_toc">Email Address</th>
                
                
                <th>&nbsp;</th>
            </tr>
            <?php foreach($photos as $photo): ?>
            
            <tr>
                
                <td><?php echo $photo->cusid;?></td>
                <td><?php echo $photo->cfname. " ".$photo->clname;?></td>
		<td><?php echo $photo->cadress1. " ,  ".$photo->cadress2. " , ".$photo->ccity. " , ".$photo->cprovince. " , ".$photo->ccounty. " ".$photo->cpcode;?></td>
		
		<td><?php echo $photo->csadress1. " , ".$photo->csadress2. " , ".$photo->cscity. " , ".$photo->csprovince. " , ".$photo->cscounty. " ".$photo->cspcode;?></td>
		
                <td><?php echo $photo->cemail;?></td>
                
                <td>
                <!--<a href="comments.php?id=<?php echo $photo->id;?>"> -->
                <?php //echo count($photo->comments());?></td>
                </a>
                <td><!--<a href="viewcusmore.php?id=<?php //echo $photo->id;?>">View</a>--><a href=#>View</a> </td>
               <!-- <td><a href="delete_admin.php?id=<?php //echo $photo->id;?>">Delete</a></td>
                 -->
            </tr>
            
            <?php endforeach;?>
            
            
            
           </table></center>
	   
	   
      	
                
        
      </div>
    
 </div>
 
 <center><div  class="logo2"><br/></div></center>

</body>
</html>
