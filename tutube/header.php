<div>
<ul>
<li><a href="acceuil.php">Home</a></li>
<li><a href="ajoutvideo.php">Add a video</a></li>
<?php 
if(isset($_SESSION['id']))
{ echo '<li><a href="deco.php">Log off</a></li>';}
else{echo'<li><a href="connexion.php">Log in</a></li>'.'<li><a href="inscription.php">Create an account</a></li>';}; 
?>


</ul>

</div>
