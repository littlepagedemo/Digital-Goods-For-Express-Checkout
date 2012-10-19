<?php

$c = $_GET["c"];  // 0 / 1

?>

<script>

//alert("Payment Cancelled"); 

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

<?php 
// add cart no
if ($c) {
?>

var no = window.opener.document.getElementById("cartbox").innerHTML;
no++;
window.opener.document.getElementById("cartbox").innerHTML = no;

<?php } ?>
                            
</script>

