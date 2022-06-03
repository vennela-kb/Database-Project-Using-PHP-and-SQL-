<?php include "logincheck.php"; ?>
<!DOCTYPE html>
<html>
<head>
	<meta content='text/html; charset=UTF-8' http-equiv='Content-Type'/>
	<title>Book Store Login</title>
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
<div id="center">
<div id="center-set">
<div id="signup">
<div id="signup-st">
<div align="center">
<?php
$remarks = isset($_GET['remarks']) ? $_GET['remarks'] : '';
if ($remarks==null and $remarks=="") {
echo ' <div id="reg-head" style=border-top-left-radius:20px; border-top-right-radius: 20px; padding-top: 12px; padding-bottom: 12px; font-size: 22px; color: #6c7a89;>Register Here</div> ';
}
if ($remarks=='success') {
echo ' <div id="reg-head" style=border-top-left-radius:20px; border-top-right-radius: 20px; padding-top: 12px; padding-bottom: 12px; font-size: 22px; color: #6c7a89;>Registration Success</div> ';
}
if ($remarks=='failed') {
echo ' <div id="reg-head-fail" style=border-top-left-radius:20px; border-top-right-radius: 20px; padding-top: 12px; padding-bottom: 12px; font-size: 22px; color: #6c7a89;>Registration Failed!, Username exists</div> ';
}
if ($remarks=='error') {
echo ' <div id="reg-head-fail" style=border-top-left-radius:20px; border-top-right-radius: 20px; padding-top: 12px; padding-bottom: 12px; font-size: 22px; color: #6c7a89;>Registration Failed! <br> Error: '.$_GET['value'].' </div> ';
}
?>
</div>
<form name="reg" action="execute.php" onsubmit="return validateForm()" method="post" id="reg">
<table border="0" align="center" cellpadding="2" cellspacing="0">
<tr>
<td>
<div align="left" id="tb-name">First&nbsp;Name:</div>
</td>
<td width="171">
<input type="text" name="fname" id="tb-box"/>
</td>
</tr>
<tr>
<td><div align="left" id="tb-name">Last&nbsp;Name:</div></td>
<td><input type="text" name="lname" id="tb-box"/></td>
</tr>
<tr>
<td ><div align="left" id="tb-name">Email:</div></td>
<td><input type="text" id="tb-box" name="email" /></td>
</tr>
<tr>
<td><div align="left" id="tb-name">Address:</div></td>
<td><input type="text" id="tb-box" name="address" /></td>
</tr>
<tr>
<tr>
<td ><div align="left" id="tb-name">Phone:</div></td>
<td><input type="text" id="tb-box" name="phone" /></td>
</tr>
<tr>
<td><div align="left" id="tb-name">Username:</div></td>
<td><input type="text" id="tb-box" name="username" /></td>
</tr>
<tr>
<td ><div align="left" id="tb-name">Password:</div></td>
<td><input id="tb-box" type="password" name="password" /></td>
</tr>
<td><div align="left" id="tb-name">Type:</div></td>
<td><select name="type" id="type">
  <option value="customer">Customer</option>
  <option value="publisher">Publisher</option>
  <option value="admin">Admin</option>
</select></td>
</tr>
<tr>
	<td>
	<div id="st"><input name="submit" type="submit" value="Submit" id="st-btn"/></div>
</td>
</tr>
</table>

</form>
</div>
</div>
<div id="login">
<div id="login-st">
	<hr>
<br>
<br>
<form action="" method="POST" id="signin" id="reg">
<?php
$remarks = isset($_GET['remark_login']) ? $_GET['remark_login'] : '';
if ($remarks==null and $remarks=="") {
echo ' <center><div>Existing User Login Here</div></center> ';
}
if ($remarks=='failed') {
echo ' <div>Login Failed!, Invalid Credentials</div> ';
}
?>
<table border="0" align="center" cellpadding="2" cellspacing="0">
<tr>
<td>Username:</div></td>
<td><input type="text" id="tb-box" name="username" /></td>
</tr>
<tr>
<td ><div align="left" id="tb-name">Password:</div></td>
<td><input id="tb-box" type="password" name="password" /></td>
</tr>
<tr>
	<td><div id="st"><input name="submit" type="submit" value="Login" id="st-btn"/></div></td>
<tr>
</table>

</form>
</div>
</div>
</div>
</div>
</body>
</html>