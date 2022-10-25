<?php
// Includes & Requires
include("SQLSrvConnectTeun.php");
include("../functies/functions.php");

// Variabelen
$errors = [];

$titel = '';
$beschrijving = '';
$startprijs = '';
$betalingswijze = '';
$betalingsinstructie = '';
$plaatsnaam = '';
$land = '';
$looptijd = '';
$looptijdBeginDag = '';
$looptijdBeginTijdstip = '';
$verzendkosten = '';
$verzendinstructies = '';
$verkoper = '';
$looptijdEindeDag = '';
$looptijdEindeTijdstip = '';
// Kolommen nog toevoegen aan DB 29-04 webserver
$afhaalmogelijkheid = '';
$categorie = '';
$koper = 'pietje';
$voorwerpnummer = '1';
$veilingGesloten = 'Nee';
$verkoopprijs = '10';

// Check for post
if(isset($_POST['submit'])) {   
    $titel = strip_tags(trim(htmlentities($_POST['titel'])));
    $beschrijving = strip_tags(trim(htmlentities($_POST['beschrijving'])));
    $startprijs = number_format($_POST['startprijs'], 2, '', '');
    $betalingswijze = $_POST['betalingswijzeKeuze'];
    $betalingsinstructie = strip_tags(trim(htmlentities($_POST['betalingsinstructie'])));
    $plaatsnaam = strip_tags(trim(htmlentities($_POST['plaatsnaam'])));
    $land = 'Nederland';
    $looptijd = $_POST['looptijd'];
    $looptijdBeginDag = date('Y-m-d');
    $looptijdBeginTijdstip = date('h:i:s');
    $looptijdInUren = berekenLooptijdInUren($looptijd);
    $verzendkosten = $_POST['verzendKeuze'];
    $verzendinstructie = strip_tags(trim(htmlentities($_POST['titel'])));
    $verkoper = 'piet';
    $looptijdEindeDag = date('d-m-Y', strtotime($looptijdBeginDag . '+' . $looptijd . 'days'));
    $looptijdEindeTijdstip = date('h:i:s', strtotime($looptijdBeginTijdstip . '+' . $looptijdInUren . 'hours'));
    $categorie = $_POST['categorie']; 
    $afhaalmogelijkheid = 'Nee';
    
    // Checks op posts
        // Titel
        if (empty($titel)) {
            $errors[] = "Titel is verplicht.";
        } else if (strlen($titel) > 20) {
            $errors[] = "Titel mag niet langer zijn dan 20 karakters.";
        }

        // Beschrijving
        if (empty($beschrijving)) {
            $errors[] = "Beschrijving is verplicht.";
        } else if (strlen($beschrijving) > 200) {
            $errors[] = "Beschrijving mag niet langer zijn dan 20 karakters.";
        }

        // Startprijs
        if (!is_numeric($startprijs)) {
            $errors[] = "Startprijs moet een getal zijn.";
        }

        // Betalingswijzekeuze
        if (!isset($betalingswijze)){
            $errors[] = "Kies uw betalingswijze.";
        }

        // Betaalinstructies
        if (empty($betalingsinstructie)) {
            $errors[] = "Betaalinstructie is verplicht.";
        } else if (strlen($betalingsinstructie) > 75) {
            $errors[] = "Betaalinstructie mag niet langer zijn dan 75 karakters.";
        }

        // Plaatsnaam
        if (empty($plaatsnaam)) {
            $errors[] = "Plaatsnaam is verplicht.";
        } else if (strlen($plaatsnaam) > 20) {
            $errors[] = "Plaatsnaam mag niet langer zijn dan 20 karakters.";
        }

        // Land
        if ($land != 'Nederland') {
            $errors[] = "Alleen Nederland is een geldig land.";
        }

        // Looptijd 
        if (!is_numeric($looptijd)) {
            $errors[] = "Looptijd moet een getal zijn, ververs pagina.";
        } 

        // Categorie
        if (!isset($betalingswijze)){
            $errors[] = "Kies uw Categorie.";
        }

        // Afhaalmogelijkheid
        if(empty($_POST['afhaalmogelijk'])){
            $afhaalmogelijk = "Nee";
        } else {
            $afhaalmogelijk = "Ja";
        }

        // Verzendkosten
        if (!is_numeric($verzendkosten)) {
            $errors[] = "Verzendkosten moet een getal zijn.";
        } 

        // Save naar database
        // Functie van maken ask verdi
        if(count($errors)==0) {
            $sql = 'insert into Voorwerp (voorwerpnummer, titel, beschrijving, startprijs, betalingswijze, betalingsinstructie, plaatsnaam, land, looptijd, looptijdBeginDag, looptijdbeginTijdstip, verzendkosten, verzendinstructies, verkoper, koper, looptijdEindeDag, looptijdEindeTijdstip, veilingGesloten, verkoopprijs, categorie, afhaalmogelijkheid)
                    values               (:voorwerpnummer, :titel, :beschrijving, :startprijs, :betalingswijze, :betalingsinstructie, :plaatsnaam, :land, :looptijd, :looptijdBeginDag, :looptijdbeginTijdstip, :verzendkosten, :verzendinstructies, :verkoper, :koper, :looptijdEindeDag, :looptijdEindeTijdstip, :veilingGesloten, :verkoopprijs, :categorie, :afhaalmogelijkheid)';
            $query = $dbh->prepare($sql);
            $result = $query->execute(
                [ 
                ':voorwerpnummer'           => $voorwerpnummer,
                ':titel'                    => $titel,
                ':beschrijving'             => $beschrijving,
                ':startprijs'               => $startprijs,
                ':betalingswijze'           => $betalingswijze,
                ':betalingsinstructie'      => $betalingsinstructie,
                ':plaatsnaam'               => $plaatsnaam,
                ':land'                     => $land,    
                ':looptijd'                 => $looptijd,
                ':looptijdBeginDag'         => $looptijdBeginDag,
                ':looptijdbeginTijdstip'    => $looptijdBeginTijdstip,
                ':verzendkosten'            => $verzendkosten,    
                ':verzendinstructies'       => $verzendinstructies,
                ':verkoper'                 => $verkoper,
                ':koper'                    => $koper,
                ':looptijdEindeDag'         => $looptijdEindeDag,
                ':looptijdEindeTijdstip'    => $looptijdEindeTijdstip,    
                ':veilingGesloten'          => $veilingGesloten,
                ':verkoopprijs'             => $verkoopprijs,
                ':categorie'                => $categorie,
                ':afhaalmogelijkheid'       => $afhaalmogelijkheid,
                ]);
        }

        if (count($errors) > 0) {
            foreach ($errors as $error){
                echo($error);
            }
        }
}
?>

