<?php
$pagetitle= 'Medien';
include "_header.php";
include "_con.php";


$sql = "SELECT MEDIUM_ID, TITEL, TYP, 
                case when verfuegbar > 0 then 'Verfügbar' 
                else 'Verliehen'
                end as status
         FROM medium";
$stid = oci_parse($conn, $sql);
oci_execute($stid);
?>
<main>

    <div class="wrapper">
        <table id="user_uebersicht">
            <tr><?php  if ($_SESSION['isadmin'] == 1) {?>
                <th>MediumID</th>
                <?php }?>
                <th>Titel</th>
                <th>Typ</th>
                <th>Status</th>
                <th>Optionen</th>

            </tr>
            <?php while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) : ?>
                <!-- OCI_ASSOC verwendet, damit ich den spaltennamen eintragen kann und nicht index 0 usw
            bei OCI_RETURN_NULLS bleibt da Feld nicht leer, sondern fügt eine echt 0 ein.-->
                <tr><tr><?php  if ($_SESSION['isadmin'] == 1) {?>
                    <td><?= htmlspecialchars($row['MEDIUM_ID'])?></td>
                    <?php }?>
                    <td><?= htmlspecialchars($row['TITEL']) ?></td>
                    <td><?= htmlspecialchars($row['TYP']) ?></td>
                    <td><?= htmlspecialchars($row['STATUS']) ?></td>
                    
                    <td><a href="warenkorb.php ?id=<?=urlencode($row['MEDIUM_ID']) ?>">Warenkorb</a></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</main>
<?php
/* Gibt die Speicherplatz wieder frei vom SQL befehl */
oci_free_statement($stid);
oci_close($conn);

include "_footer.php";
?>