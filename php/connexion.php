<?php

include "../db_connect.php";

function connectDB()
{
  global $name, $password;

  $servername = "127.0.0.1";
  $username = $name;
  $password = $password;
  $database = "restiloc";
  $conn = null;

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
    // Remove the last value of the array that indicate the table name
    if ($_POST["table"] !== "Create") {
      $array = array_slice($_POST, 0, -2);
    }
    else {
      $array = array_slice($_POST, 0, -1);
    }

    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    echo "<pre>";
    print_r($array);
    echo "</pre>";

    $key = array_keys($array);
    $val = array_values($array);
    $sql =
      "INSERT INTO $table (" .
      implode(", ", $key) .
      ") " .
      "VALUES ('" .
      implode("', '", $val) .
      "')";

    $req = $db->prepare($sql);

    $req->debugDumpParams();

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

function selectAllCars($db, $table)
{
  try {
    $sql = "SELECT * FROM $table ORDER BY nom_modele ASC";

    // echo $sql;

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

  echo "<div class='grid grid-cols-3 gap-4 w-full'>";
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

function displayCreateFolder()
{
  ?>
    <div class="gap-4">
      <form action="<?php echo htmlspecialchars(
        $_SERVER["PHP_SELF"]
      ); ?>" method="post" class="flex flex-row w-full items-center gap-5">
        <input type="hidden" name="clientFolder" value="true" />
        <input type="submit" value="Créer un dossier" class="px-5 py-4 bg-slate-700 text-white rounded-xl text-xl max-w-lg hover:bg-slate-800 duration-300"/>
      </form>
    </div>
  <?php
}

function createClientFolder()
{
  ?>
    <div class="flex flex-row gap-4">
      <h2>Information du dossier</h2>
      <form action="<?php echo htmlspecialchars(
        $_SERVER["PHP_SELF"]
      ); ?>" method="post" class="flex flex-row w-full items-center gap-5">
        <label for="ref">
          <span>Reférence du dossier</span>
          <input type="ref" name="ref_dossier" id="ref" class="text-input"
          value="aaaaa" disabled>
        </label>
        <label for="date">
          <span>Date de création</span>
          <input type="date" name="date_naissance_client" id="date" class="text-input"
          pattern="[0-31]{2}/[0-12]{2}/[1000-3000]{2}"
          required
          value="<?php echo date("Y-m-d"); ?>">
        </label>
        <label for="address">
          <span>Choix du véhicule</span>
          <select id="cars" name="cars">
          <?php
          $db = connectDB();
          $cars = selectAllCars($db, "vehicule");
          closeDB($db);
          foreach ($cars as $car) {
            echo "<option>" . $car["nom_modele"] . "</option>";
          }?>
          </select>
        </label>
        <input type="submit" value="Créer le dossier" class="px-5 py-4 bg-slate-700 text-white rounded-xl text-xl max-w-lg hover:bg-slate-800 duration-300"/>
      </form>
    </div>
  <?php
}

function displayClientFolder()
{
}

?>
