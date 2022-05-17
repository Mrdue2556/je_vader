<?php
// Functie om te checken hoeveel studenten nog kunnen inloggen
function Counter($Reis_ID, $pdo) {

    $sql = "SELECT * FROM reis_inschrijf WHERE Reis_ID = :Reis_ID";
    if($stmt2 = $pdo->prepare($sql)){
        //Bind variabelen aan de prepared statement als parameters
        $stmt2->bindParam(":Reis_ID", $Reis_ID);

        // Poging om de prepared statement uit te voeren
        if($stmt2->execute() && $stmt2->rowCount() > 0){

            // Krijg de data van de command
            $Inschrijvingen = $stmt2->fetchAll();

            // Tel de inschrijvingen
            $InschrijvingenCount = count($Inschrijvingen);

            // Check of er data bestaat
            if (isset($InschrijvingenCount)){
                return $InschrijvingenCount;
            }
        }
    }
}