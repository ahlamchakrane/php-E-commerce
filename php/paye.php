<?php
session_start();
 ?>
<!DOCTYPE html>
<html>
<head>
  <title>Payment</title>
  <link rel="stylesheet" type="text/css" href="css/Login.css">
  <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">

  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<style>
	.div{
		font-size: 26px;
	}
.position .div textarea{
	margin-right: 80%;
}

</style>
<body>
	<div class="container">
		<div class="login-content">

			<form action="connexion.php" method="post">
           		
           		   <div class="div">
           		   		<h5><?php if(isset($_SESSION['user'])){echo '<p><strong>'.$_SESSION['user']['username'].'</strong></p>';}?>
           		   		 <input type="hidden" name="username" value='<?= $_SESSION['user']['username']?>'>
           		   		</h5>
           		   </div>
           		 <?php if(!empty($_SESSION['total']) && isset($_SESSION['user']['username'])){?>
   
           		   <div class="div">
           		   		<h5><?php if(isset($_SESSION['total'])){echo '<p>The total to pay is: <strong>'.$_SESSION['total'].'</strong>MAD</p>';}?></h5>
           		   		<input type="hidden" name="total" value='<?= $_SESSION['total']?>'>
           		   </div>
           		
           		   	<div class="input-div pass">
           		   <div class="i">
           		    	
           		   </div>
           		   <div class="div">
           		    	<input type="text" class="input" name="adresse" required placeholder="Your address">
            	   </div>
            	 </div>
               <div class="input-div pass">
                 <div class="i">
                    
                 </div>
                 <div class="div">
                    <input type="text" class="input" name="phone" required placeholder="Phone number">
                 </div>
               </div>
           		
           		<div class="div" style="margin-top: 150px">
           		   		<h5>Payment Mode : cash on delivery</h5>
           		 </div>
           		 <input type="submit" class="btn" value="Place Order" name="paye">
              <?php } else{
                echo '<p><strong>You don\'t have anything in your shipping cart</strong></p><br><a href="index.php">Back to the main page</a>';

              } ?>
</form> 
</body>
</html>
