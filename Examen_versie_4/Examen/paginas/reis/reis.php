<?php
// Voeg config bestand toe
include "../../config/config.php";
// Voeg de navbar.php
include "../../assets/navbar.php";

include "../../php/verwerk/reis_counter_verwerk.php";

//Check of je als student in bent gelogd zo ja, dan laat inschrijf form zien
if(isset($_SESSION['Student_ID']) || !empty($_SESSION['Student_ID'])) {
    if ($_SESSION['Student_ID']) {
        header("location: ../../index.php");
    }
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
                    <h2 class="pull-left">Reis Details</h2>
                    <a href='reis_toevoeg.php' class='btn btn-success pull-right'>
                        <i class='fa fa-plus'></i>Voeg een reis toe</a>
                </div>
                <?php
                // Poging om select query uit te voeren
                $sql = "SELECT * FROM reis";

                if($result = $pdo->query($sql)){
                    if ($result->rowCount() > 0){
                        echo '<table class="table table-bordered table-striped">';
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>#</th>";
                        echo "<th>Titel</th>";
                        echo "<th>Bestemming</th>";
                        echo "<th>Omschrijving</th>";
                        echo "<th>Begindatum</th>";
                        echo "<th>Einddatum</th>";
                        echo "<th>Aantal plekken</th>";
                        echo "<th>Acties</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        while($rij = $result->fetch()){
                            echo "<tr>";
                            echo "<td>" . $rij['Reis_ID'] . "</td>";
                            echo "<td>" . $rij['Titel'] . "</td>";
                            echo "<td>" . $rij['Bestemming'] . "</td>";
                            echo "<td>" . $rij['Omschrijving'] . "</td>";
                            echo "<td>" . $rij["Begindatum"] . "</td>";
                            echo "<td>" . $rij["Einddatum"] . "</td>";

                            // Check de aantal personen nog zich kunnen inschrijven
                            $Aantal_Plekken = $rij['Aantal_Plekken'];
                            $OpenRuimtes = $Aantal_Plekken - Counter($rij["Reis_ID"], $pdo);
                            if ($OpenRuimtes === 0){
                                echo "<p class=''>VOL</p>";
                            } else{
                                echo "<td>" . $OpenRuimtes ."/". $Aantal_Plekken . "</td>";
                            }

                            echo "<td class='pull-right'>";
                            // Detail scherm
                            echo '<a href="reis_toon.php?Reis_ID=' . $rij['Reis_ID'] .'" class="mr-3" title="Toon Reis" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                            //  Bewerk gegevens scherm
                            echo '<a href="reis_update.php?Reis_ID=' . $rij['Reis_ID'] .'" class="mr-3" title="Bewerk Reis" data-toggle="tooltip"> <span class="fa fa-pencil"></span></a>';
                            // Verwijder gegevens scherm
                            echo '<a href="reis_verwijder.php?Reis_ID=' . $rij['Reis_ID'] .'" title="Verwijder Reis" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
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
