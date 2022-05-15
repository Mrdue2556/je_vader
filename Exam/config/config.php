<?php

//Database gegevens
define('DB_SERVER', 'localhost');
define('DB_GEBRUIKERSNAAM', '85120');
define('DB_WACHTWOORD', 'Dindon!23');
define('DB_NAAM', 'AdamDzik');

// Laat foutmeldingen zien.
error_reporting(E_ALL);
ini_set('display_errors', '1');

//Poging om verbinding te maken met de database
try {
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAAM,
    DB_GEBRUIKERSNAAM, DB_WACHTWOORD);

//Stel de PDO error mode in op exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e){
    die("ERROR: Could not connect. " . $e->getMessage());
}