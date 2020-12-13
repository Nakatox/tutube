<style>
    ul{
        display:flex;
        align-items:center;
        justify-content:center;
        /* margin-left: 25%; */
        
    }
    ul li a{
       
        text-decoration: none;
        font-size: 30px;
        color: white;
        border: white solid 2px;
        padding: 10px;
    }
    ul li{
        padding-left: 30px;
        padding-right: 30px;

        list-style: none;
       
    }
    .img{
        width: 200px;
        position: absolute;
    }
</style>
    <img src="logo.png" alt="" class="img" />
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
