<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
include_once 'product-action.php';
error_reporting(0);
session_start();
if(empty($_SESSION["user_id"]))
{
	header('location:login.php');
}
else{

										  
												foreach ($_SESSION["cart_item"] as $item)
												{
                                                    $item_title = $item["title"];
							
												    $item_total += ($item["price"]*$item["quantity"]);
												
													if($_POST['submit'])
													{
						
													$SQL="insert into users_orders(u_id,title,quantity,price) values('".$_SESSION["user_id"]."','".$item["title"]."','".$item["quantity"]."','".$item["price"]."')";
						
														mysqli_query($db,$SQL);
														
														$success = "Bạn đã đặt hàng thành công! Xin cảm ơn";

														
														
													}
												}
?>


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="checkout.png">
    <title>Order Checkout</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet"> </head>
<body>
    
    <div class="site-wrapper">
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
						if(empty($_SESSION["user_id"])) // khi chưa đăng nhập
							{
								echo '<li class="nav-item"><a href="login.php" class="nav-link active">Đăng nhập</a> </li>
							  <li class="nav-item"><a href="registration.php" class="nav-link active">Đăng ký</a> </li>';
							}
						else
							{
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
                <div class="container">
                 
					   <span style="color:green;">
								<?php echo $success; ?>
										</span>	
                </div>			  
            <div class="container m-t-30">
			<form action="" method="post">
                <div class="widget clearfix">
                    
                    <div class="widget-body">
                        <form method="post" action="#">
                            <div class="row">
                                
                                <div class="col-sm-12">
                                    <div class="cart-totals margin-b-20">
                                        <div class="cart-totals-title">
                                            <h4>Xác nhận</h4> </div>
                                        <div class="cart-totals-fields">
                                            <table class="table">
											<tbody>
                                                    <tr>
                                                        <td>Món ăn</td>
                                                        <td><?php echo $item_title;?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Giá món ăn</td>
                                                        <td><?php echo $item_total; ?>đ</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Phí giao hàng</td>
                                                        <td>FREE*</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-color"><strong>Tổng</strong></td>
                                                        <td class="text-color"><strong> <?php echo $item_total; ?>đ</strong></td>
                                                    </tr>
                                                </tbody>	
                                            </table>
                                        </div>
                                    </div>
                                    <!--cart summary-->
                                    <div class="payment-option">
                                        <p class="text-xs-center"> <input action="" type="submit" onclick="return confirm('Are you sure?');" name="submit"  class="btn btn-outline-success btn-block" value="Đặt hàng"> </p>
                                    </div>
									</form>
                                </div>
                            </div>
                       
                    </div>
                </div>
				 </form>
            </div>
                   
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

<?php
}
?>
