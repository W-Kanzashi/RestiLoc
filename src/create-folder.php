<!DOCTYPE html>

<?php
session_start();

require_once "../php/displayInfo.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $info = new DisplayInfo();
  $info->connectDB();
  $info->insertDB("client");
  $info->closeDB();
}
?>

<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Restiloc - Creer dossier</title>
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

    <!-- Create client doc -->
    <section class="mt-20 w-full flex flex-col p-10 gap-10">
      <h1>Formulaire de création du dossier client</h1>
      <div class="flex flex-col p-5 justify-center items-center h-96">
        <form
          action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
          method="post"
          class="grid w-full grid-cols-2 gap-5"
        >
          <label for="fname" class="">
            <span>Prénom</span>
            <input
              type="text"
              name="prenom_client"
              id="fname"
              class="text-input"
              required
              value="John"
            />
          </label>
          <label for="lname">
            <span>Nom</span>
            <input
              type="text"
              name="nom_client"
              id="lname"
              class="text-input"
              required
              value="Doe"
            />
          </label>
          <label for="date">
            <span>Date de naissance</span>
            <input type="date" name="date_naissance_client" id="date" class="text-input"
            pattern="[0-31]{2}/[0-12]{2}/[1000-3000]{2}"
            required
            value="01/10/1312">
          </label>
          <label for="address">
            <span>Adresse</span>
            <input
              type="text"
              name="rue_client"
              id="address"
              placeholder="123 Avenue..."
              class="text-input"
              value="123 Avenue..."
            />
          </label>
          <label for="cp">
            <span>Code Postal</span>
            <input
              type="text"
              name="cp_client"
              id="cp"
              placeholder="00000"
              class="text-input"
              value="10000"
            />
          </label>
          <label for="city">
            <span>Ville</span>
            <input
              type="text"
              name="ville_client"
              id="city"
              placeholder="Paris"
              class="text-input"
              value="Paris"
            />
          </label>
          <label for="pphone">
            <span>Téléphone</span>
            <input
              type="tel"
              name="tel_client"
              id="pphone"
              placeholder="00 00 00 00 00"
              class="text-input"
              required
              value="0000000000"
            />
          </label>
          <label for="hphone">
            <span>Portable</span>
            <input
              type="tel"
              name="tel_port_client"
              id="hphone"
              placeholder="00 00 00 00 00"
              class="text-input"
              value="0000000000"
            />
          </label>
          <label for="email">
            <span>Email</span>
            <input
              type="email"
              name="email_client"
              id="email"
              placeholder="email@example.com"
              pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
              class="text-input"
              value="jhon.doe@example.com"
            />
          </label>
          <input type="hidden" name="table" value="Create">

          <input type="submit" value="Créer client" class="px-5 py-4 bg-slate-700 text-white rounded-xl text-xl max-w-lg mx-auto hover:bg-slate-800 duration-300">
        </form>
      </div>
    </section>
  </body>
</html>
