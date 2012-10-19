<?php

session_start();
include_once("config.php");
require_once ("paypalfunctions.php");


//-----------------------------------
// Checkout from Cart page
// Submit more than one product item


	//-------------------------------------------
	// Prepare url for items details information
	//-------------------------------------------
	if ($_SESSION['cart_item_arr']) 
	{

		$cart_item_arr = $_SESSION['cart_item_arr']; 
		$items = array();
		
		foreach ($cart_item_arr as $c) 
		{
			$items[] = array('name' => $c[0], 
						'desc' => $c[1],
						'number' => $c[2],
						'amt' => $c[3], 
						'qty' => $c[4]);				
		}
		
		
        //'------------------------------------
        //' Calls the SetExpressCheckout API call
        //'
        //' The CallSetExpressCheckout function is defined in the file PayPalFunctions.php,
        //' it is included at the top of this file.
        //'-------------------------------------------------

		$paymentAmount = $_SESSION['cart_item_total_amt'];
        
		$resArray = SetExpressCheckoutDG( $paymentAmount, $currencyCodeType, $paymentType, 
												$returnURL, $PayPalCancelURL, $items);

        $ack = strtoupper($resArray["ACK"]);
        if($ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING")
        {
                $token = urldecode($resArray["TOKEN"]);
                 RedirectToPayPalDG( $token );
        } 
        else  
        {
                //Display a user friendly Error on the page using any of the following error information returned by PayPal
                DisplayErrorMessage('SetExpressCheckout', $resArray, $items);

        }

	}else {
	
		header("Location: cart.php"); // back to cart if don't have cart items 
		exit;
	
	}

?>
