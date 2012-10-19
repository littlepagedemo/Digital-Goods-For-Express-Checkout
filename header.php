<!DOCTYPE html>

<html lang="en">
<head>

  <title>Paypal API - Express Checkout</title>

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  
  <link rel="stylesheet" href="css/style.css">
   
  </head>
  
  <body>
  
    <div id="container">
    
	<div id="header">
		<h1 style="float:left;width:50%">
			Company Name
		</h1>
		<div style='float:left;width:50%;text-align:right'><img src="https://www.paypalobjects.com/en_US/i/bnr/bnr_shopNowUsing_150x40.gif"></div>
	</div>
	
	<div id="navigation">
		<ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="cart.php">Cart (<span id='cartbox'><?php if($_SESSION['cart_no']) echo $_SESSION['cart_no']; else echo '0'; ?></span>)</a></li>
			<!--li><a href="admin.php">Admin</a></li-->			
		</ul>
	</div>