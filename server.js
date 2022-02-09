const http = require("http");

const server = http.createServer(function (req, res) {
  // A l'arrivée d'une requête
  res.write("Hello World!");
  res.end();
});

// Lancer le serveur
server.listen(3000);
