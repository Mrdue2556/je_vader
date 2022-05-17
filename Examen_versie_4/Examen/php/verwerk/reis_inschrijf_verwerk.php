<?php

include "../../config/config.php";

session_start();

// Stop de student id in een session
$Student_ID = $_SESSION["Student_ID"];
// Stop de studentnummer in een session
$Studentnummer = $_SESSION["Studentnummer"];

if (isset($_GET["Reis_ID"])) {
    $Reis_ID = $_POST['Reis_ID'];
}

// Laat foutmeldingen zien.
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Definieer variabelen en initialiseer met lege waarden
$Identiteitsbewijs_nummer = $Opmerkingen ="";
$Identiteitsbewijs_nummer_err = "";

// Formuliergegevens verwerken wanneer formulier wordt ingediend
if ($_SERVER["REQUEST_METHOD"] == "POST"){

    $input_Identiteitsbewijs_nummer = trim($_POST["Identiteitsbewijs_nummer"]);
    if(empty($input_Identiteitsbewijs_nummer)) {
        $Identiteitsbewijs_nummer_err = "Voer je Identiteitsbewijs nummer/BSN.";
    } else{
        $Identiteitsbewijs_nummer = $input_Identiteitsbewijs_nummer	;
    }

    // Omschrijving
    $input_Opmerkingen = trim($_POST["Opmerkingen"]);
        $Opmerkingen = $input_Opmerkingen;

    // Controleer invoerfouten voordat de data in de database ingevoegd word
    if(empty($Identiteisbewijs_nummer_err)){
        // Bereid een inster statement voor
        $sql = "INSERT INTO `reis_inschrijf`(`Student_ID`, `Reis_ID`, `Studentnummer`, `Identiteitsbewijs_nummer`, `Opmerkingen`) 
                VALUES (:Student_ID, :Reis_ID, :Studentnummer, :Identiteitsbewijs_nummer, :Opmerkingen)";

        if($stmt = $pdo->prepare($sql)){
            //Bind variabelen aan de prepared statement als parameters
            $stmt->bindParam(":Student_ID", $param_Student_ID);
            $stmt->bindParam(":Reis_ID", $param_Reis_ID);
            $stmt->bindParam(":Studentnummer", $param_Studentnummer);
            $stmt->bindParam(":Identiteitsbewijs_nummer", $param_Identiteitsbewijs_nummer);
            $stmt->bindParam(":Opmerkingen", $param_Opmerkingen);

            // Stel paramaters in
            $param_Student_ID = $Student_ID;
            $param_Reis_ID = $Reis_ID;
            $param_Studentnummer = $Studentnummer;
            $param_Identiteitsbewijs_nummer = $Identiteitsbewijs_nummer;
            $param_Opmerkingen = $Opmerkingen;


            var_dump($stmt);
            // Poging om de prepared statement uit te voeren
            if($stmt->execute()){
                // Records succesvol aangemaakt. Doorverwijzen naar reis pagina
                header("location: reis_inschrijf.php");
                exit();
            } else{
                echo "Oops! Er is iets fout gegaan. Probeer het later opnieuw.";
            }
        }
        // Sluit de statement
        unset($stmt);
    }

    // Sluit de connectie
    unset($pdo);
}

?>
