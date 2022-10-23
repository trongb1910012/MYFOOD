<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
error_reporting(0);
session_start();

if(empty($_SESSION['user_id']))  //if usser is not login redirected back to login page
{
	header('location:login.php');
}
else
{
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="ecommerce.png">
    <title>Đơn đặt của bạn</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <style type="text/css" rel="stylesheet">
    .indent-small {
        margin-left: 5px;
    }

    .form-group.internal {
        margin-bottom: 0;
    }

    .dialog-panel {
        margin: 10px;
    }

    .datepicker-dropdown {
        z-index: 200 !important;
    }

    .panel-body {
        background: #e5e5e5;
        /* Old browsers */
        background: -moz-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
        /* FF3.6+ */
        background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, #e5e5e5), color-stop(100%, #ffffff));
        /* Chrome,Safari4+ */
        background: -webkit-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
        /* Chrome10+,Safari5.1+ */
        background: -o-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
        /* Opera 12+ */
        background: -ms-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
        /* IE10+ */
        background: radial-gradient(ellipse at center, #e5e5e5 0%, #ffffff 100%);
        /* W3C */
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#e5e5e5', endColorstr='#ffffff', GradientType=1);
        /* IE6-9 fallback on horizontal gradient */
        font: 600 15px "Open Sans", Arial, sans-serif;
    }

    label.control-label {
        font-weight: 600;
        color: #777;
    }


    table {
        width: 750px;
        border-collapse: collapse;
        margin: auto;
    }
    th {
        background: #ba1d20;
        color: white;
        font-weight: bold;

    }

    td,
    th {
        padding: 10px;
        border: 1px solid #ccc;
        text-align: left;
        font-size: 14px;

    }


    @media only screen and (max-width: 760px),
    (min-device-width: 768px) and (max-device-width: 1024px) {

        table {
            width: 100%;
        }


        table,
        thead,
        tbody,
        th,
        td,
        tr {
            display: block;
        }

        thead tr {
            position: absolute;
            top: -9999px;
            left: -9999px;
        }

        tr {
            border: 1px solid #ccc;
        }

        td {

            border: none;
            border-bottom: 1px solid #eee;
            position: relative;
            padding-left: 50%;
        }

        td:before {

            position: absolute;

            top: 6px;
            left: 6px;
            width: 45%;
            padding-right: 10px;
            white-space: nowrap;
            /* Label the data */
            content: attr(data-column);

            color: #000;
            font-weight: bold;
        }

    }
    </style>

</head>

<body>

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
        <!-- //results show -->
        <section class="restaurants-page">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-3">
                    </div>
                    <div class="col-xs-12 col-sm-7 col-md-7 ">
                        <div class="bg-gray restaurant-entry">
                            <div class="row">

                                <table>
                                    <thead>
                                        <tr>

                                            <th>Món ăn</th>
                                            <th>Số lượng</th>
                                            <th>Giá</th>
                                            <th>Trạng thái</th>
                                            <th>Ngày</th>
                                            <th>Xóa</th>

                                        </tr>
                                    </thead>
                                    <tbody>


                                        <?php 
						// displaying current session user login orders 
						$query_res= mysqli_query($db,"select * from users_orders where u_id='".$_SESSION['user_id']."'");
												if(!mysqli_num_rows($query_res) > 0 )
														{
															echo '<td colspan="6"><center>Bạn chưa order</center></td>';
														}
													else
														{			      
										  
										  while($row=mysqli_fetch_array($query_res))
										  {
						
							?>
                                        <tr>
                                            <td data-column="Item"> <?php echo $row['title']; ?></td>
                                            <td data-column="Quantity"> <?php echo $row['quantity']; ?></td>
                                            <td data-column="Price"><?php echo $row['price'] ; ?>đ</td>
                                            <td data-column="Status">
                                                <?php 
																			$status=$row['status'];
																			if($status=="" or $status=="NULL")
																			{
																			?>
                                                <button type="button" class="btn btn-info"
                                                    style="font-weight:bold;">Đang chờ</button>
                                                <?php 
																			  }
																			   if($status=="in process")
																			 { ?>
                                                <button type="button" class="btn btn-warning"><span
                                                        class="fa fa-cog fa-spin" aria-hidden="true"></span>Đang giao hàng</button>
                                                <?php
																				}
																			if($status=="closed")
																				{
																			?>
                                                <button type="button" class="btn btn-success"><span
                                                        class="fa fa-check-circle" aria-hidden="true">Đã giao</button>
                                                <?php 
																			} 
																			?>
                                                <?php
																			if($status=="rejected")
																				{
																			?>
                                                <button type="button" class="btn btn-danger"> <i
                                                        class="fa fa-close"></i>Đã hủy</button>
                                                <?php 
																			} 
																			?>






                                            </td>
                                            <td data-column="Date"> <?php echo $row['date']; ?></td>
                                            <td data-column="Action"> <a
                                                    href="delete_orders.php?order_del=<?php echo $row['o_id'];?>"
                                                    onclick="return confirm('Are you sure you want to cancel your order?');"
                                                    class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i
                                                        class="fa fa-trash-o" style="font-size:16px"></i></a>
                                            </td>

                                        </tr>


                                        <?php }} ?>




                                    </tbody>
                                </table>



                            </div>
                            <!--end:row -->
                        </div>



                    </div>



                </div>
            </div>
    </div>
    </section>
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