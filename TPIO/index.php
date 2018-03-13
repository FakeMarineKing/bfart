<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>TTT</title>
    </head>
    <body>
        <?php include("codb.php"); ?>
    	<?php include("entete.php"); ?>
		<?php include("menu.php"); ?>
    	<?php include("foot.php"); ?>
        <?php if(isset($_SESSION['user']))
    	   include("game/game.php");
        ?>
    </body>
</html>