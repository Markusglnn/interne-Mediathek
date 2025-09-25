<?php
include "_header.php";
include "_con.php";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $medium_id = $_POST['MEDIUM_ID'];
    $beschreibung = $_POST['BESCHREIBUNG'];
    $startzeit = $_POST['STARTZEIT'];
    $strasse = $_POST['STRASSE'];
    $plz = $_POST['PLZ'];
    $ort = $_POST['ORT'];

    $sql = 'begin
            proc_insert_event(:medium_ID, :beschreibung, :startzeit, :strasse, :plz, :ort);
            end;
            ';
    $stid = oci_parse($conn, $sql);
    oci_bind_by_name($stid, ':medium_id', $medium_id);
    oci_bind_by_name($stid, ':beschreibung', $beschreibung);
    oci_bind_by_name($stid, ':startzeit', $startzeit);
    oci_bind_by_name($stid, ':strasse', $strasse);
    oci_bind_by_name($stid, ':plz', $plz);
    oci_bind_by_name($stid, ':ort', $ort);

    oci_execute($stid);
    oci_free_statement($stid);
    oci_close($conn);

    if($stid) {
        ?>
        <div id="messageBox_not_none" class="box">
                   <div id="message_loeschen">
                       <h2>Benachrichtigung</h2>
                           <p>Event hinzugefügt</p>
                      <div id="message_löschen_aktion" >
                   <a href="event.php">OK</a>
               </div>
            </div>
        </div>
    <?php 
    }
} else {
    echo "es gibt kein Medium mit der id ".$medium_id;
}