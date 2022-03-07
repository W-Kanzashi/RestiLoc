<!DOCTYPE html>

<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

session_start();

require_once "../php/connexion.php";

$clientFolder = "false";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST["request"])) {
    $db = connectDB();
    switch ($_POST["request"]) {
      case "insert":
        insertDB($db, $_POST["table"]);
        break;
      case "select":
        $sqlResult = selectDB($db, $_POST["table"]);
        $_SESSION["displayClient"] = $sqlResult;
        break;
    }
    closeDB($db);
  }

  echo "<pre>";
  var_dump($_SESSION);
  var_dump($_POST);
  echo "</pre>";
}
?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../css/output.css" />
</head>
<body>

  <nav
    class="flex h-20 w-full flex-row items-center justify-around bg-slate-200 p-4"
  >
    <div>
      <h2 class="text-4xl font-bold">Restiloc</h2>
    </div>
    <div>
      <a href="../index.php" class="text-2xl font-bold">Accueil</a>
    </div>
  </nav>

  <div class="flex flex-row p-5">

    <!-- Create client doc -->
    <section class="mt-20 mx-auto p-10 basis-1/3">
      <h1 class="text-2xl">Afficher le dossier d&apos;un client</h1>
      <div class="flex flex-col p-5 max-w-4xl h-96">
        <form
          action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
          method="post"
          class="grid grid-cols-2 gap-5"
        >
          <label for="fname" class="">
            <span>Numéro de dossier</span>
            <input
              type="text"
              name="prenom_client"
              id="fname"
              class="text-input"
            />
          </label>
          <label for="lname">
            <span>Immatriculation du véhicule</span>
            <input
              type="text"
              name="nom_client"
              id="lname"
              class="text-input"
            />
          </label>
          <label for="lname">
            <span>Nom</span>
            <input
              type="text"
              name="nom_client"
              id="lname"
              class="text-input"
            />
          </label>
          <label for="lname">
            <span>Prénom</span>
            <input
              type="text"
              name="prenom_client"
              id="lname"
              class="text-input"
            />
          </label>
          <input type="hidden" name="table" value="Client">
          <input type="hidden" name="request" value="select">
  
          <input type="submit" value="Rechercher" class="px-5 py-4 bg-slate-700 text-white rounded-xl text-xl max-w-lg hover:bg-slate-800 duration-300">
        </form>
      </div>
      <div>
        <?php if (isset($_SESSION["displayClient"])) {
          displayResult($_SESSION["displayClient"]);
        } ?>
      </div>
    </section>
  
    <section class="mb-20 h-screen basis-2/3">
      <div class='border-2 border-slate-800 rounded-xl px-10 py-6 flex flex-col gap-10'>
        <?php
        if (isset($_GET["id"])) {
          displayClient($_SESSION["displayClient"][$_GET["id"]]);
        }

        if (isset($_POST["clientFolder"])) {
          createClientFolder();
        } else {
          displayCreateFolder();
        }
        ?>

        <div class="flex flex-row gap-4">
          <form action="<?php echo htmlspecialchars(
            $_SERVER["PHP_SELF"]
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
      </div>
    </section>
  </div>

</body>
</html>