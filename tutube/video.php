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
<body>
<?php require 'header.php'; ?>
<iframe id="ytplayer" type="text/html" width="800px" height="400px"
    src="https://www.youtube.com/embed/<?php echo $id ?>?rel=0&showinfo=0&color=white&iv_load_policy=3"
    frameborder="0" allowfullscreen></iframe> 
    <?php if(isset($_SESSION['pseudo'])): ?>
    <a href="supr.php?videoid=<?php echo $videos['id'] ?>">Delete this video</a>
    <?php endif; ?>
    <?php echo $videos['title'] ?>
    <?php echo $videos['description'] ?>
    <?php if(isset($_SESSION['pseudo'])): ?>

    <form action="" method="POST">
        Edit the informations 
        <br>
        Title : <input type="text" value="<?php echo $videos['title'] ?>" name="title">
        <br>
        Url : <input type="text" value="<?php echo $videos['url'] ?>" name="url">
        <br>
        Description : <input type="text" value="<?php echo $videos['description'] ?>" name="description">
        <br>
        <input type="submit" value="Edit">
    </form>
    <?php endif ?>
</body>
</html>
