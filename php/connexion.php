<?php

import_once('../db_connect.php');

function connectDB()
{
  try {
    $db = new PDO('mysql:host=10.0.128.127; dbname=restiloc; charset=utf8', $name, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion à la base de données réussie";
    return $db;
  } catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
  }
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