<?php

		session_start();
		include_once("config.php");
		require_once ("paypalfunctions.php");


		$Item = $_GET["id"];
		$ItemName=$ItemDesc=$ItemNumber=$ItemPrice="";
		$paymentAmount=0.00;

		if($Item == "1"){
			$ItemName = "Book A";
			$ItemDesc = "Book A Desc";
			$ItemNumber ="p1001";
			$ItemQty = 1;
			$ItemPrice=$paymentAmount=$ItemTotalPrice = '10.00';
		}

		if($Item == "2"){
			$ItemName = "Book B";
			$ItemDesc = "Book B Desc";
			$ItemNumber = "p1002";
			$ItemQty = 1;
			$ItemPrice=$paymentAmount=$ItemTotalPrice = '15.00';
		}


		// Keep in array
		$cart_item = array("$ItemName","$ItemDesc","$ItemNumber","$ItemPrice","$ItemQty","$ItemTotalPrice"); 
	
		// update cart
		cart_process($cart_item);		
		
		
        //'------------------------------------
        //' Calls the SetExpressCheckout API call
        //'
        //' The CallSetExpressCheckout function is defined in the file PayPalFunctions.php,
        //' it is included at the top of this file.
        //'-------------------------------------------------
        
		$items = array();
		$items[] = array('name' 	=> $ItemName, 
						'desc' 		=> $ItemDesc,
						'number' 	=> $ItemNumber,
						'amt' 		=> $paymentAmount, 
						'qty' 		=> $ItemQty);				

		$resArray = SetExpressCheckoutDG( $paymentAmount, $currencyCodeType, $paymentType, 
												$returnURL, $cancelURL, $items );

        $ack = strtoupper($resArray["ACK"]);
        if($ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING")
        {
                $token = urldecode($resArray["TOKEN"]);
                RedirectToPayPalDG( $token );
        } 
        else  
        {
                //Display a user friendly Error on the page using any of the following error information returned by PayPal
                DisplayErrorMessage('SetExpressCheckout',$resArray, $items);
                
        }


?>
