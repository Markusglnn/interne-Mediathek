<?php
include "_con.php";
include "_header.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nutzerId = $_POST['NUTZER_ID'];
    $vorname = $_POST['VORNAME'];
    $nachname = $_POST['NACHNAME'];
    $email = $_POST['EMAIL'];
    $passwort = $_POST['PASSWORT'];
    $abteilung = $_POST['ABTEILUNG'];
    $isadmin = $_POST['ISADMIN'];

    $sql = 'UPDATE USERS SET
            vorname = :VORNAME,
            nachname = :NACHNAME,
            email    = :EMAIL,
            passwort = :PASSWORT,
            abteilung = :ABTEILUNG,
            isadmin   = :ISADMIN
            where email = :EMAIL'
            ;
    $stid = oci_parse($conn, $sql );
    oci_bind_by_name($stid, ':VORNAME', $vorname);
    oci_bind_by_name($stid, ':NACHNAME', $nachname);
    oci_bind_by_name($stid, ':EMAIL', $email);
    oci_bind_by_name($stid, ':PASSWORT', $passwort);
    oci_bind_by_name($stid, ':ABTEILUNG', $abteilung);
    oci_bind_by_name($stid, ':ISADMIN', $isadmin);
    
    oci_execute($stid);

    if($stid) {
        ?>
            <div id="messageBox_not_none" class="box">
                   <div id="message_loeschen">
                       <h2>Benachrichtigung</h2>
                           <p> Erfolgreich gespeichert</p>
                      <div id="message_löschen_aktion" >
                   <a href="nutzer_hinzufügen.php">OK</a>
               </div>
            </div>
        </div>
        <?php
    } else {
        ?>
        <div id="messageBox_not_none" class="box">
                   <div id="message_loeschen">
                       <h2>Benachrichtigung</h2>
                           <p>Etwas ist schief gelaufen</p>
                      <div id="message_löschen_aktion" >
                   <a href="nutzer_hinzufügen.php">Zurück</a>
               </div>
            </div>
        </div>
        <?php
    }
}


?>  
