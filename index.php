<!DOCTYPE html>

<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
?>

<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./css/output.css" />
    <title>Application Restiloc</title>
  </head>

  <body>
    <nav
      class="flex h-20 w-full flex-row items-center justify-around bg-slate-200 p-4"
    >
      <div>
        <h2 class="text-4xl font-bold">Restiloc</h2>
      </div>
      <div>
        <a href="./index.php" class="text-2xl font-bold">Accueil</a>
      </div>
    </nav>

    <section
      class="flex h-96 max-w-full flex-row items-center justify-center gap-20"
    >
      <button
        class="button-section"
      >
        <a href="./src/create-folder.php">
          <h1 class="text-4xl font-semibold">Créer un client</h1>
        </a>
      </button>
      <button
        class="button-section"
      >
        <a href="./src/show-folder.php">
          <h1 class="text-4xl font-semibold">Afficher un client</h1>
        </a>
      </button>
    </section>

    <section class="flex flex-row items-center justify-center">
      <h2 class="text-4xl font-semibold">Statistiques</h2>
      <div>
        <!-- Display stats and create button for more stats -->
      </div>
    </section>

    <footer></footer>
  </body>
</html>
