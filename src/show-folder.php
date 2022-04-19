<!DOCTYPE html>

<?php
ini_set("display_errors", "1");
ini_set("display_startup_errors", "1");
error_reporting(E_ALL);

session_start();

include_once "../php/displayInfo.php";

$displayInfo = new DisplayInfo();
isset($_SESSION["displayClient"])
  ? $displayInfo->setClientData($_SESSION["displayClient"])
  : null;

$clientFolder = "false";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  if (isset($_POST["request"])) {
    $displayInfo->connectDB();
    switch ($_POST["request"]) {
      case "insert":
        $displayInfo->insertDB($_POST["table"]);
        break;
      case "select":
        $result = $displayInfo->selectDB($_POST["table"]);
        $displayInfo->setClientData($result);
        $_SESSION["displayClient"] = $result;
        break;
      case "update":
        $displayInfo->updateDB($_POST["table"]);
        break;
    }
    $displayInfo->closeDB();
  }
}
?>

<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../css/output.css" />
</head>
<body class="">

  <?php include_once "../components/navbar.php"; ?>

  <div class="flex flex-col md:flex-row p-5 gap-10 md:gap-5">

    <!-- Create client folder -->
    <section class="py-20 mx-auto px-10 basis-1/3 bg-slate-800 w-full h-full rounded-lg shadow-xl">
      <h1 class="text-2xl text-slate-100">Afficher le dossier d&apos;un client</h1>
      <div class="flex flex-col p-5 max-w-4xl h-full w-full">
        <form
          action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
          method="post"
          class="flex flex-col justify-center gap-5"
        >
          <label for="ref_dossier">
            <span class="label-text">Numéro de dossier</span>
            <input
              type="text"
              name="ref_dossier"
              id="ref_dossier"
              placeholder="AAA-123"
              class="text-input"
            />
          </label>
          <label for="immatriculation">
            <span class="label-text">Immatriculation du véhicule</span>
            <input
              type="text"
              name="immatriculation"
              id="immatriculation"
              placeholder="XA-23-23"
              class="text-input"
            />
          </label>
          <label for="lname">
            <span class="label-text">Nom</span>
            <input
              type="text"
              name="nom_client"
              id="lname"
              placeholder="Nom"
              class="text-input"
            />
          </label>
          <label for="lname">
            <span class="label-text">Prénom</span>
            <input
              type="text"
              name="prenom_client"
              id="lname"
              placeholder="Prénom"
              class="text-input"
            />
          </label>
          <input type="hidden" name="table" value="client">
          <input type="hidden" name="request" value="select">
  
          <button type="submit" class="px-5 py-4 bg-slate-700 text-white rounded-xl text-2xl max-w-lg hover:bg-slate-100 duration-300 hover:text-slate-800">Rechercher</button>
        </form>
      </div>
      <div>
        <?php if (isset($_SESSION["displayClient"])) {
          $displayInfo->displayResult();
        } ?>
      </div>
    </section>
  
    <section class="mb-20 h-screen basis-2/3">
      <div class='border-2 border-slate-800 rounded-xl px-10 py-6 flex flex-col gap-10' id="clientFolder">
        <?php if (isset($_GET["id"])) {
          $displayInfo->displayClient();

          // Check if the client got a folder or not
          if (isset($displayInfo->getClientData($_GET["id"])["id_dossier"])) {
            $displayInfo->displayClientFolder();
          } else {
            $displayInfo->createClientFolder();
          }
        } ?>        
      </div>
    </section>
  </div>

  <script src="../js/openClientFolder.js"></script>
</body>
</html>