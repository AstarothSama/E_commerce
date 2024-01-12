<!DOCTYPE html>
<html>
<head>
	<title>dashboard</title>
	<link rel="stylesheet" href="projectstyle.css">
	<link rel="shortcut icon" href="../images/dashboard-icon.png">
  
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="lib/jquery.js" type="text/javascript"></script>
<script src="src/facebox.js" type="text/javascript"></script>
<script type="text/javascript">
  jQuery(document).ready(function($) {
    $('a[rel*=facebox]').facebox({
      loadingImage : 'src/loading.gif',
      closeImage   : 'src/closelabel.png'
    })
  })
</script>
</head>
<body>
	<?php
	session_start();
if (!isset($_SESSION['SESS_MEMBER_ID']) || !isset($_SESSION['SESS_NAME']) ) {
    header("location: ../index.php");
    exit();
}
	?>
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
				    <li><a href="dashboard.php" data-after="dashboard">Dashboard</a></li>
					<li><a href="../productList.php" data-after="ProductList">Product list</a></li>
					<li><a rel="facebox" href="../AddProduct.php" data-after="add product"> Add Product</a></li>
					<li><a href="Logout.php" data-after="logout">Logout</a></li>
	
				</ul>
			</div>
		 </div>
		</div>
	</div>
	</section>
	<section id="hero">
        <div class="hero container">
            <div>
                <h1>Hello,<span></span></h1> 
				<?php
				echo '<h1>' . $_SESSION['SESS_NAME'] . ' <span></span></h1>';
				?>
                <h1>Welcome<span></span></h1>
                <a href="../productList.php"  class="cta" >products list</a>
            </div>
        </div>
    </section>
	
</body>
<script src="project.js"></script>
</html>
