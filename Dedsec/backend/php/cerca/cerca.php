
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


$query="SELECT * FROM forum";
$statement = $pdo->prepare($query);
$statement->execute();
$user = $_SESSION["username"];
?>

<html>
    <head>
        <title>forum</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Mono">
        <link rel="stylesheet" href="style.css">
        <link rel="Websait icon" type="png" href="../../img/logo/DedSec_logo.png">
    </head>
<body class="body2">

                <nav class="nav-b">
                    <a href="../../../index.html"><img class="img-logo" src="../../../img/logo/DedSec_logo_50.png" alt="logo"></a>
                    <img class="img-f" src="../../../img/forum_del_Dedsec.png" alt="benvenuto" >
                    <p style="color: white;position: absolute;top: 2%;left:5%;">logged: <?php echo $user; ?></p>
                    <a  href="../crea_forum.html"><img class="modifica" src="../../../img/crea.png" alt="m"></a>
                </nav>

    <?php
        $titolo=$_POST["titolo"];
        $data=$_POST["data"];
        $user=$_POST["user"];
        $categoria=$_POST["categoria"];
        $id=$_POST["id"];
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        // Verifica se la query ha prodotto dei risultati
        if ( $row> 0) {
            // Creazione della tabella per visualizzare i risultati
            echo"<br><br>";
            echo "<table>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Titolo</th>";
            echo "<th>Categoria</th>";
            echo "<th>Data</th>";
            echo "<th>Descrizione</th>";
            echo "</tr>";


            // Visualizza i risultati della query
            
            foreach($pdo->query($query) as $row) {
                if($id==$row["id"] or $categoria==$row["categoria"] or $titolo==$row["titolo"] or $data==$row["data"] or $user==$row["user"]){
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["titolo"] . "</td>";
                echo "<td>" . $row["categoria"] . "</td>";
                echo "<td>" . $row["data"] . "</td>";
                echo "<td><a href='../dettaglio.php?id=" . $row["id"] . "'>Visualizza dettaglio</a></td>";
                echo "</tr>";
            }

        } 
    }
        
    ?>

    
    </body>
</html>