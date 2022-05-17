<?php
// Voeg config bestand toe
include "../../config/config.php";

// Laat foutmeldingen zien.
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Definieer variabelen en initialiseer met lege waarden
$Titel = $Bestemming = $Omschrijving = $Begindatum= $Einddatum ="";
$Titel_err = $Bestemming_err = $Omschrijving_err = $Begindatum_err = $Einddatum_err  = "";

// Formuliergegevens verwerken wanneer formulier wordt ingediend
if ($_SERVER["REQUEST_METHOD"] == "POST"){

    // Titel valideren
    $input_Titel = trim($_POST["Titel"]);
    if(empty($input_Titel)) {
        $Titel_err = "Voer de titel in.";
    } else{
        $Titel = $input_Titel;
    }

    // Bestemming valideren
    $input_Bestemming = trim($_POST["Bestemming"]);
    if(empty($input_Bestemming)) {
        $Bestemming_err = "Voer de bestemming in.";
    } else{
        $Bestemming = $input_Bestemming;
    }

    // Omschrijving valideren
    $input_Omschrijving = trim($_POST["Omschrijving"]);
    if(empty($input_Omschrijving)) {
        $Omschrijving_err = "Voer de omschrijving in.";
    } else{
        $Omschrijving = $input_Omschrijving;
    }

    // Begindatum valideren
    $input_Begindatum = trim($_POST["Begindatum"]);
    if(empty($input_Begindatum)){
        $Begindatum_err = "Voer de begindatum.";
    } else{
        $Begindatum = $input_Begindatum;
    }

    // Einddatum valideren
    $input_Einddatum = trim($_POST["Einddatum"]);
    if (empty($input_Einddatum)){
        $Einddatum_err = "Voer de einddatum";
    } else{
        $Einddatum = $input_Einddatum;
    }


    // Controleer invoerfouten voordat de data in de database ingevoegd word
    if(empty($Omschrijving_err) && empty($Begindatum_err) && empty($Einddatum_err)){
        // Bereid een inster statement voor
        $sql = "INSERT INTO Reis(Titel, Bestemming, Omschrijving, Begindatum, Einddatum) VALUES (:Titel, :Bestemming, :Omschrijving, :Begindatum, :Einddatum)";

        if($stmt = $pdo->prepare($sql)){
            //Bind variabelen aan de prepared statement als parameters
            $stmt->bindParam(":Titel", $param_Titel);
            $stmt->bindParam(":Bestemming", $param_Bestemming);
            $stmt->bindParam(":Omschrijving", $param_Omschrijving);
            $stmt->bindParam(":Begindatum", $param_Begindatum);
            $stmt->bindParam(":Einddatum", $param_Einddatum);

            // Stel paramaters in
            $param_Titel = $Titel;
            $param_Bestemming = $Bestemming;
            $param_Omschrijving = $Omschrijving;
            $param_Begindatum = $Begindatum;
            $param_Einddatum = $Einddatum;

            // Poging om de prepared statement uit te voeren
            if($stmt->execute()){
                // Records succesvol aangemaakt. Doorverwijzen naar reis pagina
                header("location: reis.php");
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