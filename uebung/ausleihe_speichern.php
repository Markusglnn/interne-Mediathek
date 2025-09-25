<?php 
include "_con.php";
include "_header.php";

$nutzer_id = $_SESSION['nutzer_id'];

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $medium_IDs = $_POST['MEDIUM_ID'];
    $titel_liste = $_POST['TITEL'];
    $typ_liste = $_POST['TYP'];

    foreach ($medium_IDs as $i => $medium_ID) {
        // für jedes Element in medium_ids soll der untere sql block ausgeführt werden . Wenn kein Element mehr vorhanden ist, dann taucht die messagebox auf
    $sql = 'begin
            medium_ausleihen(:NUTZER_ID, :MEDIUM_ID);
            end;';
    $stid = oci_parse($conn, $sql );
    oci_bind_by_name($stid, ':NUTZER_ID', $nutzer_id);
    oci_bind_by_name($stid, ':MEDIUM_ID', $medium_ID);
    oci_execute($stid);
  }
}
if($stid){
    unset($_SESSION['cart']);
    header("Location:warenkorb.php");
}

?>