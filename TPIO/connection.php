<?php
	session_start();
	if(isset($_SESSION['user'])){
		header("Location: index.php");
	}

	include("codb.php");
	$error=false;
	if(isset($_POST['connect'])){
	
		$pseudo=trim($_POST['pseudo']);
		$pseudo=strip_tags($pseudo);
		$pseudo=htmlspecialchars($pseudo);

		$password=trim($_POST['password']);
		$password=strip_tags($password);
		$password=htmlspecialchars($password);

		if(empty($pseudo)){
			$error=true;
			$pseudoError=" Entrez un pseudo svp ";
		}
		if(empty($password)){
			$error=true;
			$passwordError=" Entrez un mdp svp ";
		}
		
		if(!$error){
			$password=hash('sha1', $password);
			$result=mysqli_query($bdd,"SELECT id, username, password FROM user WHERE username='$pseudo'");
			$usr=mysqli_fetch_array($result);
			$nbr=mysqli_num_rows($result);
			if($nbr==1 && $usr['password']==$password){
				$_SESSION['user'] = $usr['id'];
				$_SESSION['username'] = $usr['username'];
				echo '<meta http-equiv="refresh" content="0">';
			}else{
				$errorMSG= " Mauvais identifiant réessayez";
			}
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
		<form method="post" action="connection.php">
			<p>
				<input type="text" name="pseudo" value="Votre Pseudo" /><br/>
				<input type="password" name="password" value=""/>
				<input type="submit" name="connect" value="Valider"/>
				<?php
					if(isset($pseudoError)) echo $pseudoError;
					if(isset($passwordError)) echo $passwordError;
					if(isset($errorMSG)){

						echo $errorMSG;
					}
				?>
			</p>
		</form>
    </body>
</html>