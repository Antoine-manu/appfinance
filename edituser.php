<?php require_once 'function.php';
$pdo = connection(); 
$id = getid();
$detailsmembers = detailsmembers($pdo, $id);

if (!empty($_POST)) {

    // vérifie que le nom est bien renseigné
    if (empty($_POST['last_name'])) {
        $errors['last_name'] = 'Le champ est requis';
    }
    if (empty($_POST['first_name'])) {
        $errors['first_name'] = 'Le champ est requis';
    }

    if (empty($_POST['birth_date'])) {
        $errors['birth_date'] = 'Le champ est requis';
    }else if(!preg_match($regexDate, $_POST['birth_date'])){
        $errors['birth_date'] = 'La valeur renseignée est incorrecte !';
    }

    if (empty($errors)) {
        $user_id = (int) htmlentities($id);
        $first_name = htmlentities($_POST['first_name']);
        $birth_date = htmlentities($_POST['birth_date']);
        $last_name = htmlentities($_POST['last_name']);
        if (updateuser($pdo, $first_name, $last_name, $birth_date, $user_id)) {
            $success = true;
        }
    }
}


?>

<?php require_once 'inc/header.php' ?>

<div class="container">
        <?php if (isset($success)) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <p>Profil modifié avec succès !</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <div class="row justify-content-center">
            <div class="col-md-5 bg-light p-3">
                <form action="" method="post">
                    <div class="mb-3">
                        <label class="mb-3" for="first_name">Prénom</label>
                        <input name="first_name" class="form-control" id="first_name" type="text" value="<?= $detailsmembers[0]['last_name'] ?>">
                        <p class="mb-0 text-danger"><?= $errors['exp_label'] ?? '' ?></p>
                    </div>
                    <div class="mb-3">
                        <label class="mb-3" for="last_name">Nom</label>
                        <input name="last_name" class="form-control" id="last_name" type="text" value="<?= $detailsmembers[0]['first_name'] ?>">
                        <p class="mb-0 text-danger"><?= $errors['exp_date'] ?? '' ?></p>
                    </div>
                    <div class="mb-3">
                        <label class="mb-3" for="birth_date">Date de naissance</label>
                        <input name="birth_date" class="form-control" id="birth_date" type="date" value="<?= formatdate($detailsmembers[0]['birth_date']) ?>">
                        <p class="mb-0 text-danger"><?= $errors['birth_date'] ?? '' ?></p>
                    </div>
                    <input class="btn btn-dark" type="submit" value="Enregister">
                    <button type="button" class="btn btn-dark"><a href="userlist.php?id=<?=$id?>" class="text-light">Revenir a la gestion des utilisateurs</a></button>
                </form>
            </div>
        </div>
    </div>

<?php require_once 'inc/footer.php' ?>