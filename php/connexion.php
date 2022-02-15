<?php

include '../db_connect.php';

function connectDB() {
  global $name, $password;

  $servername = "127.0.0.1";
  $username = $name;
  $password = $password;
  $database = "restiloc";
  
  // Create connection
  $link_db = mysqli_connect($servername, $username, $password, $database);
  
  // Check connection
  if (!$link_db) {
    die("Connection failed: " . mysqli_connect_error());
  }

  return $link_db;
}

function closeDB($db)
{
  $db = null;
}

function insertDB($db, $nom, $prenom, $email) {
  $req = $db->prepare('INSERT INTO users (nom, prenom, email) VALUES (:nom, :prenom, :email)');
  $req->execute(array(
    'nom' => $nom,
    'prenom' => $prenom,
    'email' => $email
  ));
}

function selectDB($db) {
  $req = $db->prepare('SELECT * FROM users');
  $req->execute();
  return $req->fetchAll();
}

function deleteDB($db, $id) {
  $req = $db->prepare('DELETE FROM users WHERE id = :id');
  $req->execute(array(
    'id' => $id
  ));
}

function updateDB($db, $id, $nom, $prenom, $email) {
  $req = $db->prepare('UPDATE users SET nom = :nom, prenom = :prenom, email = :email WHERE id = :id');
  $req->execute(array(
    'id' => $id,
    'nom' => $nom,
    'prenom' => $prenom,
    'email' => $email
  ));
}

?>