<?php

session_start();
include_once("config.php");
include("header.php");

?>


  	
	<div id="content-container">
	
		<div id="content">
			<h2>
				E-Book
			</h2>


			<div class="thumbnail">
				<img src="images/ios.jpeg" alt="" width="120"><br>
				Book A <?php echo $currencyCodeType; ?> $10.00<br>

				<!--a href="checkout.PHP" id="paypal-submit">
				<img src='https://www.paypal.com/en_US/i/btn/btn_dg_pay_w_paypal.gif' border="0"></a-->
				
				<!-- checkout 1 item -->
				<form action='checkoutone.php?id=1' METHOD='POST'>
				<input type='image' name='paypal-submit1' id='paypal-submit1' src='https://www.paypal.com/en_US/i/btn/btn_dg_pay_w_paypal.gif' border='0' align='top' alt='Pay with PayPal'/>
				</form>

				<!-- Add to cart -->
				<form method="post" action="cart.php">
					<input type="hidden" name="itemname" value="Book A" /> 
					<input type="hidden" name="itemdesc" value="Book A Desc" /> 
					<input type="hidden" name="itemnumber" value="p1001" /> 
					<input type="hidden" name="itemprice" value="10.00" />
					<input type="hidden" name="itemQty" value="1" />
        			<br><input type='image' src="images/addtocart.png" value="Add to Cart" />
    			</form>
    								
			</div>
			
			<div class="thumbnail">
				<img src="images/ios5.jpeg" alt="" width="120"><br>
				Book B <?php echo $currencyCodeType; ?> $15.00<br>
				
				<!-- checkout 1 item -->
				<form action='checkoutone.php?id=2' METHOD='POST'>
				<input type='image' name='paypal-submit2' id='paypal-submit2' src='https://www.paypal.com/en_US/i/btn/btn_dg_pay_w_paypal.gif' border='0' align='top' alt='Pay with PayPal'/>
				</form>	
				
				<!-- Add to cart -->
				<form method="post" action="cart.php">
					<input type="hidden" name="itemname" value="Book B" /> 
					<input type="hidden" name="itemdesc" value="Book B Desc" /> 
					<input type="hidden" name="itemnumber" value="p1002" /> 
					<input type="hidden" name="itemprice" value="15.00" />
					<input type="hidden" name="itemQty" value="1" />
        			<br><input type='image' src="images/addtocart.png" value="Add to Cart" />
    			</form>
			</div>


		</div>
		
		<div id="aside">
			<h3>
				Digital Goods Express 
			</h3>
			<p>Digital goods payments combines JavaScript with the Express Checkout API to streamline the checkout process for buyers of digital goods.

				<br><br>Digital goods are items such as e-books, music files, and digital images distributed in electronic format. Typically the prices of items are a few dollars. The buyer can conveniently purchase digital goods during checkout with a minimum of clicks without leaving your website or interrupting their online activities.
			</p>
			
		</div>
		
		<script src ="https://www.paypalobjects.com/js/external/dg.js" type="text/javascript"></script>
		<script>var dg1 = new PAYPAL.apps.DGFlow({trigger: "paypal-submit1", expType: 'instant'}); </script>	
		<script>var dg2 = new PAYPAL.apps.DGFlow({trigger: "paypal-submit2", expType: 'instant'}); </script>
		
<?php
	include("footer.php");
?>
