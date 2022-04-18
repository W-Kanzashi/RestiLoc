<?php

class Database
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

  protected function connectDB()
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
      echo "Connected successfully<br/>";
    } catch (PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }
  }

  protected function closeDB()
  {
    $this->db = null;
  }

  protected function insertDB(string $table): void
  {
    try {
      // Remove the last value of the array that indicate the table name
      if ($_POST["table"] === "create") {
        $array = array_slice($_POST, 0, -1);
      } elseif ($_POST["table"] === "rdv") {
        $result = $this->selectDB($this->db, "garage");

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

      $req = $this->db->prepare($sql);

      $req->execute();
    } catch (Exception $e) {
      print $e->getMessage();
    }
  }

  protected function selectDB(string $table): array|null
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
        //$sql .= "JOIN expert ON expert.id_expert=dossier.id_expert ";
        $sql .=
          "WHERE id_client=" .
          $_SESSION["displayClient"][$_GET["id"]]["id_client"];
      }

      if ($table === "garage") {
        // SELECT * FROM `expert`
        // JOIN garage ON garage.ville_garage="Auvergne"
        // WHERE ville_expert="Auvergne"
        $sql = "SELECT id_expert, id_garage FROM garage ";
        $sql .= "JOIN expert ON expert.ville_expert='" . $_POST["garage"] . "'";
        $sql .= " WHERE garage.ville_garage='" . $_POST["garage"] . "'";
      }

      // Request database
      $req = $this->db->prepare($sql);

      $req->execute();
    } catch (Exception $e) {
      print $e->getMessage();
      return null;
    }

    return $req->fetchAll();
  }

  protected function updateDB($table): void
  {
    try {
      // UPDATE client SET
      $sql =
        "UPDATE $table SET id_expert=" .
        $_POST["id_expert"] .
        " WHERE id_client=" .
        $_POST["id_client"];

      $req = $this->db->prepare($sql);
      $req->execute();
    } catch (Exception $e) {
      print $e->getMessage();
    }
  }

  protected function selectAllCars($table): array
  {
    try {
      $sql = "SELECT * FROM $table ORDER BY nom_modele ASC";

      $req = $this->db->prepare($sql);

      $req->execute();
    } catch (Exception $e) {
      print $e->getMessage();
    }

    return $req->fetchAll();
  }

  protected function deleteDB($id): void
  {
    $req = $this->db->prepare("DELETE FROM users WHERE id = :id");
    $req->execute([
      "id" => $id,
    ]);
  }
}
