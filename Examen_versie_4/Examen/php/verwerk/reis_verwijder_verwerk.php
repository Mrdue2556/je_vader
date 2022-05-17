<?php
// Verwerk verwijderingsbewerking na bevestiging.
if (isset($_POST["Reis_ID"]) && !empty($_POST["Reis_ID"])){
    // Voeg config bestand toe
    include "../../config/config.php";

    // Bereid een verwijder statement voor.
    $sql = "DELETE FROM Reis WHERE Reis_ID = :Reis_ID";

    if ($stmt = $pdo->prepare($sql)){
        // Bind variabelen aan de prepared statement als parameters.
        $stmt->bindParam(":Reis_ID", $param_Reis_ID);

        // Zet parameters.
        $param_Reis_ID = trim($_POST["Reis_ID"]);

        // Poging om de prepared statement uit te voeren.
        if ($stmt->execute()){
            // Records succesvol verwijderd. Doorverwijzen naar bestemmingspagina.
            header("location: reis.php");
            exit();
        } else{
            echo "Oops! Er is iets fout gegaan. Probeer het later opnieuw.";
        }
    }
    // Sluit de statement
    unset($stmt);

    // Sluit de connectie.
    unset($pdo);
} else{
    // Controleer het bestaan de id-parameter.
    if (empty(trim($_GET["Reis_ID"]))){
        // URL bevat geen id-parameter. Doorverwijzen naar foutpagina.
        header("location: ../error_page.php");
        exit();
    }
}