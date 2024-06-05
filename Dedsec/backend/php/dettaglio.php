<?php
session_start();
// Configurazione della connessione al database
$host = "localhost";
$dbname = "dedsec";
$username = "root";
$password = "";

// Tentativo di connessione al database tramite PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Errore di connessione al database: " . $e->getMessage();
    die();
}



// Verifica che sia stato passato un parametro "id"


?>
<!DOCTYPE html>
<html>
  <head>
    <title>Dettaglio Articolo</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Mono">
    <link rel="stylesheet" href="style.css">
  </head>
  <body class="body2">
    <div class="container">
      <h1 class="h12">Dettaglio Articolo</h1>
      <?php        
        // Verifica che sia stato passato un parametro "id"
        if(isset($_GET["id"])) {
            // Seleziona la riga corrispondente dall'id passato
            $query = "SELECT * FROM forum WHERE id = :id";
            $stmt = $pdo->prepare($query);
            $id = $_GET["id"];
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            $row = $stmt->fetch();

            // Visualizza la descrizione completa
            echo "<div class='card'>";
            echo "<h2 class='h22'>" . $row["titolo"] . "</h2>";
            echo "<p>" . $row["desc"] . "</p>";
            echo "<p class='author'>Autore: " . $row["user"] . "</p>";
            echo "<p class='date'>Data: " . $row["data"] . "</p>";
            echo "</div>";
        } else {
            echo "<p class='error'>Nessuna riga selezionata.</p>";
        }
      ?>
    </div>
  </body>
</html>
