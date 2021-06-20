<script src="sweetalert.min.js"></script>
 <link rel="stylesheet" type="text/css" href="sweetalert.css">
<?php
    $serveur="localhost";
    $login="root";
    $password="";
 
    $connexion= new PDO("mysql::host=$serveur;dbname=boutique",$login,$password);
    $connexion -> setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if(isset($_POST['login'])){
	if(isset($_POST['username']) && isset($_POST['password']))
	{
		$query = " SELECT * FROM users WHERE username = :username ";
		$statement = $connexion->prepare($query);
		$statement->execute(
			array(
				':username' => $_POST["username"]
			)
		);
			$result = $statement->fetch(); //un seul utilisateur
	// password_verify($_POST["password"], $row["password"])
			if($result && password_verify($_POST['password'],$result['password']))
				{
					 session_start();
					$_SESSION['user'] = array(
						'id'=> $result['iduser'],
						'username'=> $result['username']
					);
				}
			else{
				header('location:Login.php?message=404');
				exit;
			}
	}
	header('location:index.php');
}



if(isset($_POST['register'])){

 	if( isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])){
 		$username = $_POST["username"];
		$email = $_POST["email"];
		$password =$_POST["password"];
		$check_query = " SELECT * FROM users WHERE username = :username ";
		$statement = $connexion->prepare($check_query);
		$statement->execute( 
			array(
			':username'		=>	$username
			)
		);
		
		if($statement->rowCount()){  
			header('location:register.php?message=exist');
			exit;
		}

		$query="INSERT INTO users (username, email, password) values ('$username','$email','".password_hash($password, PASSWORD_DEFAULT)."')";	
		$statement = $connexion->prepare($query);
				if($statement->execute())
				{
				        header('location:Login.php');
				}
	}
	else
	{
		header('location:register.php?message=champs_vide');
	}
}
if(isset($_POST['paye'])){
$adresse=$_POST['adresse'];
$total=$_POST['total'];
$username=$_POST['username'];
$phone=$_POST['phone'];
$query="INSERT INTO payment (username, adresse, total, phone) values ('$username','$adresse','$total', '$phone')";	
$result =$connexion->prepare($query);
	if($result->execute()){
      	header('location:done.php');
    }    
}