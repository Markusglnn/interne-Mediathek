<?php
$pagetitle = 'bearbeiten';
include "_con.php";
include "_header.php";


$id = $_GET['id']; /*Holt die Nutzer ID aus der URL*/


// Nutzer-Daten auslesen
$sql_select = "SELECT * FROM USERS WHERE nutzer_id = :id";
$stid = oci_parse($conn, $sql_select);
oci_bind_by_name($stid, ":id", $id);
oci_execute($stid);
$row = oci_fetch_assoc($stid); // Holt die Zeile als assoziatives Array


?>
<main>

        <div id="nutzer_bearbeiten">
            
            <form action="nutzer_speichern.php" method = "post">
                <h2>Benutzerdaten bearbeiten</h2>
                <table>
                
                    <tr>
                        <th><label for="vorname">Vorname</th>
                        <td> <input name="VORNAME" id="vorname" value=" <?= htmlspecialchars($row['VORNAME']) ?>"></label></td>
                    </tr>
                    <tr>
                        <th><label for="nachname">Nachname</th>
                        <td> <input name="NACHNAME" id="nachname" value ="<?= htmlspecialchars($row['NACHNAME'])?>"></label></td>
                    </tr>
                    <tr>
                        <th><label for="email">Email</th></label>
                        <td> <input name="EMAIL" id="email" value="<?= htmlspecialchars($row['EMAIL'])?>"></td>
                    </tr>
                    <tr>
                        <th><label for="passwort">Passwort</th></label>
                        <td> <input name="PASSWORT" id="passwort" value="<?= htmlspecialchars($row['PASSWORT'])?>"></td>
                    </tr>
                    <tr>
                        <th><label for="abteilung">Abteilung</th></label>
                        <td> <input name="ABTEILUNG" id="abteilung" value="<?= htmlspecialchars($row['ABTEILUNG'])?>"></td>
                    </tr>
                    <tr>
                        <th><label for="isadmin">IsAdmin</th></label>
                        <td> <input name="ISADMIN" id="isadmin" value="<?= htmlspecialchars($row['ISADMIN'])?>"></td>
                    </tr>

                    <input type="hidden" name="NUTZER_ID" value="<?= htmlspecialchars($row['NUTZER_ID']) ?>">
                </table>
            
                <div id="button">
                    <button id="button" onclick="alert_message()" type="submit">Speichern</button>
                    <button id="button" type="button" onclick="window.location.href='nutzer_uebersicht.php'">Zurück</button>       
            </div>
        </form>
    </div>

</main>
<?php 
include "_footer.php";
?>
<script>
    function alert_message (id) {
        document.getElementById('messageBox').style.display='flex';
    } 
</script>