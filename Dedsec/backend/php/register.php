
<?php
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
if(isset($_POST['username'])){
    // Ottieni i dati dal form
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $data = date('Y-m-d', time());

    // Query di inserimento dei dati nel database
    $query = "INSERT INTO data (username, password, email, data) VALUES (:username, :password, :email, :data)";

    // Preparazione della query per l'esecuzione
    $statement = $pdo->prepare($query);

    // Bind dei parametri
    $statement->bindParam(':username', $username);
    $statement->bindParam(':password', $password);
    $statement->bindParam(':email', $email);
    $statement->bindParam(':data', $data);

    // Esecuzione della query
    if($statement->execute()) {
        header("location: ../login.html");

    } else {
        header("location: ../register.html");
    }
}else
{
    echo"error 404";
}
?>