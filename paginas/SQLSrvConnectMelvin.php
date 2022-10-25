<?php
$dsn =
"sqlsrv:Server=DESKTOP-7D6VJ9Q\SQLEXPRESS;Database=eenmaalAndermaal;ConnectionPooling=0";
try {
 $conn = new PDO($dsn);
 $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);}
catch(PDOException $e) {
 echo $e->getMessage();
}

?>