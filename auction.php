<!DOCTYPE html>
<html>
<head>
    <title>Détails du produit</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="main/projectstyle.css">
	<link rel="shortcut icon" href="images/details.png">

</head>
<body style=" background-image: url(main/img/dashboard-background.png); background-size: 88%;">
<?php
	session_start();
if (!isset($_SESSION['SESS_MEMBER_ID']) || !isset($_SESSION['SESS_NAME']) ) {
    header("location: ../index.php");
    exit();
}
	?>
<section id="header">
	
		<div class="header container">
		 <div class="nav-bar" style="background-color: black;">
			<div class="brand">
				<a href="#hero"><h1><span>S</span>hop<span>V</span>ista</h1></a>
			</div>
			<div class="nav-list">
				<div class="humburger">
					<div class="bar">
					</div>
				</div>
				<ul>
				    <li><a href="main/dashboard.php" data-after="dashboard">Dashboard</a></li>
					<li><a href="../productList.php" data-after="ProductList">Product list</a></li>
					<li><a rel="facebox" href="../AddProduct.php" data-after="add product"> Add Product</a></li>
					<li><a href="main/Logout.php" data-after="logout">Logout</a></li>

	
				</ul>
			</div>
		 </div>
		</div>
	</div>
	</section>
	<?php
	 $product_id = $_GET['product_id'];

	 
	 include("connexion.php");
	 $stmt = $pdo->prepare("SELECT Image, MAX(Bid_price) AS Current_price,Name, Description, Price, End_date, p.Product_id FROM products p JOIN auctions a ON p.Product_id=a.Product_id WHERE p.Product_id = ?");
	 $stmt->execute([$product_id]);
	 $product = $stmt->fetchAll();
	

	 
	$product_name = $product[0]['Name'];
    $product_image = $product[0]['Image'];
    $product_description = $product[0]['Description'];
    $product_price = $product[0]['Price'];
    $product_End_date = $product[0]['End_date'];
?>
<style>
	body {
  padding-top: 80px; 
}

	.product-details {
  max-width: 800px;
  margin:  auto;
  padding: 50px;
  background-color: #fff;
  
}

.product-details .produit {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-bottom: 30px;
}

.product-details .produit img {
	max-width: 100%;
  height: auto;
  margin-bottom: 20px;
  max-width: 400px;
}

.product-details .produit h2 {
  font-size: 28px;
  font-weight: bold;
  margin: 0 0 10px;
}

.product-details .price {
  font-size: 20px;
  margin: 10px 0;
}

.product-details .price span {
  font-weight: bold;
  margin-right: 10px;
}

.product-details form {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.product-details label {
  font-size: 20px;
  font-weight: bold;
  margin-bottom: 10px;
}

.product-details input[type="number"] {
  font-size: 20px;
  padding: 10px;
  margin-bottom: 20px;
  border: 2px solid #ccc;
  border-radius: 5px;
}

.product-details button[type="submit"] {
  font-size: 20px;
  padding: 10px;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.product-details button[type="submit"]:hover {
  background-color: #0062cc;
}

</style>

<section class="product-details">
	<br><br>
	<div class="produit">
	<img src="<?php echo htmlspecialchars('images/' . $product_image);  /* prevent cross-site scripting (XSS) attacks. */?>" alt="<?php echo htmlspecialchars($product_name); ?>">
        <h2><?php echo htmlspecialchars($product_name); ?></h2>
		<p class="price"><span>Initial price : </span><?php echo htmlspecialchars($product_price); ?> TND</p>
        <p class="price"><span>Description : </span><?php echo htmlspecialchars($product_description); ?> </p>
        <p class="price" ><span>End auction : </span><?php echo htmlspecialchars($product_End_date); ?></p>
		<p class="price"><span>Current price : </span><?php echo htmlspecialchars($product[0]['Current_price']); ?> TND</p>
		<?php
$remaining_time =   strtotime( $product_End_date)  - time() ;
$remaining_days = floor($remaining_time / 86400);
$remaining_hours = floor(($remaining_time % 86400) / 3600);
$remaining_minutes = floor(($remaining_time % 3600) / 60);
$remaining_seconds = $remaining_time % 60;
?>
<p class="price" style="font-weight: bold;">Remaining time: <span style="color: red;"><?php echo $remaining_days ?> jour(s), <?php echo $remaining_hours ?> heure(s), <?php echo $remaining_minutes ?> minute(s), <?php echo $remaining_seconds ?> seconde(s)</span></p>
	</div>
	<div>
	<form method="POST" action="" onsubmit="return confirmBid()">

			<label for="new-price">Enter Your Price:</label>
			<input type="number" id="new-price" name="new_price" step="any" min="<?php echo htmlspecialchars($product[0]['Current_price'] + 1); ?>" required>
			<button type="submit" name="submit" id="submit-btn" >Place Bid</button>
            <script>
    function confirmBid() {
    if (confirm("Are you sure you want to place this bid?")) {
        return true;
    } else {
        return false;
    }
}

</script>
		</form>
		<?php
			if(isset($_POST['submit']))
			{
				include("connexion.php");
				$new_price = $_POST['new_price'];
				if($new_price <= $product_price)
				 {
					echo "Bid amount should be higher than the current price.";
				 } 
				 else
				{  $stmt2 = $pdo->prepare("SELECT Username FROM auctions WHERE Product_id = ?");
					$stmt2->execute([$product_id]);
					$Users = $stmt2->fetchAll();
					$found_username = false;
                    foreach ($Users as $row)
					{
                    	if ($row['Username'] === $_SESSION['SESS_MEMBER_ID']) {
                    		$found_username = true;
                    		break;
                    	}
                    }
                    
                    if ($found_username) {
						$update_bid_query = "UPDATE auctions SET Bid_price = $new_price WHERE Product_id = ".$product_id." AND Username = '".$_SESSION['SESS_MEMBER_ID']."'";
						$update_bid_result = $pdo->query($update_bid_query);
						if ($update_bid_result) {
							header("location:productList.php");
						} else {
						  echo "Something went wrong. Please try again later.";
						}

					}
		           else
				   {
			         $insert_bid_query = "INSERT INTO auctions (Product_id, Username, Bid_price) VALUES (".$product_id.", '".$_SESSION['SESS_MEMBER_ID']."', $new_price)";
			         $insert_bid_result = $pdo->query($insert_bid_query);
			         if($insert_bid_result)
					 {
						header("location:productList.php");
				   	 }
					  else 
					  {
				   		echo "Something went wrong. Please try again later.";
				   	  }
				    }
			    }
		    }
		?>

	</div>
	</section>
	

<script src="main/project.js"></script>
</html>

