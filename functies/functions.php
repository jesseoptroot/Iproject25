<?php

function verbindDB() {
    $hostname = 'localhost';
    $dbname = 'eenmaalAndermaal';
    $username = 'applicatie';
    $pw = 'test';

    try{
        $pdo = new PDO("sqlsrv:Server=$hostname;Database=$dbname;ConnectionPooling=0", $username, $pw);
        $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION,);
    }
    catch(PDOException $e) {
        echo $e -> getMessage();
    }
    return $pdo;
    
}

/*
* LaadPagina zorgt voor een specifieke pagina
* Deze functie zou als het goed is ook ervoor zorgen dat URL manipulatie onmogelijk wordt gemaakt
* Deze functie retourneert een PHP file en verwacht een string als parameter
* Gemaakt door Verdi
* Deze functie moet nog wel onderhouden worden in verband met unieke veilings items en eventuele nieuwe pagina's
*/

function LaadPagina($pagina) {
    switch($pagina) {
        case 'home':
            $pagina = require_once('./paginas/home.php');
            break;
        case 'mijn-veilingen':
            $pagina = require_once('./paginas/mijnVeilingen.php');
            break;
        case 'veiling-toevoegen':
            $pagina = require_once('./paginas/veilingAanmaken.php');
            break;
        case 'mijn-biedingen':
            $pagina = require_once('./paginas/mijnBiedingen.php');
            break;
        case 'overons':
            $pagina = require_once('./paginas/overOns.php');
            break;
        case 'mijn-profiel':
            $pagina = require_once('./paginas/profiel.php');
            break;
        case 'berichten':
            $pagina = require_once('./paginas/berichten.php');
            break;
        case 'login':
            $pagina = require_once('./paginas/inloggen.php');
            break;
        case 'uitloggen':
            $pagina = require_once('./paginas/logout.php');
            break;
        case 'beheer':
            $pagina = require_once('./paginas/beheer.php');
            break;
        case 'profiel-aanpassen':
            $pagina = require_once('./paginas/profielAanpassen.php');
            break;
        case 'registreer':
            $pagina = require_once('./paginas/registreer.php');
            break;
        case 'veilings-item':
            $pagina = require_once('./paginas/veilingsItem.php'); //deze pagina krijgt nog een aparte URL(GET) methode mee voor de specefieke item
            break;
        default:
            $pagina = require_once('./paginas/home.php'); //deze pagina krijgt nog een aparte URL(GET) methode mee voor de specefieke categorieen
    }
    return $pagina;
} 

// Berekent looptijd in uren aan de hand van ingevoerde dagen
function berekenLooptijdInUren($looptijdInDagen){
    $looptijdInUren ='';
    $loopTijdInDagenArray = array(1, 3, 5, 7, 10);
    $loopTijdInUrenArray = array(24, 72, 120, 168, 24);

    for ($i = 0; $i < sizeof($loopTijdInDagenArray); $i++){
        if ($loopTijdInDagenArray[$i] == $looptijdInDagen){
            $looptijdInUren = $loopTijdInUrenArray[$i];
        }
    }
    return $looptijdInUren;
}

// Checkt database voor gebruikersnaam, als deze al bestaat geeft hij een error
function checkDatabaseVoorGebruikersnaam($dbh, $gebruikersnaam){
    $sql = 'select * from Gebruiker where gebruikersnaam = :gebruikersnaam';
    $query = $dbh->prepare($sql);
    $query->execute([':gebruikersnaam'  => $gebruikersnaam]);
    $data = $query->fetchAll();
    $count_rows = count($data);
  	if ($count_rows > 0) {
  	    $errors[] = "Gebruikersnaam al in gebruik, kies een andere"; 	
    }
}

//door Melvin Profiel pagina gegevens ophalen//
  
