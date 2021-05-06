<?php require_once 'function.php';
$pdo = connection(); 
$userlist = userlist($pdo)?>

<!doctype html>
<html lang="en">

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

<body class="bg-dark">
    
<div class="container-fluid ">

    <h2 class="text-center text-light">Qui est-ce ?</h2>

        <div class="userlist text-center ">
        <?php foreach($userlist as $ul) : ?>
        <div class="card bg-dark" >
            <img src="assets/img/<?= $ul['sexe']?>.png"
                class="card-img-top" alt="">
            <div class="card-body text-light">
                <p class="card-text"><?= $ul['first_name'] ?> <?= $ul['last_name'] ?></p>
                <p class="card-text"><a href="backoffice?id=<?= $ul['user_id'] ?>">Choisir cet utilisateur</a></p>
            </div>
        </div>
        <?php endforeach; ?>
        </div>
 

<?php require_once 'inc/footer.php' ?>