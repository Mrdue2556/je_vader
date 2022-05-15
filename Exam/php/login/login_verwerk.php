<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ../index.php");
    exit;
}

// Include config file
include "../config/config.php";


// Geeft de variables Lege values
$Email = $Wachtwoord = "";
$Email_err = $Wachtwoord_err = $login_err = "";

// Form verwerken wanneer formulier wordt ingediend
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Controleer of "username" leeg is
    if(empty(trim($_POST["Email"]))){
        $Email_err = "Please enter username.";
    } else{
        $Email = trim($_POST["Email"]);
    }

    // Controleer of "password" leeg is
    if(empty(trim($_POST["Wachtwoord"]))){
        $Wachtwoord_err = "Please enter your password.";
    } else{
        $Wachtwoord = trim($_POST["Wachtwoord"]);
    }

    // Valideer credentials
    if(empty($Email_err) && empty($Wachtwoord_err)){

        // Prepare en select statement
        $sql = "SELECT User_ID, Email, Wachtwoord FROM Gebruikers WHERE Email = :Email";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables aan de prepared statement als parameters
            $stmt->bindParam(":Email", $param_Email, PDO::PARAM_STR);

            // Zet parameters
            $param_Email = trim($_POST["Email"]);

            // Execute de prepared statement
            if($stmt->execute()){
                // Controleer of de "username" bestaat, zo ja, verifieer dan het "password"
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $User_ID = $row["User_ID"];
                        $Email = $row["Email"];
                        $hashed_password = $row["Wachtwoord"];

                        if(password_verify($Wachtwoord, $hashed_password)){
                            // Password is correct, start een nieuwe session
                            session_start();

                            // Stopt de data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["User_ID"] = $User_ID;
                            $_SESSION["Email"] = $Email;

                            // Stuurd de gebruiker naar de index.php
                            header("location: ../index.php");
                        } else{
                            // Password is niet geldig, geef een algemene foutmelding weer
                            $login_err = "Wachtwoord klopt niet.";
                            var_dump($stmt);
                        }
                    }
                } else{
                    // "Username" doesn't exist, display a generic error message
                    $login_err = "Email klopt niet.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }

    // Close connection
    unset($pdo);
}
?>
