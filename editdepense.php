<?php require_once 'function.php' ;
$id = getid();
$data = getdata();
$pdo = connection();
$detailsmembers = detailsmembers($pdo, $id);

$detailsmembers = detaildepense($pdo, $id, $data);
$detaildepense = geteditdepense($pdo, $id, $data);

if (!empty($_POST)) {

    // vérifie que le nom est bien renseigné
    if (empty($_POST['exp_label'])) {
        $errors['exp_label'] = 'Le champ est requis';
    }
    if (empty($_POST['exp_amount'])) {
        $errors['exp_amount'] = 'Le champ est requis';
    }

    if (empty($_POST['exp_date'])) {
        $errors['exp_date'] = 'Le champ est requis';
    }else if(!preg_match($regexDate, $_POST['exp_date'])){
        $errors['exp_date'] = 'La valeur renseignée est incorrecte !';
    }

    if (empty($errors)) {
        $exp_id = (int) htmlentities($data);
        $exp_label = htmlentities($_POST['exp_label']);
        $exp_date = htmlentities($_POST['exp_date']);
        $exp_amount = htmlentities($_POST['exp_amount']);
        if (updatedepense($pdo, $exp_label, $exp_date, $exp_id, $exp_amount)) {
            $success = true;
        }
    }
}

?>
<?php require_once 'inc/header.php' ?>

<div class="container">
        <?php if (isset($success)) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <p>Album modifié avec succès !</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <div class="row justify-content-center">
            <div class="col-md-5 bg-light p-3">
                <form action="" method="post">
                    <div class="mb-3">
                        <label class="mb-3" for="exp_label">Raison de la dépense</label>
                        <input name="exp_label" class="form-control" id="exp_label" type="text" value="<?= $detaildepense[0]['exp_label'] ?>">
                        <p class="mb-0 text-danger"><?= $errors['exp_label'] ?? '' ?></p>
                    </div>
                    <div class="mb-3">
                        <label class="mb-3" for="exp_date">Date de sortie</label>
                        <input name="exp_date" class="form-control" id="exp_date" type="date" value="<?= formatdate($detaildepense[0]['exp_date']) ?>">
                        <p class="mb-0 text-danger"><?= $errors['exp_date'] ?? '' ?></p>
                    </div>
                    <div class="mb-3">
                        <label class="mb-3" for="exp_amount">Montant de la dépense</label>
                        <input name="exp_amount" class="form-control" id="exp_amount" type="text" value="<?= $detaildepense[0]['exp_amount'] ?>">
                        <p class="mb-0 text-danger"><?= $errors['exp_amount'] ?? '' ?></p>
                    </div>
                    <input class="btn btn-primary" type="submit" value="Enregister">
                    <button type="button" class="btn btn-primary"><a href="detailsmember.php?id=<?=$id?>" class="text-light">Revenir a la gestion de dépenses</a></button>
                </form>
            </div>
        </div>
    </div>

<?php require_once 'inc/footer.php' ?>