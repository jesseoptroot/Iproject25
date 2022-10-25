<?php
$mail = '';
$errors = [];
if(isset($_POST['Inloggen'])){
    $mail = strip_tags($_POST['Gebruikersnaam']);
    $wachtwoord = strip_tags($_POST['Wachtwoord']);

    $pdo = verbindDB();
    $gebruiker = inloggen($pdo, $mail);
    unset($pdo);


    if(!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "De ingevoerde mail klopt niet";
    }

    if(!password_verify($wachtwoord, $gebruiker['wachtwoord'])) {
        $errors[] = "Wachtwoord en/of mail adres komt niet overeen";
    }

    if (count($errors) == 0) {
        if ($gebruiker['verkoper'] == "ja") {
            $_SESSION['rol'] = 'verkoper';
        } else {
            $_SESSION['rol'] = 'koper';
        }

        $_SESSION['gebruikersnaam'] = $gebruiker['gebruikersnaam'];
        $_SESSION['voornaam'] = $gebruiker['voornaam'];
        $_SESSION['achternaam'] = $gebruiker['achternaam'];
    }
}
?>
<main class="container is-fluid">
    <div class="columns inlog">
        <div class="infoblockInlog column">
            <section class="section is-small">
                <h1 class="title">Bestaande klanten</h1>
                <h2 class="subtitle">
                    Welkom terug bij EenmaalAndermaal! Vul hier uw gegevens in.
                </h2>
            </section>
            <form method="post">
                <div class="field">
                    <label class="label">Gebruikersnaam</label>
                    <div class="control">
                        <input class="input" type="text" name="Gebruikersnaam" placeholder="Gebruikersnaam" required>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Wachtwoord</label>
                    <div class="control">
                        <input class="input" type="password" name="Wachtwoord" placeholder="Wachtwoord">
                    </div>
                </div>
                <input class="button is-info" type="submit" name="Inloggen" value="Inloggen">
                <!-- PHP met query $uname & $pw == true naar profiel page anders error (uname of pw of combinatie is onjuist)-->
                <button class="button is-ghost">Wachtwoord vergeten?</button>
                <!-- LINK NAAR WACHTWOORD OPNIEUW INSTELLEN PAGINA-->
            </form>
        </div>

        <div class="infoblockInlog column">
            <section class="section is-small">
                <h1 class="title">Nieuwe klanten</h1>
                <h2 class="subtitle">
                    Nieuw bij EenmaalAndermaal? Maak binnen 2 minuten een account aan!
                </h2>
            </section>
            <form>
                <div class="field">
                    <label class="label">E-mailadres</label>
                    <div class="control">
                        <input class="input" type="email" placeholder="E-mailadres" required> 
                    </div>
                </div>
                <br>
                <input class="button is-info" type="submit" value="Registreren">
                <!-- PHP met query $mail of al bestaat == false naar registreer pagina anders error (mail bestaat al)-->
            </form>
        </div>
    </div>
</main>
