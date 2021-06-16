<?php
session_start();
 ?>
<!DOCTYPE html>
<html>
<head>
  <title>Done</title>
  <link rel="stylesheet" type="text/css" href="css/Login.css">
  <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">

  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<style>
	.div{
		font-size: 26px;
	}
.milieux {
	text-align: center;
  align-items: center;
  font-size: 20px;
}
.milieux a{
  margin-right: 30%;
}

</style>
<body>
	<div class="container">
		<div class="login-content">
           		
           		   <div class="milieux">
           		   		<h5><?php if(isset($_SESSION['user'])){echo '<p><strong>'.$_SESSION['user']['username'].'</strong></p><br>You have successfully paid <br>your command will be arrived after some weeks<br><br>';}?>
           		   		</h5>
                    <a href="index.php"></i>Back to the main page</a>
                 </div>
      </div>
    </div>
</body>
</html>
