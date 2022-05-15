<?php
// Voeg config bestand toe
include "../config/config.php";

// Laat foutmeldingen zien.
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Definieer variabelen en initialiseer met lege waarden
$Email = $Gebruikersnaam = $Wachtwoord = $Level ="";
$Email_err = $Gebruikersnaam_err = $Wachtwoord_err = $Level_err = "";

// Formuliergegevens verwerken wanneer formulier wordt ingediend
if ($_SERVER["REQUEST_METHOD"] == "POST"){

    // Email valideren
    $input_Email = trim($_POST["Email"]);
    if(empty($input_Email)) {
        $Email_err = "Voer een email in.";
    } else{
        $Email = $input_Email;
    }

    // Gebruikersnaam valideren
    $input_Gebruikersnaam = trim($_POST["Gebruikersnaam"]);
    if(empty($input_Gebruikersnaam)){
        $Gebruikersnaam_err = "Voer een gebruiekrsnaam in.";
    } else{
        $Gebruikersnaam = $input_Gebruikersnaam;
    }

    // Wachtwoord valideren
    $input_Wachtwoord = trim($_POST["Wachtwoord"]);
    if (empty($input_Wachtwoord)){
        $Wachtwoord_err = "Voer een wachtwoord in.";
    } else{
        $Wachtwoord = $input_Wachtwoord;
    }

    $input_Level = trim($_POST["Level"]);
    if (empty($input_Level)){
        $Level_err = "Kies een rol.";
    } else{
        $Level = $input_Level;
    }


    // Controleer invoerfouten voordat de data in de database ingevoegd word
    if(empty($Email_err) && empty($Gebruikersnaam_err) && empty($Wachtwoord_err) && empty($Level_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO Gebruikers (Email, Gebruikersnaam, Wachtwoord, Level) VALUES (:Email, :Gebruikersnaam, :Wachtwoord, :Level)";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":Email", $param_Email);
            $stmt->bindParam(":Gebruikersnaam", $param_Gebruikersnaam);
            $stmt->bindParam(":Wachtwoord", $param_Wachtwoord);
            $stmt->bindParam(":Level", $param_Level);

            // Set parameters
            $param_Email = $Email;
            $param_Gebruikersnaam = $Gebruikersnaam;
            $param_Wachtwoord = $Wachtwoord;
            $param_Level = $Level;

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records created successfully. Redirect to landing page
                header("location: ../index.php");
                exit();
            } else{
                echo "Oops! Er is iets fout gegaan. Probeer het later opnieuw.";
            }
        }

        // Close statement
        unset($stmt);
    }

    // Close connection
    unset($pdo);
}
?>
