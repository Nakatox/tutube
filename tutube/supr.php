<?php

$id = $_GET['videoid'];

try {
    $database = new PDO('mysql:host=localhost;dbname=tutube;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('error on db' . $e->getMessage());
}

$tab = $database->prepare('DELETE FROM `video` WHERE id LIKE :id');
$tab->execute([
    'id' => $id,
]);

header('Location:acceuil.php');

?>
