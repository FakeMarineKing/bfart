
<?php 
	$host_name  = "localhost";
    $database   = "ttt";
    $user_name  = "root";
    $password   = "YourPassWord";
	try{ 
    	$bdd = new mysqli($host_name, $user_name, $password, $database);
		}
		catch(Exception $e){
			die('Erreur : ' . $e->getMessage());
		}
?>