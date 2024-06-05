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

// Verifica se il form è stato inviato
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Ottieni i dati dal form
    $titolo = $_POST['titolo'];
    $discussione = $_POST['discussione'];
    $categoria = $_POST['categoria'];
    $data = date('Y-m-d:h:m:s', time());
    $username = $_SESSION["username"];
    // Query di inserimento dei dati nel database

    $query = "INSERT INTO `forum`(`titolo`, `desc`, `user`, `data`, `categoria`) VALUES (:titolo,:desc,:user,:data,:categoria)";
 
    // Preparazione della query per l'esecuzione
    $statement = $pdo->prepare($query);

    // Bind dei parametri
    $statement->bindParam(':titolo', $titolo,PDO::PARAM_STR);
    $statement->bindParam(':desc', $discussione,PDO::PARAM_STR);
    $statement->bindParam(':user', $username,PDO::PARAM_STR);
    $statement->bindParam(':data', $data,PDO::PARAM_STR);
    $statement->bindParam(':categoria', $categoria,PDO::PARAM_STR);

    // Esecuzione della query
    if($statement->execute()) {
        echo"desc caricata..";
        header("location: forum.php");
    } else {
        echo"desc non caricata..";
    }
}else
{
    echo"error 404";
}
?>