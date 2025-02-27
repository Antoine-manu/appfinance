<!doctype html>
<html lang="en" class="h-100">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <!-- Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" />

    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="../assets/css/style.css">

    <title>Hello, world!</title>
</head>

<body class="bg-light h-100">

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">App Finance</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link <?= active()=='backoffice' ? 'active' : '' ?>"
                            href="backoffice.php?id=<?=$id?>">Tableau
                            de bord <i class="fas fa-wallet "></i></a>
                        <a class="nav-link <?= active()=='adduser' ? 'active' : '' ?>"
                            href="adduser.php?id=<?=$id?>">Ajouter un
                            utilisateur <i class="fas fa-user-plus"></i></a>
                        <a class="nav-link <?= active()=='addrevenue' ? 'active' : '' ?>"
                            href="addrevenue.php?id=<?=$id?>">Déclarer
                            un revenu <i class="fas fa-piggy-bank"></i></a>
                        <a class="nav-link <?= active()=='adddepense' ? 'active' : '' ?>"
                            href="adddepense.php?id=<?=$id?>">Déclarer
                            une depense <i class="fas fa-donate"></i></a>
                        <a class="nav-link <?= active()=='userlist' ? 'active' : '' ?>"
                            href="userlist.php?id=<?=$id?>&actu=0">Voir les
                            utilisateurs <i class="fas fa-users"></i></a>
                    </div>
                    <?php if(isset($id)) :?>
                    <span class="navbar-text ms-auto">
                        <a href="selectuser.php?id=<?=$id?>"><i class="fas fa-sign-out-alt"></i></a>

                        <a href="detailsmember.php?id=<?=$id?>"><?= $detailsmembers['0']['first_name'] ?>
                            <?= $detailsmembers['0']['last_name'] ?><img
                                src="../assets/img/<?=$detailsmembers['0']['sexe'] ?>.png" class="rounded-circle ms-3"
                                alt="..." width="40rem" height="40rem"></a>
                    </span>
                    <?php endif ; ?>
                </div>
            </div>
        </nav>
    </header>

    <div class="container-fluid margin h-100">