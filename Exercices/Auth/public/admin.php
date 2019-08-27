<?php
require "../vendor/autoload.php";
$pdo = \App\App::getPdo();

$auth = new \App\Auth($pdo);
$user = $auth->user();

if(!$user or $user->role != 'admin') {
    header('Location:index.php?forbiden=1');
}
?>
Réservé à l'admin