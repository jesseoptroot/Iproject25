<?php
include("db.php");
?>

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
        <form action="overzicht-pagina.php" method="post">
            <div class="container is-fluid">
                <div class="infoblockVeilingAanmaak">
                    <section class="section is-small">
                        <h1 class="title">Nieuwe Veiling</h1>
                        <h2 class="subtitle">
                            Vul het onderstaande formulier in om uw product aan te bieden!
                        </h2>
                    </section>

                    <br>
                    <label class="label">Titel</label>
                    <textarea class="textarea" maxlength="20" placeholder="Pakkende titel product" rows="1"
                        required></textarea><br>
                    <label class="label">Omschrijving</label>
                    <textarea class="textarea" maxlength="80"
                        placeholder="Korte omschrijving product (maximum 80 tekens)" rows="3" required></textarea><br>

                    <label class="label">Selecteer Categorie</label>
                    <div class="select">
                        <select>
                            <option>Kies categorie</option>
                            <option>Opties</option>
                        </select>
                    </div>

                    <div class="field"><br>
                        <label class="label">Startprijs</label>
                        <div class="control">
                            <!--met php nog checks toevoegen zodat het automatisch gecheckt word op numeric value en automatisch word omgezet naar een prijs.-->
                            <input class="input" type="text" placeholder="Startprijs" required>
                        </div><br>
                    </div>

                    <label class="label">Looptijd</label>
                    <div class="select">
                        <select>
                            <option>Kies looptijd product</option>
                            <option>1 dag</option>
                            <option>3 dagen</option>
                            <option>5 dagen</option>
                            <option>7 dagen</option>
                            <option>10 dagen</option>
                        </select>
                    </div>

                    <div class="field"><br>
                        <label class="label">Voorwerp locatie</label>
                        <div class="control">
                            <input class="input" type="text" placeholder="Locatie" required>
                        </div>
                    </div><br>

                    <div>
                        <label class="checkbox">
                            <input type="checkbox">
                            Bank/Giro
                        </label>

                        <label class="checkbox">
                            <input type="checkbox">
                            Contant
                        </label>

                        <label class="checkbox">
                            <input type="checkbox">
                            iDeal
                        </label>

                        <label class="checkbox">
                            <input type="checkbox">
                            PayPal
                        </label>
                    </div><br>

                    <div class="field">
                        <label class="label">Betalingsinstructies</label>
                        <div class="control">
                            <input class="input" type="text" placeholder="Betalingsinstructies" required>
                        </div>
                    </div><br>

                    <label class="label">Verzendopties</label>
                    <div class="select">
                        <select>
                            <option>Kies verzendopties</option>
                            <option>Alleen Nederland</option>
                            <option>Binnen EU</option>
                            <option>Internationaal</option>
                            <option>Geen verzending mogelijk</option>
                        </select>
                    </div>

                    <div><br>
                        <label class="checkbox">
                            <input type="checkbox" required>
                            Afhalen op locatie mogelijk
                        </label>
                    </div><br>

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

                    <input class="button is-info is-medium is-fullwidth" type="submit" value="Veiling Plaatsen">
                    <!-- Link naar overzicht veiling pagina -->

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