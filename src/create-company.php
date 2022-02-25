<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

require_once "../php/connexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $db = connectDB();

  insertDB($db, $_POST["form"]);

  closeDB($db);
}
?>

<!DOCTYPE html>
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

  <div class="grid grid-cols-2 p-5 max-w-7xl mx-auto">

    <!-- Add new garage -->
    <section class="mt-20 mx-auto p-10 w-full">
      <h2 class="text-2xl mb-10">Ajouter un garage</h2>
      <div class="flex flex-col p-5 max-w-4xl h-96">
        <form
          action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
          method="post"
          class="grid grid-cols-2 gap-5"
        >
          <label for="name">
            <span>Nom</span>
            <input
              type="text"
              name="nom_garage"
              id="name"
              class="text-input"
            />
          </label>
          <label for="lname">
            <span>Ville</span>
            <input
              type="text"
              name="ville_garage"
              id="lname"
              class="text-input"
            />
          </label>
          <label for="phone">
            <span>Téléphone</span>
            <input
              type="text"
              name="tel_garage"
              id="phone"
              class="text-input"
            />
          </label>
          <input type="hidden" name="form" value="garage">
  
          <input type="submit" value="Ajouter" class="button-send">
        </form>
      </div>
    </section>
  
    <!-- Add expert -->
    <section class="mt-20 mx-auto p-10 w-full">
      <h2 class="text-2xl mb-10">Ajouter un expert</h2>
      <form
        action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
        method="post"
        class="grid grid-cols-2 gap-5"
      >
        <label for="fname" class="">
          <span>Prénom</span>
          <input
            type="text"
            name="prenom_expert"
            id="fname"
            class="text-input"
          />
        </label>
        <label for="lname">
          <span>Nom</span>
          <input
            type="text"
            name="nom_expert"
            id="lname"
            class="text-input"
          />
        </label>
        <label for="pphone">
          <span>Portable</span>
          <input
            type="text"
            name="tel_port_expert"
            id="pphone"
            class="text-input"
          />
        </label>
        <label for="ville">
          <span>Ville</span>
          <input
            type="text"
            name="ville_expert"
            id="ville"
            class="text-input"
          />
        </label>
        <label for="email">
          <span>Email</span>
          <input
            type="text"
            name="email_expert"
            id="email"
            class="text-input"
          />
        </label>
        <input type="hidden" name="form" value="expert">

        <input type="submit" value="Ajouter" class="button-send">
      </form>
    </section>

    <!-- Add cars -->
    <section class="mt-20 mx-auto p-10 w-full">
      <h2 class="text-2xl mb-10">Ajouter un véhicule</h2>
      <form
        action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
        method="post"
        class="grid grid-cols-2 gap-5"
      >
        <label for="name" class="">
          <span>Nom</span>
          <input
            type="text"
            name="nom_vehicule"
            id="name"
            class="text-input"
          />
        </label>
        <label for="code">
          <span>Immatriculation</span>
          <input
            type="text"
            name="immatriculation"
            id="code"
            class="text-input"
          />
        </label>
        <label for="date">
          <span>Date de mise en circulation</span>
          <input
            type="text"
            name="date_mec"
            id="date"
            class="text-input"
          />
        </label>
        <label for="color">
          <span>Couleur</span>
          <input
            type="text"
            name="couleur"
            id="color"
            class="text-input"
          />
        </label>
        <input type="hidden" name="form" value="expert">

        <input type="submit" value="Ajouter" class="button-send">
      </form>
    </section>
  </div>
</body>
</html>