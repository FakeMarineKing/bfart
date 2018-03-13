
<?php
	session_start();
	if(isset($_SESSION['user'])){
		header("Location: index.php");
	}
	include('codb.php');
	$error=false;
	if(isset($_POST['signup'])){
		$pseudo=trim($_POST['pseudo']);
		$pseudo= strip_tags($pseudo);
		$pseudo= htmlspecialchars($pseudo);
		
		$pass=trim($_POST['password']);
		$pass=strip_tags($pass);
		$pass=htmlspecialchars($pass);

		//Pseudo check
		if(empty($pseudo)){
			$error=true;
			$pseudoError=" Saisissez un pseudo ";
		}else if(strlen($pseudo)<3 || strlen($pseudo>20)){
			$error=true;
			$pseudoError=" Pseudo entre 3 et 20 caractere";
		}else{
			$query = "SELECT username FROM user WHERE username='$pseudo'";
			$nbUser=mysqli_query($bdd,$query);
			if(mysqli_num_rows($nbUser)!=0){
				$error=true;
				$pseudoError=" Pseudo deja utiliser ";
			}
		}

		//Pass encryption&Validation
		if(empty($pass)){
			$error=true;
			$passError="Vous devez saisir un mot de pass ";
		}elseif (strlen($pass)<4 || strlen($pass)>20) {
			$error=true;
			$passError=" Mdp entre 4 et 20 caractere ";
		}else{
			$password = hash('sha1',$pass);
		}

		if(!$error){
			$query = "INSERT INTO user(username,Password) VALUES('$pseudo','$password')";
   		$res = mysqli_query($bdd,$query);

		}

		if($res){
			$msg= "Enregistrer avec succes !";
			unset($pseudo);
			unset($pass);
		}
	} 
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Connection</title>
    </head>
    <body>
    	<?php include("entete.php"); ?>
		<?php include("menu.php"); ?>
		<?php include("foot.php"); ?>

		<form method="post" action="register.php">
			<p>
				<input type="text" name="pseudo" value="Votre Pseudo" /><br/>
				<input type="password" name="password" value=""/>
				<button type="submit" name="signup">SignUp</button>
			</p>
		<?php
			if ($error==true){
				if(isset($pseudoError))
					echo $pseudoError;
				if(isset($passError))
					echo $passError;
			}
				echo $msg;
		?>
		</form>
    </body>
</html>