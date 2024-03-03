<?php
// Database connection
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "shoopeerefund";

// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['Btnsubmit'])){
    // Fixed data
    $reason = "Fixed Refund Reason";
    $solution = "Fixed Refund Solution";
    $description = "Fixed Refund Description";
    $email = "fixed@example.com";

    // File upload handling
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["REFUND_EVIDENCE"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if (isset($_POST["Btnsubmit"])) {
        $check = getimagesize($_FILES["REFUND_EVIDENCE"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["REFUND_EVIDENCE"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["REFUND_EVIDENCE"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["REFUND_EVIDENCE"]["name"])) . " has been uploaded.";

            // Insert data into database
            $sql = "INSERT INTO refund (REFUND_REASON, REFUND_SOLUTION, REFUND_DESCRIPTION, CUST_EMAIL, REFUND_EVIDENCE) 
                    VALUES ('$reason', '$solution', '$description', '$email', '$target_file')";

            if ($conn->query($sql) === TRUE) {
                echo '<script type="text/javascript">
                    alert("Your request has been submitted. Please wait for the seller to approve. Thank you!!");
                    window.location = "myPurchases.php"; 
                    </script>';
            } else {
                echo "Error inserting data: " . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    $conn->close();
} else {
    // If the form is not submitted, redirect back to the form page
    header("Location: myPurchases.php");
    exit;
}
?>
