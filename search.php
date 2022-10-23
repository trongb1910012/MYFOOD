
<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");  //kết nối csdl
error_reporting(0);
session_start();

?>

<body>

<form action="phpSearch.php" method="post">
Search <input type="text" name="search"><br>
<input type ="submit">
</form>

</body>

    
</html>

