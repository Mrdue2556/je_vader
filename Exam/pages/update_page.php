<?php
// Voeg update.php bestand toe.
include "../php/verwerk/update.php";
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Update Gebruiker</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Update Gebruiker</h2>
                    <p>Bewerk de ingevoerde waarden en verzend deze om de gebruiker te updaten.</p>
                </div>
                <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="Email" class="form-control <?php echo (!empty($Email_err)) ? 'is-invalid' : ''; ?>"
                        value="<?php echo $Email; ?>">
                        <span class="invalid-feedback" <?php echo $Email_err; ?>></span>
                    </div>
                    <div class="form-group">
                        <label>Gebruikersnaam</label>
                        <input name="Gebruikersnaam" class="form-control <?php echo (!empty($Gebruikersnaam_err)) ? 'is-invalid' : ''; ?>"
                        value="<?php echo $Gebruikersnaam; ?>">
                        <span class="invalid-feedback" <?php echo $Gebruikersnaam_err; ?>></span>
                    </div>
                    <div class="form-group">
                        <label>Wachtwoord</label>
                        <input type="password" name="Wachtwoord" class="form-control <?php echo (!empty($Wachtwoord_err)) ? 'is-invalid' : ''; ?>"
                        value="<?php echo $Wachtwoord; ?>">
                        <span class="invalid-feedback" <?php echo $Wachtwoord_err; ?>></span>
                    </div>
                    <div class="form-group">
                        <label>Level</label>
                        <select class="form-control <?php echo (!empty($Level_err)) ? 'is-invalid' : ""; ?>" name="Level">
                            <option value="">Kies een rol</option>
                            <option <?php echo ($Level == '1')?"selected":"" ?> value="1" >Gebruiker</option>
                            <option <?php echo ($Level == '2')?"selected":"" ?> value="2" >Admin</option>
                        </select>
                        <span class="invalid-feedback"><?php echo $Level_err;?></span>
                    </div>
                    <input type="hidden" name="User_ID" value="<?php echo $User_ID; ?>">
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <a href="../index.php" class="btn btn-secondary ml-2">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>