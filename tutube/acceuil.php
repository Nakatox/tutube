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
<style>
    body{
        background-color: #a31c23;
    }
    .container{
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .container a{
        text-decoration: none;
        color: white;
        font-size: 20px;
        border: white solid 3px ;
        padding: 5px;
        border-radius: 20px;
    }
    .container{
        border:  white solid 3px;
    }
    .title {
        color: white;
        border-bottom: white solid 3px;
        padding-left: 500px;
        padding-right: 500px;
        padding-bottom: 10px;
        font-size: 40px;
    }
    body p{
        color: white;
        font-size: 20px;
    }
    .hello{
        text-align: center;
    }
</style>
<body>
<?php require 'header.php'; ?>
<?php if (isset($_SESSION['pseudo'])):?>
    <p class="hello">Hello <?php echo $_SESSION['pseudo'] ?> and welcome to <img src="logo.png" alt="" width="70px"></p>
<?php endif ?>

<div class="container">
    <?php foreach($tableau as $value): ?>

        <p class="title"> Title : <?php echo $value[2] ?></p>
        <br>
        <iframe id="ytplayer" type="text/html" width="600px" height="400px"
        src="https://www.youtube.com/embed/<?php echo $value[0] ?>?rel=0&showinfo=0&color=white&iv_load_policy=3"
        frameborder="0" allowfullscreen>
        </iframe> 
        <br>
        <?php if(isset($_SESSION['pseudo'])): ?>
            <a href="supr.php?videoid=<?php echo $value[1] ?>">Delete this video</a>
        <?php endif ?>
        <br>
        <a href="video.php?videoid=<?php echo $value['1']?>">See this video in big</a>
        <br>
        
    <?php endforeach ?>
</div>
</body>
</html>