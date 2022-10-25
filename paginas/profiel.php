<?php 
session_start();
include("../functies/functions.php");
include("../paginas/SQLSrvConnect.php");
$dbh =verbindDB();
if (empty($_GET['pagina'])) {
    $_GET['pagina'] = 'profiel';
}  


     $_SESSION['gebruikersnaam']='G3rr1e';

if (!isset($_SESSION['gebruikersnaam'])) {
    } else {
            $gebruikersnaam = $_SESSION['gebruikersnaam'];    
        $sql =  'SELECT gebruikersnaam,voornaam,achternaam,adresregel1,adresregel2,postcode,plaatsnaam,landnaam,geboorteDag,mailbox,wachtwoord,telefoon1,telefoon2,tekstvraag,antwoordtekst
        FROM Gebruiker
        inner join gebruikerstelefoon
        on gebruiker.gebruikersnaam = Gebruikerstelefoon.gebruiker
        inner join Vraag
        on gebruiker.vraag = vraag.vraagnummer
        WHERE :gebruikersnaam = gebruikersnaam';
        $query = $dbh->prepare($sql);
        $query->execute([':gebruikersnaam'  => $gebruikersnaam]);
        $data = $query->fetchAll();
        
            foreach($data as $row){
            $gebruikersnaam           = $row[0];
            $voornaam                 = $row[1];
            $achternaam               = $row[2];
            $adresregel1              = $row[3];
            $adresregel2              = $row[4];
            $postcode                 = $row[5];
            $plaatsnaam               = $row[6];
            $landnaam                 = $row[7];
            $geboorteDag              = $row[8];
            $mailbox                  = $row[9];
            $wachtwoord               = $row[10];
            $telefoon1                = $row[11];
            $telefoon2                = $row[12];
            $tekstvraag               = $row[13];
            $antwoordtekst            = $row[14];
            
            $_SESSION['gebruikersnaam'] = $gebruikersnaam;
            $_SESSION['voornaam']       = $voornaam;
            $_SESSION['achternaam']     = $achternaam;
            $_SESSION['adresregel1']    = $adresregel1;
            $_SESSION['adresregel2']    = $adresregel2;
            $_SESSION['postcode']       = $postcode;
            $_SESSION['plaatsnaam']     = $plaatsnaam;
            $_SESSION['landnaam']       = $landnaam;
            $_SESSION['geboorteDag']    = $geboorteDag;
            $_SESSION['mailbox']        = $mailbox;
            $_SESSION['wachtwoord']     = $wachtwoord;
            $_SESSION['telefoon1']      = $telefoon1;
            $_SESSION['telefoon2']      = $telefoon2;
            $_SESSION['tekstvraag']    = $tekstvraag;
            $_SESSION['antwoordtekst'] = $antwoordtekst;
        }
    }




?>    
<!--Door Melvin-->
 <!-- 2de nav bar profiel-->
<header class="container is-fluid">
    <div class="columns level">
        <div class="column level-item field is-horizontal">
            <form method="post">
                <input class="button is-medium is-light" type="submit" value="Mijn veilingen">
            </form>
            <form method="post">
                <input class="button is-medium is-light" type="submit" value="Mijn biedingen">
            </form>
            <form method="post">
                <input class="button is-medium is-light" type="submit" value="Mijn berichten">
            </form>
        </div>
    </div>
</header>
<body>
    <!--Navigatie balk van deze pagina individueel-->
    <main class="mainProfiel container is-fluid" style="padding: 5%;">
        <!-- moet nog naar gekeken worden-->
        <div class="profielContainer container is-fluid">
            <div class="profielGegevenskolommen columns">
                <div class="gegevensTabelProfielOverzicht column is-one-third">
                    <section class="section">
                        <h1 class="title"> Mijn Gegevens</h1>
                        <ul>
                            <?php echo toonGeregistreerdeGegevensTabel1 ($gebruikersnaam,$voornaam,$achternaam,$mailbox,$wachtwoord,$adresregel1,$adresregel2,$postcode);
                             ?>
                        </ul><br>
                    </section>
                </div>
                             
                <div class="gegevensTabelProfielOverzichtTwee column is-one-third">
                    <section class="section">
                        <ul>
                        <?php echo toonGeregistreerdeGegevensTabel2 ($plaatsnaam,$landnaam,$geboorteDag,$telefoon1,$telefoon2,$tekstvraag,$antwoordtekst);
                             ?>
                        </ul>
                        <br>
                        <a class=" gegevensUpdatenProfielOverzichtButton button is-centered is-info"
                            href="../paginas/profielaanpassen.html">
                            Profiel Aanpassen
                        </a>
                    </section>
                </div>

                <?php  ?> 
                <div class="verkoperGegevensTabelProfielOverzicht column is-one-third">
                    <section class="section ">
                        <h1 class="title">Verkoper gegevens</h1>
<?php                   if (returnwaardeVerkoper($dsn,$gebruikersnaam)=='ja'){
                                $gebruikersnaam = $_SESSION['gebruikersnaam'];    
                                $sql =  'SELECT bank,bankrekening,controleoptie,creditcard
                                FROM Verkoper
                                WHERE :gebruikersnaam = gebruiker';
                                $query = $dbh->prepare($sql);
                                $query->execute([':gebruikersnaam'  => $gebruikersnaam]);
                                $data = $query->fetchAll();
        
                                    foreach($data as $row){
                                    $bank                        = $row[0];
                                    $bankrekening                = $row[1];
                                    $controleoptie               = $row[2];
                                    $creditcard                  = $row[3];
            
            
                                    $_SESSION['bank']               = $bank;
                                    $_SESSION['bankrekening']       = $bankrekening;
                                    $_SESSION['controleoptie']      = $controleoptie;
                                    $_SESSION['creditcard']         = $creditcard;
                                    }
                                }else{
                                    $html .= '<h2>U bent nog geen verkoper</h2>';
                                }
?>
                    </section>
                </div>
            </div>
        </div>

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
</html>