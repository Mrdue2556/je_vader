<?php

// Controleer het bestaan van de id-parameter voordat deze verder word verwerkt.
if (isset($_GET["Reis_ID"]) && !empty(trim($_GET["Reis_ID"]))){
    // Voeg config bestand toe
    include "../../config/config.php";

    // Bereid een select statement.
    $sql = "SELECT * FROM Reis WHERE Reis_ID = :Reis_ID";

    if ($stmt = $pdo->prepare($sql)){
        // Bind variabelen aan de prepared statement als parameters
        $stmt->bindParam(":Reis_ID", $param_User_ID);

        // Zet parameters.
        $param_User_ID = trim($_GET["Reis_ID"]);

        // Poging om de prepared statement uit te voeren.
        if ($stmt->execute()){
            if ($stmt->rowCount() == 1){
                // Haal de resultaatrij op als een associatieve array.
                // Sinds de result set een rij bevat, hoeft er geen while loop gebruikt te worden.
                $rij = $stmt->fetch(PDO::FETCH_ASSOC);

                // Haal individuele veldwaarden op
                $Omschrijving = $rij["Omschrijving"];
                $Begindatum = $rij["Begindatum"];
                $Einddatum = $rij["Einddatum"];
            } else{
                // URL bevat geen geldige ID-parameter. Doorverwijzen naar error pagina.
                header("location: error_page.php");
                exit();
            }
        } else{
            echo "Oops! Er is iets fout gegaan. Probeer het later opnieuw.";
        }
    }

    // Sluit de statement.
    unset($stmt);

    // Sluit de connectie.
    unset($pdo);
} else{
    // URL bevat geen id-parameter. Doorverwijzen naar foutpagina.
    header("location: ../error_page.php");
    exit();
}
?>

<!-- Html Code -->
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Toon Gebruikers</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/stylesheet.css">
</head>
<body>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="mt-5">Reis Gegevens</h1>
                <form>
                    <div class="form-group">
                        <label>Omschrijving</label>
                        <p><textarea disabled><?php echo $rij["Omschrijving"]; ?></textarea></p>
                    </div>
                    <div class="form-group">
                        <label>Begindatum</label>
                        <p><input disabled type="date" value="<?php echo $rij["Begindatum"]; ?>"></p>
                    </div>
                    <div class="form-group">
                        <label>Einddatum</label>
                        <p><input disabled type="date" value="<?php echo $rij["Einddatum"]; ?>"></p>
                    </div>
                </form>
                <p><a href="reis.php" class="btn btn-primary">Terug</a></p>
            </div>
        </div>
    </div>
</div>
</body>
</html>

