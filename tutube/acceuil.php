<!-- - Liste des vidéos avec son titre
- Un bouton permettant d’aller sur la page vidéo
- Un bouton pour supprimer la vidéo (seulement une personne connectée) -->

<?php
session_start();
try {
    $database = new PDO('mysql:host=localhost;dbname=tutube;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('error on db' . $e->getMessage());
}

$query = $database->prepare('SELECT `id`, `url`, `title` FROM video ');
$query->execute();
$videos = $query->fetchAll();

$tableau = [];
foreach($videos as $value){
try {
    $database = new PDO('mysql:host=localhost;dbname=tutube;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('error on db' . $e->getMessage());
}

$tab = $database->prepare('SELECT `id`, `url`, `title`,`description` FROM `video`');
$tab->execute();
$video = $tab->fetch();

    $url = $value['url'];
    preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url, $matches);
 
    array_push($tableau, [$matches[1], $value['id'], $value['title']]);
 
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
</head>
<body>
<?php require 'header.php'; ?>
<?php if (isset($_SESSION['pseudo'])):?>
<p>Hello <?php echo $_SESSION['pseudo'] ?></p>
<?php endif ?>


<?php foreach($tableau as $value): ?>
<br>
<?php if(isset($_SESSION['pseudo'])): ?>
<a href="supr.php?videoid=<?php echo $value[1] ?>">Delete this video</a>
<?php endif ?>
<br>
<iframe id="ytplayer" type="text/html" width="400px" height="200px"
    src="https://www.youtube.com/embed/<?php echo $value[0] ?>?rel=0&showinfo=0&color=white&iv_load_policy=3"
    frameborder="0" allowfullscreen></iframe> 
    <br>
    <a href="video.php?videoid=<?php echo $value['1']?>">See this video in big</a>
    <br>
    <p> Title : <?php echo $value[2] ?></p>
    
    
<?php endforeach ?>
</body>
</html>