<!-- HTML Veiling Aanmaken -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.2/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <link rel="stylesheet" href="../css/huisStyle.css">
    <title>Veiling aanmaken</title>
</head>

<body>
    <header>
    <?php
require_once("navbar.html");
    ?>
    </header>

    <main class="container is-fluid">   
        <form action="" method="post">
            <div class="container is-fluid">
                <div class="infoblockVeilingAanmaak">
                    <section class="section is-small">
                        <h1 class="title">Nieuwe Veiling</h1>
                        <h2 class="subtitle">Vul het onderstaande formulier in om uw product aan te bieden!</h2>
                    </section><br>
                    
                    <label class="label">Titel</label>
                    <input type="text" class="textarea" name="titel" maxlength="20" placeholder="Pakkende titel product" rows="1" 
                    value="<?=$titel?>" required></input><br>

                    <label class="label">Beschrijving</label>
                    <textarea type="text" class="textarea" name="beschrijving" maxlength="200"
                        placeholder="Korte beschrijving product (maximum 200 tekens)" rows="3" required></textarea><br>
                    
                    <label class="label">Startprijs</label>   
                    <input type="number" class="input" name="startprijs" placeholder="Startprijs" required></input><br><br>
                   
                    <label class="label">Selecteer Categorie</label>
                    <div class="select">
                        <select name="categorie" required>
                            <option value="">Kies categorie</option>
                            <option value="Opties">Opties</option>
                        </select>
                    </div><br><br>

                    <label class="label">Looptijd</label>
                    <div class="select">
                        <select name="looptijd" required>
                            <option value="">Kies looptijd product</option>
                            <option value="1">1 dag</option>
                            <option value="3">3 dagen</option>
                            <option value="5">5 dagen</option>
                            <option value="7">7 dagen</option>
                            <option value="10">10 dagen</option>
                        </select>
                    </div><br><br>

                    <label class="label">Voorwerp locatie</label>
                    <input type="text" class="textarea" name="plaatsnaam" maxlength="20" placeholder="Plaatsnaam" rows="1" required></input><br>
                       
                    <label class="label">Kies uw betaalwijze:</label>
                    <input type="radio" id="bankGiro" name="betalingswijzeKeuze" value="Bank/Giro">
                    <label for="bankGiro">Bank/Giro</label><br>
                    <input type="radio" id="contant" name="betalingswijzeKeuze" value="Contant">
                    <label for="contant">Contant</label><br>
                    <input type="radio" id="iDeal" name="betalingswijzeKeuze" value="iDeal">
                    <label for="iDeal">iDeal</label><br>
                    <input type="radio" id="payPal" name="betalingswijzeKeuze" value="PayPal">
                    <label for="payPal">PayPal</label><br><br>
                    
                    <label class="label">Betalinginstructie</label>
                    <textarea type="text" class="textarea" name="betalingsinstructie" maxlength="75"
                        placeholder="Betalinginstructie (maximum 75 tekens)" rows="2" required></textarea><br>

                    <label class="label">Kies uw verzendoptie:</label>
                    <input type="radio" id="alleenNL" name="verzendKeuze" value="5">
                    <label for="alleenNL">Alleen Nederland €5,00 </label><br>
                    <input type="radio" id="binnenEU" name="verzendKeuze" value="12.5">
                    <label for="binnenEU">Binnen EU €12,50</label><br>
                    <input type="radio" id="internationaal" name="verzendKeuze" value="25.5">
                    <label for="internationaal">Internationaal €25,50</label><br>
                    <input type="radio" id="geenVerzending" name="verzendKeuze" value="null">
                    <label for="geenVerzending">Geen verzending mogelijk</label><br><br>

                    <label class="label">Verzendinstructies</label>
                    <textarea type="text" class="textarea" name="verzendinstructies" maxlength="75"
                        placeholder="Verzendinstructies (maximum 75 tekens)" rows="2" required></textarea><br>

                    <label class="checkbox">
                        <input type="checkbox" name="afhaalmogelijk" value="afhaalmogelijk">
                        Afhalen op locatie mogelijk
                    </label><br><br>
    
                    <label class="label"> Afbeelding toevoegen (Maximaal 4) </label>
                    <div class="file is-info has-name">
                        <label class="file-label">
                            <input class="file-input" type="file" name="resume">
                            <span class="file-cta">
                                <span class="file-icon">
                                    <i class="fas fa-upload"></i>
                                </span>
                                <span class="file-label">
                                    Afbeelding
                                </span>
                            </span>
                            <span class="file-name">
                                Bestandsnaam
                            </span>
                        </label>
                    </div><br><br>

                    <input class="button is-info is-medium is-fullwidth" name="submit" id="submit" type="submit" value="Veiling Plaatsen"></input>

                </div>
            </div>
        </form>
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