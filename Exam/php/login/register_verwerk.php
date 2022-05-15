<?php
// Include config file
include "../config/config.php";

// Define variables and initialize with empty values
$Email = $Wachtwoord = $confirm_Wachtwoord = "";
$Email_err = $Wachtwoord_err = $confirm_Wachtwoord_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate username
    if(empty(trim($_POST["Email"]))){
        $username_err = "Please enter a Email.";
    } else{
        // Prepare a select statement
        $sql = "SELECT User_ID FROM Gebruikers WHERE Email = :Email";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":Email", $param_Email, PDO::PARAM_STR);

            // Set parameters
            $param_Email = trim($_POST["Email"]);

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $Email_err = "This username is already taken.";
                } else{
                    $Email = trim($_POST["Email"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }

    // Validate password
    if(empty(trim($_POST["Wachtwoord"]))){
        $Wachtwoord_err = "Please enter a password.";
    } elseif(strlen(trim($_POST["Wachtwoord"])) < 6){
        $Wachtwoord_err = "Password must have atleast 6 characters.";
    } else{
        $Wachtwoord= trim($_POST["Wachtwoord"]);
    }

    // Validate confirm password
    if(empty(trim($_POST["confirm_Wachtwoord"]))){
        $confirm_Wachtwoord_err = "Please confirm Wachtwoord.";
    } else{
        $confirm_Wachtwoord = trim($_POST["confirm_Wachtwoord"]);
        if(empty($Wachtwoord_err) && ($Wachtwoord != $confirm_Wachtwoord)){
            $confirm_Wachtwoord_err = "Password did not match.";
        }
    }

    // Check input errors before inserting in database
    if(empty($Email_err) && empty($Wachtwoord_err) && empty($confirm_Wachtwoord_err)){

        // Prepare an insert statement
        $sql = "INSERT INTO Gebruikers (Email, Wachtwoord) VALUES (:Email, :Wachtwoord)";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":Email", $param_Email, PDO::PARAM_STR);
            $stmt->bindParam(":Wachtwoord", $param_Wachtwoord, PDO::PARAM_STR);

            // Set parameters
            $param_Email = $Email;
            $param_Wachtwoord = password_hash($Wachtwoord, PASSWORD_DEFAULT); // Creates a password hash

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                header("location: login_page.php");
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
