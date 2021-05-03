<?php require_once 'function.php';
$pdo = connection(); 
$id = getid();
$detailsmembers = detailsmembers($pdo, $id);
$userlist = userlist($pdo)?>


<?php require_once 'inc/header.php' ?>



        <div class="userlist">
        <?php foreach($userlist as $ul) : ?>
        <div class="card">
            <img src="assets/img/men.jpg"
                class="card-img-top" alt="">
            <div class="card-body">
                <p class="card-text"><?= $ul['first_name'] ?> <?= $ul['last_name'] ?></p>
                <?php if(isset($ul['exp_amount'])) : ?>
                <p class="card-text">Dépense : <?= $ul['exp_amount'] ?></p>
                <?php endif ; ?>
                <?php if(isset($ul['inc_amount'])) : ?>
                <p class="card-text">Revenue : <?= $ul['inc_amount'] ?></p>
                <?php endif ; ?>
                <p class="card-text"><a href="detailsmember.php?id=<?= $ul['user_id'] ?>">Voir plus</a></p>
            </div>
        </div>
        <?php endforeach; ?>
        </div>
 

<?php require_once 'inc/footer.php' ?>