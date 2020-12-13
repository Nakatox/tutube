<!-- - Un formulaire d’ajout de vidéo avec les champs titre, url et description -->
<?php
session_start();
$wrong = [];
if (isset($_POST['title']) && isset($_POST['url']) && isset($_POST['description'])) {
    
    $title = htmlspecialchars($_POST['title']);
    $url = htmlspecialchars($_POST['url']);
    $urlcheck = "^(https?\:\/\/)?(www\.)?(youtube\.com|youtu\.?be)\/.+$^";
    $description = htmlspecialchars($_POST['description']);
    
    if(preg_match($urlcheck, $url)){
        array_push($wrong,"");
    }else{
        array_push($wrong,"The url is not in a good format.");
    }
    if(strlen($title) >= 30){
        array_push($wrong,"The title is too long");
    }else{
        array_push($wrong,"");
    }
    if(strlen($description) >= 200){
      array_push($wrong,"The description is too long");
    }else{
        array_push($wrong,"");
    }
    
    if($wrong[0] == "" && $wrong[1] =="" && $wrong[2]=="") {
        
        try {
            $database = new PDO('mysql:host=localhost;dbname=tutube;charset=utf8', 'root', '');
        } catch (Exception $e) {
            die('error on db' . $e->getMessage());
        }
        
        $tab = $database->prepare('INSERT INTO `video`(`url`, `title`, `description`) VALUES (:url, :title, :description)');
        $tab->execute([
            'url' => $url,
            'title' => $title,
            'description' => $description,
            ]);
            
            
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a video</title>
</head>
<body>
<?php require 'header.php'; ?>
    <form action="" method="POST">
    Enter the video title :<input type="text" name = "title"> (Must be under 30 characters)
    <br>
    His url :<input type="text" name="url">
    <br>
    And his description :<textarea width="100px" height="50px" name = "description"></textarea>
    <br>
    <input type="submit" value="Add the video">
    </form>
    <br>
    <?php foreach($wrong as $value):?>
    <?php echo $value . '<br/>' ?>
    <?php endforeach ?>
</body>
</html>