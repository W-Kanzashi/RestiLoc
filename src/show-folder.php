<!DOCTYPE html>

<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

session_start();

require_once "../php/connexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $db = connectDB();

  $sqlResult = selectDB($db, "client");

  $_SESSION["displayClient"] = $sqlResult;

  // echo "<pre>";
  // print_r($_SESSION["displayClient"]);
  // echo "</pre>";

  closeDB($db);
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
    <section class="mt-20 mx-auto p-10 basis-2/3">
      <h1 class="text-2xl">Afficher le dossier d&apos;un client</h1>
      <div class="flex flex-col p-5 justify-center items-center h-96">
        <form
          action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
          method="post"
          class="flex flex-row w-full gap-5"
        >
          <label for="fname" class="">
            <span>Prénom</span>
            <input
              type="text"
              name="prenom_client"
              id="fname"
              class="mt-1 block w-full rounded-md border border-slate-300 bg-white px-3 py-2 placeholder-slate-400 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500 sm:text-sm"
            />
          </label>
          <label for="lname">
            <span>Nom</span>
            <input
              type="text"
              name="nom_client"
              id="lname"
              class="mt-1 block w-full rounded-md border border-slate-300 bg-white px-3 py-2 placeholder-slate-400 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500 sm:text-sm"
            />
          </label>
  
          <input type="submit" value="Rechercher" class="px-5 py-4 bg-slate-700 text-white rounded-xl text-xl max-w-lg hover:bg-slate-800 duration-300">
        </form>
      </div>
      <div>
        <?php if (isset($_SESSION["displayClient"])) {
          displayResult($_SESSION["displayClient"]);
        } ?>
      </div>
    </section>
  
    <section class="mb-20 h-screen basis-1/3">
      <div class='border-2 border-slate-800 rounded-xl px-10 py-6'>
        <?php if (isset($_GET["id"])) {
          displayClient($_SESSION["displayClient"][$_GET["id"]]);
        } ?>

        <div class="flex flex-row gap-4">
          <button class="client">Ajouter un RDV</button>
        </div>
      </div>
    </section>
  </div>

</body>
</html>