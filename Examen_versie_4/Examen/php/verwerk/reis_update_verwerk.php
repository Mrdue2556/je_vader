<?php
// Voeg config bestand toe.
include "../../config/config.php";

// Definieer variabelen en initialiseer met lege waarden
$Omschrijving = $Begindatum = $Einddatum = "";
$Omschrijving_err = $Begindatum_err = $Einddatum_err = "";

//Formuliergegevens verwerken wanneer formulier wordt ingediend
if(isset($_POST["Reis_ID"]) && !empty($_POST["Reis_ID"])){
    // Verborgen invoerwaarde ophalen
    $Reis_ID = $_POST["Reis_ID"];

    // Valideer de omschrijving van de reis
    $input_Omschrijving = trim($_POST["Omschrijving"]);
    if (empty($input_Omschrijving)){
        $Omschrijving_err = "Voer de omschrijving van de reis in.";
    } else{
        $Omschrijving = $input_Omschrijving;
    }

    // Valideer de begindatum
    $input_Begindatum = trim($_POST["Begindatum"]);
    if(empty($input_Begindatum)){
        $Begindatum_err = "Please enter an address.";
    } else{
        $Begindatum = $input_Begindatum;
    }

    // Valideer de einddatum
    $input_Einddatum = trim($_POST["Einddatum"]);
    if(empty($input_Einddatum)){
        $Einddatum_err = "Please enter the salary amount.";
    } else{
        $Einddatum = $input_Einddatum;
    }

    //Controleer invoerfouten voordat u deze in de database invoegt
    if(empty($Omschrijving_err) && empty($Begindatum_erre) && empty($Einddatum_err)){
        // Bereid een update statement voor
        $sql = "UPDATE Reis SET Omschrijving=:Omschrijving, Begindatum=:Begindatum, Einddatum=:Einddatum WHERE Reis_ID=:Reis_ID";

        if($stmt = $pdo->prepare($sql)){
            // Bind variabelen aan de prepared statement als parameters
            $stmt->bindParam(":Omschrijving", $param_Omschrijving);
            $stmt->bindParam(":Begindatum", $param_Begindatum);
            $stmt->bindParam(":Einddatum", $param_Einddatum);
            $stmt->bindParam(":Reis_ID", $param_Reis_ID);

            // Stel parameters in
            $param_Omschrijving = $Omschrijving;
            $param_Begindatum = $Begindatum;
            $param_Einddatum = $Einddatum;
            $param_Reis_ID = $Reis_ID;

            // Poging om de prepared statement uit te voeren
            if($stmt->execute()){
                // Records zijn bijgewerkt. Doorverwijzen naar reis pagina
                header("location: reis.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Sluit de statement
        unset($stmt);
    }

    // Sluit de connectie
    unset($pdo);
} else{
    //Controleer het bestaan van de id-parameter voordat u deze verder verwerkt
    if(isset($_GET["Reis_ID"]) && !empty(trim($_GET["Reis_ID"]))){
        // URL-parameter ophalen
        $Reis_ID =  trim($_GET["Reis_ID"]);

        // Bereid een select statement voor
        $sql = "SELECT * FROM Reis WHERE Reis_ID = :Reis_ID";
        if($stmt = $pdo->prepare($sql)){
            //Bind variabelen aan de prepared statement als parameters
            $stmt->bindParam(":Reis_ID", $param_Reis_ID);

            // Stel de parameters in
            $param_Reis_ID = $Reis_ID;

            //Poging om de prepared statement uit te voeren
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    // Haal de resultaatrij op als een associatieve array.
                    // Sinds de resultatenset bevat slechts één rij, we hoeven geen while loop gebruikt te worden
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);

                    // Individuele veldwaarde ophalen
                    $Omschrijving = $row["Omschrijving"];
                    $Begindatum = $row["Begindatum"];
                    $Einddatum = $row["Einddatum"];
                } else{
                    // URL bevat geen geldige ID. Doorverwijzen naar error page
                    header("location: ../error_page.php");
                    exit();
                }

            } else{
                echo "Oeps! Er is iets fout gegaan. Probeer het later opnieuw.";
            }
        }

        // Sluit de statement
        unset($stmt);

        // Sluit de connectie
        unset($pdo);
    }  else{
        // URL bevat geen reis_id parameter. Doorverwijzen naar error page
        header("location: ../error_page.php");
        exit();
    }
}