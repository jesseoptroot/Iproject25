<?php 
require('./functies/functions.php');

/**
 * showMenu is een functie dat "samen" met de LaadPagina werkt om zo de juiste menu te tonen
 * Dit per gebruiker om specifieker te zijn de rol van deze gebruiker
 * Deze functie retourneert een string value en verwacht een string als parameter
 * Gemaakt door Verdi
 * Functie heeft nog toevoegingen nodig
 */

function showMenu($gebruikerRol){
    $menu = '<div class="navbar-dropdown">
                <a href="?pagina=home" class="navbar-item">Home</a>';
    switch ($gebruikerRol) {
        case 'gast':
            $menu .= '
                    <a href="?pagina=login" class="navbar-item">Inloggen</a>
                    <a href="?pagina=registreer" class="navbar-item">Registreren</a>';
                    //hier moeten later extra categorieen neergezet worden zodat het bovenste gedeelte weg kan
            break;
        case 'verkoper':
            $menu .= '
                        <a href="?pagina=mijn-veilingen" class="navbar-item">Mijn veilingen</a>
                        <a href="?pagina=mijn-biedingen" class="navbar-item">Mijn biedingen</a>
                        <a href="?pagina=veiling-toevoegen" class="navbar-item">Veiling aanmaken</a>
                        <a href="?pagina=berichten" class="navbar-item">Berichten</a>
                        <a href="?pagina=mijn-profiel" class="navbar-item">Mijn profiel</a>
                        <a href="?pagina=uitloggen" class="navbar-item">Uitloggen</a>'
                    ;
            break;
        default:
        $menu .= '
        <a href="?pagina=login" class="navbar-item">Inloggen</a>
        <a href="?pagina=registreer" class="navbar-item">Registreren</a>';
        //hier moeten later extra categorieen neergezet worden zodat het bovenste gedeelte weg kan
        //Dit is een standaard als er geen gebruikersRol is of als er een andere soort gebruiker is
    }

    $menu .= '<a href="?pagina=overons" class="navbar-item">Over ons</a>
    </div>';

    return $menu;
}

?>