<?php require_once 'function.php' ;
$pdo = connection();
$id = getid();
$detailsmembers = detailsmembers($pdo, $id);
 ?>
<?php require_once 'inc/header.php' ?>

<article
  id="totalinc"
  data-number=<?= $detailsmembers[0]['totalinc'] ?>>
</article>
<article
  id="totalexp"
  data-number=<?= $detailsmembers[0]['totalexp'] ?>>
</article>

<div class="wrapper">
    <div class="container">
        <div class="title">
            <h2>Résumé de votre compte :</h2>
        </div>
        <div class="chart-wrapper">
            <canvas id="myChart"></canvas>
        </div>
    </div>
</div>

<?php require_once 'inc/footer.php' ?>