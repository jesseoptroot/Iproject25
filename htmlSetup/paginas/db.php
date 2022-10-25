<?php
// Naam van server
$hostname = 'host.docker.internal';
// Naam van database
$dbname = 'eenmaalAndermaal';
// Je eigen gebruikersnaam
$username = 'applicatie';
// Je eigen password
$pw = 'test';

$dbh = new PDO("sqlsrv:Server=$hostname;Database=$dbname;ConnectionPooling=0", $username, $pw);
// Tijdens het ontwikkelen is het handig om meteen ook de foutmeldingen vanuit
// de database te kunnen lezen.
// Dat doen we met onderstaande regel:
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>