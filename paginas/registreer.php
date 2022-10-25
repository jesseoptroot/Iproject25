<?php
  $registratieErrors = [];

  $emailadres = '';
  $bevestigingscode = '';
  $voornaam = '';
  $achternaam = '';
  $gebruikersnaam = '';
  $wachtwoord1 = '';
  $wachtwoord2 = '';
  $adres1 = '';
  $adres2 = '';
  $postcode = '';
  $telefoonnummer1 = '';
  $telefoonnummer2 = '';
  $geboortedatum = '';
  $geheimevraag = '';
  $geheimantwoord = '';
  $verkopercontrole = '';
  $creditcardnummer = '';
  $rekeningnummer = '';
  
  if(isset($_POST['bevestigen'])) {
    $emailadres = strip_tags($_POST['e-mailadres']);
   // $bevestigingscode = strip_tags($_POST['bevestigingscode']); //later hierna kijken
    $voornaam = strip_tags(htmlentities(trim($_POST['voornaam'])));
    $achternaam = strip_tags(htmlentities(trim($_POST['achternaam'])));
    $gebruikersnaam = strip_tags($_POST['gebruikersnaam']);
    $wachtwoord1 = strip_tags($_POST['wachtwoord1']);
    $wachtwoord2 = strip_tags($_POST['wachtwoord2']);
    $adres1 = strip_tags(htmlentities($_POST['adres1']));
    $adres2 = strip_tags(htmlentities($_POST['adres2']));
    $postcode = strip_tags(htmlentities($_POST['postcode']));
    $telefoonnummer1 = strip_tags(htmlentities($_POST['telefoonnummer1']));
    $telefoonnummer2 = strip_tags(htmlentities($_POST['telefoonnummer2']));
    $geboortedatum = strip_tags($_POST['geboortedatum']);
    $geheimevraag = strip_tags(htmlentities($_POST['geheime vraag']));
    $geheimantwoord = strip_tags(htmlentities($_POST['geheim antwoord']));
    $verkopercontrole = strip_tags($_POST['verkopercontrole']);
    $creditcardnummer = strip_tags($_POST['creditcardnummer']);
    $rekeningnummer = strip_tags(htmlentities(trim($_POST['rekeningnummer'])));

    $pdo = verbindDB();
    $checkMail = checkMail($pdo, $emailadres);
    unset($pdo);
  
    if (!filter_var($emailadres, FILTER_VALIDATE_EMAIL)) {
      $registratieErrors[] = "De ingevoerde mail bestaat niet";
    } else if ($checkMail == $emailadres) {
      $registratieErrors[] = "Dit mail adres bestaat al";
    }

    if (empty($voornaam) || strlen($voornaam) < 3) {
      $registratieErrors[] = "Voornaam is verplicht met minimaal 3 characters.";
    }

    if (empty($achternaam) || strlen($achternaam) < 3) {
      $registratieErrors[] = "Achternaam is verplicht met minimaal 3 characters.";
    }

    if (strlen($wachtwoord1) <= 5) {
      $registratieErrors[] = "Uw ingevulde wachtwoord is te kort en heeft minimaal 6 characters nodig";
    }

    if ($wachtwoord2 != $wachtwoord1) {
      $registratieErrors[] = "De ingevoerde wachtwoorden komen niet overeen";
    }

    /**
     * Voor gemak is adres1 tot en met telefoonnummer niet meegenomen
     */

    if ($adres2 == null || empty($adres2)) {
      $adres2 = "";
    }

    if (!valideerDatum($geboortedatum, 'd-m-Y')) {
      $registratieErrors[] = "Datum is ongeldig";
    }

    /**
     * Voor gemak de geheime vraag tot en met verkoper controle overgeslagen vanwege de afwachting van de correcte db
     */

    if (!is_numeric($creditcardnummer)) {
      $registratieErrors[] = "creditcard nummer is ongeldig";
    }

    if (!is_numeric($rekeningnummer)) {
      $registratieErrors[] = "Het ingevoerde rekening nummer is ongeldig";
    }

    if (count($registratieErrors) > 0) {
      foreach ($registratieErrors as $error){
          echo($error);
      }
    } else {
      $pdo = verbindDB();
      gebruikerToevoegen($pdo, $voornaam, $achternaam, $adres1, $adres2, $postcode, " ", " ", $geboortedatum, $emailadres, $wachtwoord1, $geheimevraag, $geheimantwoord, $verkopercontrole);
      unset($pdo);
    }
  }
