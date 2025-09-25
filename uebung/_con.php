<?php
$username = "MWGILLEN";
$password = "Pdb-2025";
$connection_string = "(DESCRIPTION =
    (ADDRESS = (PROTOCOL = TCP)(Host = 172.16.1.31)(Port = 1521))
    (CONNECT_DATA = (SERVICE_NAME = PDBDEVL.optimal-online.de))
  )"; 
// sorgt dafür, dass die Daten, die man von der Datenbank mit Fetch in UFT-8 umwandelt. Somit kein ü etc in der Tabelle
putenv("NLS_LANG=GERMAN_GERMANY.AL32UTF8");
//statt localhost braucht man hier die IP vom Server
$conn = oci_connect($username, $password, $connection_string);

// Prüfen, ob die Verbindung erfolgreich war
if (!$conn) {
    $e = oci_error();
    echo "Verbindung fehlgeschlagen: " . $e['message'];
}

