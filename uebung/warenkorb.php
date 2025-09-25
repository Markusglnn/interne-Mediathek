<?php
$pagetitle= 'Warenkorb';
include "_con.php";
include "_header.php";

// Wenn eine ID in der URL ist, dann wird die id in $ID variable gespeichert
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // wenn keine session mit cart existiert, dann soll eine session cart angelegt werden als array
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    /* wenn die id aus der url noch nicht in session cart eingetragen ist, dann soll sie in cart gespeichert werden.
       Somit lasse ich zu, dass jeder Mitarbeiter nur Ein Buch der gleichen id ausleihen darf.*/
    if (!in_array($id, $_SESSION['cart'])) {
        $_SESSION['cart'][] = $id;
    }

    
}
// $cart liest alle Daten aus die in der Session cart gespeichert wurden
$cart = $_SESSION['cart'] ?? [];
// Wenn die Session cart leer ist, dann wird dies auch mitgeteilt.
if (empty($cart)) {
    echo '
    <div style="display: flex; justify-content: center; align-items: center; height: 100vh;">
        <p style="font-size: 50px; margin: 0; color: #db7438;">Dein Warenkorb ist leer.</p>
    </div>';
    exit;
}

// Dynamisch Platzhalter.Alle IDS werden in $placeholders eingetragen
$placeholders = [];
foreach ($cart as $index => $id) {
    $placeholders[] = ":id" . $index;
}
/* damit die Abfrage später mit SQL gelingen kann, braucht es komma zwischen den ids. 
    implode bindet  komma und id 
*/
$placeholders_str = implode(',', $placeholders);



$sql = "SELECT * FROM medium WHERE medium_id IN ($placeholders_str)";
$stid = oci_parse($conn, $sql);

// Bindung der IDs an Platzhalter
foreach ($cart as $index => $id) {
    oci_bind_by_name($stid, ":id" . $index, $cart[$index]);
}

oci_execute($stid);

?>
<main>
    <div id="nutzer_bearbeiten">
        <form action="ausleihe_speichern.php" method="POST">
            <h2>Warenkorb</h2>
            <table>
                <tr>
                    <th>Titel</th>
                    <th>Typ</th>
                    <th>Optionen</th>
                </tr>
                <?php while ($row = oci_fetch_assoc($stid)) : ?>
                    <tr>
                        <td><?= htmlspecialchars($row['TITEL']) ?></td>
                        <td><?= htmlspecialchars($row['TYP']) ?></td>
                        <td>
                            <a id="option_links" href="zeile_loeschen.php?id=<?= urlencode($row['MEDIUM_ID']) ?>">löschen</a>
                        </td>                   
                        <td style="display: none;">
                            <input type="hidden" name="MEDIUM_ID[]" value="<?= htmlspecialchars($row['MEDIUM_ID']) ?>">
                            <input type="hidden" name="TITEL[]" value="<?= htmlspecialchars($row['TITEL']) ?>">
                            <input type="hidden" name="TYP[]" value="<?= htmlspecialchars($row['TYP']) ?>">
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>

            <div id="button">
                <button id="button" type="submit">Ausleihen</button>
                <button id="button" type="button" onclick="window.location.href='medien_uebersicht.php'">Medien</button>
            </div>
        </form>
    </div> 
</main>
<?php 
include "_footer.php";
?>