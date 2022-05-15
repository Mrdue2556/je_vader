<?php
// Voeg gebruiker toevoeg bestand toe
include "../php/verwerk/create.php";

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
    <link rel="stylesheet" href="../assets/css/style.css">
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
                        <label>Email</label>
                        <input type="email" name="Email" class="form-control <?php echo (!empty($Email_err)) ? 'is-invalid' : ''; ?>"
                               value="<?php echo $Email; ?>">
                        <span class="invalid-feedback"><?php echo $Email_err;?></span>
                    </div>
                    <div class="form-group">
                        <label>Gebruikersnaam</label>
                        <input name="Gebruikersnaam" class="form-control <?php echo (!empty($Gebruikersnaam_err)) ? 'is-invalid' : ''; ?>"
                               value="<?php echo $Gebruikersnaam; ?>" >
                        <span class="invalid-feedback"><?php echo $Gebruikersnaam_err;?></span>
                    </div>
                    <div class="form-group">
                        <label>Wachtwoord</label>
                        <input type="password" name="Wachtwoord" class="form-control <?php echo (!empty($Wachtwoord_err)) ? 'is-invalid' : ''; ?>"
                               value="<?php echo $Wachtwoord; ?>">
                        <span class="invalid-feedback"><?php echo $Wachtwoord_err;?></span>
                    </div>
                    <div class="form-group">
                        <label>Level</label>
                        <select class="form-control <?php echo (!empty($Level_err)) ? 'is-invalid' : ""; ?>" name="Level">
                            <option selected="selected" value="">Kies een rol</option>
                            <option value="1" >Gebruiker</option>
                            <option value="2" >Admin</option>
                        </select>
                        <span class="invalid-feedback"><?php echo $Level_err;?></span>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <a href="../index.php" class="btn btn-secondary ml-2">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>