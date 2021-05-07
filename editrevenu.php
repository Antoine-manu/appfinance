<?php require_once 'function.php' ;
$id = getid();
$data = getdata();
$pdo = connection();
$categorie = categorie($pdo);
$detailsmembers = detailsmembers($pdo, $id);
$detaildepense = geteditrevenu($pdo, $id, $data);
if (!empty($_POST)) {

    // vérifie que le nom est bien renseigné
    if (empty($_POST['inc_cat_id'])) {
        $errors['inc_cat_id'] = 'Le champ est requis';
    }
    if (empty($_POST['inc_amount'])) {
        $errors['inc_amount'] = 'Le champ est requis';
    }

    if (empty($_POST['inc_receipt_date'])) {
        $errors['inc_receipt_date'] = 'Le champ est requis';
    }else if(!preg_match($regexDate, $_POST['inc_receipt_date'])){
        $errors['inc_receipt_date'] = 'La valeur renseignée est incorrecte !';
    }

    if (empty($errors)) {
        $inc_id = (int) htmlentities($data);
        $inc_cat_id = htmlentities($_POST['inc_cat_id']);
        $inc_receipt_date = htmlentities($_POST['inc_receipt_date']);
        $inc_amount = htmlentities($_POST['inc_amount']);
        if (updaterevenu($pdo, $inc_cat_id, $inc_receipt_date, $inc_id, $inc_amount)) {
            $success = true;
        }
    }
}

?>
<?php require_once 'inc/header.php' ?>

<div class="container">
    <?php if (isset($success)) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <p>Revenu modifié avec succès !</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>
    <div class="row justify-content-center">
        <div class="col-md-5 bg-light p-3">
            <form action="" method="post">
            <div class="mb-3">
                        <label class="mb-3" for="inc_cat_id">Rentrée:</label>
                        <select class="form-select" name="inc_cat_id" id="inc_cat_id">
                            <?php foreach($categorie as $dm) : ?>
                            <option value="<?= $dm['inc_cat_id'] ?>"><?= $dm['inc_cat_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <p class="mb-0 text-danger"><?= $errors['artist_id'] ?? '' ?></p>
                    </div>
                <div class="mb-3">
                    <label class="mb-3" for="inc_receipt_date">Date de sortie</label>
                    <input name="inc_receipt_date" class="form-control" id="inc_receipt_date" type="date"
                        value="<?= formatdate($detaildepense[0]['inc_receipt_date']) ?>">
                    <p class="mb-0 text-danger"><?= $errors['inc_receipt_date'] ?? '' ?></p>
                </div>
                <div class="mb-3">
                    <label class="mb-3" for="inc_amount">Montant de la rentrée</label>
                    <input name="inc_amount" class="form-control" id="inc_amount" type="text"
                        value="<?= $detaildepense[0]['inc_amount'] ?>">
                    <p class="mb-0 text-danger"><?= $errors['inc_amount'] ?? '' ?></p>
                </div>
                <input class="btn btn-dark" type="submit" value="Enregister">
                <button type="button" class="btn btn-dark"><a href="detailsmember.php?id=<?=$id?>"
                        class="text-light">Revenir a la gestion de dépenses</a></button>
            </form>
        </div>
    </div>
</div>

<?php require_once 'inc/footer.php' ?>