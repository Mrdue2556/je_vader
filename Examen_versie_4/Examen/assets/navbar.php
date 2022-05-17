<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<nav class="navbar navbar-light bg-light justify-content-between">
    <a class="navbar-brand">Ga Lekker Reizen</a>
    <form class="form-inline">
        <?php
        // Initialize the session
        session_start();

        if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
            // Als je niet ingelogd bent, laat login knop zien
            echo "<a href='../paginas/login/login.php' class='btn btn-outline-success my-2 my-sm-0'>LOGIN</a>";
        } else{
            // Als je ingelogd bent, laat loguit knop zien
            echo "<a href='../../php/login/loguit.php' class='btn btn-outline-success my-sm-0'>LOGUIT</a>";
        }
        ?>
    </form>
</nav>