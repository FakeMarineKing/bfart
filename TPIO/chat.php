<?php 
    session_start();
    if(!isset($_SESSION['user'])){
        header("Location: connection.php");
    }else{
        $username=$_SESSION['username'];
    }
    include("codb.php");
    $error=false;
    if(isset($_POST['postmsg'])){
        $msg=trim($_POST['message']);
        $msg=strip_tags($msg);
        $msg=htmlspecialchars($msg);

        if(empty($msg)){
            $error=true;
            $errmsg="Ecrivez un message si vous voulez poster";
        }
        if(!$error){
            $query="INSERT INTO chat(message,user)
            VALUES('$msg','$username')";
            $res=mysqli_query($bdd,$query); 

        }
}
?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/
libs/jquery/1.3.0/jquery.min.js"></script>
<script type="text/javascript">
var auto_refresh = setInterval(
function ()
{
$('#showchat').load('msgchat.php').fadeIn("slow");
}, 1000);
</script>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Chat</title>
    </head>
    <body>
   		<?php include_once 'codb.php';?>
    	<?php include("entete.php"); ?>
		<?php include("menu.php"); ?>
		<?php include("foot.php"); ?>

        <form method="post" action="chat.php">
            <p>
                <input type="text" name="message"/>
                <input type="submit" name="postmsg" value="envoyer"
                />
            </p>
            <div id="showchat"></div>
            
        </form>
	</body>
</html>