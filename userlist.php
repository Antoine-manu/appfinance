<?php require_once 'function.php';
$actu = $_GET['actu'] ?? 0;
$pdo = connection(); 
$id = getid();
$detailsmembers = detailsmembers($pdo, $id);
$userlist = userlist($pdo, $actu)?>


<?php require_once 'inc/header.php' ?>



        <div class="userlist">
        <?php foreach($userlist as $ul) : ?>
        <div class="card col-12">
            <img src="assets/img/<?=$ul['sexe'] ?>.png"
                class="card-img-top" alt="">
            <div class="card-body">
                <p class="card-text"><?= $ul['first_name'] ?> <?= $ul['last_name'] ?></p>
                <?php if(isset($ul['exp_amount'])) : ?>
                <p class="card-text">Dépense : <?= $ul['exp_amount'] ?></p>
                <?php endif ; ?>
                <?php if(isset($ul['inc_amount'])) : ?>
                <p class="card-text">Revenue : <?= $ul['inc_amount'] ?></p>
                <?php endif ; ?>
                <a class="card-link" href="detailsmember.php?id=<?= $ul['user_id'] ?>">Voir plus</a>
                <a class="card-link" href="edituser?id=<?= $ul['user_id'] ?>"><i class="far fa-edit"></i></a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    
<nav aria-label="Page navigation example" class="float-end">
  <ul class="pagination">
  <?php if($actu>0 ){?>
    <li class="page-item" <?= $actu==0?'disabled':'' ?>"><a class="page-link text-light" href="userlist.php?id=<?=$id ?>&actu=<?php echo $actu - 5 ?>"><i class="fas fa-chevron-left"></i></a></li>
    <?php } ?>
    <li class="page-item"><a class="page-link text-light" href="#"><?php echo $actu/5 ?></a></li>
    <li class="page-item"><a class="text-light page-link" href="userlist.php?id=<?=$id ?>&actu=<?php echo $actu + 5 ?>"><i class="fas fa-chevron-right"></i></a></li>
  </ul>
</nav>

<?php require_once 'inc/footer.php' ?>