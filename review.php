<?php
include('session.php');
require_once("dbcontroller.php");
$loggedin_id = $row['mem_id'];
echo "user" . $loggedin_id;
$order_history = mysqli_query($con, "SELECT * FROM `bookstore`.`orderhistory` where mem_id='$loggedin_id'");
?>
<center><p>Add Review</p></center>
    <form name="reg" action="review.php" method="post" id="reg" enctype="multipart/form-data">
        <table border="0" align="center" cellpadding="2" cellspacing="0">
			<?php
echo "<tr>";
echo "<td>";
echo "<select name='book_id' id='book_id'>";
while ($row = mysqli_fetch_array($order_history)) {
    echo $row['code'];
    $code = $row['code'];
    $book_list = mysqli_query($con, "SELECT * FROM `bookstore`.`books` where code='$code'");
    $row1 = mysqli_fetch_array($book_list);
    echo "<option value='" . $row1['book_id'] . "'>" . $row1['name'] . "</option>";
}
echo "</select>";
echo "</tr>";
echo "<tr>";
echo "<td>";
echo "<select name='review_id' id='review_id'>";
echo "<option value='1'>1</option>";
echo "<option value='2'>2</option>";
echo "<option value='3'>3</option>";
echo "<option value='4'>4</option>";
echo "<option value='5'>5</option>";
echo "</select>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
echo "<textarea cols='40' rows='5' name='cust_review' id='tb-box'>review</textarea>";
echo "</td>";
echo "</tr>";
?>
<tr>
<td><input name="review" type="submit" value="Submit"/></td>
</tr>
			</table>
</form>

<?php
if (isset($_POST['review'])) {
    $review_id = $loggedin_id . $_POST['book_id'];
    $book_id = $_POST['book_id'];
    $review = $_POST['cust_review'];
    $rating = $_POST['review_id'];
    $sql = "INSERT INTO `bookstore`.`review` (`review_id`, `book_id`, `review`, `mem_id`, `rating`) VALUES ('$review_id', '$book_id', '$review', '$loggedin_id','$rating')";
    if ($con->query($sql) === TRUE) {
        echo '<script>alert("Review created Successfully")</script>';
        $_POST = array();
    }
    else {
        echo '<script>alert("Review failed to create")</script>';
    }
}

?>