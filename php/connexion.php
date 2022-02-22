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
  try {
    $key = array_keys($_POST);
    $val = array_values($_POST);
    $sql =
      "INSERT INTO $table (" .
      implode(", ", $key) .
      ") " .
      "VALUES ('" .
      implode("', '", $val) .
      "')";

    $req = $db->prepare($sql);

    // $req->debugDumpParams();

    $req->execute();
  } catch (Exception $e) {
    print $e->getMessage();
  }
}

function selectDB($db, $table)
{
  try {
    $key = array_keys($_POST);
    $val = array_values($_POST);

    $sql =
      "SELECT * FROM $table WHERE prenom_client='" .
      $_POST["prenom_client"] .
      "' ORDER BY prenom_client ASC";

    echo $sql;

    $req = $db->prepare($sql);

    $req->execute();
  } catch (Exception $e) {
    print $e->getMessage();
  }

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

function displayResult($results)
{
  $counter = 0;

  echo "<div class='grid grid-cols-4 gap-4 w-full'>";
  foreach ($results as $result) {
    echo "<button class='my-10 border-2 rounded-xl border-slate-800 shadow-lg px-5 py-4 hover:scale-105 hover:shadow-lg hover:duration-300 col-span-1'>";
    echo "<a href='./show-folder.php?id=" . $counter . "'>";
    echo "<h2>Client :</h2>";
    echo "<p>";
    echo "Prénom : " . $result["prenom_client"] . "<br/>";
    echo "Nom : " . $result["nom_client"] . "<br/>";
    echo "</p>";
    echo "</a>";
    echo "</button>";
    $counter++;
  }
  echo "</div>";
}

function displayClient()
{
  echo "Prénom : " . $_SESSION["displayClient"][$_GET["id"]][2] . "<br/>";
  echo "Nom : " . $_SESSION["displayClient"][$_GET["id"]][1] . "<br/>";
  echo "Date de naissance : " .
    $_SESSION["displayClient"][$_GET["id"]][9] .
    "<br/>";
  echo "Rue : " . $_SESSION["displayClient"][$_GET["id"]][3] . "<br/>";
  echo "Ville : " . $_SESSION["displayClient"][$_GET["id"]][4] . "<br/>";
  echo "Code postal : " . $_SESSION["displayClient"][$_GET["id"]][5] . "<br/>";
  echo "Téléphone : +33 " .
    $_SESSION["displayClient"][$_GET["id"]][6] .
    "<br/>";
  echo "Portable : +33 " . $_SESSION["displayClient"][$_GET["id"]][7] . "<br/>";
  echo "Email : " . $_SESSION["displayClient"][$_GET["id"]][8] . "<br/>";
}

function createClientFolder()
{
}

?>
