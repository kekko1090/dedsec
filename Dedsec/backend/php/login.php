<?php
 session_start();  
 $host = "localhost";  
 $username = "root";  
 $password = "";  
 $database = "dedsec";   
 try  
 {  
      $connect = new PDO("mysql:host=$host; dbname=$database", $username, $password);  
      $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
           if(empty($_POST["username"]) || empty($_POST["password"]))  
           {  
                header("location: ../login.html");
           }  
           else  
           {  
                $query = "SELECT * FROM data WHERE username = :username AND password = :password";  
                $statement = $connect->prepare($query);  
                $statement->execute(  
                     array(  
                          'username'     =>     $_POST["username"],  
                          'password'     =>     $_POST["password"]  
                     )  
                );  
                $count = $statement->rowCount();  
                if($count > 0)  
                {  
                     $_SESSION["username"] = $_POST["username"];  
                     header("location: forum.php");    
                }  
                else  
                {  
                    header("location: ../login_error.html");
                }  
           }  
      }  
 catch(PDOException $error)  
 {  
    echo"errore db";
 }  
?>  