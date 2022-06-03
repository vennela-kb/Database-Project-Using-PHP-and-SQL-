<?php
include('session.php');
require_once("dbcontroller.php");
$user_check = $_SESSION['login_user'];
echo $user_check;
$ses_sql = mysqli_query($con, "select * from `bookstore`.`member` where username='$user_check'");
$row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);
error_reporting(E_ERROR | E_PARSE);
?>

<!DOCTYPE html>
<html>
<head>
	<meta content='text/html; charset=UTF-8' http-equiv='Content-Type'/>
	<title>Personal Page</title>
</head>
<body>
<center><p>Update Perosnal Details and MemberShip</p></center>
    <form name="reg" action="personal.php" method="post" id="reg" enctype="multipart/form-data">
        <table border="0" align="center" cellpadding="2" cellspacing="0">
        <tr>
        <td><div align="left" id="tb-name">First Name:</div></td>
        <td><input type="text" name="fname" id="tb-box" value=<?php echo $row['fname']; ?> //></td>
        </tr>
        <tr>
        <td><div align="left" id="tb-name">Last Name:</div></td>
        <td><input type="text" name="lname" id="tb-box" value=<?php echo $row['lname']; ?> //></td>
        </tr>
        <tr>
        <td><div align="left" id="tb-name">email:</div></td>
        <td><input type="text" name="email" id="tb-box" value=<?php echo $row['email']; ?> //></td>
        </tr>
        <tr>
        <td><div align="left" id="tb-name">Address:</div></td>
        <td><input type="text" name="address" id="tb-box" value=<?php echo $row['address']; ?> //></td>
        </tr>
        <tr>
        <td><div align="left" id="tb-name">MemberShip:</div></td>
        <td>
        <select name="member" id="member">
        <option value="yes">Yes</option>
        <option value="no">No</option>
        </select>
        </td>
        </tr>
        <tr>
            <td><input name="submit" type="submit" value="Submit"/></td>
        </tr>
</table>
</form>
</body>
</html>

<?php
//add athor
if (isset($_POST['submit'])) {
    // $fname = $_POST['fname'];
    // $lname = $_POST['lname'];
    // $email = $_POST['email'];
    // $address = $_POST['address'];
    // $sql = "UPDATE `bookstore`.`member` SET fname='$fname',lname='$lname',email='$email',address='$address' where username='$user_check'";
    // if ($con->query($sql) === TRUE) {
    //     echo '<script>alert("Updated Successfully")</script>';
    //     $_POST = array();
    if ($_POST['member'] == "yes") {
        echo("<script>location.href = 'membershipcheckout.php?total_price=10';</script>");
    }
// }
// else {
//     echo '<script>alert("Updated failed")</script>';
// }
}