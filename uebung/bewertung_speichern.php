<?php 
include "_con.php";
include "_header.php";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nutzerid = $_POST['NUTZER_ID'];
    $mediumid = $_POST ['MEDIUM_ID'];
    $sterne = $_POST['STERNE'];
    
    $sql= 'begin
    bewertung_abgeben( :NUTZER_ID, :MEDIUM_ID,:STERNE);
    end;'
    ;

    $stid = oci_parse($conn, $sql);
    oci_bind_by_name($stid, ':NUTZER_ID', $nutzerid);
    oci_bind_by_name($stid, ':MEDIUM_ID', $mediumid);
    oci_bind_by_name($stid, ':STERNE', $sterne);

    oci_execute($stid);
    
    if ($stid) {
        ?>
        <div id="messageBox_not_none" class="box">
                   <div id="message_loeschen">
                       <h2>Benachrichtigung</h2>
                           <p>Bewertung erfolgreich</p>
                      <div id="message_löschen_aktion" >
                   <a href="aktuelle_ausleihe.php">OK</a>
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
                   <a href="bewerung_abgeben.php">OK</a>
               </div>
            </div>
        </div>
        <?php
    }
}
?>