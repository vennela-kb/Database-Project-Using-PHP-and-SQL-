<?php
session_start();
include("dbcontroller.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$username = mysqli_real_escape_string($con, $_POST['username']);
	$password = mysqli_real_escape_string($con, $_POST['password']);
	echo $username;
	$result = mysqli_query($con, "SELECT * FROM `bookstore`.`member`");
	$c_rows = mysqli_num_rows($result);
	if ($c_rows != $username) {
		//echo("<script>location.href = 'index.php?remark_login=failed';</script>"); 
		echo $username;
	}
	$sql = "SELECT * FROM `bookstore`.`member` WHERE username='$username' and password='$password'";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result);
	$active = $row['active'];
	$type = $row['type'];
	$count = mysqli_num_rows($result);
	if ($count == 1) {
		$_SESSION['login_user'] = $username;
		if ($type == "customer") {
			echo("<script>location.href = 'customer.php';</script>");
		}
		elseif ($type == "admin") {
			echo("<script>location.href = 'admin.php';</script>");
		}
		elseif ($type == "publisher") {
			echo("<script>location.href = 'publisher.php';</script>");
		}

	}
}
?>