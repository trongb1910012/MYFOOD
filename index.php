<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");  //kết nối csdl
error_reporting(0);
session_start();
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <link rel="icon" href="homepage.png">
    <title>Trang chủ</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <!--CSS -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="home">

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
    <!-- banner-->
    <section class="hero bg-image" data-image-src="images/img/banner.jpg">
        <div class="hero-inner">
            <div class="container text-center hero-text font-white">
                <h1>Enjoy your meal</h1>
                <div class="banner-form">
                     <form class="form-inline" action="index.php" method="get">
                        <div class="form-group">
                            <label class="sr-only" for="exampleInputAmount">Tìm kiếm món ăn</label>
                            <div class="form-group">
                                <input type="text" name="search" class="form-control form-control-lg" id="exampleInputAmount" placeholder="Tôi muốn ăn">
                            </div>
                        </div>
                        <button  type="submit" class="btn theme-btn btn-lg" >Tìm kiếm</button>
                    </form> 
                </div>
            </div>
        </div>
    </section>
    <!-- banner ends -->

    <!-- Popular -->
    <section class="popular">
        <div class="container">
            <div class="row">
                <?php
                $query_res = mysqli_query($db, "select * from dishes LIMIT 3");
                $search = $_GET['search'];
                $sql = "select * from dishes where title like '%$search%'";
                $result = $db->query($sql);
                if (empty($_GET["search"])) // khi chưa đăng nhập
                {
                    echo '<div class="title text-xs-center m-b-30">
                    <h2>Món ăn đươc yêu thích</h2>
                             </div> ';
                    while ($r = mysqli_fetch_array($query_res)) {
                        echo '<div class="col-xs-4 col-sm-4 col-md-4 food-item">
                                <div class="food-item-wrap">
                                    <div class="figure-wrap bg-image" data-image-src="images/product/' . $r['img'] . '">
                                    </div>
                                    <div class="content">
                                        <h5><a href="dishes.php?res_id=' . $r['rs_id'] . '">' . $r['title'] . '</a></h5>
                                        <div class="product-name">' . $r['slogan'] . '</div>
                                        <div class="price-btn-block"> <span class="price">' . $r['price'] . 'đ</span> <a href="dishes.php?res_id=' . $r['rs_id'] . '" class="btn theme-btn-dash pull-right">Đặt ngay</a> </div>
                                    </div>
                                    
                                </div>
                        </div>';
                    }
                } else {
                    if ($result->num_rows > 0) {
                        echo '<div class="title text-xs-center m-b-30">
                                        <h2>Kết quả tìm kiếm cho từ khóa :"'. $search .'"</h2>
                                    </div> ';
                        while ($r1 = $result->fetch_assoc()) {
                            echo ' <div class="col-xs-4 col-sm-4 col-md-4 food-item">
                                    <div class="food-item-wrap">
                                        <div class="figure-wrap bg-image" data-image-src="images/product/' . $r1['img'] . '">
                                        </div>
                                        <div class="content">
                                            <h5><a href="dishes.php?res_id=' . $r1['rs_id'] . '">' . $r1['title'] . '</a></h5>
                                            <div class="product-name">' . $r1['slogan'] . '</div>
                                            <div class="price-btn-block"> <span class="price">' . $r1['price'] . 'đ</span> <a href="dishes.php?res_id=' . $r1['rs_id'] . '" class="btn theme-btn-dash pull-right">Đặt ngay</a> </div>
                                        </div>
                                        
                                    </div>
                            </div>';
    }
                    } else {
                        echo "0 records";
                    }
                $db->close(); }
                ?>

            </div>
        </div>
    </section>
    <!-- Popular ends -->
    <!-- start: FOOTER -->
    <footer class="footer">
        <div class="container">
            <!-- top footer statrs -->
            <div class="row top-footer">
                <div class="col-xs-12 col-sm-3 footer-logo-block text-dark">
                    <a href="#"> <img class="img-rounded" src="images/img/logo.jpg" width="70%" alt="Footer logo"> </a> <span>Choose it &amp; Enjoy your meals! </span>
                </div>
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
                        <h5>Call us at: <a href="tel:+914450005500">0382030303</a></h5>
                    </div>
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

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/animsition.min.js"></script>
    <script src="js/bootstrap-slider.min.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <!-- <script src="js/headroom.js"></script> -->
    <script src="js/foodpicky.min.js"></script>
</body>

</html>