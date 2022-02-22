<!DOCTYPE html>

<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

require_once "../db_connect.php";
require_once "../php/connexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $db = connectDB();

  $_POST["table"] = htmlspecialchars("Client");

  insertDB($db, $_POST["table"]);

  closeDB($db);
}
?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Restiloc - Creer dossier</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
              name="champ1"
              id="fname"
              class="mt-1 block w-full rounded-md border border-slate-300 bg-white px-3 py-2 placeholder-slate-400 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500 sm:text-sm"
              required
              value="John"
            />
          </label>
          <label for="lname">
            <span>Nom</span>
            <input
              type="text"
              name="champ2"
              id="lname"
              class="mt-1 block w-full rounded-md border border-slate-300 bg-white px-3 py-2 placeholder-slate-400 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500 sm:text-sm"
              required
              value="Doe"
            />
          </label>
          <label for="date">
            <span>Date de naissance</span>
            <input type="date" name="champ3" id="date" class="mt-1 block w-full rounded-md border border-slate-300 bg-white px-3 py-2 placeholder-slate-400 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500 sm:text-sm"
            pattern="[0-31]{2}/[0-12]{2}/[1000-3000]{2}"
            required
            value="01/10/1312">
          </label>
          <label for="address">
            <span>Adresse</span>
            <input
              type="text"
              name="champ4"
              id="address"
              placeholder="123 Avenue..."
              class="mt-1 block w-full rounded-md border border-slate-300 bg-white px-3 py-2 placeholder-slate-400 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500 sm:text-sm"
              value="123 Avenue..."
            />
          </label>
          <label for="cp">
            <span>Code Postal</span>
            <input
              type="text"
              name="champ5"
              id="cp"
              placeholder="00000"
              class="mt-1 block w-full rounded-md border border-slate-300 bg-white px-3 py-2 placeholder-slate-400 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500 sm:text-sm"
              value="10000"
            />
          </label>
          <label for="city">
            <span>Ville</span>
            <input
              type="text"
              name="champ6"
              id="city"
              placeholder="Paris"
              class="mt-1 block w-full rounded-md border border-slate-300 bg-white px-3 py-2 placeholder-slate-400 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500 sm:text-sm"
              value="Paris"
            />
          </label>
          <label for="pphone">
            <span>Téléphone</span>
            <input
              type="tel"
              name="champ7"
              id="pphone"
              placeholder="00 00 00 00 00"
              class="mt-1 block w-full rounded-md border border-slate-300 bg-white px-3 py-2 placeholder-slate-400 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500 sm:text-sm"
              required
              value="0000000000"
            />
          </label>
          <label for="hphone">
            <span>Portable</span>
            <input
              type="tel"
              name="champ8"
              id="hphone"
              placeholder="00 00 00 00 00"
              class="mt-1 block w-full rounded-md border border-slate-300 bg-white px-3 py-2 placeholder-slate-400 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500 sm:text-sm"
              value="0000000000"
            />
          </label>
          <label for="email">
            <span>Email</span>
            <input
              type="email"
              name="champ9"
              id="email"
              placeholder="email@example.com"
              pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
              class="mt-1 block w-full rounded-md border border-slate-300 bg-white px-3 py-2 placeholder-slate-400 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500 sm:text-sm"
              value="jhon.doe@example.com"
            />
          </label>

          <input type="submit" value="Créer client" class="px-5 py-4 bg-slate-700 text-white rounded-xl text-xl max-w-lg mx-auto hover:bg-slate-800 duration-300">
        </form>
      </div>
    </section>
  </body>
</html>
