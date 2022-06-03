<?php 
session_start();
include('dbcontroller.php');
$username=$_POST['username'];
if ($result = mysqli_query($con,"SELECT * FROM `bookstore`.`member` WHERE username='$username'"))
{
$num_rows = mysqli_num_rows($result);
}
if ($num_rows) {
	echo("<script>location.href = 'index.php?remarks=failed';</script>"); 
}else {
 $fname=$_POST['fname'];
 $lname=$_POST['lname'];
 $address=$_POST['address'];
 $email=$_POST['email'];
 $phone=$_POST['phone'];
 $username=$_POST['username'];
 $password=$_POST['password'];
 $type=$_POST['type'];
 $sql = "INSERT INTO `bookstore`.`member` (`username`, `password`, `fname`, `lname`, `address`, `type`, `email`, `phone`) VALUES ('$username', '$password', '$fname', '$lname','$address','$type', '$email', '$phone')";
 if ($con->query($sql) === TRUE) {
	echo '<script>alert("User Created Successfully - Please Login")</script>';
	echo("<script>location.href = 'index.php?remarks=success';</script>");
  } else {
	echo "Error: " . $sql . "<br>" . $conn->error;
  }
  
}
?>