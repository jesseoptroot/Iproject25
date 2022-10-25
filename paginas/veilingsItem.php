<main class="container is-fluid content extra-space">
    <!-- Flickity HTML init -->
    <div class="gallery js-flickity">
        <img src="./afbeeldingen/verkocht%20rev9.png" alt="Logo">
        <img src="./afbeeldingen/verkocht%20rev9.png" alt="Logo">
        <img src="./afbeeldingen/verkocht%20rev9.png" alt="Logo">
        <img src="./afbeeldingen/verkocht%20rev9.png" alt="Logo">
    </div>
    <div class="columns achtergrondkleur">
        <div class="column is-half">
            <h1 class="title achtergrondkleur">$Titel veiling, $veilingsnummer</h1>
        </div>
        <div class="column is-half">
            <h1 class="title achtergrondkleur">$Resterende tijd veiling</h1>
        </div>
    </div>

    <div class="columns achtergrondkleur">
        <div class="column is-two-third">
            <section class="section is-small achtergrondkleur">
                <h1 class="title">$Titel veiling</h1> <!-- PHP naar titel-->
                <h2 class="subtitle">
                    $Omschrijving veiling <br><br>
                    <!-- PHP naar veiling omschrijving-->
                    $Categorieen<br><br>
                    <!-- PHP naar veiling categorie(en)-->
                </h2>
            </section>
            <section class="section is-small achtergrondkleur">
                <h1 class="title">Verkoper gegevens</h1>
                <h2 class="subtitle">
                    $Username <br><br><!-- PHP link naar profiel -->
                    $Locatie <br><br><!-- PHP link naar Locatie -->
                    $Geaccepteerde betaalwijze<br><br><!-- PHP link naar Locatie -->
                    $Verzendopties<br><br><!-- PHP link naar verzendopties verkoper -->
                </h2>
            </section>
        </div>
        <div class="column is-one-third">
            <section class="section is-small achtergrondkleur">
                <h1 class="title">Info veiling</h1> <!-- PHP naar titel-->
                <h2 class="subtitle">
                    Startprijs: <br>
                    $Startbod veiling <br><br> <!-- PHP naar veiling startbod-->


                    Huidige hoogste bod door: $bieder <br><!-- PHP link naar bieder-->
                    $Hoogste bod<br><br> <!-- PHP naar huidige hoogste bod-->

                    Nu een bod doen?
                </h2>
                <form action="bevestig-bod.php" method="post">
                    <div class="field is-horizontal"><br>
                        <form>
                            <div class="field-label is-normal">
                                <label class="label">Uw bod</label>
                            </div>
                            <div class="field-body">
                                <div class="field">
                                <!--met php nog checks toevoegen zodat het automatisch gecheckt word op numeric value en automatisch word omgezet naar een prijs.-->
                                    <input class="input" type="text" placeholder="€" required>
                                </div>
                                <div class="field">
                                    <input class="button is-info is-medium is-fullwidth" type="submit" value="Bieden">
                                </div>
                            </div>
                        </form>
                    </div>
                </form>
            </section>
        </div>
    </div>
</main>