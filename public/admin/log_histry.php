<?php require_once("../../includes/initialize.php");?>
<?php if(!$session->is_logged_in()){
    redirect_to("login.php");
}
?>

<?php
  $logfile = SITE_ROOT.DS.'logs'.DS.'log.txt';
  
  if(isset($_GET['clear']) && $_GET['clear']=='true'){
    file_put_contents($logfile,'');
    log_action('Logs Cleared',"by User ID {$session->user_id}");
    redirect_to('logfile.php');
    
  }
?>


<?php
//include_layout_template('header.php');
//var_dump($_SERVER);
require_once('../layouts/header1.php');
?>
<center><h1 class="main_toc5">Add Product</h1></center>
<?php require_once('../layouts/header2.php'); ?>

      
      <div id="admin_content">
      	<table class="log_detail" cellpadding="5px" cellspacing="15px">
        <tr class="head_row">
        <th>Date</th>
        <th>Time</th>
        <th>Description</th>
        <th class="de_but">Clear All Log History</th>
        </tr>
        
        <tr>
        <td><p><a href="logfile.php?clear=true" onclick="return confirm('Are you shure you want to Clear log ');">Clear log file</a></p>
<?php

if(file_exists($logfile)&& is_readable($logfile)&& $handle=fopen($logfile,'r')){
  echo "<ul class=\"log-entries\">";
  while(!feof($handle)){
    $entry=fgets($handle);
    if(trim($entry)!=""){
      echo "<li>{$entry}</li>";
    }
  }
  echo "</ul>";
  fclose($handle);
  
}else{
  echo "Cound not read from {$logfile}";
}

?></td>
        
        </tr>
        
        
        
        </table>
	

           

	 </div>
 </div> 
 
 <center><div  class="logo3"><br/></div></center>

</body>
</html>
