<?php

include_once "SetGet.php";

/**
 * Database class to make all the databases requests
 * @property private $username: string
 * @property private $password: string
 * @property private $conn
 * @method public connectDB(): void
 * @method public closeDB(): void
 * @method public insertDB(string $table): void
 * @method public selectDB(string $table, int $expert = null): array|null
 * @method public updateDB(string $table): void
 * @method protected selectAllCars(string $table): array|null
 */

class Database extends SetGet
{
  private string $username = "";
  private string $password = "";
  private $conn = null;

  public function __construct()
  {
    include_once "../db_connect.php";
    $this->username = $user;
    $this->password = $pwd;
  }

  public function connectDB(): void
  {
    $servername = "127.0.0.1";
    $database = "restiloc";

    try {
      $this->conn = new PDO(
        "mysql:host=$servername;dbname=$database",
        $this->username,
        $this->password
      );
      // set the PDO error mode to exception
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      // echo "Connected successfully<br/>";
    } catch (PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }
  }

  public function closeDB(): void
  {
    $this->conn = null;
  }

  public function insertDB(string $table): void
  {
    try {
      // Remove the last value of the array that indicate the table name
      if ($table === "dossier") {
        // Create a folder for the client
        $array = array_slice($_POST, 0, -1);
      } elseif ($table === "rdv") {
        // Create a meeting for the client
        echo "<pre>";
        var_dump($_POST);
        echo "</pre>";
        $array = array_slice($_POST, 0, -2);
      } else {
        $array = array_slice($_POST, 0, -2);
      }

      $key = array_keys($array);
      $val = array_values($array);
      if ($table === "rdv") {
        $sql =
          "INSERT INTO rdv (date_rdv, id_dossier, id_garage, id_expert) VALUES ('" .
          implode("', '", $val) .
          "', (SELECT id_expert FROM expert JOIN garage ON garage.ville_garage=expert.ville_expert WHERE garage.id_garage='" .
          $array["id_garage"] .
          "' LIMIT 1))";
      } else {
        $sql =
          "INSERT INTO $table (" .
          implode(", ", $key) .
          ") " .
          "VALUES ('" .
          implode("', '", $val) .
          "')";
      }

      $req = $this->conn->prepare($sql);

      $req->execute();
    } catch (Exception $e) {
      print $e->getMessage();
    }
  }

  public function selectDB(string $table, int $expert = null): array|null
  {
    try {
      $key = array_keys($_POST);
      $val = array_values($_POST);

      $key = array_slice($key, 0, -1);
      $val = array_slice($val, 0, -2);

      // Build the sql request
      $sql = "SELECT * FROM ";
      $sqlReady = false;

      if (isset($_POST["ref_dossier"]) && $table === "client") {
        $sql .=
          "dossier JOIN client ON client.id_client=dossier.id_client JOIN vehicule ON vehicule.id_vehicule=dossier.id_vehicule WHERE ref_dossier='" .
          $val[0] .
          "'";
        $sqlReady = true;
      } elseif (isset($_POST["immatriculation"]) && $table === "client") {
        $sql .=
          "vehicule JOIN dossier ON dossier.id_vehicule=vehicule.id_vehicule JOIN client ON client.id_client=dossier.id_client WHERE immatriculation='" .
          $val[1] .
          "'";
        $sqlReady = true;
      } elseif (
        (isset($_POST["nom_client"]) || isset($_POST["prenom_client"])) &&
        $table === "client"
      ) {
        $sql .=
          "client JOIN dossier ON dossier.id_client=client.id_client JOIN vehicule ON vehicule.id_vehicule=dossier.id_vehicule WHERE ";
        if ($key[2] === "nom_client" && $val[2] !== "") {
          $sql .= "nom_client = '" . $val[2] . "'";
        }
        if ($key[3] === "prenom_client" && $val[3] !== "") {
          $sql .= "prenom_client = '" . $val[3] . "'";
        }
        $sql .= " ORDER BY prenom_client ASC";
        $sqlReady = true;
      } else {
      }

      if ($table === "expert" && $expert !== null) {
        $sql .= "expert WHERE id_expert=" . $expert;
        $sqlReady = true;
      }

      if ($table === "garage") {
        // Select the city of the garage and remove duplicate
        $sql =
          "SELECT id_garage, ville_garage FROM garage ORDER BY ville_garage ASC";
        $sqlReady = true;
      }

      if ($table === "rdv") {
        $id_dossier = $this->getClientData($_GET["id"])["id_dossier"];
        $sql =
          "SELECT expert.prenom_expert,garage.nom_garage,garage.ville_garage,garage.tel_garage,rdv.date_rdv FROM rdv JOIN expert ON expert.id_expert=rdv.id_expert JOIN garage on garage.id_garage=rdv.id_garage WHERE rdv.id_dossier='" .
          $id_dossier .
          "' ORDER BY date_rdv DESC";
        $sqlReady = true;
      }

      if ($table === "prestation_carosserie" || $table === "prestation_piece") {
        $id_vehicule = $this->getClientData($_GET["id"])["id_vehicule"];
        $sql =
          "SELECT * FROM " .
          $table .
          " JOIN vehicule ON vehicule.id_vehicule=" .
          $table .
          ".id_vehicule WHERE vehicule.id_vehicule='" .
          $id_vehicule .
          "'";
        $sqlReady = true;
      }

      // Request database
      if ($sqlReady) {
        $req = $this->conn->prepare($sql);
        $req->execute();
        return $req->fetchAll();
      }
    } catch (Exception $e) {
      print $e->getMessage();
      return null;
    }

    return null;
  }

  public function updateDB(string $table): void
  {
    try {
      // UPDATE client SET
      $sql =
        "UPDATE $table SET id_expert=" .
        $_POST["id_expert"] .
        " WHERE id_client=" .
        $_POST["id_client"];

      $req = $this->conn->prepare($sql);
      $req->execute();
    } catch (Exception $e) {
      print $e->getMessage();
    }
  }

  protected function selectAllCars(string $table): array|null
  {
    try {
      $sql = "SELECT * FROM $table ORDER BY nom_modele ASC";

      $req = $this->conn->prepare($sql);

      $req->execute();
      return $req->fetchAll();
    } catch (Exception $e) {
      print $e->getMessage();
    }
    return null;
  }
}
