<?php
// Verwerk verwijderingsbewerking na bevestiging.
if (isset($_POST["User_ID"]) && !empty($_POST["User_ID"])){
    // Voeg config bestand toe
    include "../config/config.php";

    // Bereid een verwijder statement voor.
    $sql = "DELETE FROM Gebruikers WHERE User_ID = :User_ID";

    if ($stmt = $pdo->prepare($sql)){
        // Bind variabelen aan de prepared statement als parameters.
        $stmt->bindParam(":User_ID", $param_User_ID);

        // Zet parameters.
        $param_User_ID = trim($_POST["User_ID"]);

        // Poging om de prepared statement uit te voeren.
        if ($stmt->execute()){
            // Records succesvol verwijderd. Doorverwijzen naar bestemmingspagina.
            header("location: ../index.php");
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
    if (empty(trim($_GET["User_ID"]))){
        // URL bevat geen id-parameter. Doorverwijzen naar foutpagina.
        header("location: ../pages/error_page.php");
        exit();
    }
}