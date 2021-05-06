<?php require_once 'function.php' ;
$id = getid();
$pdo = connection();
$detailsmembers = detailsmembers($pdo, $id);


if (isset($_GET['exp_id'])) {
  $user_id = (int) $_GET['user_id'];
  $deletedepense = deletedepense($pdo, $user_id);
  if ($deletedepense && ($deletedepense > 0)) {
      $success = true;
  }
}
if (isset($_GET['inc_id'])) {
  $user_id = (int) $_GET['inc_id'];
  $deletedepense = deleterevenu($pdo, $user_id);
  if ($deletedepense && ($deletedepense > 0)) {
      $success = true;
  }
}
$revenue = getrevenue($pdo, $id);
$depense = getdepense($pdo, $id);
?>
<?php require_once 'inc/header.php' ?>

    <?php if (isset($success)) : ?> 
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <p>La suppression a été effectuée avec succès !</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

<div class="container-fluid d-inline-flex">

  
<table class="table">
  <thead>
    <tr>
      <th scope="col">Dépense</th>
      <th scope="col">Montant</th>
      <th scope="col">Date</th>
      <th scope="col"></th>
      <th scope="col"><a class="text-dark" href="adddepense.php?id=<?= $id ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ajouter une dépense"><i class="fas fa-plus"></i></a></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($depense as $dm) : ?>
  <tr>
      <th><?= $dm['exp_label'] ?></th>
      <td><?= $dm['exp_amount'] ?></td>
      <td><?= formatdate($dm['exp_date']);?></td>
      <td><a href="editdepense.php?id=<?=$id ?>&data=<?= $dm['exp_id'] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Editer"><i class="fas fa-edit"></i></a></td>
      <td ><a href="?exp_id=<?= $dm['exp_id'] ?>&id=<?= $id?>" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Supprimer">
      <i class="fas fa-trash-alt" ></i></a>
      </td>
    </tr>
<?php endforeach; ?>

  </tbody>
</table>

<table class="table">
  <thead>
    <tr>
      <th scope="col">Rentrée</th>
      <th scope="col">Montant</th>
      <th scope="col">Date</th>
      <th scope="col"></th>
      <th scope="col"><a class="text-dark" href="addrevenue.php?id=<?= $id ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ajouter un revenu"><i class="fas fa-plus"></i></a></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($revenue as $dm) : ?>
  <tr>
      <th><?= $dm['inc_cat_name']?></th>
      <td><?= $dm['inc_amount'] ?></td>
      <td><?= formatdate($dm['inc_receipt_date'])?></td>
      <td><a href="editrevenu.php?id=<?=$id ?>&data=<?= $dm['inc_id'] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Editer""><i class="fas fa-edit"></i></a></td>
      <td><a href="?inc_id=<?= $dm['inc_id'] ?>&id=<?= $id?>" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Supprimer"><i class="fas fa-trash-alt"></i></a></td>
    </tr>
<?php endforeach; ?>

  </tbody>
</table>




</div>
<?php require_once 'inc/footer.php' ?>