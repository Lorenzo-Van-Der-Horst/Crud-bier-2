<?php

    echo "<h1>Update film</h1>";
    require_once('functions.php');

    // Test of er op de wijzig-knop is gedrukt 
    if(isset($_POST['btn_wzg'])){
        Updatefilm($_POST);

        //header("location: crud_3dplus.php");
    }

    if(isset($_GET['filmid'])){  
        // Haal alle info van de betreffende filmid $_GET['filmid']
        $filmid = $_GET['filmid'];
        $row = Getfilm($filmid);
    
?>

<html>
    <body>
        <form method="post">
        <br>
        <input type="hidden" name="filmid" value="<?php echo $row['filmid'];?>"><br>
        filmnaam:<input type="" name="filmnaam" value="<?php echo $row['filmnaam'];?>"><br> 
        genreid: <input type="text" name="genreid" value="<?= $row['genreid']?>"><br>
        releasejaar: <input type="text" name="releasejaar" value="<?= $row['releasejaar']?>"><br>
        regisseur: <input type="text" name="regisseur" value="<?= $row['regisseur']?>"><br>
        landherkomst: <input type="text" name="landherkomst" value="<?= $row['landherkomst']?>"><br>
        duur: <input type="text" name="duur" value="<?= $row['duur']?>"><br>

        <!---landherkomst: <input type="text" name="landherkomst" value="<?= $row['landherkomst']?>">-->
        <br><br>
         <input type="submit" name="btn_wzg" value="Wijzigen"><br>
        </form>
        <br><br>
        <a href='crud_3dplus.php'>Home</a>
    </body>
</html>

<?php
    } else {
        "Geen filmid opgegeven<br>";
    }
?>