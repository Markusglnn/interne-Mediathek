<?php
$pagetitle = 'Event';
include "_con.php";
include "_header.php";



$sql = 'SELECT me.TITEL, ev.EVENT_ID, ev.BESCHREIBUNG, ev.STARTZEIT, ev.STRASSE, ev.PLZ, ev.ORT  FROM medium me
        join EVENT ev on me.medium_id = ev.medium_id';
$stid = oci_parse($conn, $sql);
oci_execute($stid);
?>
<main>
<div class="wrapper">

    <?php if ($_SESSION['isadmin'] == 1) { ?>

        <a id="option_links" href="event_hinzufügen.php">
            <img src="img/hinzufügen.png" alt="hinzufügen">
        </a>
    <?php } ?>

    <table id="user_uebersicht">
        <tr>
            <?php if ($_SESSION['isadmin'] == 1) { // Nur Admin darf das sehen 
            ?>
                <th>EventID</th>
            <?php } ?>
            <th>Titel</th>
            <th>Beschreibung </th>
            <th>Start </th>
            <th>Straße </th>
            <th>Postleitzahl </th>
            <th>Ort </th>

            <?php if ($_SESSION['isadmin'] == 1) { // Nur Admin darf das sehen
            ?>
                <th>Optionen</th>
            <?php } ?>

        </tr>


        <?php while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) : { ?>
                <tr>


                    <?php if ($_SESSION['isadmin'] == 1) { ?>
                        <td><?= htmlspecialchars($row['EVENT_ID']) ?></td>
                    <?php }  ?>

                    <td><?= htmlspecialchars($row['TITEL']) ?></td>
                    <td><?= htmlspecialchars($row['BESCHREIBUNG']) ?></td>
                    <td><?= htmlspecialchars($row['STARTZEIT']) ?></td>
                    <td><?= htmlspecialchars($row['STRASSE']) ?></td>
                    <td><?= htmlspecialchars($row['PLZ']) ?></td>
                    <td><?= htmlspecialchars($row['ORT']) ?></td>



                    <?php if ($_SESSION['isadmin'] == 1) { // Nur Admin darf das sehen
                    ?>
                        <td><a id="option_links" href="event_loeschen.php ?id=<?= urlencode($row['EVENT_ID']) ?>">
                                <img src="img\loeschen.png" alt="Löschen" style="width:16px; height:16px;">
                            </a>
                        </td>

                    <?php } ?>
            <?php }
        endwhile; ?>

                </tr>

    </table>
</div>
    </main>
<?php
include "_footer.php";
?>