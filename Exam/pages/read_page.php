<?php

// Controleer het bestaan van de id-parameter voordat deze verder word verwerkt.
if (isset($_GET["User_ID"]) && !empty(trim($_GET["User_ID"]))){
    // Voeg config bestand toe
    include "../config/config.php";

    // Bereid een select statement.
    $sql = "SELECT * FROM Gebruikers WHERE User_ID = :User_ID";

    if ($stmt = $pdo->prepare($sql)){
        // Bind variabelen aan de prepared statement als parameters
        $stmt->bindParam(":User_ID", $param_User_ID);

        // Zet parameters.
        $param_User_ID = trim($_GET["User_ID"]);

        // Poging om de prepared statement uit te voeren.
        if ($stmt->execute()){
            if ($stmt->rowCount() == 1){
                // Haal de resultaatrij op als een associatieve array.
                // Sinds de result set een rij bevat, hoeft er geen while loop gebruikt te worden.
                $rij = $stmt->fetch(PDO::FETCH_ASSOC);

                // Haal individuele veldwaarden op
                $Email = $rij["Email"];
                $Gebruikersnaam = $rij["Gebruikersnaam"];
                $Wachtwoord = $rij["Wachtwoord"];
                $Level = $rij["Level"];
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
    header("location: error_page.php");
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
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">Toon Gegevens</h1>
                    <div class="form-group">
                        <label>Email</label>
                        <p><b><?php echo $rij["Email"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Gebruikersnaam</label>
                        <p><b><?php echo $rij["Gebruikersnaam"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Wachtwoord</label>
                        <p><b><?php echo $rij["Wachtwoord"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Level</label>
                        <select class="form-control" name="Level" disabled>
                            <option value="">Kies een rol</option>
                            <option <?php echo ($Level == '1')?"selected":"" ?> value="1" >Gebruiker</option>
                            <option <?php echo ($Level == '2')?"selected":"" ?> value="2" >Admin</option>
                        </select>
                    </div>
                    <p><a href="../index.php" class="btn btn-primary">Terug</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
