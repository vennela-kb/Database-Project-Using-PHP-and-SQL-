<?php
include('session.php');
if ($loggedin_type != "admin") {
    echo '<script>alert("You are not a valid admim")</script>';
    echo("<script>location.href = 'home.php';</script>");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta content='text/html; charset=UTF-8' http-equiv='Content-Type'/>
	<title>Welcome to Admin Page</title>
</head>
<body>
<header>
<?php include("header.php"); ?>
</header>
<div id="center">
<div id="center-set">
<h1 align='center'>Welcome <?php echo $loggedin_session; ?>,</h1>
<div id="contentbox">
<?php
$sql = "SELECT * FROM `bookstore`.`member`";
$result = mysqli_query($con, $sql);
?>
<div id="signup">
<div id="signup-st">
<form action="" method="POST" id="signin" id="reg">
<center><p>Remove/Edit Books</p></center>
<table border="1" align="center" cellpadding="1" cellspacing="1">
<tr>
                <td>Id</td>
                <td>UserName</td>
                <td>password</td>
				<td>FirstName</td>
				<td>LastName</td>
				<td>email</td>
</tr>
<?php
while ($rows = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $rows['mem_id'] . "</td>";
    echo "<td>" . $rows['username'] . "</td>";
    echo "<td>" . $rows['password'] . "</td>";
    echo "<td>" . $rows['fname'] . "</td>";
    echo "<td>" . $rows['lname'] . "</td>";
    echo "<td>" . $rows['address'] . "</td>";
    echo "<td><input name='delete' type='submit' value='Remove'/></td>";
    echo "<td><input name='update' type='submit' value='Update'/></td>";
    echo "</tr>";
}

?>
</table>
</form>
<!-- Add for updating Shipping cost -->
<?php
$sql1 = "SELECT * FROM `bookstore`.`shippingcost`";
$result1 = mysqli_query($con, $sql1);
?>
<hr>
<form name="reg" action="admin.php" method="post" id="reg">
        <table border="0" align="center" cellpadding="2" cellspacing="0">
        <tr>
        <td>
        <div align="left" id="tb-name">Pincode:</div>
        </td>
        <td width="171">
        <input type="text" name="pin" id="tb-box"/>
        </td>
        </tr>
        <tr>
        <td><div align="left" id="tb-name">Cost:</div></td>
        <td><input type="text" name="cost" id="tb-box"/></td>
        </tr>
        <tr>
		<tr>
            <td><input name="cost" type="submit" value="Submit"/></td>
        </tr>
		</table>
		</form>
<hr>
<center><p>Update Shipping Cost</p></center>
<form action="" method="POST" id="signin" id="reg">
<table border="1" align="center" cellpadding="1" cellspacing="1">
<tr>
                <td>Pincode</td>
                <td>Cost</td>
</tr>
<?php
while ($rows1 = mysqli_fetch_array($result1)) {
    echo "<tr>";
    echo "<td><input type='text' id='fname' name='pin' value=" . $rows1['pincode'] . "></td>";
    echo "<td><input type='text' id='fname' name='cost' value=" . $rows1['cost'] . "></td>";
    echo "<td><input name='delete' type='submit' value='Remove'/></td>";
    echo "<td><input name='update' type='submit' value='Update'/></td>";
    echo "</tr>";
}

?>
</table>
</form>

</div>
</div>

<?php

//add athor
if (isset($_POST['cost'])) {
    $username = $_POST['pin'];
    if ($result = mysqli_query($con, "SELECT * FROM `bookstore`.`shippingcost` WHERE pincode='$username'")) {
        $num_rows = mysqli_num_rows($result);
    }
    if ($num_rows) {
        echo '<script>alert("Same pincode is there already")</script>';
    }
    else {
        $pin = $_POST['pin'];
        $cost = $_POST['cost'];
        $sql = "INSERT INTO `bookstore`.`shippingcost` (`pincode`, `cost`) VALUES ('$pin', '$cost')";
        if ($con->query($sql) === TRUE) {
            echo '<script>alert("New cost created Successfully")</script>';
            $_POST = array();
        }
        else {
            echo '<script>alert("cost failed to create")</script>';
            $_POST = array();
        }
    }
}
?>
</div>
</div>
</div>
</br>
</body>
</html>