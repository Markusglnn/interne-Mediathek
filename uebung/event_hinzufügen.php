<?php
$pagetitle = 'Event hinzufügen';
include "_con.php";
include "_header.php";


?>
<main>
    <div id="nutzer_bearbeiten">
            
            <form id="nutzer_form" action="event_speichern.php" method = "post">
                <h2>Event hinzufügen</h2>
                <table>
                
                    <tr>
                        <th><label for="medium_id">MediumID</th>
                        <td> <input name="MEDIUM_ID" id="medium_id"></label></td>
                    </tr>
                    <tr>
                        <th><label for="beschreibung">Beschreibung</th>
                        <td> <input name="BESCHREIBUNG" id="beschreibung"></label></td>
                    </tr>
                    <tr>
                        <th><label for="startzeit">Start</th></label>
                        <td> <input name="STARTZEIT" id="startzeit"></td>
                    </tr>
                    <tr>
                        <th><label for="strasse">Straße</th></label>
                        <td> <input name="STRASSE" id="strasse"></td>
                    </tr>
                    <tr>
                        <th><label for="plz">Postleitzahl</th></label>
                        <td> <input name="PLZ" id="plz"></td>
                    </tr>
                    <tr>
                        <th><label for="ort">Ort</th></label>
                        <td> <input name="ORT" id="ort"></td>
                    </tr>

                </table>
            
                <div id="button">
                    <button id="button" type="submit">Speichern</button>
                    <button id="button" type="button" onclick="window.location.href='event.php'">Zurück</button>       
            </div>
        </form>
    </div>
</main>

<?php 
include "_footer.php";
?>