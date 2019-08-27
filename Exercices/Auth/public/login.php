<?php
require "../vendor/autoload.php";
use App\Auth;
require "../vendor/autoload.php";
$pdo = \App\App::getPdo();
$auth = new Auth($pdo);
$connected_user = $auth->user();
if($connected_user) {
    header('Location:index.php');
    exit();
}

if(!empty($_POST)) {
    $error = false;

    $user = $auth->login($_POST['username'],$_POST['password']);
    if($user) {
        header('Location:index.php?login=1');
        exit();
    } else {
        $error = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body class="p-4">

<form method="post">
    <div class="container">
        <?php if(isset($error) and $error):?>
          <div class="alert alert-danger">Identifiant ou mot de passe incorrecte</div>
        <?php endif ?>
        <h1>Login</h1>
        <div class="form-group">
            <label class="col-form-label">Login</label>
            <input type="text" class="form-control" name="username"/>
        </div>
        <div class="form-group">
            <label class="col-form-label">Password</label>
            <input type="password" class="form-control" name="password"/>
        </div>
        <button class="btn btn-success">Login</button>
    </div>
</form>

</body>
</html>
