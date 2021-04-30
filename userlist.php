<?php require_once 'function.php';
$pdo = connection(); 
$userlist = userlist($pdo)?>

<?php require_once 'inc/header.php' ?>



        <?php foreach($userlist as $ul) : ?>
        <div class="card" style="width: 18rem;">
            <img src="assets/img/men.jpg"
                class="card-img-top" alt="">
            <div class="card-body">
                <p class="card-text"><?= $ul['first_name'] ?> <?= $ul['last_name'] ?></p>
                <p class="card-text">Dépense : <?= $ul['exp_amount'] ?></p>
                <p class="card-text">Revenue : <?= $ul['inc_amount'] ?></p>
                <p class="card-text"><a href="detailsmember.php?id=<?= $ul['user_id'] ?>">Voir plus</a></p>
            </div>
        </div>
        <?php endforeach; ?>
 

<?php require_once 'inc/footer.php' ?>