<?php
// Voeg delete.php bestand toe
include "../php/verwerk/delete.php";
?>

<!DOCTYPE html>
<html lang="nl>
<head>
    <meta charset="UTF-8">
    <title>Verwijder Gebruiker</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5 mb-3">Verwijder Gebruiker</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger">
                            <input type="hidden" name="User_ID" value="<?php echo trim($_GET["User_ID"]); ?>" />
                            <p>Weet u zeker dat u dit gebruiker wilt verwijderen?</p>
                            <input type="submit" value="Ja" class="btn btn-danger">
                            <a href="../index.php" class="btn btn-secondary">Nee</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>