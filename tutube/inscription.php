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
        font-size: 30px;
    }
    .btn{
        margin:20px 20px 0 20px;
        padding:5px;
    }
</style>
<body>
<?php require 'header.php'; ?>
<form action="" method="POST">
    <p>Pseudo :</p> <input type="text" name="pseudo"> (4 characters minimun)
    <br>
    <p>Email :</p> <input type="text" name="email">
    <br>
    <p>Password :</p> <input type="password" name="password"> (4 characters minimun)
    <br>
    <p>Confirm Password : </p> <input type="password" name="confirm">
    <br>
    <br>
    <input type="submit" class="btn"value = "Create my account"/></p> 
</form>
    
<div class="row">
    <?php foreach($wrong as $value):?>
        <p><?php echo $value  ?></p>
    <?php endforeach ?>
</div>
</body>
</html>