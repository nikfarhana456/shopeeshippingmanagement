<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancel Order</title>
    <link rel="stylesheet" type="text/css" href="cancelcss.css">
</head>
<body>
    <h1>Cancel Order</h1>
	<?php
    include('dbconnect.php');
	
	$order_sql = "SELECT * FROM orders WHERE ORDER_ID = 123456789"; 
    $order_result = $conn->query($order_sql);
	
	$item_sql = "SELECT *  FROM item WHERE ITEM_ID = 5427787"; 
    $item_result = $conn->query($item_sql);
    
    $customer_sql = "SELECT * FROM customer WHERE CUST_ID = 57236903"; 
    $customer_result = $conn->query($customer_sql);

    
    $detail_sql = "SELECT * FROM order_detail WHERE DETAIL_ID = 3314567"; 
    $detail_result = $conn->query($detail_sql);
    
    if ($customer_result->num_rows > 0 && $detail_result->num_rows > 0 && $item_result->num_rows > 0 && $order_result->num_rows > 0) {
        // Output order details
        while ($row = $detail_result->fetch_assoc()) {
            echo "<div class='section'>";
            echo "<h2>Shipping Information</h2>";
            echo "<p>Shipping Method: " . $row["SHIPPING_OPTION"] . "</p>";
            echo "</div>";
			
			echo "<div class='section'>";
            echo "<h2>Payment Method</h2>";
            echo "<p>Payment Method: " . $row["PAYMENT_METHOD"] . "</p>";
            echo "</div>";

			echo "<div class='section'>";
            echo "<h2>Order ID</h2>";
            echo "<p>Order ID: " . $row["ORDER_ID"] . "</p>";
            echo "</div>";
		// Output data of customer details
        while ($row = $customer_result->fetch_assoc()) {
            echo "<div class='section'>";
            echo "<h2>Delivery Address</h2>";
            echo "<p>Delivery Name: " . $row["CUST_FULLNAME"] . "</p>";
            echo "<p>Delivery Address: " . $row["CUST_ADDRESS"] . "</p>";
            echo "</div>";

        }
         while ($row = $item_result->fetch_assoc()) {
            echo "<div class='section'>";
            echo "<h2>Order List</h2>";
            echo "<p>Item Name: " . $row["ITEM_NAME"] . "</p>";
            echo "<p>Item Price: " . $row["ITEM_PRICE"] . "</p>";
		 while ($row = $order_result->fetch_assoc()) {
            echo "<p>Total Amount: " . $row["ORDER_AMOUNT"] . "</p>";
            echo "</div>";
        }
    } 
		}
	}
	else {
        echo "No results found";
    }

    $conn->close();
?>


    <div class="cancel-button">
        <button onclick="cancelOrder()">Cancel Order</button>
    </div>

    <script>
        function cancelOrder() {
            // Add cancellation logic here
            alert('Your order has been cancelled.');
            // You can redirect the user to another page or perform additional actions as needed
			window.location.href = 'myPurchases.php';
        }
    </script>
	
</body>
</html>
