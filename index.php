<?php
	session_start();
	
	unset($_SESSION['SESS_MEMBER_ID']);
	unset($_SESSION['SESS_FIRST_NAME']);
	
?>
<html>
<head>
<title>
Vista
</title>
    <link rel="shortcut icon" href="images/pos.jpg">

  <link href="main/css/bootstrap.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="main/css/DT_bootstrap.css">
  
  <link rel="stylesheet" href="main/css/font-awesome.min.css">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
        background-image: url(main/img/dashboard-background.png) ;
        background-size:  500px; 
      }
      .sidebar-nav {
        padding: 9px 0;
      }
    </style>
    <link href="main/css/bootstrap-responsive.css" rel="stylesheet">

	<script src="main/jeffartagame.js" type="text/javascript" charset="utf-8"></script>
<script src="main/js/application.js" type="text/javascript" charset="utf-8"></script>
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
<body>
    <div class="container-fluid">
      <div class="row-fluid">
		<div class="span4">
		</div>
	
</div>
<div id="login">
<?php
if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
	foreach($_SESSION['ERRMSG_ARR'] as $msg) {
		echo '<div style="color: red; text-align: center;">',$msg,'</div><br>'; 
	}
	unset($_SESSION['ERRMSG_ARR']);
}
?>
<form action="login.php" method="post">

			<font style=" font:bold 44px 'Aleo'; text-shadow:1px 1px 15px #000; color:#fff;"><center>Vista Shop</center></font>
		<br>

		
<div class="input-prepend">
		<span style="height:30px; width:25px;" class="add-on"><i class="icon-user icon-2x"></i></span><input style="height:40px;" type="text" name="username" Placeholder="Username" required/><br>
</div>
<div class="input-prepend">
  <span style="height:30px; width:25px;" class="add-on"><i class="icon-lock icon-2x"></i></span>
  <input type="password" style="height:40px;" class="form-control" name="password" id="password" Placeholder="Password" required/>
  <span class="input-group-addon toggle-password" style="cursor: pointer;">
    <i class="fa fa-eye"></i>
  </span>
</div>
		<div class="qwe" style="display: flex; flex-direction: row;">
		 <button class="btn btn-md btn-primary btn-block pull-right"  href="dashboard.html"  type="submit"><i class="icon-signin icon-large"></i> Login</button>
		
		 <a rel="facebox" href="main/addcustomer.php" style="color: blue;" onmouseover="this.style.color='black';" onmouseout="this.style.color='blue';"><i class="icon-plus-sign icon-large"></i> new Customer ?</a>

		</div>

		 </form>
</div>
</div>
</div>
</div>
</body>
</html>