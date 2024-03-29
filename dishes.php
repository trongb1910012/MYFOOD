<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php"); // connection to db
error_reporting(0);
session_start();

include_once 'product-action.php'; //including controller

?>


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="potoffood.png">
    <title>Dishes</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>

    <!--header starts-->
    <!--header starts-->
    <header id="header" class="header-scroll top-header headrom">
        <!-- .navbar -->
        <nav class="navbar navbar-light">
            <div class="container">
                <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                <a class="navbar-brand" href="index.php"> <img class="img-rounded" src="images/img/logo.jpg" width="70px" alt=""> </a>
                <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                    <ul class="nav navbar-nav">
                        <li class="nav-item"> <a class="nav-link active" href="index.php">Trang chủ<span class="sr-only">(current)</span></a> </li>
                        <li class="nav-item"><a href="restaurants.php" class="nav-link active">Món ăn</a>
                            <?php
                            if (empty($_SESSION["user_id"])) // khi chưa đăng nhập
                            {
                                echo '<li class="nav-item"><a href="login.php" class="nav-link active">Đăng nhập</a> </li>
							  <li class="nav-item"><a href="registration.php" class="nav-link active">Đăng ký</a> </li>';
                            } else {
                                //khi đã đăng nhập

                                echo  '<li class="nav-item"><a href="your_orders.php" class="nav-link active">Đơn đã đặt</a> </li>';
                                echo  '<li class="nav-item"><a href="logout.php" class="nav-link active">Đăng xuất</a> </li>';
                            }

                            ?>

                    </ul>

                </div>
            </div>
        </nav>
        <!-- /.navbar -->
    </header>
    <div class="page-wrapper">
        <div class="row restaurant-entry">
            <?php $ress = mysqli_query($db, "select * from restaurant");
            while ($rows = mysqli_fetch_array($ress)) {


                echo ' <div class="col-sm-12 col-md-12 col-lg-2 text-xs-center text-sm-left">
															<div class="entry-logo">
																<a class="img-fluid" href="dishes.php?res_id=' . $rows['rs_id'] . '" > <img src="images/product/' . $rows['image'] . '" alt="Food logo"></a>
															</div>
														</div>
														
													';
            }


            ?>

        </div>
        <div class="container">

        </div>
    </div>
    <div class="container m-t-30">
        <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">

                <div class="widget widget-cart">
                    <div class="widget-heading">
                        <h3 class="widget-title text-dark">
                            Giỏ hàng của bạn
                        </h3>


                        <div class="clearfix"></div>
                    </div>
                    <div class="order-row bg-white">
                        <div class="widget-body">


                            <?php

                            $item_total = 0;

                            foreach ($_SESSION["cart_item"] as $item)  // fetch items define current into session ID
                            {
                            ?>

                                <div class="title-row">
                                    <?php echo $item["title"]; ?><a href="dishes.php?res_id=<?php echo $_GET['res_id']; ?>&action=remove&id=<?php echo $item["d_id"]; ?>">
                                        <i class="fa fa-trash pull-right"></i></a>
                                </div>

                                <div class="form-group row no-gutter">
                                    <div class="col-xs-8">
                                        <input type="text" class="form-control b-r-0" value=<?php echo $item["price"]; ?> readonly id="exampleSelect1">

                                    </div>
                                    <div class="col-xs-4">
                                        <input class="form-control" type="text" readonly value='<?php echo $item["quantity"]; ?>' id="example-number-input">
                                    </div>

                                </div>

                            <?php
                                $item_total += ($item["price"] * $item["quantity"]); // calculating current price into cart
                            }
                            ?>



                        </div>
                    </div>

                    <!-- end:Order row -->

                    <div class="widget-body">
                        <div class="price-wrap text-xs-center">
                            <p>Total Amount</p>
                            <h3 class="value"><strong><?php echo $item_total; ?>đ</strong></h3>
                            <p>Free Shipping</p>
                            <a href="checkout.php?res_id=<?php echo $_GET['res_id']; ?>&action=check" class="btn theme-btn btn-lg">Checkout</a>
                        </div>
                    </div>




                </div>
            </div>

            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-6">

                <!-- end:Widget menu -->
                <div class="menu-widget" id="2">
                    <div class="widget-heading">
                        <h3 class="widget-title text-dark">
                            Your Menu <a class="btn btn-link pull-right" data-toggle="collapse" href="#popular2" aria-expanded="true">
                                <i class="fa fa-angle-right pull-right"></i>
                                <i class="fa fa-angle-down pull-right"></i>
                            </a>
                        </h3>
                        <div class="clearfix"></div>
                    </div>
                    <div class="collapse in" id="popular2">
                        <?php  // display values and item of food/dishes
                        $stmt = $db->prepare("select * from dishes where rs_id='$_GET[res_id]'");
                        $stmt->execute();
                        $products = $stmt->get_result();
                        if (!empty($products)) {
                            foreach ($products as $product) {



                        ?>
                                <div class="food-item">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-lg-8">
                                            <form method="post" action='dishes.php?res_id=<?php echo $_GET['res_id']; ?>&action=add&id=<?php echo $product['d_id']; ?>'>
                                                <div class="rest-logo pull-left">
                                                    <a class="restaurant-logo pull-left" href="#"><?php echo '<img src="images/product/' . $product['img'] . '" alt="Food logo">'; ?></a>
                                                </div>
                                                <!-- end:Logo -->
                                                <div class="rest-descr">
                                                    <h6><a href="#"><?php echo $product['title']; ?></a></h6>
                                                    <p> <?php echo $product['slogan']; ?></p>
                                                </div>
                                                <!-- end:Description -->
                                        </div>
                                        <!-- end:col -->
                                        <div class="col-xs-12 col-sm-12 col-lg-4 pull-right item-cart-info">
                                            <span class="price pull-left"><?php echo $product['price']; ?>đ</span>
                                            <input class="b-r-0" type="text" name="quantity" style="margin-left:30px;" value="1" size="2" />
                                            <input type="submit" class="btn theme-btn" style="margin-left:40px;" value="Thêm vào giỏ" />
                                        </div>
                                        </form>
                                    </div>
                                    <!-- end:row -->
                                </div>
                                <!-- end:Food item -->

                        <?php
                            }
                        }

                        ?>



                    </div>
                    <!-- end:Collapse -->
                </div>
                <!-- end:Widget menu -->

            </div>
            <!-- end:Bar -->

            <!-- end:Right Sidebar -->
        </div>
        <!-- end:row -->
    </div>
    <!-- end:Container -->
    <!-- start: FOOTER -->
    <footer class="footer">
            <div class="container">
                <!-- top footer statrs -->
                <div class="row top-footer">
                    <div class="col-xs-12 col-sm-3 footer-logo-block text-dark">
                        <a href="#"> <img class="img-rounded" src="images/img/logo.jpg" width="70%" alt="Footer logo"> </a> <span>Choose it &amp; Enjoy your meals! </span> </div>
                    <div class="col-xs-12 col-sm-2 how-it-works-links text-dark">
                        <h5>How it Works?</h5>
                        <ul>
                            <li><a href="#">Chọn món ăn</a></li>
                            <li><a href="#">Cung cấp địa chỉ</a></li>
							<li><a href="#">Thanh toán trực tiếp</a></li>
							<li><a href="#">Thưởng thức bửa ăn</a></li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-2 pages text-dark">
                        <h5>Legal</h5>
                        <ul>
                            <li><a href="#">Terms & Conditions</a> </li>
                            <li><a href="#">Refund & Cancellation</a> </li>
                            <li><a href="#">Privacy Policy</a> </li>
                            <li><a href="#">Cookie Policy</a> </li>
                            <li><a href="#">Offer Terms</a> </li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-3 popular-locations text-dark">
                        <h5>Địa chỉ có thể giao</h5>
                        <ul>
                            <li><a href="#">Quận Ninh Kiều</a></li>
                            <li><a href="#">Quận Bình Thủy</a></li>
                            <li><a href="#">Quận Cái Răng</a></li>
                        </ul>
                    </div>
                </div>
                <!-- top footer ends -->
                <!-- bottom footer statrs -->
                <div class="bottom-footer">
                    <div class="row">
                        <div class="col-xs-12 col-sm-4 address text-dark">
                            <h5>Địa chỉ:</h5>
                            <p>ĐH Cần Thơ 3/2 p.Xuân Khánh Q.Ninh Kiều</p>
                            <h5>Call us at: <a href="tel:+914450005500">0382030303</a></h5></div>
                        <div class="col-xs-12 col-sm-5 additional-info text-dark">
                            <h5>Who are we?</h5>
                            <p>Launched in 2022, Our technology platform connects customers, restaurant partners and delivery partners, serving their multiple needs. Customers use our platform to search and discover restaurants, read and write customer generated reviews and view and upload photos, order food delivery, book a table and make payments while dining-out at restaurants.</p>
                        </div>
                    </div>
                </div>
                <!-- bottom footer ends -->
            </div>
        </footer>
    <!-- end:Footer -->
    </div>
    <!-- end:page wrapper -->
    </div>
    <!--/end:Site wrapper -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/animsition.min.js"></script>
    <script src="js/bootstrap-slider.min.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/headroom.js"></script>
    <script src="js/foodpicky.min.js"></script>
</body>

</html>