<?php
    // auteur: Lorenzo van der Horst
    // functie: wijzig een film op basis van de filmid
    
    echo "<h1>Update film</h1>";
    require_once('functions.php');

    // Test of er op de wijzig-knop is gedrukt 
    if(isset($_POST) && isset($_POST['btn_wzg'])){
        Updatefilm($_POST);

        //header("location: update.php?$_POST[NR]");
    }

    if(isset($_GET['filmid'])){  
        echo "Data uit het vorige formulier:<br>";
        // Haal alle info van de betreffende filmid $_GET['filmid']
        $filmid = $_GET['filmid'];
        $row = Getfilm($filmid);
    }
   ?>

<html>
    <<head>
       <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <form method="post">
        <br>
        filmid:<input type="" name="filmid" value="<?php echo $row['filmid'];?>"><br>
        <label for="filmnaam">filmnaam</label>
        <input type="" name="filmnaam" id="filmnaam"value="<?php echo $row['filmnaam'];?>"><br> 
        <label for="genreid">genreid</label>
        <input type="text" name="genreid" id="genreid" value="<?= $row['genreid']?>"><br>
        <label for="releasejaar">releasejaar</label>
        <input type="text" name="releasejaar" id="releasejaar" value="<?= $row['releasejaar']?>"><br>
        <label for="regisseur">regisseur</label>
        <input type="text" name="regisseur"id="regisseur" value="<?= $row['regisseur']?>"><br>
        <label for="landherkomst">landherkomst</label>
        <input type="text" name="landherkomst"id="landherkomst" value="<?= $row['landherkomst']?>"><br>
        <label for="duur">duur</label>
        <input type="text" name="duur"id="duur" value="<?= $row['duur']?>"><br>
        
         <input type="submit" name="btn_wzg" value="Wijzigen"><br>
        </form>
    </body>
</html>