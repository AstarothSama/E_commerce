<?php
session_start();

include 'connexion.php';


  $product_name = $_POST['product-name'];
  $product_image = $_FILES['product-image']['name'];
  $product_price = $_POST['product-price'];
  $product_duration = $_POST['product-duration'];
  $product_description = $_POST['product-description'];
  $auction_end_time = $_POST['auction_end_time']; 
  $TimeStamp = strtotime($auction_end_time);
  $mysqlDate =date('Y-m-d H:i:s', $TimeStamp) ;

  if ($auction_end_time < time()) {
    echo "Erreur : la date de fin d'enchère est déjà passée.";
    header("location:main/dashboard.php");
  }

  // Check for file upload errors
  if ($_FILES['product-image']['error'] === UPLOAD_ERR_OK) {
    $tmp_name = $_FILES['product-image']['tmp_name'];
    $product_image = basename($_FILES['product-image']['name']);
    $target_path = 'images/' . $product_image;
    move_uploaded_file($tmp_name, $target_path);

    
    $stmt = $pdo->prepare("INSERT INTO products (Username, Name, Description, Price, End_date, Image) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$_SESSION['SESS_MEMBER_ID'], $product_name, $product_description, $product_price,  $mysqlDate, $product_image]);
    
$product_id = $pdo->lastInsertId();
    
    if ($stmt->rowCount() > 0) {
        echo '<script>alert("Product added successfully!"); window.location.href = "http://localhost/my%20project/main/dashboard.php";</script>';
    } else {
        echo '<script>alert("Error adding product."); window.location.href = "http://localhost/my%20project/main/dashboard.php";</script>';
    }
} else {
    echo '<script>alert("Error uploading image."); window.location.href = "http://localhost/my%20project/main/dashboard.php";</script>';
}
$stmt = $pdo->prepare("INSERT INTO auctions (Product_id,Username,Bid_price) VALUES (?, ?, ?)");
    $stmt->execute([$product_id , $_SESSION['SESS_MEMBER_ID'] , $product_price]);

?>