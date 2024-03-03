<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Return/Refund</title>
    <link rel="stylesheet" href="return.css">
</head>
<body>

<div class="container">
    <form action="testtt.php" method="post" enctype="multipart/form-data" onsubmit="return redirectToMyPurchases()">
        <header class="header">
            <h2>Request Return/Refund</h2>
        </header>
        <div class="product-info">
            <?php
            include('dbconnect.php');

            $target = "image/";
            $item_id = 7573784;

            $item_sql = "SELECT * FROM item WHERE ITEM_ID = $item_id";
            $item_result = $conn->query($item_sql);

            if ($item_result->num_rows > 0) {
                while ($row = $item_result->fetch_assoc()) {
                    $productImage = $row['ITEM_IMAGE'];
                    $productName = $row['ITEM_NAME'];
                    $productPrice = $row['ITEM_PRICE'];

                    // Check if the image file exists
                    $image_path = $target . $productImage;
                    if (file_exists($image_path)) {
                        // Display the image
                        echo '<img src="' . $image_path . '" alt="' . $productName . '">';
                    } else {
                        // Image file does not exist, display a placeholder or handle the error
                        echo 'Image not found';
                    }

                    echo '<div>';
                    echo '<p>' . $productName . '</p>';
                    echo '<p>' . $productPrice . '</p>';
                    echo '</div>';
                }
            } else {
                echo "No results found";
            }
            ?>
        </div>
        <div class="form-group">
            <label for="reason">Reason for Return</label>
            <select id="reason" name="REFUND_REASON" required onchange="showSolution()">
                <option value="select">-Please select-</option>
                <option value="missing-product">Missing quantities/accessories</option>
                <option value="wrong-item">Received wrong item</option>
                <option value="damage-item">Damaged item</option>
                <option value="faulty-product">Faulty product</option>
                <option value="expired-product">Expired product(s)</option>
            </select>
        </div>
        <div class="form-group">
            <label for="solution">Solution</label>
            <select id="solution" name="REFUND_SOLUTION" required onchange="showSolution()">
                <option value="select">-Please select-</option>
                <option value="refund">Refund</option>
                <option value="return_refund">Return and Refund</option>
            </select>
        </div>
        <div class="form-group">
            <label for="description">Description (Optional)</label>
            <textarea id="description" name="REFUND_DESCRIPTION" rows="4" cols="50"></textarea>
        </div>
        <div class="form-group">
            <label for="evidence">Upload Photo Evidence</label>
            <input type="file" id="evidence" name="REFUND_EVIDENCE">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <?php
            $customer_sql = "SELECT * FROM customer WHERE CUST_ID = 21343212";
            $customer_result = $conn->query($customer_sql);
            if ($customer_result->num_rows > 0) {
                while ($row = $customer_result->fetch_assoc()) {
                    $userEmail = $row['CUST_EMAIL']; // Assuming this is the column name for email in the customer table
                    echo '<input type="email" id="email" name="CUST_EMAIL" value="' . $userEmail . '" required>';
                }
            }
            ?>
        </div>
        <div class="form-group">
            <input type="submit" id="Btnsubmit" name="Btnsubmit" value="Submit">
        </div>
    </form>
</div>

<?php
$conn->close();
?>

<script>
    function redirectToMyPurchases() {
        // Redirect to "myPurchases.php" after form submission
        window.location.href = "myPurchases.php";
        return false; // Prevents default form submission
    }
</script>

</body>
</html>
