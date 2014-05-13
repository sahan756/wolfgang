<?php
require_once('includes/initialize.php');

if (!empty($session->cusid)) {
    $user = Customers::find_by_id($session->cusid);
    //var_dump($session);
}

$cat_men = ProductCategory::find_by_id(CAT_MEN);

$men_types = CategoryType::find_all_by_cat_id(CAT_MEN);

$cat_kids = ProductCategory::find_by_id(CAT_KIDS);

$kids_types = CategoryType::find_all_by_cat_id(CAT_KIDS);

$cat_acc = ProductCategory::find_by_id(CAT_ACC);

$acc_types = CategoryType::find_all_by_cat_id(CAT_ACC);
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Wolfgang-Home</title>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Simple Multi-Item Slider: Category slider with CSS animations" />
        <meta name="keywords" content="jquery plugin, item slider, categories, apple slider, css animation" />
        <meta name="author" content="Codrops" />
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <link rel="stylesheet" type="text/css" href="css/register.css"/>
        <link rel="stylesheet" type="text/css" href="css/view.css" media="all">
        <script src="js/modernizr.custom.63321.js"></script>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>


        <script src="js/ajax.js"></script>
        <script src="js/example.js"></script>
        <script src="js/jquery.color-RGBa-patch.js"></script>

        <script src='js/jquery-1.8.3.min.js'></script>
        <script src='js/jquery.elevatezoom.js'></script> 

        <link rel="stylesheet" type="text/css" href="css/supper.css"/>
        <link rel="stylesheet" type="text/css" href="css/shoe_page.css"/>
        <link rel="stylesheet" type="text/css" href="css/product_list.css"/>
        <link rel="stylesheet" type="text/css" href="css/cart.css"/>
        <!--<script src="js/jquerylibrarry.js"></script>-->        
    </head>

    <body>
        <div id="wrap">
            <img class="logo" src="images/logo-02-01 small.jpg">
            <?php 
//        $user = Customers::find_by_id(2);
//        echo $user->cfname . " " . $user->clname;
            $text = '';
            if(!empty($user)){
                $link = "logout.php";
                $link_text = "logout";
                $text = "Hello, " . $user->cfname . " " . $user->clname . " ";
            } else {
                $link = "registern.php";
                $link_text = "Sign in or Register";
            }
 ?>
            <p class="headsec"><?php echo $text; ?><a class="headsec_link" href="<?php echo $link ?>"><?php echo $link_text ?></a> | <a class="headsec_link" href="myacc.php">My Account</a> | <a class="headsec_link" href="my_cart.php"><strong><img src="images/shopping7.png"> My Cart</strong></a></p><br/>
            <p class="headsec">Help Line <strong><span class="hotline">+94 77 600 1 600</spansz></strong></p><br/>
            <p class="headsec"><span style="font-size:10px;">( open 24 hourse evereyday )</span></p><br/>

            <p class="headsec"> <form action='/search' id='search-form' method='get' target='_top'>
                <input id='search-text' name='q' placeholder='Enter Your Keyword or Product code' type='text'/>
                <button id='search-button' type='submit'><span>Go</span></button>
            </form></p>

        <ul class="maintab">
            <li class="tab"><a class="tablink1" href="index.php">Home</a></li>
            <li class="tabinsub">
                <?php if (!empty($cat_men)) { ?>
                    <a class="tablink" href="product_list.php?cat=<?php echo $cat_men->id ?>"><?php echo $cat_men->category ?></a>
                    <?php if (!empty($men_types)) { ?>
                        <ul class="mensub">
                            <?php
                            $count = count($men_types);
                            $i = 0;
                            foreach ($men_types as $value) {
                                $i++;
                                $li_class = $count == $i ? "subtab1" : "subtab";
                                ?>
                                <li class="<?php echo $li_class ?>"><a class="subtablink" href="product_list.php?cat=<?php echo $cat_men->id ?>&type=<?php echo $value->id ?>"><?php echo $value->type ?><p class="arrow"> > </p></a></li>
                            <?php }
                            ?>                    
                        </ul>
                    <?php
                    }
                }
                ?>
            </li>
            <li class="tabinsub">
                <?php if (!empty($cat_kids)) { ?>
                    <a class="tablink" href="product_list.php?cat=<?php echo $cat_kids->id ?>"><?php echo $cat_kids->category ?></a>
                        <?php if (!empty($kids_types)) { ?>
                        <ul class="mensub">
                            <?php
                            $count = count($kids_types);
                            $i = 0;
                            foreach ($kids_types as $value) {
                                $i++;
                                $li_class = $count == $i ? "subtab1" : "subtab";
                                ?>
                                <li class="<?php echo $li_class ?>"><a class="subtablink" href="product_list.php?cat=<?php echo $cat_kids->id ?>&type=<?php echo $value->id ?>"><?php echo $value->type ?><p class="arrow"> > </p></a></li>
                            <?php }
                            ?>                    
                        </ul>  
                    <?php }
                }
                ?>
            </li>
            <li class="tabinsub">
                <?php if (!empty($cat_acc)) { ?>
                    <a class="tablink" href="product_list.php?cat=<?php echo $cat_acc->id ?>"><?php echo $cat_acc->category ?></a>
                        <?php if (!empty($acc_types)) { ?>
                        <ul class="mensub">
                            <?php
                            $count = count($acc_types);
                            $i = 0;
                            foreach ($acc_types as $value) {
                                $i++;
                                $li_class = $count == $i ? "subtab1" : "subtab";
                                ?>
                                <li class="<?php echo $li_class ?>"><a class="subtablink" href="product_list.php?cat=<?php echo $cat_acc->id ?>&type=<?php echo $value->id ?>"><?php echo $value->type ?><p class="arrow"> > </p></a></li>
                            <?php }
                            ?>                    
                        </ul>  
                    <?php }
                }
                ?>
            </li>
        <!-- <li class="tabinsub"><a class="tablink" href="#">Accessorice</a>
                <ul class="mensub">
                    <li class="subtab"><a class="subtablink" href="#">Shokes<p class="arrow"> > </p></a></li>
                    <li class="subtab"><a class="subtablink" href="#">Polishes<p class="arrow"> > </p></a></li>
                    <li class="subtab1"><a class="subtablink" href="#">Otheres<p class="arrow"> > </p></a></li>
                </ul>
            </li>  -->
            <li class="tab"><a class="tablink_notsub" href="#">Gift voucher</a></li>
            <li class="tab"><a class="tablink_notsub" href="about_us.php">About Wolfgang</a></li>
            <li class="tab"><a class="tablink_notsub" href="contact.php">Contact us</a></li>
            <li class="tab"><a class="tablink2" href="#">Dilevery</a></li>
        </ul>   
