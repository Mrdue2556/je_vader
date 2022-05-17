<?php
session_start();
include "../../php/verwerk/reis_inschrijf_verwerk.php";

// Controleer het bestaan van de id-parameter voordat deze verder word verwerkt.
if (isset($_GET["Reis_ID"]) && !empty(trim($_GET["Reis_ID"]))){
    // Voeg config bestand toe


    // Bereid een select statement.
    $sql = "SELECT * FROM Reis WHERE Reis_ID = :Reis_ID";

    if ($stmt = $pdo->prepare($sql)){
        // Bind variabelen aan de prepared statement als parameters
        $stmt->bindParam(":Reis_ID", $param_Reis_ID);

        // Stel parameters in
        $param_Reis_ID = trim($_GET["Reis_ID"]);

        // Poging om de prepared statement uit te voeren.
        if ($stmt->execute()){
            if ($stmt->rowCount() == 1){
                // Haal de resultaatrij op als een associatieve array.
                // Sinds de result set een rij bevat, hoeft er geen while loop gebruikt te worden.
                $rij = $stmt->fetch(PDO::FETCH_ASSOC);

                // Haal individuele veldwaarden op
                $Reis_ID = $rij["Reis_ID"];
                $Titel = $rij["Titel"];
                $Bestemming = $rij["Bestemming"];
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

}
?>
<!-- Html Code -->
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Inschrijf</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/stylesheet.css">
</head>
<body>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="mt-5">Reis detail</h1>
                <form>
                    <div class="form-group">
                        <label>Titel</label>
                        <p><textarea disabled><?php echo $rij["Titel"]; ?></textarea></p>
                    </div>
                    <div class="form-group">
                        <label>Bestemming</label>
                        <p><textarea disabled><?php echo $rij["Bestemming"]; ?></textarea></p>
                    </div>
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

                <hr class="mt-4 mb-4"/>
                <h1>Schrijf je in</h1>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                    <div class="form-group">
                        <label>Identiteitsbewijs nummer</label>
                        <input type="number" name="Identiteitsbewijs_nummer" class="form-control <?php echo (!empty($Identiteitsbewijs_nummer_err)) ? 'is-invalid' : ''; ?>"
                               value="<?php echo $Identiteitsbewijs_nummer; ?>">
                        <span class="invalid-feedback"><?php echo $Identiteitsbewijs_nummer_err	;?></span>
                    </div>
                    <div class="form-group">
                        <label>Opmerkingen</label>
                        <textarea name="Opmerkingen" class="form-control"><?php echo $Opmerkingen; ?></textarea>
                    </div>
                    <input type="submit" class="btn btn-success mb-5" value="Schrijf in">
                    <a href="reis_inschrijf.php" class="btn btn-secondary ml-2 mb-5">Terug</a>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>

