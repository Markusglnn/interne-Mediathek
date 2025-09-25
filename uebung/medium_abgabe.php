<?php 
include "_con.php";

$id = $_GET['id'];

$sql = 'begin
        medium_zurueckgeben(:id);
        end;';
$stid = oci_parse($conn,$sql);
oci_bind_by_name($stid, ':id', $id);
oci_execute($stid);
oci_free_statement($stid);

header("Location:aktuelle_ausleihe.php")
?>