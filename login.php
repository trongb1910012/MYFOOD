<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Login</title>
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

      <link rel="stylesheet" href="css/login.css">

	  <style type="text/css">
	  #buttn{
		  color:#fff;
		  background-color: #ba1d20;
	  }
	  .pen-title h1{
		color: #ba1d20;
	  }
	  </style>
</head>

<body>
<?php
include("connection/connect.php"); //Kết nối csdl
error_reporting(0); 
session_start(); 
if(isset($_POST['submit']))   // bấm nút submit
{
	$username = $_POST['username'];  //lấy username và mk
	$password = $_POST['password'];
	
	if(!empty($_POST["submit"]))   // nếu kq không trống
     {
	// $loginquery ="SELECT * FROM users WHERE username='$username' && password='".md5($password)."'";
	$loginquery ="SELECT * FROM users WHERE username='$username' && password='$password'";
	$result=mysqli_query($db, $loginquery);
	$row=mysqli_fetch_array($result);
	
	                        if(is_array($row))  // if matching records in the array & if everything is right
								{
                                    	$_SESSION["user_id"] = $row['u_id']; 
										 header("refresh:1;url=index.php"); // vào trang chủ
	                            } 
							else
							    {
                                      	$message = "Mật khẩu và tên đăng nhập không đúng!!"; // lỗi
                                }
	 }
	
	
}
?>
<div class="pen-title">
  <h1>Đăng nhập</h1>
</div>
<!-- Form Module-->
<div class="module form-module">
  <div class="toggle">
   
  </div>
  <div class="form">
    <h2>Đăng nhập</h2>
	  <span style="color:red;"><?php echo $message; ?></span> 
   <span style="color:green;"><?php echo $success; ?></span>
    <form action="" method="post">
      <input type="text" placeholder="Tên đăng nhập"  name="username"/>
      <input type="password" placeholder="Mật khẩu" name="password"/>
      <input type="submit" id="buttn" name="submit" value="Đăng nhập" />
    </form>
  </div>
  
  <div class="cta">Bạn chưa có tài khoản??<a href="registration.php" style="color:#ba1d20;">Đăng kí tại đây</a></div>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
</body>

</html>
