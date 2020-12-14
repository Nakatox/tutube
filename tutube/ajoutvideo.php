<?php
session_start();
$wrong = [];
$missingfields = "";
if (isset($_POST['title']) && !empty($_POST['title']) && isset($_POST['url']) &&!empty($_POST['url'])  && isset($_POST['description']) && !empty($_POST['description']) ) {
    
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
}else{
    $missingfields = "There is a empty field";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a video</title>
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
        margin:20px;
        padding:5px;
    }
</style>    
<body>
<?php require 'header.php'; ?>
    <form action="" method="POST">
   <p> Enter the video title :</p><input type="text" name = "title"> (Must be under 30 characters)
    <br>
    <p>His url :</p><input type="text" name="url">
    <br>
    <p>And his description :</p><textarea width="100px" height="50px" name = "description"></textarea>(Must be under 200 characters)
    <br>
    <input type="submit" value="Add the video" class="btn">
    </form>
    <br>
    <div class="row">
        <?php echo $missingfields ?>
    <?php foreach($wrong as $value):?>
        <p><?php echo $value . '<br/>' ?></p>
    <?php endforeach ?>
    </div>
</body>
</html>