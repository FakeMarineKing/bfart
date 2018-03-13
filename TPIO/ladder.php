<?php
	session_start();
	$loop=0;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Ladder</title>
    </head>
    <body>
   		<?php include 'codb.php';?>
    	<?php include("entete.php"); ?>
		<?php include("menu.php"); ?>
		<?php include("foot.php"); ?>
		<form method="post" action="ladder.php">
			<p>
				<input type="text" name="pseudo" />
				<input type="submit" name="search" value="Rechercher"/>
			</p>
		</form>
		<?php
			if(isset($_POST['search'])){
				$pseudo=trim($_POST['pseudo']);
				$pseudo=strip_tags($pseudo);
				$pseudo=htmlspecialchars($pseudo);
				$reponse = mysqli_query($bdd,"SELECT username,score FROM user WHERE username='$pseudo'");
				$donnees = mysqli_fetch_array($reponse);
				if($donnees == null){
					echo "Ce joueur n'existe pas !";
				}else{
					?>
					<p>
						<strong>Username</strong> : 
					<?php echo $donnees['username'];?>, 
					<?php 
							if($donnees['score']==null){
								echo 0;
							}else {
								echo $donnees['score'];
							}
						?>
						point<br/>
					</p>
					<?php
				}

			}else{
				$reponse = mysqli_query($bdd,'SELECT username,score FROM user ORDER BY score DESC');
				while ($donnees = mysqli_fetch_array($reponse)){
					if($loop<10){
						$loop++;
						?>
					<p>
						<strong>Username</strong> : 
						<?php echo $donnees['username'];?>, 
						<?php 
							if($donnees['score']==null){
								echo 0;
							}else {
								echo $donnees['score'];
							}
						?>
						point<br/>
					</p>
						<?php 	
					}
				}
			}
		?>
    </body>
</html>