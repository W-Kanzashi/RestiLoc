<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
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
  
  <section>

    <!-- Create client doc -->
    <section class="mt-20 w-full flex flex-col p-10">
      <h1>Formulaire visualiser le dossier client</h1>
      <div class="flex flex-col p-5 justify-center items-center h-96">
        <form
          action="../php/connexion.php"
          method="post"
          class="grid w-full grid-cols-2 gap-5"
        >
          <label for="fname" class="">
            <span>Prénom</span>
            <input
              type="text"
              name="fname"
              id="fname"
              class="mt-1 block w-full rounded-md border border-slate-300 bg-white px-3 py-2 placeholder-slate-400 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500 sm:text-sm"
            />
          </label>
          <label for="lname">
            <span>Nom</span>
            <input
              type="text"
              name="lname"
              id="lname"
              class="mt-1 block w-full rounded-md border border-slate-300 bg-white px-3 py-2 placeholder-slate-400 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500 sm:text-sm"
            />
          </label>
          <label for="address">
            <span>Adresse</span>
            <input
              type="text"
              name="address"
              id="address"
              placeholder="123 Avenue..."
              class="mt-1 block w-full rounded-md border border-slate-300 bg-white px-3 py-2 placeholder-slate-400 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500 sm:text-sm"
            />
          </label>
          <label for="city">
            <span>Ville</span>
            <input
              type="text"
              name="city"
              id="city"
              placeholder="Paris"
              class="mt-1 block w-full rounded-md border border-slate-300 bg-white px-3 py-2 placeholder-slate-400 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500 sm:text-sm"
            />
          </label>
          <label for="cp">
            <span>Ville</span>
            <input
              type="text"
              name="cp"
              id="cp"
              placeholder="00000"
              class="mt-1 block w-full rounded-md border border-slate-300 bg-white px-3 py-2 placeholder-slate-400 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500 sm:text-sm"
            />
          </label>
          <label for="pphone">
            <span>Téléphone</span>
            <input
              type="tel"
              name="pphone"
              id="pphone"
              placeholder="00 00 00 00 00"
              pattern="[0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2}"
              class="mt-1 block w-full rounded-md border border-slate-300 bg-white px-3 py-2 placeholder-slate-400 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500 sm:text-sm"
            />
          </label>
          <label for="hphone">
            <span>Portable</span>
            <input
              type="tel"
              name="hphone"
              id="hphone"
              placeholder="00 00 00 00 00"
              pattern="[0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2}"
              class="mt-1 block w-full rounded-md border border-slate-300 bg-white px-3 py-2 placeholder-slate-400 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500 sm:text-sm"
            />
          </label>
          <label for="email">
            <span>Email</span>
            <input
              type="email"
              name="email"
              id="email"
              placeholder="email@example.com"
              class="mt-1 block w-full rounded-md border border-slate-300 bg-white px-3 py-2 placeholder-slate-400 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500 sm:text-sm"
            />
          </label>

          <input type="submit" value="Voir dossier client" class="px-5 py-4 bg-slate-700 text-white rounded-xl text-xl max-w-lg mx-auto hover:bg-slate-800 duration-300">
        </form>


  </section>

</body>
</html>