<?php
// Voeg delete.php bestand toe
include "../../php/verwerk/reis_verwijder_verwerk.php";
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
<title>Verwijder Gebruiker</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="../../assets/css/stylesheet.css">
</head>
<body>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mt-5 mb-3">Verwijder Gebruiker</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="alert alert-danger">
                        <input type="hidden" name="Reis_ID" value="<?php echo trim($_GET["Reis_ID"]); ?>" />
                        <p>Weet u zeker dat u de reis wilt verwijderen?</p>
                        <input type="submit" value="Ja" class="btn btn-danger">
                        <a href="reis.php" class="btn btn-secondary">Nee</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
