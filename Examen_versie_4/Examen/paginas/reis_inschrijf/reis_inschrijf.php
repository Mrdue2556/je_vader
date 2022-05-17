<?php
// Voeg config bestand toe
require_once "../../config/config.php";
// Voeg de navbar.php
include "../../assets/navbar.php";

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
    <link rel="stylesheet" href="../../assets/css/stylesheet.css">

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
                    <h2 class="pull-left">Schrijf je in.</h2>
                </div>
                <?php
                // Poging om select query uit te voeren
                $sql = "SELECT * FROM Reis";

                if($result = $pdo->query($sql)){
                    if ($result->rowCount() > 0){
                        echo '<table class="table table-bordered table-striped">';
                        echo "<thead>";
                        echo "<tr>";

                        echo "<th>Titel</th>";
                        echo "<th>Bestemming</th>";
                        echo "<th>Omschrijving</th>";
                        echo "<th>Begindatum</th>";
                        echo "<th>Einddatum</th>";
                        echo "<th>Acties</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        while($rij = $result->fetch()){
                            echo "<tr>";
                            echo "<td>" . $rij['Titel'] . "</td>";
                            echo "<td>" . $rij['Bestemming'] . "</td>";
                            echo "<td>" . $rij['Omschrijving'] . "</td>";
                            echo "<td>" . $rij["Begindatum"] . "</td>";
                            echo "<td>" . $rij["Einddatum"] . "</td>";
                            echo "<td class='pull-right'>";

                            // Detail scherm
                            echo '<a href="reis_inschrijf_toon.php?Reis_ID=' . $rij['Reis_ID'] .'" class="mr-3" title="Schrijf je in" data-toggle="tooltip"><span>Schrijf in</span></a>';
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

