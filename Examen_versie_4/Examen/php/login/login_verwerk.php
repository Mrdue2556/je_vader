<?php
// Initialize de sessie
session_start();

// Controleer of de gebruiker al is ingelogd, zo ja, stuur hem dan door naar de index pagina.
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ../../index.php");
    exit;
}

// Voeg de config bestant
require_once "../../config/config.php";

// Definieer variabelen en initialiseer met lege waarden
$Email = $Wachtwoord = "";
$Email_err = $Wachtwoord_err = $login_err = "";

// Formuliergegevens verwerken wanneer formulier wordt ingediend
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Controleer of de email leeg is
    if(empty(trim($_POST["Email"]))){
        $Email_err = "Voer een email in.";
    } else{
        $Email = trim($_POST["Email"]);
    }

    // Controleer of de wachtwoord leeg is
    if(empty(trim($_POST["Wachtwoord"]))){
        $Wachtwoord_err = "Voer een wachtwoord in.";
    } else{
        $Wachtwoord = trim($_POST["Wachtwoord"]);
    }

    // Valideer inloggegevens
    if(empty($Email_err) && empty($Wachtwoord_err)){
        // Bereid een slect statement voor
        $sql = "SELECT Student_ID, Studentnummer, Email, Wachtwoord  FROM student WHERE Email = :Email";

        if($stmt = $pdo->prepare($sql)){
            // Bind variabelen aan de voorbereide instructie als parameters
            $stmt->bindParam(":Email", $param_Email, PDO::PARAM_STR);

            //Stel parameters in
            $param_Email = trim($_POST["Email"]);

            // Poging om de preparet statement uit te voeren
            if($stmt->execute()){
                // Controleer of de email bestaat, zo ja, verifieer dan het wachtwoord
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $Student_ID = $row["Student_ID"];
                        $Email = $row["Email"];
                        $Studentnummer = $row["Studentnummer"];
                        $hashed_Wachtwoord = $row["Wachtwoord"];
                        if(password_verify($Wachtwoord, $hashed_Wachtwoord)){
                            // Wachtwoord is correct, dus start een nieuwe sessie
                            session_start();

                            //Gegevens opslaan in sessievariabelen
                            $_SESSION['loggedin'] = true;
                            $_SESSION['Student_ID'] = $Student_ID;
                            $_SESSION['Email'] = $Email;
                            $_SESSION['Studentnummer'] = $Studentnummer;

                            //Gebruiker doorverwijzen naar de index pagina
                            header("location: ../../index.php");
                        } else{
                            // Wachtwoord is niet geldig, geef een algemene foutmelding
                            $login_err = "Ongeldige wachtwoord.";
                        }
                    }
                } else{
                    // Email bestaat niet, geef een algemene foutmelding
                    $login_err = "Ongeldige email.";
                }
            } else{
                echo "Oeps! Er is iets fout gegaan. Probeer het later opnieuw.";
            }
            // Sluit de statement
            unset($stmt);
        }
    }
    // Sluit de connectie
    unset($pdo);
}
?>
