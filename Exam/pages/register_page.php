<?php
include "../php/login/register_verwerk.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<div class="wrapper">
    <h2>Sign Up</h2>
    <p>Please fill this form to create an account.</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label>Username</label>
            <input type="Email" name="Email" class="form-control <?php echo (!empty($Email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Email; ?>">
            <span class="invalid-feedback"><?php echo $Email_err; ?></span>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="Wachtwoord" class="form-control <?php echo (!empty($Wachtwoord_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Wachtwoord_err; ?>">
            <span class="invalid-feedback"><?php echo $Wachtwoord_err; ?></span>
        </div>
        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="confirm_Wachtwoord" class="form-control <?php echo (!empty($confirm_Wachtwoord_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_Wachtwoord; ?>">
            <span class="invalid-feedback"><?php echo $confirm_Wachtwoord_err; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit">
            <input type="reset" class="btn btn-secondary ml-2" value="Reset">
        </div>
        <p>Already have an account? <a href="login_page.php">Login here</a>.</p>
    </form>
</div>
</body>
</html>
