<?php
session_start();
include('dbcontroller.php');
$user_check = $_SESSION['login_user'];
$ses_sql = mysqli_query($con, "select username,mem_id,type from `bookstore`.`member` where username='$user_check'");
$row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);
$loggedin_session = $row['username'];
$loggedin_id = $row['mem_id'];
$loggedin_type = $row['type'];
$_SESSION["mem_id"] = $row['mem_id'];
if (!isset($loggedin_session) || $loggedin_session == NULL) {
	echo "Go back";
	echo("<script>location.href = 'index.php';</script>");

}
?>