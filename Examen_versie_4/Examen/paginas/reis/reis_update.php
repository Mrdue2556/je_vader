<?php
// Voeg update.php bestand toe.
include "../../php/verwerk/reis_update_verwerk.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Reis</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/stylesheet.css">
</head>
<body>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mt-5">Update Record</h2>
                <p>Please edit the input values and submit to update the employee record.</p>
                <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                    <div class="form-group">
                        <div class="form-group">
                            <label>Address</label>
                            <textarea name="Omschrijving" class="form-control <?php echo (!empty($Omschrijving_err)) ? 'is-invalid' : ''; ?>"><?php echo $Omschrijving; ?></textarea>
                            <span class="invalid-feedback"><?php echo $Omschrijving_err;?></span>
                        </div>
                        <label>Name</label>
                        <input type="date" name="Begindatum" class="form-control <?php echo (!empty($Begindatum_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Begindatum; ?>">
                        <span class="invalid-feedback"><?php echo $Begindatum_err;?></span>
                    </div>
                    <div class="form-group">
                        <label>Salary</label>
                        <input type="date" name="Einddatum" class="form-control <?php echo (!empty($Einddatum_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Einddatum; ?>">
                        <span class="invalid-feedback"><?php echo $Einddatum_err;?></span>
                    </div>
                    <input type="hidden" name="Reis_ID" value="<?php echo $Reis_ID; ?>"/>
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <a href="reis.php" class="btn btn-secondary ml-2">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
