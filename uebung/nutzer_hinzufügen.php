   <?php 
   $pagetitle = 'hinzufügen';
   include "_con.php";
   include "_header.php";

   ?>
<main>
   <div id="nutzer_bearbeiten">
        
        <form id="nutzer_form" action="nutzer_einfuegen.php" method = "post">
            <h2>Benutzer hinzufügen</h2>
            <table>
               
                <tr>
                    <th><label for="vorname">Vorname</th>
                    <td> <input name="VORNAME" id="vorname"></label></td>
                </tr>
                <tr>
                    <th><label for="nachname">Nachname</th>
                    <td> <input name="NACHNAME" id="nachname"></label></td>
                </tr>
                <tr>
                    <th><label for="email">Email</th></label>
                    <td> <input name="EMAIL" id="email"></td>
                </tr>
                <tr>
                    <th><label for="passwort">Passwort</th></label>
                    <td> <input name="PASSWORT" id="passwort"></td>
                </tr>
                <tr>
                    <th><label for="abteilung">Abteilung</th></label>
                    <td> <input name="ABTEILUNG" id="abteilung"></td>
                </tr>
                <tr>
                    <th><label for="isadmin">IsAdmin</th></label>
                    <td> <input name="ISADMIN" id="isadmin"></td>
                </tr>

                <input type="hidden" name="NUTZER_ID">
            </table>
        
            <div id="button">
                <button id="button" type="submit">Speichern</button>
                <button id="button" type="button" onclick="window.location.href='nutzer_uebersicht.php'">Zurück</button>       
        </div>
    </form>
</div>

</main>
<?php include "_footer.php"; ?>