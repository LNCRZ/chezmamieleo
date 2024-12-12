<?php
$host = '188.165.47.99';
$dbname ='amrvagll_chezmamieleo';
$username = 'amrvagll_chezmamieleo';
$pwd = 'JLjvyfGsE+j]';

try {
    $bdd = new PDO ( "mysql:host=$host;dbname=$dbname", $username, $pwd);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "L'erreur est: " . $e->getMessage();
}
       
