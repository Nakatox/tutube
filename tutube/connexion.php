<!-- - Un formulaire de login avec les champs email et mot de passe -->
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
<body>
<?php require 'header.php'; ?>
    <form action="" method="POST">
        Email :<input type="text" name="email">
        Password :<input type="password" name="password">
        <input type="submit" value="Connexion">
    </form>
    <div>
        <?php if (isset($tab)): ?>
        <?php if ($tab[0] == false): ?>
        <?php echo "Informations are incorrect" ?>
        <?php else: ?>
        <?php session_start()?>
        <?php $_SESSION['id'] = $tab[0]['id'];
            $_SESSION['pseudo'] = $tab[0]['pseudo']; ?>
        <?php header('Location:acceuil.php')?>
        <?php endif ?>
        <?php else: ?>
        <?php echo "Please connect, if you don't have a account, click " ?><a href="inscription.php">here</a>
        
        <?php endif ?>
    </div>
</body>
</html>