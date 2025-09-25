<?php
$pagetitle= 'Benutzer';
include "_con.php";
include "_header.php";
?>

<?php
$sql = 'SELECT * FROM users';
$stid = oci_parse($conn, $sql);
oci_execute($stid);

?>
<main>
<div class="wrapper">
        <div id="menu"><a  href="nutzer_hinzufügen.php">
            <img src="img/hinzufügen.png" alt="hinzufügen">
        </a>
        <label for="suche"> Suche: </label>
        <input type="text" id="suche"  placeholder="Suche..." >
    </div>
    <table id="user_uebersicht">
        <tr>
            <th>Nutzer ID</th>  
            <th>Vorname</th>
            <th>Nachname </th>
            <th>Email </th>
            <th>Passwort </th>
            <th>Abteilung </th>
            <th>Rolle </th>
            <th>created at </th>
            <th>Optionen</th>

        </tr>
        <?php while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) : ?>
            <!-- OCI_ASSOC verwendet, damit ich den spaltennamen eintragen kann und nicht index 0 usw
        bei OCI_RETURN_NULLS bleibt da Feld nicht leer, sondern fügt eine echte 0 ein.-->
            <tr>
                <td><?= htmlspecialchars($row['NUTZER_ID']) ?></td>
                <td><?= htmlspecialchars($row['VORNAME']) ?></td>
                <td><?= htmlspecialchars($row['NACHNAME']) ?></td>
                <td><?= htmlspecialchars($row['EMAIL']) ?></td>
                <td><?= htmlspecialchars($row['PASSWORT']) ?></td>
                <td><?= htmlspecialchars($row['ABTEILUNG']) ?></td>
                <td><?= htmlspecialchars($row['ISADMIN']) ?></td>
                <td><?= htmlspecialchars($row['CREATED_AT']) ?></td>
                <td><a id="option_links" href="nutzer_bearbeiten.php ?id=<?= urlencode($row['NUTZER_ID']) ?>">
                        <img src="img\bearbeiten.png" alt="bearbeiten" style="width:16px; height:16px;">
                    </a>
                    <!-- Javascript:void(0) verhindert, dass der Link auf eine Seite weiterleitet. Hier nicht nötig, aber notiz für mich, dass sowas möglich ist-->
                    <a id="option_loeschen" href="javascript:void(0);" onclick="user_loeschen('<?= $row['NUTZER_ID'] ?>')">
                        <img src="img\loeschen.png" alt="löschen" style="width:16px; height:16px;">
                    </a>
                </td>           
            </tr>
        <?php endwhile; ?>
        
    </table>
    
</div>

<div id="messageBox" class="message-box" style="display: none;">
    <div id="message_loeschen">
        <h2>Löschen</h2>
        <p>Wollen Sie den Benutzer wirklich löschen?</p>
        <div id="message_löschen_aktion">
            <button id="button_message" onclick="confirmDelete()">Ja</button>
            <button id="button_message" onclick="cancelDelete()">Nein</button>
        </div>
    </div>
</div>


<div id="registerbox" class="wrapper wrapper_login" style="display: none;">
    <div>
        <div class="login">
            <h2>Hinzufügen</h2>
            <div id="label_input">
                <label for="vorname"> Vorname:</label>
                <input type="text" id="vorname">
                <label for="nachname"> Nachname:</label>
                <input type="text" id="nachname">
                <label for="email">Email: </label>
                <input type="text" id="email">
                <label for="passwort">Passwort: </label>
                <input type="text" id="passwort">
                <label for="abteilung">Abteilung</label>
                <input type="text" id="abteilung">
                <div>
                    <button onclick="">Registrieren</button>
                </div>
            </div>
        </div>
    </div>
</div>

        </main>


<?php
/* Gibt den Speicherplatz wieder frei vom SQL befehl */
oci_free_statement($stid);
oci_close($conn);

include "_footer.php";
?>

<script>
    let deleteUserId = null;

    function user_hinzufügen() {
        document.getElementById('registerbox').style.display = 'flex';
    }

    function user_loeschen(id) {
        deleteUserId = id;
        document.getElementById('messageBox').style.display = 'flex';
    }

    function confirmDelete() {
        if (deleteUserId !== null) {
            /*encodeURIComponent sorgt dafür , dass Sonderzeichen in einer url korrekt und sicher übergeben werden. 
             bei Fälle mit einer ID 144/255 Slash wegen slash wird encode gebraucht */
            window.location.href = 'nutzer_loeschen.php?id=' + encodeURIComponent(deleteUserId);
        }
    }

    function cancelDelete() {
        document.getElementById('messageBox').style.display = 'none';
        deleteUserId = null;
    }
</script>


</body>

</html>