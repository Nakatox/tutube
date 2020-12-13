<?php

if (isset($_POST['email']) && isset($_POST['password'])) {
    $tab = [];
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    try {
        $database = new PDO('mysql:host=localhost;dbname=tutube;charset=utf8', 'root', '');
    } catch (Exception $e) {
        die('error on db' . $e->getMessage());
    }

    $query = $database->prepare('SELECT id, email, password, pseudo FROM user WHERE email LIKE :email AND password LIKE :password');
    $query->execute([
        'email' => $email,
        'password' => $password,
    ]);
    $tab[] = $query->fetch();

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<style>
    body{
        background-color: #a31c23;
    }
    form{
        display:flex;
        flex-direction: column;
        justify-content: space-around;
        padding-left: 20%;
        padding-right: 20%;
        text-align: center;
        border: 3px solid white;
        margin-top: 150px ;
        margin-left: 300px ;
        margin-right: 300px ;
    }
    form p{
        
        color: white;
        font-size:30px;
        text-decoration: underline;
    }
    .row {
        border: 3px solid white;
        color: white;
        text-align: center;
        font-size: 15px;
    }
    .btn{
        margin:20px;
        padding:5px;
    }
</style>
<body>
<?php require 'header.php'; ?>
<form action="" method="POST">
    <p> Email :</p><input type="text" name="email">
    <p> Password :</p><input type="password" name="password">
    <br>
    <br>
    <input type="submit" value="Connexion" class="btn">
</form>
<br>
<br>
<div class="row">
    <?php if (isset($tab)): ?>
        <?php if ($tab[0] == false): ?>
            <p><?php echo "Informations are incorrect" ?></p>
        <?php else: ?>
            <?php session_start()?>
            <?php $_SESSION['id'] = $tab[0]['id'];
                $_SESSION['pseudo'] = $tab[0]['pseudo']; ?>
            <?php header('Location:acceuil.php')?>
        <?php endif ?>
    <?php else: ?>
        <p><?php echo "Please connect, if you don't have a account, click " ?><a href="inscription.php">here</a></p>
    <?php endif ?>
</div>
</body>
</html>