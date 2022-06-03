<?php
$mysql_hostname = "127.0.0.1";
$mysql_user = "root";
$mysql_password = "";
$mysql_database = "bookstore";
$con = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password, $mysql_database);
if ($con->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  
class DBController {
	private $host = "127.0.0.1";
	private $user = "root";
	private $password = "";
	private $database = "bookstore";
	private $conn;
	
	function __construct() {
		$this->conn = $this->connectDB();
	}
	
	function connectDB() {
		$conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
		return $conn;
	}
	
	function runQuery($query) {
		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
		}		
		if(!empty($resultset))
			return $resultset;
	}
	
	function numRows($query) {
		$result  = mysqli_query($this->conn,$query);
		$rowcount = mysqli_num_rows($result);
		return $rowcount;	
	}
}
?>