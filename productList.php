<?php
	session_start();
if (!isset($_SESSION['SESS_MEMBER_ID']) || !isset($_SESSION['SESS_NAME']) ) {
    header("location: index.php");
    exit();
}
	?>
<head>
	<title>Product List</title>
	<link rel="stylesheet" href="main/projectstyle.css">
  <link rel="shortcut icon" href="images/Product_sample_icon_picture.png">

	<link rel="stylesheet" href="main/css/font-awesome.min.css">
  <link href="main/src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="main/lib/jquery.js" type="text/javascript"></script>
<script src="main/src/facebox.js" type="text/javascript"></script>
<script type="text/javascript">
  jQuery(document).ready(function($) {
    $('a[rel*=facebox]').facebox({
      loadingImage : 'main/src/loading.gif',
      closeImage   : 'main/src/closelabel.png'
    })
  })
</script>
</head>
<body style=" background-image: url(main/img/dashboard-background.png); background-size: 88%;">

<style>
  
  .fa-search {
    color: #666; 
    font-size: 18px; 
  }

  #search {
    border: none; 
    border-radius: 20px; 
    padding: 10px 20px; 
    font-size: 16px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1); 
  }
  
  input[type="submit"] {
    background-color: #337ab7; 
    color: #fff; 
    border: none;
    border-radius: 20px; 
    padding: 10px 20px;
    font-size: 16px; 
    cursor: pointer; 
    transition: background-color 0.3s ease; 
  }
  input[type="submit"]:hover {
    background-color: #23527c;
  }
</style>
<form action="search.php" method="post">
	<section id="header">
		<div class="header container">
		 <div class="nav-bar">
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
					<li><a href="productList.php" data-after="ProductList">Product list</a></li>
					<li><a rel="facebox" href="AddProduct.php" data-after="add product"> Add Product</a></li>
					<li> <label for="search">
    <i class="fa fa-search"></i>
  </label>
  <input type="text" id="search" name="keyword" placeholder="Search...">
    <input type="submit" value="Search">
				</ul>
			</div>
		 </div>
		</div>
	
	</section>
	</form>
	
	<?php


include 'connexion.php';


$stmt = $pdo->prepare("SELECT Image,Name,max(Bid_price) as Price,End_date,p.Product_id FROM products p join auctions a on p.Product_id=a.Product_id WHERE TIMESTAMPDIFF(MINUTE, Now(), End_date) > 0 GROUP BY p.Product_id; ");

$stmt->execute();
$products = $stmt->fetchAll();

?>


	<style type="text/css">
		.product-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  grid-gap: 1rem;
  margin-top: 100px;
  justify-items: center;
}

.product-card {
  display: flex;
  flex-direction: column;
  background-color: #ccc;
  align-items: left;
  text-align: left;
  padding: 1rem;
  border: 1px solid #ccc;
  position: relative;
}

.product-card img {
  width: 100%;
  max-width: 250px; 
  min-width: 250px;
  height: auto;
  max-height: 150px;
  object-fit: contain;
}

.product-card h2 {
  font-size: 4vh;
}

.product-card p {
  margin: 0.5rem 0;
}
.product-card span{
font-weight: bold;
color: darkblue;
}
.product-card a {
  color: #fff; 
  text-decoration: none; 
  font-size: 2vh;
  text-align: right;
  padding: 10px ; 
  background-color: #2196F3; 
  border-radius: 10px; 
  box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.25); 
  transition: all 0.3s ease-in-out; 
  position: absolute;
  top: 95%;
  right: 5%;
  transform: translate(5%, -95%);
}

.product-card a:hover {
  background-color: #0D47A1; 
  box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); 
}
@media screen and (min-width: 1000px) { 
  .product-grid {
    grid-template-columns: repeat(4, 1fr);
  }
}

	</style>

<section>
  
  <div class="product-grid">
    <?php foreach ($products as $product) { ?>
      <div class="product-card">
        <img src="<?php echo htmlspecialchars('images/' . $product['Image']);  /* prevent cross-site scripting (XSS) attacks. */?>" alt="<?php echo htmlspecialchars($product['Name']); ?>">
        <h2><?php echo htmlspecialchars($product['Name']); ?></h2>
        <p class="price"><span>Current price : </span><?php echo htmlspecialchars($product['Price']); ?> TND</p>
        <p><span>End auction : </span><?php echo htmlspecialchars($product['End_date']); ?></p>
        <p>  <br></p>
        <p><a href="auction.php?product_id=<?php echo htmlspecialchars($product['Product_id']); ?>" style="text-align: right; font-size: 2vh;">view details</a></p>

      </div>
    <?php } ?>
  </div>
  </section>

    </body>
    <script src="main/project.js"></script>

