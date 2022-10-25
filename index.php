<?php
session_start();
require_once('./functies/functionsShow.php');
require_once('./functies/functions.php');
$rol = '';

//Kijkt naar de URL of de opgegeven(GET) pagina leeg is ja of nee
if (empty($_GET['pagina'])) {
    $_GET['pagina'] = 'home';
}

//Kijkt in de sessie of er een gebruiker is ja of nee en zet indien er een gebruiker is op een sessie variabele
if (empty($_SESSION['gebruiker'])) {
    $_SESSION['rol'] = $rol = 'gast'; 
} else {
    $tol = $_SESSION['rol'];
}

?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.2/css/bulma.min.css">
    <link rel="stylesheet" href="./css/huisStyle.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <title>EenmaalAndermaal</title>
</head>
<body>
    <nav class="navbar" aria-label="main navigation">
        <div>
            <a href="?pagina=home">
                <img src="./afbeeldingen/verkocht%20rev9.png" width="115" height="60" alt="Logo">
            </a>

            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>
        <div class="first-navbar-start">
            <div class="search-container">
                <form action="/action_page.php">
                    <input class="searchbar" type="text" placeholder="Search.." name="search">
                    <button class="searchbutton" type="submit">
                        <span class="icon">
                            <i class="fas fa-search"></i>
                        </span>
                    </button>
                </form>
            </div>
        </div>
        <div class="navbar-end">
            <div class="navbar-item">
                <div class="buttons">
                    <a class="button is-success" href="?pagina=registreer">
                        <strong>Sign up</strong>
                    </a>
                    <a class="button is-light" href="?pagina=login">
                        Log in
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <nav class="secnavbar" aria-label="main navigation">
        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link">
                        Pagina's
                    </a>
                    <?php echo(showMenu($_SESSION['rol'])); ?>
                </div>

                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link">
                        Categorieën
                    </a>

                    <div class="navbar-dropdown">
                        <a class="navbar-item">
                            About
                        </a>
                        <a class="navbar-item">
                            Jobs
                        </a>
                        <a class="navbar-item">
                            Contact
                        </a>
                        <hr class="navbar-divider">
                        <a class="navbar-item">
                            Report an issue
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <?php
     LaadPagina($_GET['pagina']);
    ?>
    <footer class="footer">
    <div class="content has-text-centered">
        <table class="footer-table">
            <thead>
            <tr>
                <th><a href="./paginas/overOns.php">Over Eenmaal Andermaal</a></th>
            </tr>
            </thead>
        </table>
    </div>
    <div class="content has-text-centered">
        <strong>EenmaalAndermaal door groep 25</strong> &copy;
    </div>
</footer>
</body>