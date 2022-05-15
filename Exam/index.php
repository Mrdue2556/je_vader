<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: pages/login_page.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Index</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">

<!-- initialiseer tooltips -->
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Gebruiker Details</h2>
                        <a href="pages/create_page.php" class="btn btn-success pull-right">
                            <i class="fa fa-plus"></i> Voeg een gebruiker toe</a>
                        <a href="php/login/loguit.php" class="btn btn-success pull-right">
                            <i class="fa fa-plus"></i> loguit</a>
                    </div>
                    <?php
                    // Voeg config bestand toe
                    require_once  "config/config.php";

                    // Poging om select query uit te voeren
                    $sql = "SELECT * FROM Gebruikers";

                    if($result = $pdo->query($sql)){
                        if ($result->rowCount() > 0){
                            echo '<table class="table table-bordered table-striped">';
                            echo "<thead>";
                                echo "<tr>";
                                    echo "<th>#</th>";
                                    echo "<th>Email</th>";
                                    echo "<th>Gebruikersnaam</th>";
                                    echo "<th>Wachtwoord</th>";
                                    echo "<th>Level</th>";
                                    echo "<th>Actie</th>";
                                echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while($rij = $result->fetch()){
                                echo "<tr>";
                                    echo "<td>" . $rij['User_ID'] . "</td>";
                                    echo "<td>" . $rij['Email'] . "</td>";
                                    echo "<td>" . $rij['Gebruikersnaam'] . "</td>";
                                    echo "<td>" . $rij["Wachtwoord"] . "</td>";
                                    echo "<td>" . $rij["Level"] . "</td>";
                                    echo "<td class='pull-right'>";

                                        // Detail scherm
                                        echo '<a href="pages/read_page.php?User_ID=' . $rij['User_ID'] .'" class="mr-3" title="Toon Gegevens" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';

                                        //  Bewerk gegevens scherm
                                        echo '<a href="pages/update_page.php?User_ID=' . $rij['User_ID'] .'" class="mr-3" title="Bewerk Gegevens" data-toggle="tooltip"> <span class="fa fa-pencil"></span></a>';

                                        // Verwijder gegevens scherm
                                        echo '<a href="pages/delete_page.php?User_ID=' . $rij['User_ID'] .'" title="Verwijder Gegevens" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';


                                        echo "</td>";
                                        echo "</tr>";
                            }
                                echo "</tbody>";
                            echo "</table>";

                            // Free result set
                            unset($result);
                        } else {
                            echo '<div class="alert alert-danger"><em>Geen gegevens gevonden.</em></div>';
                        }
                    } else {
                        echo "Oops! Er is iets fout gegaan. Probeer het later opnieuw.";
                    }

                    // Sluit de connectie
                    unset($pdo);
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>