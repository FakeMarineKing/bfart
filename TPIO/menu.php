<?php 
session_start();
?>
<nav>
	<ul>
		<li><a href="regles.php">Régles</a></li>
		<li><a href="ladder.php">Ladder</a></li>
		

		<?php 
			if (!isset($_SESSION['user'])) {
		?>
		<li><a href="connection.php">Connection</a></li>
		<li><a href="register.php">Register</a></li>
		<?php
		}
		?>
		<?php
			if(isset($_SESSION['user'])){
		?>
		<li><a href="chat.php">Chat</a></li>
		<li><a href="deconnection.php">Deconnect</a></li>
		<?php 
		} 
		?>
	</ul>
</nav>
<p><br/><br/><p>