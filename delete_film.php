<?php
// auteur: Lorenzo van der Horst
// functie: verwijder een film op basis van de filmid
include 'functions.php';

// Haal film uit de database
if(isset($_GET['filmid'])){
    Deletefilm($_GET['filmid']);

    echo '<script>alert("filmid: ' . $_GET['filmid'] . ' is verwijderd")</script>';
    echo "<script> location.replace('crud_3dplus.php'); </script>";
}
?>

