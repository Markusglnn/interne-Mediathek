<?php
$pagetitle= 'Ausleihe';
include "_con.php";
include "_header.php";


$sql = "SELECT aus.ausleihe_id 
          ,titel
          ,typ
          ,us.vorname
          ,us.nachname
          ,us.email
          ,us.abteilung
          ,aus.ausleihdatum
          ,aus.faelligkeitsdatum
          ,aus.status
      from ausleihe aus
           join users us on (aus.nutzer_id = us.nutzer_id)
           join medium me on (aus.medium_id = me.medium_id)";
$stid = oci_parse($conn, $sql);
oci_execute($stid);


?>
<main>
    <div class="wrapper">
            <table>
                <tr>
                    <th>Ausleih_ID</th>
                    <th>Titel</th>
                    <th>Typ</th>
                    <th>Vorname </th>
                    <th>Nachname </th>
                    <th>Email </th>
                    <th>Abteilung </th>
                    <th>Ausleihdatum </th>
                    <th>Fälligkeitsdatum </th>
                    <th>Status</th>

                </tr>
                <?php while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) : ?>
                    <!-- OCI_ASSOC verwendet, damit ich den spaltennamen eintragen kann und nicht index 0 usw
                bei OCI_RETURN_NULLS bleibt da Feld nicht leer, sondern fügt eine echt 0 ein.-->

                    <?php if ($_SESSION['isadmin'] == 1) { ?>
                        <tr>
                            <td><?= htmlspecialchars($row['AUSLEIHE_ID'])?></td>
                            <td><?= htmlspecialchars($row['TITEL']) ?></td>
                            <td><?= htmlspecialchars($row['TYP']) ?></td>
                            <td><?= htmlspecialchars($row['VORNAME']) ?></td>
                            <td><?= htmlspecialchars($row['NACHNAME']) ?></td>
                            <td><?= htmlspecialchars($row['EMAIL']) ?></td>
                            <td><?= htmlspecialchars($row['ABTEILUNG']) ?></td>
                            <td><?= htmlspecialchars($row['AUSLEIHDATUM']) ?></td>
                            <td><?= htmlspecialchars($row['FAELLIGKEITSDATUM']) ?></td>
                            <td><?= htmlspecialchars($row['STATUS']) ?></td>
                            
                        </tr>
                    <?php } ?>
                <?php endwhile; ?>
                <input type="hidden" value="<?= htmlspecialchars($row['AUSLEIHE_ID']) ?>"> </td>
            </table>

    </div>
</main>
<?php
/* Gibt die Speicherplatz wieder frei vom SQL befehl */
oci_free_statement($stid);
oci_close($conn);
include "_footer.php";
?>

