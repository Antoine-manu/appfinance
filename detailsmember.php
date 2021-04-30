<?php require_once 'function.php' ;
$id = getid();
$pdo = connection();
$detailsmembers = detailsmembers($pdo, $id);


if (isset($_GET['user_id'])) {
  $user_id = (int) $_GET['user_id'];

  if (deletedepense($pdo, $user_id) && (deletedepense($pdo, $user_id) > 0)) {
      $success = true;
  }
}

?>
<?php require_once 'inc/header.php' ?>

<div class="container-fluid d-inline-flex">

<table class="table">
  <thead>
    <tr>
      <th scope="col">Dépense</th>
      <th scope="col">Montant</th>
      <th scope="col">Date</th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($detailsmembers as $dm) : ?>
  <tr>
      <th><?= $dm['exp_label'] ?></th>
      <td><?= $dm['exp_amount'] ?></td>
      <td><?= formatdate($dm['exp_date']);?></td>
      <td><a href="editdepense.php?id=<?=$id ?>&data=<?= $dm['exp_id'] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Editer"><i class="fas fa-edit"></i></a></td>
      <td ><a href="?user_id=<?= $dm['exp_id'] ?>&id=<?= $id?>" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Supprimer">
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
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($detailsmembers as $dm) : ?>
  <tr>
      <th><?= $dm['inc_cat_name']?></th>
      <td><?= $dm['inc_amount'] ?></td>
      <td><?= formatdate($dm['inc_receipt_date'])?></td>
      <td><a href="" data-bs-toggle="tooltip" data-bs-placement="top" title="Editer""><i class="fas fa-edit"></i></a></td>
      <td><a href="" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Supprimer"><i class="fas fa-trash-alt"></i></a></td>
    </tr>
<?php endforeach; ?>

  </tbody>
</table>




</div>
<button type="button" class="btn btn-primary "><a class="text-light" href="adddepense.php?id=<?= $id ?>">Ajouter une depense</a></button>
<?php require_once 'inc/footer.php' ?>