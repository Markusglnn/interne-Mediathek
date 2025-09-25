<?php
include "_con.php";
include "_header.php";

$id = $_GET['id']; /*Holt die Nutzer ID aus der URL*/


$sql_select = "DELETE FROM USERS WHERE nutzer_id = :id";
$stid = oci_parse($conn, $sql_select);
oci_bind_by_name($stid, ":id", $id);
oci_execute($stid);

oci_free_statement($stid);
oci_close($conn);

header("Location:nutzer_uebersicht.php");
?>


