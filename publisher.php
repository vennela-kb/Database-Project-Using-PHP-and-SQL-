<?php
include('session.php');
require_once("dbcontroller.php");
if ($loggedin_type != "publisher") {
    echo '<script>alert("You are not a valid publisher")</script>';
    echo("<script>location.href = 'home.php';</script>");
}
$db_handle = new DBController();
$author_list = mysqli_query($con,"SELECT * FROM `bookstore`.`author`");
$publisher_list = mysqli_query($con,"SELECT * FROM `bookstore`.`publisher`");
#cover page upload
$target_dir = "book-cover/";
error_reporting(E_ERROR | E_PARSE);
?>
<!DOCTYPE html>
<html>
<head>
	<meta content='text/html; charset=UTF-8' http-equiv='Content-Type'/>
	<title>Publisher Page</title>
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
<center><p>Publish New Book (if you can't find the auther add auther first)</p></center>
    <form name="reg" action="publisher.php" method="post" id="reg" enctype="multipart/form-data">
        <table border="0" align="center" cellpadding="2" cellspacing="0">
        <tr>
        <td><div align="left" id="tb-name">Book&nbsp;Name:</div></td>
        <td><input type="text" name="bname" id="tb-box"/></td>
        </tr>
        <tr>
        <td><div align="left" id="tb-name">Author:</div></td>
        <td>
          <?php
               echo "<select name='author_id' id='author_id'>";
                while ($row = mysqli_fetch_array($author_list)) {
              echo "<option value='" . $row['author_id'] . "'>" . $row['name'] . "</option>";
              }
              echo "</select>";
          ?>
        </td>
        </tr>
        <tr>
        <td><div align="left" id="tb-name">Publisher:</div></td>
        <td>
        <?php
               echo "<select name='publisher_id' id='publisher_id'>";
                while ($row = mysqli_fetch_array($publisher_list)) {
              echo "<option value='" . $row['publisher_id'] . "'>" . $row['name'] . "</option>";
              }
              echo "</select>";
          ?>
        </td>
        </tr>
        <tr>
        <tr>
        <td><div align="left" id="tb-name">Price:</div></td>
        <td><input type="text" id="tb-box" name="price" /></td>
        </tr>
        <tr>
        <td><div align="left" id="tb-name">ISBN:</div></td>
        <td><input type="text" id="tb-box" name="isbn" /></td>
        </tr> 
        <tr>
        <td><div align="left" id="tb-name">Cover Page Image:</div></td>
        <td><input type="file" name="file" id="file"></td>
        </tr> 
        <tr>
            <td><input name="book" type="submit" value="Submit"/></td>
        </tr>
        </table>
        <br>
        <br>
    </form>
    <hr>
    <!--code for adding new author -->
    <center><p>Add New Author</p></center>
    <form name="reg" action="publisher.php" method="post" id="reg">
        <table border="0" align="center" cellpadding="2" cellspacing="0">
        <tr>
        <td>
        <div align="left" id="tb-name">Author Name:</div>
        </td>
        <td width="171">
        <input type="text" name="author_name" id="tb-box"/>
        </td>
        </tr>
        <tr>
        <td><div align="left" id="tb-name">Address:</div></td>
        <td><input type="text" name="auth_address" id="tb-box"/></td>
        </tr>
        <tr>
        <td><div align="left" id="tb-name">Phone:</div></td>
        <td><input type="text" name="auth_phone" id="tb-box"/></td>
        </tr>
        <tr>
        <td><div align="left" id="tb-name">Gender:</div></td>
        <td><input type="text" name="auth_gender" id="tb-box"/></td>
        </tr>
        <tr>
        <td><div align="left" id="tb-name">Email:</div></td>
        <td><input type="text" name="auth_email" id="tb-box"/></td>
        </tr>
        <tr>
            <td><input name="author" type="submit" value="Submit"/></td>
        </tr>
            </table>
            </form>
        <hr>
        <!--code for adding new author -->
    <center><p>Add New Publisher</p></center>
    <form name="reg" action="publisher.php" method="post" id="reg">
        <table border="0" align="center" cellpadding="2" cellspacing="0">
        <tr>
        <td>
        <div align="left" id="tb-name">Publisher Name:</div>
        </td>
        <td width="171">
        <input type="text" name="pub_name" id="tb-box"/>
        </td>
        </tr>
        <tr>
        <td><div align="left" id="tb-name">Address:</div></td>
        <td><input type="text" name="pub_address" id="tb-box"/></td>
        </tr>
        <tr>
        <td><div align="left" id="tb-name">Phone:</div></td>
        <td><input type="text" name="pub_phone" id="tb-box"/></td>
        </tr>
        <tr>
        <td><div align="left" id="tb-name">Email:</div></td>
        <td><input type="text" name="pub_email" id="tb-box"/></td>
        </tr>
        <tr>
            <td><input name="publisher" type="submit" value="Submit"/></td>
        </tr>
            </table>
        </form>
    <!-- Edit book details -->
    <hr>
    <center><p>Remove/Edit Books</p></center>
    <?php
    $book_list = mysqli_query($con,"SELECT * FROM `bookstore`.`books`");
    echo "<form name='reg' action='publisher.php' method='post' id='reg'>";
      echo "<table border='1' align='center' cellpadding='2 cellspacing='0' >";
      echo "<tr>";
      echo "<td>Id</td>";
      echo  "<td>Book Name</td>";
      echo  "<td>Author</td>";
	  echo	"<td>Publisher</td>";
	  echo	"<td>Price</td>";
	  echo 	"<td>Isbn</td>";
      echo  "</tr>";
      while($rows=mysqli_fetch_array($book_list)){
        echo "<tr>";
        echo "<td>".$rows['book_id']."</td>";
        echo "<td>".$rows['name']."</td>";
        echo "<td>".$rows['author_id']."</td>";
        echo "<td>".$rows['publisher_id']."</td>";
        echo "<td>".$rows['price']."</td>";
        echo "<td>".$rows['code']."</td>";
        echo "<td><input name='delete' type='submit' value='Remove'/></td>";
        echo "<td><input name='update' type='submit' value='Update'/></td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</form>"
    ?>
<!-- php functions -->
<?php
//add athor
if(isset($_POST['author'])) {
    $username=$_POST['pub_name'];
    if ($result = mysqli_query($con,"SELECT * FROM `bookstore`.`author` WHERE name='$username'"))
    {
        $num_rows = mysqli_num_rows($result);
    }
    if ($num_rows) {
        echo '<script>alert("Same Author is there already")</script>';
    }else {
             $author_name=$_POST['author_name'];
             $auth_address=$_POST['auth_address'];
             $auth_phone=$_POST['auth_phone'];
             $auth_gender=$_POST['auth_gender'];
             $auth_email=$_POST['auth_email'];
             $sql = "INSERT INTO `bookstore`.`author` (`name`, `address`, `phone`, `email`, `gender`) VALUES ('$author_name', '$auth_address', '$auth_phone', '$auth_gender','$auth_email')";
             if ($con->query($sql) === TRUE) {
                echo '<script>alert("New author created Successfully")</script>';
                $_POST = array();
              } else {
                echo '<script>alert("Author failed to create")</script>';
              }
            }
        }
        //add publisher
        if(isset($_POST['publisher'])) {
            $username=$_POST['pub_name'];
            if ($result = mysqli_query($con,"SELECT * FROM `bookstore`.`publisher` WHERE name='$username'"))
            {
                $num_rows = mysqli_num_rows($result);
            }
            if ($num_rows) {
	            echo '<script>alert("Same Publisher is there already")</script>';
            }else {
            $pub_name=$_POST['pub_name'];
            $pub_address=$_POST['pub_address'];
            $pub_phone=$_POST['pub_phone'];
            $pub_email=$_POST['pub_email'];
            $sql = "INSERT INTO `bookstore`.`publisher` (`name`, `address`, `phone`, `email`) VALUES ('$pub_name', '$pub_address', '$pub_phone', '$pub_email')";
            if ($con->query($sql) === TRUE) {
               echo '<script>alert("New author created Successfully")</script>';
               $_POST = array();
             } else {
               echo '<script>alert("Author failed to create")</script>';
             }
            }
       }
       //add book
       if(isset($_POST['book'])) {
        $username=$_POST['bname'];
        if ($result = mysqli_query($con,"SELECT * FROM `bookstore`.`books` WHERE name='$username'"))
        {
            $num_rows = mysqli_num_rows($result);
        }
        if ($num_rows) {
            echo '<script>alert("Same Book is there already")</script>';
        }else {
        #file upload
        #if(array_key_exists('file', $_FILES)){
            $target_file = $target_dir . basename($_FILES['file']['name']);
            #echo $target_file;
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                #echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
          }
        #}
        # db record creations
        $bname=$_POST['bname'];
        $author_id=$_POST['author_id'];
        $publisher_id=$_POST['publisher_id'];
        $price=$_POST['price'];
        $coverpage=$target_file;
        $isbn=$_POST['isbn'];
        $sql = "INSERT INTO `bookstore`.`books` (`name`, `author_id`, `publisher_id`, `price`, `image`, `code`) VALUES ('$bname', '$author_id', '$publisher_id','$price','$coverpage', '$isbn')";
        if ($con->query($sql) === TRUE) {
            echo '<script>alert("New Book added Successfully")</script>';
            $_POST = array();
         } else {
            echo '<script>alert("New Book failed to create")</script>';
            $_POST = array();
         }
        }
   }
?>
            </body>
            </html>
