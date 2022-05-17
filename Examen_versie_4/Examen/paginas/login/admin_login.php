<?php
// Voeg de login_verwerk bestand
include "../../php/login/admin_login_verwerk.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/stylesheet.css">
</head>
<body>
<div class="wrapper">
    <h2>Login als admin</h2>
    <p>Please fill in your credentials to login.</p>
    <!--    Laat een error zien wanneer wachtwoord of email niet klopt. -->
    <?php
    if(!empty($login_err)){
        echo '<div class="alert alert-danger">' . $login_err . '</div>';
    }
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label>Username</label>
            <input type="email" name="Email" class="form-control <?php echo (!empty($Email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Email; ?>">
            <span class="invalid-feedback"><?php echo $Email_err; ?></span>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="Wachtwoord" class="form-control <?php echo (!empty($Wachtwoord_err)) ? 'is-invalid' : ''; ?>">
            <span class="invalid-feedback"><?php echo $Wachtwoord_err; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Login">
        </div>
    </form>
</div>
</body>
</html>
