<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.2/css/bulma.min.css">
    <link rel="stylesheet" href="../css/huisStyle.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <title>Voorwerp ter verkoop aanbieden</title>
</head>

<body>
<header>
    <nav class="navbar" aria-label="main navigation">
        <div>
            <a href="../paginas/index.html">
                <img src="../afbeeldingen/verkocht%20rev9.png" width="115" height="60" alt="Logo">
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
                    <a class="button is-success" href="registreer.html">
                        <strong>Sign up</strong>
                    </a>
                    <a class="button is-light" href="inloggen.html">
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

                    <div class="navbar-dropdown">
                        <a class="navbar-item" href="../paginas/index.html">Zoeken</a>
                        <a class="navbar-item" href="../paginas/overOns.html">Over ons</a>
                        <a class="navbar-item" href="../paginas/beheer.html">Beheerder pagina</a>
                        <a class="navbar-item" href="../paginas/profiel.html">Profiel</a>
                        <a class="navbar-item" href="../paginas/inloggen.html">Inloggen/uitlog</a>
                        <a class="navbar-item" href="../paginas/registreer.html">Registreer</a>
                        <a class="navbar-item" href="../paginas/mijnVeilingen.html">Mijn veilingen</a>
                        <a class="navbar-item" href="../paginas/mijnBiedingen.html">Mijn biedingen</a>
                        <a class="navbar-item" href="../paginas/veilingAanmaken.html">Veiling aanmaken</a>
                        <a class="navbar-item" href="../paginas/berichten.html">Berichten</a>
                        <a class="navbar-item" href="../paginas/veilingsItem.html">Veiling item</a>
                        <hr class="navbar-divider">
                        <a class="navbar-item">
                            Report an issue
                        </a>
                    </div>
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
</header>


<main>
        - Rubrieken toevoegen.
        - Geheime vragen toevoegen.
        - Veilingen zoeken en kunnen verwijderen.
        - Gebruikers kunnen zoeken op username of achternaam en kunnen verwijderen of ban geven.
    </main>
    <footer class="footer">
        <div class="content has-text-centered">
            <table class="footer-table">
                <thead>
                <tr>
                    <th><a href="../paginas/overOns.html">Over Eenmaal Andermaal</a></th>
                </tr>
                </thead>
            </table>
        </div>
        <div class="content has-text-centered">
            <strong>EenmaalAndermaal door groep 25</strong> &copy;
        </div>
    </footer>
</body>

</html>