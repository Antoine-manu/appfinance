<?php require_once 'function.php'; 

$id = getid();
$pdo = connection(); 
$error = false;
$detailsmembers = detailsmembers($pdo, $id);
// Le formulaire a été soumis
if (!empty($_POST)) {

    // vérifie que le nom est bien renseigné
    if (empty($_POST['exp_label'])) {
        $error = true;
    }
    if (empty($_POST['exp_amount'])) {
        $error = true;
    }
    if (empty($_POST['exp_date'])) {
        $errors['exp_date'] = 'Le champ est requis';
    }else if(!preg_match($regexDate, $_POST['exp_date'])){
        $errors['exp_date'] = 'La valeur renseignée est incorrecte !';
    }

    if (!$error) {
        $exp_label = htmlentities($_POST['exp_label']);
        $exp_date = htmlentities($_POST['exp_date']);
        $exp_amount = (int) htmlentities($_POST['exp_amount']);
        if (adddepense($pdo, $exp_amount, $exp_date, $exp_label, $id)) {
            $success = true;
        }
    }
}
?>
<?php require_once 'inc/header.php' ?>

<div class="container">
        <?php if (isset($success)) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <p>Dépense créé avec succès !</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        
        <div class="row justify-content-center text-light">
            <div class="col-md-5  p-3">
            <h2>Declarer une dépense</h2>
                <form action="" method="post">
                    <div class="mb-3">
                        <label class="mb-3" for="exp_label">Dépense :</label>
                        <input name="exp_label" class="form-control" placeholder="Raison de la depense" id="exp_label" type="text">
                        <p class="mb-0 text-danger"><?= $error ? 'Le champ est requis' : '' ?></p>
                    </div>
                    <div class="mb-3">
                        <label class="mb-3" for="exp_amount">Montant :</label>
                        <input name="exp_amount" class="form-control" placeholder="Montant de la depense" id="exp_amount" type="text">
                        <p class="mb-0 text-danger"><?= $error ? 'Le champ est requis' : '' ?></p>
                    </div>
                    <div class="mb-3">
                        <label class="mb-3" for="exp_date">Date :</label>
                        <input name="exp_date" class="form-control" id="exp_date" type="date">
                        <p class="mb-0 text-danger"><?= $error ? 'Le champ est requis' : '' ?></p>
                    </div>
                    <input class="btn btn-dark text-center" type="submit" value="Enregister">
                </form>
            </div>
            <div class="col-md-5">
                <img src="assets/img/undraw_Bitcoin_P2P_re_1xqa.svg" alt="">
            </div>
        </div>
    </div>

<?php require_once 'inc/footer.php' ?>