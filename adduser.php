<?php require_once 'function.php' ;

$id = getid();
$pdo = connection();
$detailsmembers = detailsmembers($pdo, $id);
$regexDate = '/\d{4}-\d{2}-\d{2}/';


if (!empty($_POST)) {

    // vérifie que le nom est bien renseigné
    if (empty($_POST['firstname'])) {
        $errors['firstname'] = 'Le champ est requis';
    }
    if (empty($_POST['name'])) {
        $errors['name'] = 'Le champ est requis';
    }
    if (empty($_POST['release_date'])) {
        $errors['release_date'] = 'Le champ est requis';
    }else if(!preg_match($regexDate, $_POST['release_date'])){
        $errors['release_date'] = 'La valeur renseignée est incorrecte !';
    }
    if (empty($errors)) {
        $first_name = htmlentities($_POST['firstname']);
        $last_name = htmlentities($_POST['name']);
        $release_date = htmlentities($_POST['release_date']);
        if (addUser($pdo, $first_name, $last_name, $release_date)) {
            $success = true;
        }
    }
}
$title = 'Ajouter un Utilisateur';
?>
<?php require_once 'inc/header.php' ?>

<div class="container">
        <?php if (isset($success)) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <p>Utilisateur créé avec succès !</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <div class="row justify-content-center">
            <div class="col-md-5 bg-light p-3">
                <form action="" method="post">
                    <div class="mb-3">
                        <label class="mb-3" for="name">Prénom de l'utilisateur</label>
                        <input name="name" class="form-control" id="name" type="text">
                        <p class="mb-0 text-danger"><?= $errors['title'] ?? '' ?></p>
                    </div>
                    <div class="mb-3">
                        <label class="mb-3" for="firstname">Nom de l'utilisateur</label>
                        <input name="firstname" class="form-control" id="firstname" type="text">
                        <p class="mb-0 text-danger"><?= $errors['title'] ?? '' ?></p>
                    </div>
                    <div class="mb-3">
                        <label class="mb-3" for="release_date">Date de naissance</label>
                        <input name="release_date" class="form-control" id="release_date" type="date">
                        <p class="mb-0 text-danger"><?= $errors['release_date'] ?? '' ?></p>
                    </div>
                    <input class="btn btn-primary" type="submit" value="Enregister">
                </form>
            </div>
        </div>
    </div>

<?php require_once 'inc/footer.php' ?>