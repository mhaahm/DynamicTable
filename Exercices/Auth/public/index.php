<?php
require "../vendor/autoload.php";
$pdo = \App\App::getPdo();
$users = $pdo->query("select * from users")->fetchAll();
$auth = new \App\Auth($pdo);
$user = $auth->user();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body class="p-4">
<h1>Accèder aux pages</h1>
<?php if(isset($_GET['login'])):?>
  <div class="alert alert-success">Vous ête bien identifié</div>
<?php endif; ?>
<?php if($user): ?>
  <p>
      Vous ête connecté en tant que <?= $user->username ?>
       <a href="logout.php">Se Déconnecter</a>
  </p>
<?php else: ?>
    <p><a href="login.php">Se connecter</a></p>
<?php endif ?>
<?php if(isset($_GET['forbiden'])): ?>
    <div class="alert alert-danger">
        Accèes interdi a la page 
    </div>
<?php endif; ?>

<ul>
    <li><a href="admin.php">Page réservée à l'administrateur</a></li>
    <li><a href="user.php">Page réservée à l'utilisateur</a></li>
</ul>

<table class="table table-striped">
    <thead>
    <tr>
        <th>ID</th>
        <th>Pseudo</th>
        <th>Role</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($users as $user): ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= $user['username'] ?></td>
            <td><?= $user['role'] ?></td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
</body>
</html>
