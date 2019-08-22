<?php
require "../vendor/autoload.php";
use App\{TableHelper,UrlHelper};
define('PER_PAGE',20);
$pdo = new PDO("sqlite:../../db/products.db",null,null,[
    PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

$orderBy = '';
if(isset($_GET['sort'])) {
    $orderBy = " order by ".$_GET['sort']." ".$_GET['dir'];
}

$sql = "select * from products ";
$queryCount = "select count(id) as countProduct from products ";
$search = (isset($_GET['city_search']) and !empty($_GET['city_search']));
$params = [];
if ($search){
    $sql.=" where city like :city_data";
    $queryCount.=" where city like :city_data";
    $params['city_data'] = "%".$_GET['city_search']."%";
}
$sql.= $orderBy;

// pagination
$page = (int)($_GET['page'] ?? 1);

$stmt = $pdo->prepare($queryCount);
$stmt->execute($params);
$count = (int)$stmt->fetch()['countProduct'];
$pages = (int)ceil($count/PER_PAGE);



$offset = ($page -1)*PER_PAGE ;
$sql.=" limit ".PER_PAGE." offset $offset";
//dd($sql);
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$products = $stmt->fetchAll();

//dd($pages);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Liste des bien imobilier</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body class="m-4">
    <h3>Liste des biens immobilier</h3><br><br>

        <form method="get" class="mb-4">
            <div class="form-group ">
                  <input type="text" class="form-control" placeholder="enter city" name="city_search" value="<?= htmlentities($_GET['city_search'] ??'') ?>"/>
            </div>
            <button class="btn btn-primary">Search</button>
        </form>
        <table class="table table-striped">
            <?php
                $tableCols = ['id','name','price','address','city'];
            ?>
            <thead>
              <tr>
                  <?php foreach ($tableCols as $col): ?>
                        <?php $dir = (isset($_GET['dir']) and $_GET['dir'] == 'asc' and (isset($_GET['sort']) and $_GET['sort'] == $col))?'desc':'asc';?>
                        <?= TableHelper::getHr($col,$dir,$_GET) ?>
                  <?php endforeach; ?>
              </tr>
            </thead>
            <tbody>
             <?php foreach ($products as $product) { ?>
                 <tr>
                     <td scope="col">#<?= $product['id'] ?></td>
                     <td  scope="col"><?= $product['name'] ?>  </td>
                     <td  scope="col"><?= TableHelper::price($product['price']) ?> </td>
                     <td  scope="col"><?= $product['address'] ?></td>
                     <td  scope="col"><?= $product['city'] ?>  </td>
                 </tr>
            <?php } ?>
            </tbody>
        </table>
        <?php  if($pages >1):  ?>
             <a href="?<?= UrlHelper::withParam(['page' => $page + 1 > $pages ? $page : $page + 1])?>" class="btn btn-primary">Page Suivante </a>
        <?php endif ?>

        <?php  if($page >1):  ?>
            <a href="?<?= UrlHelper::withParam(['page' => $page - 1 < 1 ? 1 : $page - 1])?>" class="btn btn-primary">Page Précédente </a>
        <?php endif ?>
</body>
</html>
