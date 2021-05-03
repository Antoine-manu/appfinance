<?php require_once 'function.php' ;
$pdo = connection();
$id = getid();
$detailsmembers = detailsmembers($pdo, $id);
 ?>
<?php require_once 'inc/header.php' ?>



<?php require_once 'inc/footer.php' ?>