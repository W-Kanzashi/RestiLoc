<?php

include "../db_connect.php";

function connectDB()
{
  global $name, $password;

  $servername = "127.0.0.1";
  $username = $name;
  $password = $password;
  $database = "restiloc";

  try {
    $conn = new PDO(
      "mysql:host=$servername;dbname=$database",
      $username,
      $password
    );
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully<br/>";
  } catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }

  return $conn;
}

function closeDB($db)
{
  $db = null;
}

function insertDB($db, $table)
{
  $sql =
    "INSERT INTO " .
    $table .
    " (champ1, champ2, champ3, champ4, champ5, champ6, champ7, champ8, champ9) VALUES (:v1, :v2, :v3, :v4, :v5, :v6, :v7, :v8, :v9)";

  $req = $db->prepare($sql);

  try {
    for ($i = 1; $i < 10; $i++) {
      $req->bindParam(":v" . $i, $_POST["champ" . $i]);

      echo "<pre>" . var_dump($_POST["champ" . $i]) . "</pre>";
    }
    $req->debugDumpParams();

    $req->execute();
  } catch (Exception $e) {
    print $e->getMessage();
  }
}

function selectDB($db)
{
  $req = $db->prepare("SELECT * FROM users");
  $req->execute();
  return $req->fetchAll();
}

function deleteDB($db, $id)
{
  $req = $db->prepare("DELETE FROM users WHERE id = :id");
  $req->execute([
    "id" => $id,
  ]);
}

function updateDB($db, $id, $nom, $prenom, $email)
{
  $req = $db->prepare(
    "UPDATE users SET nom = :nom, prenom = :prenom, email = :email WHERE id = :id"
  );
  $req->execute([
    "id" => $id,
    "nom" => $nom,
    "prenom" => $prenom,
    "email" => $email,
  ]);
}

?>
