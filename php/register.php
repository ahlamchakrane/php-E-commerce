<!DOCTYPE html>
<html>
<head>
	<title>Login Form</title>
	<link rel="stylesheet" type="text/css" href="css/register.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<div class="container">
		<div class="login-content">
			<form action="connexion.php" method="post">
				<h2 class="title">Create an account</h2>
				<p>and join our community</p>
           		<div class="input-div one">
           		   <div class="i">
           		   		
           		   </div>
           		   <div class="div">
           		   		<h5>Full name</h5>
           		   		<input type="text" class="input" name="username" required>
           		   </div>
           		</div>
							<div class="input-div one">
           		   <div class="i">
           		   		
           		   </div>
           		   <div class="div">
           		   		<h5>Email</h5>
           		   		<input type="text" class="input" name="email" required>
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i">
           		    	
           		   </div>
           		   <div class="div">
           		    	<h5>Password</h5>
           		    	<input type="password" class="input" name="password" required>
            	   </div>
            	</div>
							
							<a href="Login.php">Already have an account?</a>
            	<input type="submit" class="btn" value="Register" name="register">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="js/main.js"></script>
</body>
</html>
