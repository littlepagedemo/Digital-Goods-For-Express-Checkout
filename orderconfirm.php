<?php
/* =====================================
 *	 PayPal Express Checkout Call
 * =====================================
 */

session_start();
include_once("config.php");
require_once ("paypalfunctions.php");

$token = $_REQUEST['token'];

// If the Request object contains the variable 'token' then it means that the user is coming from PayPal site.	
if ( $token != "" )
{
	/*
	 '------------------------------------
	 ' this  step is required to get parameters to make DoExpressCheckout API call, 
	 ' this step is required only if you are not storing the SetExpressCheckout API call's request values in you database.
	 ' ------------------------------------
	 */
	$res = GetExpressCheckoutDetails( $_REQUEST['token'] );	
	
	/*
	 '------------------------------------
	 ' The paymentAmount is the total value of
	 ' the purchase. 
	 '------------------------------------
	 */

	$finalPaymentAmount =  $res["AMT"];

	/*
	 '------------------------------------
	 ' Calls the DoExpressCheckoutPayment API call
	 '
	 ' The ConfirmPayment function is defined in the file PayPalFunctions.php,
	 ' that is included at the top of this file.
	 '-------------------------------------------------
	 */

	//Format the  parameters that were stored or received from GetExperessCheckout call.
	$token 				= $_REQUEST['token'];
	$payerID 			= $_REQUEST['PayerID'];
	$paymentType 		= 'Sale';
	$currencyCodeType 	= $res['CURRENCYCODE'];


	$resArray = ConfirmPayment ( $token, $paymentType, $currencyCodeType, $payerID, $finalPaymentAmount );
	$ack = strtoupper($resArray["ACK"]);
	if( $ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING" )
	{
		$transactionId		= $resArray["PAYMENTINFO_0_TRANSACTIONID"]; // Unique transaction ID of the payment.
		
		SaveTransaction($resArray);

		// clear session
		session_start();
		session_unset();
		session_destroy();
		$_SESSION = array();

?>
		
		
<html>
<script>
     
function closewin() {

	window.opener.location.reload();
	
    if(window.opener){
         window.close();
     }
    else{
         if(top.dg.isOpen() == true){
             top.dg.closeFlow();
             return true;
          }
    }
          
}                                
</script>

<body>
<h3>Payment Successful</h3>
<br>TransactionId: <?php echo $transactionId; ?>

<br><br>
<input type="button" name="close" value="Close" onclick="closewin()"> 

<div style="overflow:scroll">
<?php 
		$resData = reformat_arr($resArray); 
		echo '<p style="font-size:10px">'.$resData.'</p>';
?>
</div>

</body>
</html>


<?php

	}
	else
	{
		//Display a user friendly Error on the page using any of the following error information returned by PayPal
		DisplayErrorMessage('DoExpressCheckoutDetails', $resArray, $token);
		
		/*$ErrorCode = urldecode($resArray["L_ERRORCODE0"]);
		$ErrorShortMsg = urldecode($resArray["L_SHORTMESSAGE0"]);
		$ErrorLongMsg = urldecode($resArray["L_LONGMESSAGE0"]);
		$ErrorSeverityCode = urldecode($resArray["L_SEVERITYCODE0"]);

		echo "DoExpressCheckoutDetails API call failed. ";
		echo "Detailed Error Message: " . $ErrorLongMsg;
		echo "Short Error Message: " . $ErrorShortMsg;
		echo "Error Code: " . $ErrorCode;
		echo "Error Severity Code: " . $ErrorSeverityCode;*/
	?>
	
<html>
<script>
alert("Payment failed");
// add relevant message above or remove the line if not required
window.onload = function(){
    if(window.opener){
         window.close();
     }
    else{
         if(top.dg.isOpen() == true){
             top.dg.closeFlow();
             return true;
          }
      }                              
};
                                
</script>
</html>
<?php 
	}
}

?>