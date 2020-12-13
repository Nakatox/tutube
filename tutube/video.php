<!-- - Une page vidéo permettant d’afficher la vidéo, son titre et sa description
- Un bouton pour supprimer la vidéo (seulement une personne connectée)
- Un formulaire d’édition pour permettre la modification du titre, de l’url et de la description.  (seulement une personne connectée) -->
<?php
session_start();
try {
    $database = new PDO('mysql:host=localhost;dbname=tutube;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('error on db' . $e->getMessage());
}

$tab = $database->prepare('SELECT `id`, `url`, `title`,`description` FROM `video` WHERE id LIKE :id');
$tab->execute([
    'id' => $_GET['videoid'],
]);
$videos = $tab->fetch();

    $url = $videos['url'];
    preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url, $matches);
    $id = $matches[1];


if(isset($_POST['title']) && isset($_POST['url']) && isset($_POST['description'])){
    $url = htmlspecialchars($_POST['url']);
    $title = htmlspecialchars($_POST['title']);
    $description = htmlspecialchars($_POST['description']);
    try {
        $database = new PDO('mysql:host=localhost;dbname=tutube;charset=utf8', 'root', '');
    } catch (Exception $e) {
        die('error on db' . $e->getMessage());
    }
    
    $taba = $database->prepare('UPDATE `video` SET `url`= :url,`title`= :title ,`description`= :description WHERE id LIKE :id');
    $taba->execute([
        'id' => $videos['id'],
        'url' => $url,
        'title' => $title,
        'description' => $description,
    ]);
    $vid = $taba->fetch();

header("Refresh:0");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    body{
        background-color: #a31c23;
    }
    iframe{
        display:flex;
        margin-left: 10%;
        border: 3px solid white;
        
    }
    form{
        display:flex;
        flex-direction: column;
        justify-content: space-around;
        padding-left: 20%;
        padding-right: 20%;
        text-align: center;
        border: 3px solid white;
     
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
        margin-top: 50px;
    }
    .btn{
        margin:20px;
        padding:5px;
    }
    .desc{
        text-align: center;
        color: white;
        font-size: 20px;
       
    }
    a{
        text-decoration: none;
        color: white;
        border: 3px solid white;
        border-radius: 50px;
        padding:7px;
    }
</style>
<body>
    
<?php require 'header.php'; ?>
<div class="row">
    <?php echo $videos['title'] ?>
</div>

<iframe id="ytplayer" type="text/html" width="1200px" height="760px"
    src="https://www.youtube.com/embed/<?php echo $id ?>?rel=0&showinfo=0&color=white&iv_load_policy=3"
    frameborder="0" allowfullscreen>
</iframe> 

<?php if(isset($_SESSION['pseudo'])): ?>
    <p class="desc">Description :<?php echo $videos['description'] ?></p> 
        <?php if(isset($_SESSION['pseudo'])): ?>
            <p class="desc"> <a href="supr.php?videoid=<?php echo $videos['id'] ?>">Delete this video</a></p> 
        <?php endif; ?>

    <form action="" method="POST">
        <p>Edit the informations </p>
            <br>
            <p> Title : </p><input type="text" value="<?php echo $videos['title'] ?>" name="title">
            <br>
            <p>Url : </p><input type="text" value="<?php echo $videos['url'] ?>" name="url">
            <br>
            <p>Description : </p><input type="text" value="<?php echo $videos['description'] ?>" name="description">
            <br>
            <input type="submit" class="btn"value="Edit">
    </form>
<?php endif ?>
</body>
</html>
