<?php
// Voeg de login_verwerk bestand
include "../../php/login/login_verwerk.php";
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
    <h2>Login</h2>
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
            <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
            <span class="invalid-feedback"><?php echo $email_err; ?></span>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="wachtwoord" class="form-control <?php echo (!empty($wachtwoord_err)) ? 'is-invalid' : ''; ?>">
            <span class="invalid-feedback"><?php echo $wachtwoord_err; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Login">
        </div>
        <p>Geen account? <a href="register.php">Registreer nu</a>.</p>
        <p>Login als <a href="admin_login.php">Admin</a>.</p>
    </form>
</div>
</body>
</html>