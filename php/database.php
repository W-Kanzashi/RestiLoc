<?php

include_once "SetGet.php";

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
      if ($_POST["table"] === "create") {
        $array = array_slice($_POST, 0, -1);
      } elseif ($_POST["table"] === "rdv") {
        $result = $this->selectDB("garage");

        // Remove unuse data
        unset($result[0][0], $result[0][1]);
        $array = array_slice($_POST, 0, -3);
        $array = array_merge($array, $result[0]);
      } else {
        $array = array_slice($_POST, 0, -2);
      }

      $key = array_keys($array);
      $val = array_values($array);
      $sql =
        "INSERT INTO $table (" .
        implode(", ", $key) .
        ") " .
        "VALUES ('" .
        implode("', '", $val) .
        "')";

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

      if (isset($_POST["ref_dossier"])) {
        $sql .=
          "dossier JOIN client ON client.id_client=dossier.id_client JOIN vehicule ON vehicule.id_vehicule=dossier.id_vehicule WHERE ref_dossier='" .
          $val[0] .
          "'";
      } elseif (isset($_POST["immatriculation"])) {
        $sql .=
          "vehicule JOIN dossier ON dossier.id_vehicule=vehicule.id_vehicule JOIN client ON client.id_client=dossier.id_client WHERE immatriculation='" .
          $val[1] .
          "'";
      } elseif (isset($_POST["nom_client"]) || isset($_POST["prenom_client"])) {
        $sql .=
          "client JOIN dossier ON dossier.id_client=client.id_client JOIN vehicule ON vehicule.id_vehicule=dossier.id_vehicule WHERE ";
        if ($key[2] === "nom_client" && $val[2] !== "") {
          $sql .= "nom_client = '" . $val[2] . "'";
        }
        if ($key[3] === "prenom_client" && $val[3] !== "") {
          $sql .= "prenom_client = '" . $val[3] . "'";
        }
        $sql .= " ORDER BY prenom_client ASC";
      } else {
      }

      if ($expert !== null) {
        $sql .= "expert WHERE id_expert=" . $expert;
      }

      if ($table === "garage") {
        // Select the city of the garage and remove duplicate
        $sql =
          "SELECT DISTINCT ville_garage FROM garage ORDER BY ville_garage ASC";
      }
      echo $table;

      // Request database
      $req = $this->conn->prepare($sql);

      $req->execute();
    } catch (Exception $e) {
      print $e->getMessage();
      return null;
    }

    return $req->fetchAll();
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

  protected function deleteDB(int $id): void
  {
    $req = $this->conn->prepare("DELETE FROM users WHERE id = :id");
    $req->execute([
      "id" => $id,
    ]);
  }
}
