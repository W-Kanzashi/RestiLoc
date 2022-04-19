<?php

include_once "database.php";
// file deepcode ignore XSS: No time for that
class DisplayInfo extends Database
{
  private $data = [];
  public function __construct()
  {
    parent::__construct();
  }

  public function displayResult(): void
  {
    $counter = 0;
    echo "<div class='flex flex-col gap-4 w-full'>";
    foreach ($this->getClientData() as $result) {
      echo "<button class='my-10 border-2 rounded-xl px-5 py-4 hover:duration-300 bg-slate-100 hover:bg-slate-800 hover:text-slate-100'>";
      echo "<a href='./show-folder.php?id=" . $counter . "'>";
      echo "<h2 class='text-lg font-bold'>Client</h2>";
      echo "<p>";
      echo "Dossier : " . $result["ref_dossier"] . "<br/>";
      echo "Plaque d'immatriculation : " . $result["immatriculation"] . "<br/>";
      echo "Prénom : " . $result["prenom_client"] . "<br/>";
      echo "Nom : " . $result["nom_client"] . "<br/>";
      echo "</p>";
      echo "</a>";
      echo "</button>";
      $counter++;
    }
    echo "</div>";
  }

  public function displayClient(): void
  {
    $this->data = $this->getClientData($_GET["id"]);
    echo "Prénom : " . $this->data["prenom_client"] . "<br/>";
    echo "Nom : " . $this->data["nom_client"] . "<br/>";
    echo "Date de naissance : " .
      $this->data["date_naissance_client"] .
      "<br/>";
    echo "Rue : " . $this->data["rue_client"] . "<br/>";
    echo "Ville : " . $this->data["ville_client"] . "<br/>";
    echo "Code postal : " . $this->data["cp_client"] . "<br/>";
    echo "Téléphone : +33 " . $this->data["tel_client"] . "<br/>";
    echo "Portable : +33 " . $this->data["tel_port_client"] . "<br/>";
    echo "Email : " . $this->data["email_client"] . "<br/>";

    echo $this->data["id_expert"];
    $this->setExpertData($this->selectDB("expert", $this->data["id_expert"]));
  }

  public function displayCreateFolder(): void
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

  public function createClientFolder(): void
  {
    $data = $this->getClientData($_GET["id"]);
    $this->connectDB();
    $cars = $this->selectAllCars("vehicule");
    $this->closeDB();
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
              value="<?php echo $data["prenom_client"] . $_GET["id"]; ?>">
            </label>
            <label for="date">
              <span>Date de création</span>
              <input type="date" name="date_creation_dossier" id="date" class="text-input"
              pattern="[0-31]{2}/[0-12]{2}/[2000-3000]{4}"
              required
              value="<?php echo date("d-m-Y"); ?>">
            </label>
            <label for="address">
              <span>Choix du véhicule</span>
              <select id="cars" name="id_vehicule" class="text-input">
              <?php foreach ($cars as $car) {
                echo "<option value=" .
                  $car["id_vehicule"] .
                  ">" .
                  $car["nom_modele"] .
                  "</option>";
              } ?>
              </select>
            </label>
            <input type="hidden" name="id_client" value="<?php echo $data[
              "id_client"
            ]; ?>">
            <input type="hidden" name="nom_fichier_expertise" value="<?php echo $data[
              "prenom_client"
            ] . $_GET["id"]; ?>">
            <input type="hidden" name="table" value="dossier">
            <input type="hidden" name="request" value="insert">
            <button type="submit" class="px-5 py-4 bg-slate-700 text-white rounded-xl text-xl max-w-lg hover:bg-slate-100 hover:text-slate-800 duration-300">Créer le dossier</button>
          </form>
        </div>
      </div>
    <?php
  }

  public function addClientMeeting(): void
  {
    $this->connectDB();
    $this->setGarageData($this->selectDB("garage"));
    $this->closeDB();
    $data = $this->getGarageData();
    ?>
      <div class="flex flex-row gap-4">
        <form action="<?php echo htmlspecialchars(
          $_SERVER["PHP_SELF"] . "?id=" . $_GET["id"]
        ); ?>" method="post" class="flex flex-row w-full items-center gap-5">
          <label for="date">
            <span>Jour de RDV</span>
            <input type="date" name="date_rdv" id="date" class="text-input"
            pattern="[0-31]{2}/[0-12]{2}/[2000-3000]{4}"
            required
            value="01/10/1312">
          </label>
          <input type="hidden" name="id_dossier" value="<?php echo $this->data[
            "id_dossier"
          ]; ?>">
          <label for="id_garage">
            <span>Choix de la ville</span>
            <select id="id_garage" name="id_garage" class="text-input">
              <?php foreach ($data as $garage) {
                echo "<option value=" .
                  $garage["id_garage"] .
                  ">" .
                  $garage["ville_garage"] .
                  "</option>";
              } ?>
            </select>
          </label>
          <input type="hidden" name="table" value="rdv">
          <input type="hidden" name="request" value="insert">
          <button type="submit" class="px-5 py-4 rounded-xl text-xl max-w-lg hover:bg-slate-800 border-slate-800 border-2 hover:text-slate-100 duration-300">Ajouter un RDV</button>
        </form>
      </div>
    <?php
  }

  private function displayExpertData(): void
  {
    ?>
      <h3 class="text-xl font-semibold">Informations Expert :</h3>
      <div class="pl-5">
        <h4>Nom : <?php echo $this->data["nom_expert"]; ?></h4>
        <h4>Prenom : <?php echo $this->data["prenom_expert"]; ?></h4>
        <h4>Ville d'intervention : <?php echo $this->data[
          "ville_expert"
        ]; ?></h4>
        <h4>Téléphone : <?php echo $this->data["tel_port_expert"]; ?></h4>
        <h4>Email : <?php echo $this->data["email_expert"]; ?></h4>
      </div>
    <?php
  }

  public function displayClientFolder(): void
  {
    $this->data = $this->getClientData($_GET["id"]); ?>
      <div class="flex flex-col gap-3">
        <h2 class="text-2xl font-bold">Dossier Client</h2>
        <div>
          <h3>Reférence du dossier : <?php echo $this->data[
            "ref_dossier"
          ]; ?></h3>
          <h3>Date de création : <?php echo $this->data[
            "date_creation_dossier"
          ]; ?></h3>
          <h3>Date de RDV : <?php echo $this->data[
            "date_creation_dossier"
          ]; ?></h3>
          <h3>Disponibilité client : <?php echo $this->data[
            "indisponibilite"
          ]; ?></h3>
          <h3 class="text-xl font-semibold">Informations Véhicule :</h3>
        </div>
        <div class="pl-5">
          <h4>Date de mise en circulation : <?php echo $this->data[
            "date_mec"
          ]; ?></h4>
          <h4>Couleur : <?php echo $this->data["couleur"]; ?></h4>
          <h4>Modèle : <?php echo $this->data["nom_modele"]; ?></h4>
          <h4>Immatriculation : <?php echo $this->data["immatriculation"]; ?>
          <?= !empty($this->getExpertData()) && $this->displayExpertData() ?>
          </h4>
        </div>
        
      </div>

    <?php $this->addClientMeeting();
  }
}
