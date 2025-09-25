<?php 
$pagetitle = 'bewerten';
include "_con.php"; 
include "_header.php";


$id = $_GET['id']; /*Holt die Nutzer ID aus der URL*/

$sql = 'SELECT * FROM ausleihe aus
        join medium med on med.medium_id = aus.medium_id 
        left join users us on us.nutzer_id = aus.nutzer_id
        WHERE TITEL = :id ';
$stid = oci_parse($conn, $sql);
oci_bind_by_name($stid, ':id', $id);
oci_execute($stid);
$row = oci_fetch_assoc($stid);
?>
<main>
    <div id="nutzer_bearbeiten">
            
            <form id="nutzer_form" action="bewertung_speichern.php" method = "post">
                <h2>Bewertung abgeben</h2>
                <table>
                
                    <tr>
                        <th><label for="vorname">Titel</th>
                        <td> <input name="VORNAME" id="vorname" value="<?= htmlspecialchars($row['TITEL'])?>" disabled></label></td>
                    </tr>
                    <tr>
                        <th><label for="nachname">Typ</th>
                        <td> <input name="NACHNAME" id="nachname" value="<?= htmlspecialchars($row['TYP'])?>" disabled></label></td>
                    </tr>
                    <tr>
                        <th><label for="sterne">Sterne</th></label>
                        <td> <input name="STERNE" id="sterne"></td>
                    </tr>
                    <input type="hidden" name="MEDIUM_ID" value="<?= htmlspecialchars($row['MEDIUM_ID']) ?>">
                    <input type="hidden" name="NUTZER_ID" value="<?= htmlspecialchars($row['NUTZER_ID']) ?>">
                </table>
            
                <div id="button">
                    <button id="button" type="submit">Speichern</button>
                    <button id="button" type="button" onclick="window.location.href='aktuelle_ausleihe.php'">Zurück</button>       
            </div>
        </form>
    </div>
</main>
<?php include "_footer.php";?>