<?php 
include "_con.php";
include "_header.php";


if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $vorname = $_POST['VORNAME'];
    $nachname = $_POST['NACHNAME'];
    $email = $_POST['EMAIL'];
    $passwort = $_POST['PASSWORT'];
    $abteilung = $_POST ['ABTEILUNG'];
    $isadmin = $_POST['ISADMIN'];

    $sql = ' begin 
     nutzer_registrieren(:VORNAME,:NACHNAME,:EMAIL,:ABTEILUNG,:PASSWORT,:ISADMIN);
    end;';
    $stid = oci_parse($conn, $sql);
    oci_bind_by_name($stid, ':VORNAME', $vorname);
    oci_bind_by_name($stid, ':NACHNAME', $nachname);
    oci_bind_by_name($stid, ':EMAIL', $email);
    oci_bind_by_name($stid, ':ABTEILUNG', $abteilung);
    oci_bind_by_name($stid, ':PASSWORT', $passwort);
    oci_bind_by_name($stid, ':ISADMIN', $isadmin);

    oci_execute($stid);
    oci_free_statement($stid);
    if($stid) {
        /*Messagebox funktioniert noch nicht*/ 

        ?>
         <div id="messageBox_not_none" class="box">
                   <div id="message_loeschen">
                       <h2>Benachrichtigung</h2>
                           <p> Die Daten  wurden erfolgreich gespeichert</p>
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
                           <p> Email ist schon vergeben</p>
                      <div id="message_löschen_aktion" >
                   <a href="nutzer_hinzufügen.php">Zurück</a>
               </div>
            </div>
        </div>
        <?php
    }
}
?> 
</body>
</html>


    
