<?php
  

  function connection(){
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=finance;charset=utf8', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    } catch (PDOException $e) {
        echo 'erreur';
        die();
    } 
    return $pdo;
  }


function userlist($pdo){
    $sql = "SELECT first_name, last_name, exp_amount, inc_amount, user_id FROM users JOIN expenses USING(user_id) JOIN incomes USING(user_id)";
    $req = $pdo->query($sql);
    $userlist = $req->fetchAll(PDO::FETCH_ASSOC);
    return $userlist;
}

function active(){
    return basename($_SERVER['SCRIPT_NAME'],'.php');
}



