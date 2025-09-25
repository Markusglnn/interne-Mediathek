<?php

include "_con.php";
include "_header.php";



if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Einfach prüfen und direkt löschen, falls vorhanden
    if (@in_array($id,$_SESSION['cart'])) {


       if(count($_SESSION['cart'])>1){
        $keys = array_keys($_SESSION['cart'], $id);
        unset($_SESSION['cart'][$keys[0]]);
       }else{
        unset($_SESSION['cart']);
       }

    }
}

header("Location:warenkorb.php");