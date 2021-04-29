<?php
  try {
    $pdo = new PDO('mysql:host=localhost;dbname=finance;charset=utf8', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (PDOException $e) {
    echo 'erreur';
    die();
}

// $sql = "";
// $req = $pdo->query($sql);
// $finance = $req->fetchAll(PDO::FETCH_ASSOC);
