<?php

// Database gegevens
define('DB_SERVER', 'localhost');
define('DB_GEBRUIKERSNAAM', 'root');
define('DB_WACHTWOORD', '');
define('DB_NAAM', 'examen85120');

// Laat foutmeldingen zien.
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Poging om verbinding te makn met de database
try {
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAAM, DB_GEBRUIKERSNAAM, DB_WACHTWOORD);

// Stel de PDO error mode in op exception.
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e){
    die("ERROR: Kon niet verbinden. " . $e->getMessage());
}