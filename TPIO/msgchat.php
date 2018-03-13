<?php include("codb.php"); ?>
<?php
    $rep=mysqli_query($bdd,'SELECT user, message FROM chat ORDER BY
    id DESC LIMIT 0, 10');
    while($data = mysqli_fetch_array($rep)){
        echo '<p><strong>' . htmlspecialchars($data['user']) . '</
        strong> : ' . htmlspecialchars($data['message']) . '</p>';
    }
?>