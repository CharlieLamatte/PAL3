<?php
$dbname= "mysql:host=localhost;dbname=jsenac;charset=utf8";
$username= "jsenac";
$userpassword= "22109342";

try{
    $bdd= new PDO($dbname,$username,$userpassword); 
    echo("connexion reussi");
}

catch(Exception $e){
    die('Erreur : '. $e -> getMessage()); 
}
?>
