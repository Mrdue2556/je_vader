<?php

// Voeg gebruiker toevoeg bestand toe
include "../../php/verwerk/reis_toevoeg_verwerk.php";

// Laat foutmeldingen zien.
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/stylesheet.css">
</head>
<body>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mt-5">Create Record</h2>
                <p>Please fill this form and submit to add employee record to the database.</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">

                        <div class="form-group">
                            <label>Titel</label>
                            <input type="text" name="Titel" class="form-control <?php echo (!empty($Titel_err)) ? 'is-invalid' : ''; ?>"
                                   value="<?php echo $Titel; ?>" >
                            <span class="invalid-feedback"><?php echo $Titel_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Bestemming</label>
                            <input type="text" name="Bestemming" class="form-control <?php echo (!empty($Bestemming_err)) ? 'is-invalid' : ''; ?>"
                                   value="<?php echo $Bestemming; ?>" >
                            <span class="invalid-feedback"><?php echo $Bestemming_err;?></span>
                        </div>
                        <label>Omschrijving</label>
                        <textarea name="Omschrijving" class="form-control <?php echo (!empty($Omschrijving_err)) ? 'is-invalid' : ''; ?>"><?php echo $Omschrijving; ?></textarea>
                        <span class="invalid-feedback"><?php echo $Omschrijving_err;?></span>
                    </div>
                    <div class="form-group">
                        <label>Begindatum</label>
                        <input type="date" name="Begindatum" class="form-control <?php echo (!empty($Begindatum_err)) ? 'is-invalid' : ''; ?>"
                               value="<?php echo $Begindatum; ?>" >
                        <span class="invalid-feedback"><?php echo $Begindatum_err;?></span>
                    </div>
                    <div class="form-group">
                        <label>Einddatum</label>
                        <input type="date" name="Einddatum" class="form-control <?php echo (!empty($Einddatum_err)) ? 'is-invalid' : ''; ?>"
                               value="<?php echo $Einddatum; ?>">
                        <span class="invalid-feedback"><?php echo $Einddatum_err;?></span>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <a href="reis.php" class="btn btn-secondary ml-2">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>