?>
<main class="container is-fluid content">
  <br>
  
  <?php echo password_hash($wachtwoord1, PASSWORD_DEFAULT) . "<br>";
    if (isset($_POST['submit'])) {
    echo 'true';
  } else {
    echo 'false';
  }
  echo "<br>";
  echo date("d-m-Y") . "<br>";
  echo strlen($voornaam); ?>
  
 <!-- <div class="emailbevestiging">
    <section class="section">
      <div class="container">        
        <h1 class="title is-2">Schrijf u gratis in bij EenmaalAndermaal!</h1>
        <h1 class="title is-5">Vul eerst uw e-mailadres in. U ontvangt dan binnen enkele minuten een mail met een bevestigingscode.</h1>


        <br>
        <h1 class="title is-5">Vul hieronder de bevestigingscode in.*</h1>
        
        <form action="post">
          <div class="field">
            <div class="control">
              <input class="input is-small" type="text" name="bevestigingscode" placeholder="Bevestigingscode" required>
            </div>
          </div>
        </form>       
      </div>
    </section>
  </div> -->
          <!-- eerste twee formulieren aanpassen later voor email te checken doormiddel van een bevestegingscode -->
        <!-- Gaat nu gebruikt worden Na de eerste keer te hebben ingelogd-->

  <div class="hoofdgegevens">
    <section class="section">
      <div class="container">
        <h1 class="title is-3">Vul hieronder de rest van uw gegevens in.</h1>

        <form method="post">
          <div class="field">
            <label class="label">E-mail*</label>
            <div class="control">
              <input class="input is-small" type="text" name="e-mailadres" placeholder="E-mail" required>
            </div>
          </div>

          <div class="field">
            <label class="label">Voornaam*</label>
            <div class="control">
              <input class="input is-small" type="text" name="voornaam" placeholder="Voornaam" required>
            </div>
          </div>

          <div class="field">
            <label class="label">Achternaam*</label>
            <div class="control">
              <input class="input is-small" type="text" name="achternaam" placeholder="Achternaam" required>
            </div>
          </div> 

          <div class="field">
            <label class="label">Gebruikersnaam*</label>
            <div class="control">
              <input class="input is-small" type="text" name="gebruikersnaam" placeholder="Gebruikersnaam" required>
            </div>
          </div>
          
          <div class="field">
            <label class="label">Wachtwoord (minimaal 7 tekens)*</label>
            <div class="control">
              <input class="input is-small" type="password" name="wachtwoord1" placeholder="Wachtwoord" required>
            </div>
          </div>

          <div class="field">
            <label class="label">Wachtwoord herhalen*</label>
            <div class="control">
              <input class="input is-small" type="password" name="wachtwoord2" placeholder="Wachtwoord" required>
            </div>
          </div>

          <div class="field">
            <label class="label">Adres 1*</label>
            <div class="control is-expanded">
              <input class="input is-small" type="text" name="adres1" placeholder="Adres" required>
            </div>
          </div>

          <div class="field">
            <label class="label">Adres 2</label>
            <div class="control is-expanded">
              <input class="input is-small" type="text" name="adres2" placeholder="Adres">
            </div>
          </div>

          <div class="field">
            <label class="label">Postcode*</label>
            <div class="control">
              <input class="input is-small" type="text" name="postcode" placeholder="Postcode" required>
            </div>
          </div> 

          <div class="field">
            <label class="label">Telefoonnummer 1*</label>
            <div class="control">
              <input class="input is-small" type="text" name="telefoonnummer1" placeholder="Telefoonnummer" required>
            </div>
          </div>

          <div class="field">
            <label class="label">Telefoonnummer 2</label>
            <div class="control">
              <input class="input is-small" type="text" name="telefoonnummer2" placeholder="Telefoonnummer" required>
            </div>
          </div> 

          <div class="field">
            <label class="label">Geboortedatum*</label>
            <div class="control">
              <input class="input is-small" type="date" name="geboortedatum" placeholder="Geboortedatum" required>
            </div>
          </div>

          <div class="field">
            <label class="label">Geheime vraag*</label>
            <div class="select is-small">
              <select name="geheime vraag">
                <option>Hoe heet je huisdier?</option>
                <option>In welke straat ben je geboren?</option>
                <option>Wat is je lievelingsgerecht?</option>
                <option>Wat is de naam van je moeder?</option>
                <option>Hoe heet je oudste zusje?</option>
              </select>
            </div>
          </div>

          <div class="field">
            <label class="label">Geheim antwoord*</label>
            <div class="control">
              <input class="input is-small" type="text" name="geheim antwoord" placeholder="Geheim antwoord" required>
            </div>
          </div>
        
        <h1 class="title is-7">
          (*) = Dit veld is verplicht.
        </h1>
        <div class="verkoperControle">
          <section class="section">
            <div class="container">  
              <h1 class="title is-5">
                Wilt u ook artikelen verkopen? Kies dan hier hoe u een extra controle wilt doen.
              </h1>
              
              <div class="field">
                <div class="select is-small">
                  <select name="verkopercontrole">
                    <option>Controle met behulp van creditcard (en creditcard kiezen als betaalmethode)</option>
                    <option>Controle met behulp van creditcard (maar een andere betaalmethode kiezen)</option>
                    <option>Controle per post</option>
                  </select>
                </div>
              </div>
            
              <br>
              <h1 class="title is-5">
                Als u ervoor kiest om met behulp van creditcard te controleren, kunt u hieronder uw creditcardnummer invullen.
              </h1>
              <fieldset disabled>
                <!--met PHP zal bepaald moeten worden welke field disabled is.-->
                <div class="field">
                  <div class="control">
                    <input class="input is-small" type="text" name="creditcardnummer" placeholder="Creditcardnummer">
                  </div>
                </div>
              </fieldset>
              <br>
              <h1 class="title is-5">Als u een andere betaalmethode wilt gebruiken, kunt u hieronder uw rekeningnummer invullen. </h1>
                <div class="field">
                  <div class="control">
                    <input class="input is-small" type="text" name="rekeningnummer" placeholder="Rekeningnummer">
                  </div>
                </div>
              </form>
            </div>
          </section>
        </div>  
        <div class="field is-grouped">
          <div class="control">
            <button class="button is-link" name="bevestigen">Bevestigen</button>
          </div>
          <div class="control">
            <button class="button is-link is-light" name="annuleren">Annuleren</button>
          </div>
        </div>    
      </div>
    </section>
  </div>
  <br>
</main>