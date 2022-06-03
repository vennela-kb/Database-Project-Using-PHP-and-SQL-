<?php
error_reporting(E_ERROR | E_PARSE);
include('session.php');
require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery("SELECT * FROM books WHERE code='" . $_GET["code"] . "'");
			$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"], 'image'=>$productByCode[0]["image"]));
			
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode[0]["code"] == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["code"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;	
}
}
?>
<HTML>
<HEAD>
<TITLE>Book Customer Page</TITLE>
</HEAD>
<BODY>
<div style="margin: 40px">
<div style="color: #211a1a;border-bottom: 1px solid #e0e0e0;overflow: auto">Shopping Cart</div>
<a id="btnEmpty" href="personal.php">Update Member</a>
&nbsp;&nbsp;
<a id="btnEmpty" href="review.php">Add Review</a>
&nbsp;&nbsp;
<a id="btnEmpty" href="customer.php?action=porder">Previous Order</a>
&nbsp;&nbsp;
<a id="btnEmpty" href="customer.php?action=empty">Empty Cart</a>
&nbsp;&nbsp;
<a id="btnEmpty" href="logout.php">Logout</a>



<?php
if(isset($_SESSION["cart_item"])){
    $total_quantity = 0;
    $total_price = 0;
?>	
<table style="font-weight: normal" cellpadding="10" cellspacing="1">
<tbody>
<tr>
<th style="text-align:left;">Name</th>
<th style="text-align:left;">Code</th>
<th style="text-align:right;" width="5%">Quantity</th>
<th style="text-align:right;" width="10%">Unit Price</th>
<th style="text-align:right;" width="10%">Price</th>
<th style="text-align:center;" width="5%">Remove</th>
</tr>	
<?php		
    foreach ($_SESSION["cart_item"] as $item){
        $item_price = $item["quantity"]*$item["price"];
		?>
				<tr>
				<td><img src="<?php echo $item["image"]; ?>" style="width: 30px;height: 30px;border-radius: 50%;border: #e0e0e0 1px solid;padding: 5px;vertical-align: middle;margin-right: 15px" /><?php echo $item["name"]; ?></td>
				<td><?php echo $item["code"]; ?></td>
				<td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
				<td style="text-align:right;"><?php echo "$ ".$item["price"]; ?></td>
				<td style="text-align:right;"><?php echo "$ ". number_format($item_price,2); ?></td>
				<td style="text-align:center;"><a href="customer.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction"><img src="icon-delete.png" alt="Remove Item" /></a></td>
				</tr>
				<?php
				$total_quantity += $item["quantity"];
				$total_price += ($item["price"]*$item["quantity"]);
		}
		?>

<tr>
<td colspan="2" align="right">Total:</td>
<td align="right"><?php echo $total_quantity; ?></td>
<td align="right" colspan="2"><strong><?php echo "$ ".number_format($total_price, 2); ?></strong></td>
<?php
echo "<td><a id='btnEmpty' href=checkout.php?total_price=".$total_price.">Checkout</a></td>";
?>
</tr>
</tbody>
</table>		
  <?php
} else {
?>
<div style="text-align: center;clear: both;margin: 38px 0px">Your Cart is Empty</div>
<?php 
}
?>
</div>

<div style="margin: 40px;">

<form method="POST" action="customer.php">
				<div>
					<input type="text" placeholder="Search here..." name="keyword" required="required" value="<?php echo isset($_POST['keyword']) ? $_POST['keyword'] : '' ?>"/>
					<span >
						<button name="search">Search</span></button>
					</span>
				</div>
			</form>
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
<div style="float: left;background: #ffffff;margin: 30px 30px 0px 0px;border: #e0e0e0 1px solid">
			<form method="post" action="customer.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
			<div style="display: flex;justify-content: center;align-items: center;overflow: hidden;width: 250px;height: 250px"><img style="height: 100%; width: 100%; object-fit: contain" src="<?php echo $product_array[$key]["image"]; ?>"></div>
			<div style="padding: 15px 15px 0px 15px;overflow: auto;">
			<div style="margin-bottom: 20px;"><?php echo $product_array[$key]["name"]; ?></div>
			<div style="float: left;"><?php echo "$".$product_array[$key]["price"]; ?></div>
			<div style="float: right;"><input type="text" style="padding: 5px 10px;border-radius: 3px;border: #e0e0e0 1px solid" name="quantity" value="1" size="2" /><input type="submit" value="Add to Cart" style="padding: 5px 10px;margin-left: 5px;background-color: #efefef;border: #E0E0E0 1px solid;color: #211a1a;float: right;text-decoration: none;border-radius: 3px;cursor: pointer" /></div>
			</div>
			</form>
		</div>
	</div>
	<?php
		}
	}
    if($_GET["action"]=="porder"){
        $order_array = $db_handle->runQuery("SELECT * FROM orders");
    }
    if (!empty($order_array)) { 
		foreach($order_array as $key=>$value){
	?>
    <div style="float: left;background: #ffffff;margin: 30px 30px 0px 0px;border: #e0e0e0 1px solid">
    <table border="2" align="center" cellpadding="2" cellspacing="5" style=color:#000000>
    <caption>Previous Orders</caption>
			<form method="post" action="customer.php?action=add&code=<?php echo $order_array[$key]["order_id"]; ?>">
			<tr>
                <td>Id</td>
                <td>BookId</td>
                <td>Total Price</td>
				<td>qty</td>
				<td>Shipping Address</td>
				<td>PaymentMethod</td>
           </tr>
           <tr>
                <td><?php echo $order_array[$key]["order_id"]; ?></td>
                <td><?php echo $order_array[$key]["book_id"]; ?></td>
                <td><?php echo $order_array[$key]["total_price"]; ?></td>
				<td><?php echo $order_array[$key]["qty"]; ?></td>
				<td><?php echo $order_array[$key]["shipping_address"]; ?></td>
				<td><?php echo $order_array[$key]["payment_method"]; ?></td>
				<td><?php echo $order_array[$key]["payment_method"]; ?></td>
				<a href="checkout.php?total_price=<?php echo $order_array[$key]["total_price"]; ?> style="background-color: #ffffff;border: #d00000 1px solid;padding: 5px 10px;color: #d00000;float: right;text-decoration: none;border-radius: 3px;margin: 10px 0px">Order Again</a>
           </tr>
			</form>
        </table>
		</div>
	<?php
		}
      
	}
    ?>

<br><br>

</BODY>
</HTML>