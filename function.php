<?php
  
  $regexDate = '/\d{4}-\d{2}-\d{2}/';

  function connection(){
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=finance;charset=utf8', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    } catch (PDOException $e) {
        echo 'erreur';
        die();
    } 
    return $pdo;
  }


function getid(){
    $id = $_GET['id'];
    return $id;
}
function getdata(){
    $data = $_GET['data'];
    return $data;
}

function userlist($pdo){
    $sql = "SELECT DISTINCT first_name, last_name, exp_amount, inc_amount, user_id FROM users JOIN expenses USING(user_id) JOIN incomes USING(user_id)";
    $req = $pdo->query($sql);
    $userlist = $req->fetchAll(PDO::FETCH_ASSOC);
    return $userlist;
}

function detailsmembers($pdo, $id){
    $sql = "SELECT
    first_name,
    last_name,
    exp_amount,
    exp_date,
    exp_label,
    exp_id,
    inc_amount,
    inc_receipt_date,
    inc_cat_name,
    inc_id,
    user_id
FROM
    users
JOIN expenses USING(user_id)
JOIN incomes USING(user_id)
JOIN incomes_categories USING(inc_cat_id)
 WHERE user_id = $id";

    $req = $pdo->query($sql);
    $detailsmembers = $req->fetchAll(PDO::FETCH_ASSOC);
    return $detailsmembers;
}

function detaildepense($pdo, $id, $data){
    $sql = "SELECT
    first_name,
    last_name,
    exp_amount,
    exp_date,
    exp_label,
    exp_id,
    user_id
FROM
    users
JOIN expenses USING(user_id)
 WHERE user_id = $id
 AND exp_id = $data";

    $req = $pdo->query($sql);
    $detailsdepense = $req->fetchAll(PDO::FETCH_ASSOC);
    return $detailsdepense;
}

function active(){
    return basename($_SERVER['SCRIPT_NAME'],'.php');
}
function formatdate($date){
    $dateformat = date_create($date);
    $dateformating = date_format($dateformat, 'Y-m-d');
    return $dateformating;
}

function updatedepense($pdo, $exp_label, $exp_date, $exp_id, $exp_amount){
    $sql = "UPDATE expenses SET `exp_label` = :exp_label, `exp_date` = :exp_date, `exp_amount` = :exp_amount WHERE `exp_id` = :exp_id";

    $req = $pdo->prepare($sql);
    // lier la variable sql avec une valeur php
    $req->bindValue(':exp_label', $exp_label, PDO::PARAM_STR);
    // lier la variable sql avec une valeur php
    $req->bindValue(':exp_date', $exp_date, PDO::PARAM_STR);
    $req->bindValue(':exp_id', $exp_id, PDO::PARAM_INT);
    $req->bindValue(':exp_amount', $exp_amount, PDO::PARAM_INT);

    try {
        // exécuter la requête
        $req->execute();
        // renvoie le nombre d'enregistrement créé.
        return $req->rowCount();
    }catch(PDOException $e){
        return false;
    }
}

function adddepense($pdo, $exp_amount, $exp_date, $exp_label, $id){
    $sql = "INSERT INTO `expenses`(`exp_label`,`exp_date`,`exp_amount`,`user_id`) VALUES (:exp_label, :exp_date, :exp_amount, $id)";

    $req = $pdo->prepare($sql);
    // lier la variable sql avec une valeur php
    $req->bindValue(':exp_label', $exp_label, PDO::PARAM_STR);
    $req->bindValue(':exp_amount', $exp_amount, PDO::PARAM_STR);
    $req->bindValue(':exp_date', $exp_date, PDO::PARAM_STR);

    try {
        // exécuter la requête
        $req->execute();
        // renvoie le nombre d'enregistrement créé.
        return $req->rowCount();
    }catch(PDOException $e){
        var_dump($e->getMessage());
        return false;
    }
}

function deletedepense($pdo, $id){
    $sql = "DELETE FROM `expenses` WHERE `exp_id` = :`user_id`";

    $req = $pdo->prepare($sql);

    $req->bindValue(':user_id', $id, PDO::PARAM_INT);

    try {
        // exécuter la requête
        $req->execute();
        // renvoie le nombre d'enregistrement créé.
        return $req->rowCount();
        
    }catch(PDOException $e){
        return false;
    }
}
