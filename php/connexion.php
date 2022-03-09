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
    if ($_POST["table"] !== "create") {
      $array = array_slice($_POST, 0, -2);
    } else {
      $array = array_slice($_POST, 0, -1);
    }

    var_dump($_POST);
    var_dump($array);

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

    $key = array_slice($key, 0, -1);
    $val = array_slice($val, 0, -2);

    // Build the sql request
    $sql = "SELECT * FROM $table ";

    if ($table === "client") {
      $sql .= "WHERE ";
      if ($key[0] === "num_dossier" && $val[0] !== "") {
        $sql .= "num_dossier = '" . $val[0] . "'";
      }
      if ($key[1] === "immatriculation" && $val[1] !== "") {
        $sql .= "immatriculation = '" . $val[1] . "'";
      }
      if ($key[2] === "nom_client" && $val[2] !== "") {
        $sql .= "nom_client = '" . $val[2] . "'";
      }
      if ($key[3] === "prenom_client" && $val[3] !== "") {
        $sql .= "prenom_client = '" . $val[3] . "'";
      }
      $sql .= " ORDER BY prenom_client ASC";
    }

    if ($table === "dossier") {
      // SELECT * FROM dossier
      // JOIN vehicule ON vehicule.id_vehicule=dossier.id_vehicule
      // JOIN expert ON expert.id_vehicule=dossier.id_expert
      // WHERE id_client=?
      $sql .= "JOIN vehicule ON vehicule.id_vehicule=dossier.id_vehicule ";
      $sql .=
        "WHERE id_client=" .
        $_SESSION["displayClient"][$_GET["id"]]["id_client"];
    }

    // Request database
    $req = $db->prepare($sql);

    $req->execute();
  } catch (Exception $e) {
    print $e->getMessage();
    return null;
  }

  return $req->fetchAll();
}

function selectAllCars($db, $table)
{
  try {
    $sql = "SELECT * FROM $table ORDER BY nom_modele ASC";

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
    echo "<h2 class='text-lg font-bold'>Client</h2>";
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

  $db = connectDB();
  $_SESSION["clientFolder"] = selectDB($db, "dossier");
  closeDB($db);
}

function displayCreateFolder()
{
  ?>
    <div class="gap-4">
      <form action="<?php echo htmlspecialchars(
        $_SERVER["PHP_SELF"] . "?id=" . $_GET["id"]
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
    <div class="bg-slate-200 px-5 py-4">
      <h2 class="text-xl font-bold">Information du dossier</h2>
      <div class="flex flex-row gap-4">
        <form action="<?php echo htmlspecialchars(
          $_SERVER["PHP_SELF"] . "?id=" . $_GET["id"]
        ); ?>" method="post" class="flex flex-row w-full items-center gap-5">
          <label for="ref">
            <span>Reférence du dossier</span>
            <input type="text" name="ref_dossier" id="ref" class="text-input"
            value="<?php echo $_SESSION["displayClient"][$_GET["id"]][
              "prenom_client"
            ] . $_GET["id"]; ?>">
          </label>
          <label for="date">
            <span>Date de création</span>
            <input type="date" name="date_creation_dossier" id="date" class="text-input"
            pattern="[0-31]{2}/[0-12]{2}/[1000-3000]{2}"
            required
            value="<?php echo date("Y-m-d"); ?>">
          </label>
          <label for="address">
            <span>Choix du véhicule</span>
            <select id="cars" name="id_vehicule" class="text-input">
            <?php
            $db = connectDB();
            $cars = selectAllCars($db, "vehicule");
            closeDB($db);
            foreach ($cars as $car) {
              echo "<option value=" .
                $car["id_vehicule"] .
                ">" .
                $car["nom_modele"] .
                "</option>";
            }
            ?>
            </select>
          </label>
          <input type="hidden" name="id_client" value="<?php echo $_SESSION[
            "displayClient"
          ][$_GET["id"]]["id_client"]; ?>">
          <input type="hidden" name="nom_fichier_expertise" value="<?php echo $_SESSION[
            "displayClient"
          ][$_GET["id"]]["prenom_client"] . $_GET["id"]; ?>">
          <input type="hidden" name="table" value="dossier">
          <input type="hidden" name="request" value="insert">
          <input type="submit" value="Créer le dossier" class="px-5 py-4 bg-slate-700 text-white rounded-xl text-xl max-w-lg hover:bg-slate-800 duration-300"/>
        </form>
      </div>
    </div>
  <?php
}

function addClientMeeting()
{
  ?>
    <div class="flex flex-row gap-4">
      <form action="<?php echo htmlspecialchars(
        $_SERVER["PHP_SELF"] . "?id=" . $_GET["id"]
      ); ?>" method="post" class="flex flex-row w-full items-center gap-5">
        <label for="date">
          <span>Jour de RDV</span>
          <input type="date" name="date_naissance_client" id="date" class="text-input"
          pattern="[0-31]{2}/[0-12]{2}/[1000-3000]{2}"
          required
          value="01/10/1312">
        </label>
        <label for="address">
          <span>Choix de la ville</span>
          <select id="garage" name="garage" class="text-input">
            <option value="Paris">Paris</option>
            <option value="Strasbourg">Strasbourg</option>
            <option value="Lyon">Lyon</option>
            <option value="Lille">Lille</option>
          </select>
        </label>
        <input type="hidden" name="table" value="rdv">
        <input type="hidden" name="request" value="select">
        <input type="submit" value="Ajouter un RDV" class="px-5 py-4 bg-slate-700 text-white rounded-xl text-xl max-w-lg hover:bg-slate-800 duration-300"/>
      </form>
    </div>
  <?php
}

function displayClientFolder()
{
  ?>
    <div class="flex flex-col gap-3">
      <h2 class="text-2xl font-bold">Dossier Client</h2>
      <h3>Reférence du dossier : <?php echo $_SESSION["clientFolder"][0][
        "ref_dossier"
      ]; ?></h3>
      <h3>Date de création : <?php echo $_SESSION["clientFolder"][0][
        "date_creation_dossier"
      ]; ?></h3>
      <h3>Disponibilité client : <?php echo $_SESSION["clientFolder"][0][
        "indisponibilite"
      ]; ?></h3>
      <h3 class="text-xl font-semibold">Informations Véhicule :</h3>
      <div class="pl-5">
        <h4>Date de mise en circulation : <?php echo $_SESSION[
          "clientFolder"
        ][0]["date_mec"]; ?></h4>
        <h4>Couleur : <?php echo $_SESSION["clientFolder"][0][
          "couleur"
        ]; ?></h4>
        <h4>Modèle : <?php echo $_SESSION["clientFolder"][0]["couleur"]; ?></h4>
        <h4>Immatriculation : <?php echo $_SESSION["clientFolder"][0][
          "couleur"
        ]; ?></h4>
      </div>
      <h3 class="text-xl font-semibold">Informations Expert :</h3>
      <div class="pl-5">
        <h4>Nom : <?php echo $_SESSION["clientFolder"][0]["nom_expert"]; ?></h4>
        <h4>Prenom : <?php echo $_SESSION["clientFolder"][0][
          "prenom_expert"
        ]; ?></h4>
        <h4>Ville d'intervention : <?php echo $_SESSION["clientFolder"][0][
          "ville_expert"
        ]; ?></h4>
        <h4>Téléphone : <?php echo $_SESSION["clientFolder"][0][
          "tel_port_expert"
        ]; ?></h4>
        <h4>Email : <?php echo $_SESSION["clientFolder"][0][
          "email_expert"
        ]; ?></h4>
      </div>
    </div>

  <?php addClientMeeting();
}

?>
