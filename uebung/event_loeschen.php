<?php
include "_con.php";

$id = $_GET['id'];

$sql = 'DELETE FROM EVENT
        WHERE EVENT_ID = :id';
$stid = oci_parse($conn, $sql);
oci_bind_by_name($stid, ':id', $id);
oci_execute($stid);
oci_free_statement($stid);
oci_close($conn); 

header("Location:event.php");
?>
