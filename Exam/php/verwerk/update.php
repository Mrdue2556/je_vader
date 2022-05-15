<?php
// Voeg config bestand toe.
require_once "../config/config.php";

// Definieer variabelen en initialiseer met lege waarden.
$Email = $Gebruikersnaam = $Wachtwoord = $Level =  "";
$Email_err = $Gebruikersnaam_err = $Wachtwoord_err = $Level_err = "";

// Formuliergegevens verwerken wanneer formulier wordt ingediend.
if (isset($_POST["User_ID"]) && !empty($_POST["User_ID"])){
    // Verborgen invoerwaarde ophalen.
    $User_ID = $_POST["User_ID"];

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
        $Gebruikersnaam_err = "Voer een gebruikersnaam in.";
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

    // Controleer invoerfouten voordat het in de database word ingevoegd.
    if (empty($Email_err) && empty($Gebruikersnaam_err) && empty($Wachtwoord_err)){
        // Bereid een update statement voor.
        $sql = "UPDATE Users SET Email=:Email, Gebruikersnaam=:Gebruikersnaam, Wachtwoord=:Wachtwoord, Level=:Level WHERE User_ID=:User_ID";

        if ($stmt = $pdo->prepare($sql)){
            // Bind variabelen aan de prepared statement als parameters.
            $stmt->bindParam(":Email", $param_Email);
            $stmt->bindParam(":Gebruikersnaam", $param_Gebruikersnaam);
            $stmt->bindParam(":Wachtwoord", $param_Wachtwoord);
            $stmt->bindParam(":User_ID", $param_User_ID);
            $stmt->bindParam("Level", $param_Level);

            // Zet parameters.
            $param_Email = $Email;
            $param_Gebruikersnaam = $Gebruikersnaam;
            $param_Wachtwoord = $Wachtwoord;
            $param_User_ID = $User_ID;
            $param_Level = $Level;

            // Poging om de prepared statement uit te voeren
            if ($stmt->execute()){
                // Records zijn bijgewerkt. Doorverwijzen naar landing pagina.
                header("location: ../index.php");
                exit();
            } else{
                echo "Oops! Er is iets fout gegaan. Probeer het later opnieuw.";
            }
        }

        // Sluit statement
        unset($stmt);
    }

    // Sluit connectie
    unset($pdo);
} else{
    // Controleer het bestaan  de id-parameter voordat u deze verder verwerkt.
    if (isset($_GET["User_ID"]) && !empty(trim($_GET["User_ID"]))){
        // URL-parameter ophalen
        $User_ID = trim($_GET["User_ID"]);

        // Bereid een prepared statement voor.
        $sql = "SELECT * FROM Gebruikers WHERE User_ID = :User_ID";
        if ($stmt = $pdo->prepare($sql)){
            // Bind variabelen aan de prepared statement als parameters.
            $stmt->bindParam(":User_ID", $param_User_ID);

            // Zet parameters.
            $param_User_ID = $User_ID;

            // Poging om de prepared statement uit te voeren.
            if ($stmt->execute()){
                if ($stmt->rowCount() == 1){
                    // Haal de resultaatrij op als een associatieve array.
                    // Sinds de resultatenset één rij bevat, hoeft er geen while loop gebruikt te worden.
                    $rij = $stmt->fetch(PDO::FETCH_ASSOC);

                    // Individuele veldwaarde ophalen
                    $Email = $rij["Email"];
                    $Gebruikersnaam = $rij["Gebruikersnaam"];
                    $Wachtwoord = $rij["Wachtwoord"];
                    $Level = $rij["Level"];
                } else{
                    // URL bevat geen geldige ID. Doorverwijzen naar foutpagina.
                    header("location: ../pages/error_page.php");
                    exit();
                }
            } else {
                echo "Oops! Er is iets fout gegaan. Probeer het later opnieuw.";
            }
        }

        // Sluit de statement.
        unset($stmt);

        // Sluit de connectie.
        unset($pdo);
    } else{
        // URL bevat geen geldige ID. Doorverwijzen naar foutpagina.
        header("location: ../pages/error_page.php");
        exit();
    }
}