<?php
$pagetitle= 'Top Medien';
include "_header.php";
include "_con.php";


$sql = 'SELECT * FROM top_medien';
$stid = oci_parse($conn, $sql);
oci_execute($stid);
?>
<main>
    <div class="wrapper">
        <table>
            <tr>
                <th>Titel</th>
                <th>Typ</th>
                <th>Sterne</th>
            </tr>
            <?php while ($row = oci_fetch_array($stid, OCI_ASSOC)) : ?>
            <tr>
                <td><?= $row['TITEL'] ?></td>
                <td><?= $row['TYP']?></td>
                <td><?= $row['STERNE']?></td>
            </tr>
            <?php endwhile;?>
        </table>
    </div>
</main>
        <?php include "_footer.php";  ?>
    </html>    
</body>
