<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
error_reporting(E_ERROR | E_PARSE);
if(!empty($_GET["action"])) {
  switch($_GET["action"]) {
    case "add":
      session_start();
      $user_check=$_SESSION['login_user'];
      $ses_sql=mysqli_query($con,"select username,mem_id from bookstore.`member` where username='$user_check'");
      $row=mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
      $loggedin_session=$row['username'];
      $loggedin_id=$row['mem_id'];
      $_SESSION["mem_id"] = $row['mem_id'];
      if(!isset($loggedin_session) || $loggedin_session==NULL) {
	      echo("<script>location.href = 'index.php';</script>"); 
      }
      else{
        echo("<script>location.href = 'customer.php';</script>"); 
      }
      break;	
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnav {
  overflow: hidden;
  background-color: rgb(51, 51, 51);
}

.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #020008;
  color: white;
}
</style>
</head>
<body>

<div class="topnav">
  <a class="active" href="#home">Home</a>
  <a href="customer.php">Members</a>
  <a href="publisher.php">Publishers</a>
  <a href="admin.php">Admin</a>
</div>

<div style="padding-left:16px">
  <h2>Welcome to Book Store</h2>
  <div style="margin: 40px;">
    <form method="POST" action="home.php">
                    <div>
                        <input type="text" placeholder="Search here..." name="keyword" required="required" value="<?php echo isset($_POST['keyword']) ? $_POST['keyword'] : '' ?>"/>
                        <span >
                            <button name="search">Search</span></button>
                        </span>
                    </div>
                </form>
    </div>
</div>
<div style="margin: 40px;">
<div style="color: #211a1a;border-bottom: 1px solid #e0e0e0;overflow: auto;">Books</div>
	<?php
    if(!empty($_POST["keyword"])) {
        $product_array = $db_handle->runQuery("SELECT * FROM books WHERE name='" . $_POST["keyword"] . "'");
      }
    else {
    $product_array = $db_handle->runQuery("SELECT * FROM books");
    }
	if (!empty($product_array)) { 
		foreach($product_array as $key=>$value){
	?>
  <form method="post" action="home.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
<div style="float: left;background: #ffffff;margin: 30px 30px 0px 0px;border: #e0e0e0 1px solid">
			<div style="display: flex;justify-content: center;align-items: center;overflow: hidden;width: 250px;height: 250px"><img style="height: 100%; width: 100%; object-fit: contain" src="<?php echo $product_array[$key]["image"]; ?>"></div>
			<div style="padding: 15px 15px 0px 15px;overflow: auto;">
			<div style="margin-bottom: 20px;"><?php echo $product_array[$key]["name"]; ?></div>
			<div style="float: left;"><?php echo "$".$product_array[$key]["price"]; ?></div>
			<div style="float: right;"><input type="text" style="padding: 5px 10px;border-radius: 3px;border: #e0e0e0 1px solid" name="quantity" value="1" size="2" /><input type="submit" value="Add to Cart" style="padding: 5px 10px;margin-left: 5px;background-color: #efefef;border: #E0E0E0 1px solid;color: #211a1a;float: right;text-decoration: none;border-radius: 3px;cursor: pointer" /></div>
			</div>
      <?php
      $book_id=$product_array[$key]["code"];
      $review = mysqli_query($con, "SELECT * FROM `bookstore`.`review` where book_id='$book_id'");
      $row1 = mysqli_fetch_array($review);
      ?>
      <div style="float: bottom;">review:<?php echo $row1['review']." "."rating:".$row1['rating'];?></div>
		</div>
    </form>
	<?php
		}
	}
  ?>
</body>
</html>
