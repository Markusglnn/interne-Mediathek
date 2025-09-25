<?php 
session_start();
include "_con.php";
?>
<nav>
    <ul>
        <?php 
        $sql = 'SELECT * FROM USERS ';
        $stid = oci_parse($conn, $sql);
        oci_execute($stid);
        $row = oci_fetch_assoc($stid);


        
        if ($_SESSION['isadmin'] == 0  ) { ?>

            
            <li><button><a href="aktuelle_ausleihe.php" class="aktiv">Aktuelle Ausleihe</a></button></li>
            <li><a href="medien_uebersicht.php">Medien</a></li>
            <li><a href="top_medien.php">Top Medien</a></li>
            <li><a href="warenkorb.php">Warenkorb</a></li>
            <li><a href="event.php">Event</a></li>
            <li><a href="einstellungen.php">Einstellungen</a></li>
            <li><a href="logout.php">Logout</a></li>
            <p>Willkommen <br><?php echo $_SESSION['vorname'];?></p>
        <?php
        }else {
             ?>
             <li><a href="nutzer_uebersicht.php">Benutzer</a></li>  
            <li><a href="aktuelle_ausleihe.php">Aktuelle Ausleihe</a></li>
            <li><a href="Ausleihe.php" class="aktiv">Ausleihe</a></li>
            <li><a href="medien_uebersicht.php">Medien</a></li>
            <li><a href="top_medien.php">Top Medien</a></li>
            <li><a href="warenkorb.php">Warenkorb</a></li>  
            <li><a href="event.php">Event</a></li> 
            <li><a href="einstellungen.php">Einstellungen</a></li> 
            <li><a href="logout.php">Logout</a></li>
            <p>Willkommen <br> <?php echo $_SESSION['vorname'];?></p>
        <?php
    }?>
        
    </ul>
</nav>

    
</body>
</html>