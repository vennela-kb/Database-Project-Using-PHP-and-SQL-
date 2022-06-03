<?php
include('session.php');
require_once("dbcontroller.php");
$db_handle = new DBController();
$ses_sql = mysqli_query($con, "select username,mem_id,address from `bookstore`.`member` where username='$user_check'");
$row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);
$address = $row['address'];
$total_price = $_GET['total_price'];
$loggedin_id = $row['mem_id'];
error_reporting(E_ERROR | E_PARSE);
?>
<!DOCTYPE html>
<html>
<head>
	<meta content='text/html; charset=UTF-8' http-equiv='Content-Type'/>
	<title>Checkout</title>
</head>
<body>
<header>
	<nav>
		<ul>
<?php
include("header.php");
?>
		</ul>
	</nav>
</header>
<center><p>Complete Your Payment</p></center>
<form name="reg" action="checkout.php" method="post" id="reg" enctype="multipart/form-data">
        <table border="0" align="center" cellpadding="2" cellspacing="0">
        <tr>
        <td>Price:</td>
        <?php
echo "<td><input type='text' readonly name='price' id='tb-box' value=" . $total_price . "></td>";
?>
        </tr>
        <tr>
        <td>Shipping Address:</td>
          <?php
echo "<td><textarea cols='40' rows='5' name='address' id='tb-box'>" . $address . "</textarea></td>";
?>
        </tr>
        <tr>
        <td><div align="left" id="tb-name">Payment Type:</div></td>
        <td><select name="type" id="type">
        <option value="cash">Cash</option>
        <option value="card">Card</option>
        <option value="bank">Bank</option>
        </select></td>
        </tr>
        <tr>
            <td><input name="pay" type="submit" value="Submit"/></td>
        </tr>
</table>
</form>