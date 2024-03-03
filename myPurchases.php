<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION["username"])) {
    // If not logged in, redirect to login page
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Purchases</title>
    <link rel="stylesheet" type="text/css" href="stylespurchases.css">
</head>
<body>
    <h1>My Purchases</h1>

    <div class="toolbar">
        <button onclick="showProducts('ship')" id="shipButton">To Ship</button>
        <button onclick="showProducts('receive')" id="receiveButton">To Receive</button>
        <button onclick="showProducts('complete')" id="completeButton">Complete</button>
        <button onclick="showProducts('cancel')" id="cancelButton">Cancel</button>
        <button onclick="showProducts('refund')" id="refundButton">Refund/Receive</button>
    </div>

    <div id="productView">
        <!-- Product view will be updated dynamically -->
    </div>

    <script>
        // Function to handle order received button click
function orderReceived() {
    alert('Thank you for your order!');
    // You can add additional functionality here
}

// Function to update the product view dynamically
function showProducts(status) {
    let products = [];

    if (status === 'ship') {
        products = [
            { 
                name: 'Selimut Gebbu', 
                shop: 'yeah market', 
                price: 20, 
                orderItems: 1, 
                orderTotal: 20, 
                shippingInfo: 'Seller has prepare your parcel', 
                imageUrl: 'image/selimut.jpeg'
            },
            { 
                name: 'Kasut Crocs Viral', 
                shop: 'WOOHUU STORE', 
                price: 15, 
                orderItems: 2, 
                orderTotal: 30, 
                shippingInfo: 'Seller has prepare your parcel', 
                imageUrl: 'image/crocs.jpeg'
            },
			 { 
                name: 'Headphone Wireless Bluetooth', 
                shop: 'mgc.gadget', 
                price: 20, 
                orderItems: 1, 
                orderTotal: 20, 
                shippingInfo: 'Seller has prepare your parcel', 
                imageUrl: 'image/headphone.jpg'
            },
        ];
    } else if (status === 'receive') {
        products = [
            { 
                name: 'Floral Bed Sheet', 
                shop: 'Sora House', 
                price: 35, 
                orderItems: 1, 
                orderTotal: 35, 
                shippingInfo: 'View More Product', 
                imageUrl: 'image/bedsheet.jpeg'
            },
             { 
                name: 'Sneakers Shoes', 
                shop: 'Princess Shoes', 
                price: 45, 
                orderItems: 1, 
                orderTotal: 35, 
                shippingInfo:  'View More Product', 
                imageUrl: 'image/sneakers.jpg'
            },
			 { 
                name: 'Cargo Pants 6 Pockets', 
                shop: 'jombeli', 
                price: 20, 
                orderItems: 1, 
                orderTotal: 20, 
                shippingInfo: 'View More Product', 
                imageUrl: 'image/cargo.jpeg'
            },
			{ 
                name: 'Korean Plain Unisex Jacket', 
                shop: 'jomonline', 
                price: 30, 
                orderItems: 1, 
                orderTotal: 34, 
                shippingInfo: 'View More Product', 
                imageUrl: 'image/jacket.jpeg'
            },
        ];
    } 
    else if (status === 'complete') {
        products = [
            { 
                name: 'Blusher', 
                shop: 'Soomoi Cosmetics', 
                price: 25, 
                orderItems: 1, 
                orderTotal: 25, 
                shippingInfo: 'View More Product', 
                imageUrl: 'image/blusher.jpg'
            },
             { 
                name: 'King Size Multifunctional Wardrobe Waterproof Roll Curtain Almari Baju ', 
                shop: 'KENZZO', 
                price: 25, 
                orderItems: 1, 
                orderTotal: 25, 
                shippingInfo:  'View More Product', 
                imageUrl: 'image/wardrobe.jpeg'
            },
			 { 
                name: 'Cargo Pants 6 Pockets', 
                shop: 'jombeli', 
                price: 20, 
                orderItems: 1, 
                orderTotal: 20, 
                shippingInfo: 'Parcel delivered', 
                imageUrl: 'image/cargo.jpeg'
            },
			{ 
                name: 'Baglane Canvas Hybrid 2-in-1 Travel Backpack Carry On Duffel Suit ', 
                shop: 'mega deal', 
                price: 30, 
                orderItems: 1, 
                orderTotal: 34, 
                shippingInfo: 'Parcel delivered', 
                imageUrl: 'image/backpack.jpeg'
            },
        ];
    } 
	else if (status === 'cancel') {
        products = [
            { 
                name: 'Baju Nikah ', 
                shop: 'Baju Nikah house ', 
                price: 205, 
                orderItems: 1, 
                orderTotal: 205, 
                shippingInfo: 'View More Product', 
                imageUrl: 'image/bajunikah.jpg'
            },
             { 
                name: 'Kasut Perkahwinan 2022 Womens High Heels, kasut nikah, Wedding Party', 
                shop: 'Princess Shoes', 
                price: 150, 
                orderItems: 1, 
                orderTotal: 105, 
                shippingInfo:  'View More Product', 
                imageUrl: 'image/kasutnikah.jpeg'
            },
			 { 
                name: 'Cargo Pants 6 Pockets', 
                shop: 'jombeli', 
                price: 20, 
                orderItems: 1, 
                orderTotal: 20, 
                shippingInfo: 'View More Product', 
                imageUrl: 'image/cargo.jpeg'
            },
			{ 
                name: 'Songkok Hitam Dewasa', 
                shop: 'jomonline', 
                price: 30, 
                orderItems: 1, 
                orderTotal: 34, 
                shippingInfo: 'View More Product', 
                imageUrl: 'image/songkok.jpeg'
            },
        ];
    } 
		else if (status === 'refund') {
        products = [
            { 
                name: 'Candlenutsbynadia - CANDLE MELTZ BAR (SCENTED CANDLE MELTZ / LILIN  ', 
                shop: 'candlenutsbynadia ', 
                price: 25, 
                orderItems: 1, 
                orderTotal: 25, 
                shippingInfo: 'View More Product', 
                imageUrl: 'image/candlenuts.jpeg'
            },
             { 
                name: 'Top Selling Casing For Iphone 11 Pro 12 Pro Max 12 Mini 6 7 8 Xr New..', 
                shop: 'casing murah', 
                price: 15, 
                orderItems: 1, 
                orderTotal: 15, 
                shippingInfo:  'View More Product', 
                imageUrl: 'image/casing.jpeg'
            },
			 { 
                name: 'Ruffled Loose Baggy Tops Blouse - Power Day Sale', 
                shop: 'jombeli', 
                price: 25, 
                orderItems: 1, 
                orderTotal: 25, 
                shippingInfo: 'View More Product', 
                imageUrl: 'image/blouse.jpg'
            },
			{ 
                name: 'Songkok Hitam Dewasa', 
                shop: 'jomonline', 
                price: 30, 
                orderItems: 2, 
                orderTotal: 64, 
                shippingInfo: 'View More Product', 
                imageUrl: 'image/songkok.jpeg'
            },
        ];
    } 
	
// Call updateProductView to update the displayed products with the appropriate status
            updateProductView(products, status);
}

// Function to update the product view dynamically
function updateProductView(products, status) {
    let productView = document.getElementById('productView');
    productView.innerHTML = ''; // Clear existing content

              products.forEach(function(product) {
                let productHTML = '<div class="product">';
                productHTML += '<h3>' + product.name + '</h3>';
                productHTML += '<p>Shop: ' + product.shop + '</p>';
                productHTML += '<p>Price: RM' + product.price + '</p>';
                productHTML += '<p>Order Items: ' + product.orderItems + '</p>';
                productHTML += '<p>Order Total: RM' + product.orderTotal + '</p>';
                productHTML += '<p>Shipping Info: ' + product.shippingInfo + '</p>';
                // Include the image tag with the product's image URL
                 productHTML += '<img src="' + product.imageUrl + '" alt="' + product.name + '" class="product-image">';

        // Add appropriate buttons based on the status
                if (status === 'ship') {
                    productHTML += '<button onclick="redirectToCancel()">Cancel</button>';
                } else if (status === 'receive') {
                    productHTML += '<button onclick="redirectToRefund()">Refund</button>';
                } else if (status === 'cancel') {
                    productHTML += '<button onclick="cancelOrder()">Buy Again</button>';
                } else if (status === 'complete') { 
                    productHTML += '<button onclick="rateProduct()">Rate</button>';
                } else if (status === 'refund') {
                    productHTML += '<button onclick="buyAgain()">Return Refund Details</button>';
                }
                productHTML += '</div>';
                productView.innerHTML += productHTML;
            });
}
// Function to redirect to the cancel.php page
        function redirectToCancel() {
            window.location.href = "cancel.php";
        }

        // Function to redirect to the refund.php page
        function redirectToRefund() {
            window.location.href = "testtt.php";
        }

        // Function to redirect to the cancel.php page
        function cancelOrder() {
            window.location.href = "cancel.php";
        }

        // Function to redirect to the rate.php page
        function rateProduct() {
            window.location.href = "rate.php";
        }

        // Function to redirect to the returnRefundDetails.php page
        function returnRefundDetails() {
            window.location.href = "returnRefundDetails.php";
        }

        // Function to redirect to myPurchases.php
        function redirectToMyPurchases() {
            window.location.href = "myPurchases.php";
        }
    </script>
</body>
</html>