function verkoperGegevensOphalenProfielOverzicht($dsn,$gebruikersnaam){
    $sql='SELECT bank,bankrekening,controleoptie,creditcard
    FROM Verkoper
    WHERE :gebruikersnaam = gebruiker';
    $query=$dsn->prepare($sql);
    $query->execute(Array(
      ':gebruikersnaam'=> $gebruikersnaam
    ));
    return $query->fetchAll();
  }

function returnwaardeVerkoper($dsn,$gebruikersnaam){
    $sql='SELECT verkoper
        FROM Gebruiker
    WHERE :gebruikersnaam = gebruikernaam';
    $query=$dsn->prepare($sql);
    $query->execute(Array(
      ':gebruikersnaam'=> $gebruikersnaam
    ));
    return $query->fetchAll();
}
// Returnt HTML voor het tonen gegevens van de ingelogde gebruiker
function toonGeregistreerdeGegevensTabel1 ($gebruikersnaam,$voornaam,$achternaam,$mailbox,$wachtwoord,$adresregel1,$adresregel2,$postcode) {
        $html =   '<li class="label">Gebruikersnaam:   </li><li>' . $gebruikersnaam . '</li>';
        $html .=  '<li class="label">Voornaam:         </li><li>' . $voornaam . '</li>';
        $html .=  '<li class="label">Achternaam:       </li><li>' . $achternaam . '</li>';
        $html .=  '<li class="label">Emailadres:       </li><li>' . $mailbox . '</li>';
        $html .=  '<li class="label">Wachtwoord:       </li><li>' . $wachtwoord . '</li>';
        $html .=  '<li class="label">Adresregel1:      </li><li>' . $adresregel1 . '</li>';
        $html .=  '<li class="label">Adresregel2:      </li><li>' . $adresregel2 . '</li>';
        $html .=  '<li class="label">Postcode:         </li><li>' . $postcode . '</li>';
        return $html;
    }

       
function toonGeregistreerdeGegevensTabel2 ($plaatsnaam,$landnaam,$geboorteDag,$telefoon1,$telefoon2,$tekstvraag,$antwoordtekst) {
    $html =   '<li class="label">Plaatsnaam:       </li><li>' . $plaatsnaam . '</li>';
    $html .=  '<li class="label">Landnaam:         </li><li>' . $landnaam . '</li>';
    $html .=  '<li class="label">GeboorteDag:      </li><li>' . $geboorteDag . '</li>';
    $html .=  '<li class="label">Telefoon1:        </li><li>' . $telefoon1 . '</li>';
    $html .=  '<li class="label">Telefoon1:        </li><li>' . $telefoon2 . '</li>';
    $html .=  '<li class="label">Geheime vraag:    </li><li>' . $tekstvraag . '</li>';
    $html .=  '<li class="label">Geheim antwoord:  </li><li>' . $antwoordtekst . '</li>';
    return $html;
}
//Todo login functie afmaken door Verdi
function inloggen($pdo, $mail) {
    $query = $pdo -> prepare('select gebruikersnaam, voornaam, achternaam, wachtwoord, verkoper
                            from Gebruiker
                            where mailbox = :mailbox');
    $query -> execute([':mailbox' => $mail]);

    return $query -> fetch(PDO::FETCH_ASSOC);
}

function checkMail($pdo, $mail) {
    $query = $pdo -> prepare('select mailbox
                             from Gebruiker 
                             where mailbox = :mailbox'
                            );
    $query -> execute([':mailbox' => $mail]);

    return $query -> fetch(PDO::FETCH_ASSOC);
}

function valideerDatum($invoerDatum, $datumFormat = 'd-m-Y') {
    $datumVoormaat = DateTime::createFromFormat($datumFormat, $invoerDatum);
    return $datumVoormaat && $datumVoormaat -> format($datumFormat) === $invoerDatum;
}

function gebruikerToevoegen($pdo, $voornaam, $achternaam, $adresregel1, $adresregel2, $postcode, $plaatsnaam, $landnaam, $geboorteDag, $mail, $wachtwoord, $vraag, $antwoord, $verkoper) {
    //moet nog afgemaakt worden
}

?>