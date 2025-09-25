<?php
session_start();
include "_con.php";



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Daten vom Loginfenster abfangen und speichern
    $email = $_POST['EMAIL'];
    $passwort = $_POST['PASSWORT'];

    //passwort hashen, damit ein Vergleich mit der Datenbank durchgeführt werden kann
    $sql_check = '
    DECLARE
    ergebnis number (11);
    BEGIN 
    :ergebnis := login_check(:PASSWORT, :EMAIL);
     END;';
    
    $stid = oci_parse($conn,$sql_check );
    oci_bind_by_name($stid, ':ergebnis', $ergebnis);
    oci_bind_by_name($stid, ':PASSWORT', $passwort);
    oci_bind_by_name($stid, ':EMAIL', $email);
    
    oci_execute($stid);
    // fetch_assoc , um nicht mit index arbeiten zu müssen , sondern mit den Elementen ( spaltennamen)
    $row = oci_fetch_assoc($stid);
   

    // Wenn beim Return 1 rauskam und in ergebnis gespeichert wurde, dann soll wenn 1 als return gespeichert wurde folgender SQL befehl stattfinden.
    if ($ergebnis == 1) {
         
         $sql = 'SELECT NUTZER_ID, VORNAME, EMAIL, ISADMIN 
                 FROM USERS 
                 WHERE EMAIL = :EMAIL';
        $stid = oci_parse($conn,$sql);
        oci_bind_by_name($stid, ':EMAIL', $email);
        oci_execute($stid);
        $row = oci_fetch_assoc($stid);
         
        // Das ganze in der Session speichern um zu überprüfen, ob der user ein Admin ist oder nicht
        // Falls noch andere Daten gebraucht werden für andere Dateien, müssten man diese auch hier abspeichern
        $_SESSION['nutzer_id'] = $row['NUTZER_ID'];
        $_SESSION ['vorname'] = $row['VORNAME'];
        $_SESSION['email'] = $row['EMAIL'];
        $_SESSION['isadmin'] = $row['ISADMIN'];
        

        if ($_SESSION['isadmin'] == 1) {
            header("Location: admin.php");
        } else{ 
            header("Location: user.php");
        }
        exit();
    } else {
        echo "Login fehlgeschlagen: E-Mail oder Passwort ist falsch.";
    }
} else {
    echo "Ungültiger Zugriff.";
}
