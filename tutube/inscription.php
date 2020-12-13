<!-- - Un formulaire d’inscription avec les champs email, mot de passe et pseudo -->
<?php

$missingfields = "";
$wrong = [];


if (isset($_POST['email']) && isset($_POST['pseudo']) && isset($_POST['password']) && isset($_POST['confirm'])) {

    try {
        $database = new PDO('mysql:host=localhost;dbname=tutube;charset=utf8', 'root', '');
    } catch (Exception $e) {
        die('error on db' . $e->getMessage());
    }

$tab = $database->prepare('SELECT `pseudo`, `email` FROM `user`');
$tab->execute();


    $missingfields = "";
    $email = htmlspecialchars($_POST['email']); 
    $emailcheck = "/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}/";
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $pseudocheck = "/[a-zA-a0-9\W]/";
    $password = htmlspecialchars($_POST['password']);
    $passwordcheck = "/[a-zA-a0-9\W]/"; 
    $confirm = htmlspecialchars($_POST['confirm']); 
    

    if (preg_match($emailcheck, $email)) {
        array_push($wrong, ""); 
    }else{
        array_push($wrong, "Your email is unvalide"); 
    }
    if (preg_match($pseudocheck, $pseudo) && strlen($pseudo) >= 4 && $pseudo) {
        array_push($wrong, ""); 
    }else{
        array_push($wrong, "Your Pseudo is unvalide"); 
    }
    if (preg_match($passwordcheck, $password) && strlen($password) >= 4) {
        array_push($wrong, ""); 
    }else{
        array_push($wrong, "Your Password is unvalide"); 
    }
    if($confirm == $password){
        array_push($wrong, ""); 
    }else{
        array_push($wrong, "Your Password does not match with the first one"); 
    }

    if($wrong[0] == "" && $wrong[1] =="" && $wrong[2]=="" && $wrong[3]==""){
        try {
            $database = new PDO('mysql:host=localhost;dbname=tutube;charset=utf8', 'root', '');
        } catch (Exception $e) {
            die('error on db' . $e->getMessage());
        }
    
    $query = $database->prepare('INSERT INTO `user`(`pseudo`, `email`, `password`) VALUES (:pseudo, :email,  :password)');
    $query->execute([
        'email' => $_POST['email'],
        'password' => $_POST['password'],
        'pseudo' => $_POST['pseudo'],
    ]);
    header('Location:connexion.php');
    }
}else{
    $missingfields = "There is a empty field";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
<?php require 'header.php'; ?>
    <form action="" method="POST">
        Pseudo :<input type="text" name="pseudo"> (4 characters minimun)
        <br>
        Email :<input type="text" name="email">
        <br>
        Password :<input type="password" name="password"> (4 characters minimun)
        <br>
        Confirm Password :<input type="password" name="confirm"> 
        <br>
        <input type="submit" value = "Create my account"/>
    </form>
    <br>
    <?php foreach($wrong as $value):?>
    <?php echo $value . '<br/>' ?>
    <?php endforeach ?>
</body>
</html>