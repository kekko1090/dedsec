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



$user = $_SESSION["username"];
?>
<!DOCTYPE html>
<html>
<head>
    <title>cerca🔎</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Mono">
    <link rel="stylesheet" href="style-c.css">
</head>
<body style="background-color:white;">
    <form method="post">
        <input type="date" placeholder="data" name="data" id="data">
        <br><br>
        <input type="number" placeholder="id" name="id" id="id">
        <br><br>
        <input type="text" placeholder="titolo" name="titolo" id="titolo">
        <br><br>
        <input type="text" placeholder="user" name="username" id="username">
        <br><br>
        <select class="categoria" id="categoria" name="categoria">
            <option value="Malware_e_virus">Malware e virus</option>
            <option value="Phishing_e_social_engineering">Phishing e social engineering</option>
            <option value="Crittografia_e_sicurezza_dei_dati">Crittografia e sicurezza dei dati</option>
            <option value="Hacking_etico_e_pentesting">Hacking etico e pentesting</option>
            <option value="Sicurezza_delle_reti_Wi-Fi">Sicurezza delle reti Wi-Fi</option>
            <option value="Protezione_della_privacy_online">Protezione della privacy online</option>
            <option value="Zero-day_exploits">Zero-day exploits</option>
            <option value="Sicurezza_mobile">Sicurezza mobile</option>
            <option value="Dev_in_generale">Dev in generale</option>
        </select>
        <br>
        <input type="submit" name="send" value="cerca">
    </form>
</body>
</html>
<?php   
if(isset($_POST['send'])){
    $id=$_POST["id"];
    $categoria=$_POST["categoria"];
    $titolo=$_POST["titolo"];
    $username=$_POST["username"];
    $data=$_POST["data"];
    $query="SELECT * FROM forum";

    $statement = $pdo->prepare($query);

    // binding dei parametri
    /*$statement->bindParam(':data', $data);
    $statement->bindParam(':user', $username);
    $statement->bindParam(':id', $id);
    $statement->bindParam(':titolo', $titolo);
    $statement->bindParam(':categoria', $categoria);*/
    // esecuzione della query
    $statement->execute();

    // recupero dei risultati
    $result = $statement->fetchAll();
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    // Verifica se la query ha prodotto dei risultati
    if ( $row> 0) {
        // Creazione della tabella per visualizzare i risultati
        echo "<div class='tabella'>";
        echo "<table>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Titolo</th>";
        echo "<th>Categoria</th>";
        echo "<th>Data</th>";
        echo "<th>Descrizione</th>";
        echo "</tr>";
        echo "</div>";

        // Visualizza i risultati della query
        
        foreach($pdo->query($query) as $row) {
            if($id==$row['id']){
            echo "<tr>";
            echo "<td class='id-'>" . $row["id"] . "</td>";
            echo "<td>" . $row["titolo"] . "</td>";
            echo "<td>" . $row["categoria"] . "</td>";
            echo "<td>" . $row["data"] . "</td>";
            echo "<td><a class='dett' href='dettaglio.php?id=" . $row["id"] . "'>Visualizza dettaglio</a></td>";
            echo "</tr>";
            }
        }
            echo "</table>";
    } 
}

?>