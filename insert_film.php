<?php
    echo "<h1>Insert film</h1>";

    require_once('functions.php');
	 
	 

    // Test of er op de insert-knop is gedrukt 
    if(isset($_POST) && isset($_POST['btn_ins'])){
		 
        Insertfilm($_POST);
        echo '<script>alert("filmnaam: ' . $_POST['filmnaam'] . ' is toegevoegd")</script>';
        //echo "<script> location.replace('crud_3dplus.php'); </script>";
    }
?>

<html>
    <body>
        <form method="post">
        <br>
        filmnaam:<input type="" name="filmnaam"><br> 
        genreid: <input type="text" name="genreid"><br>
        releasejaar: <input type="text" name="releasejaar"><br>
        regisseur: <input type="text" name="regisseur"><br>
        landherkomst: <input type="text" name="landherkomst"><br>
        Duur: <input type="text" name="duur"><br>

        <br>
        <input type="submit" name="btn_ins" value="Insert"><br>
        </form>
        <br><br>
        <a href='crud_3dplus.php'>Home</a>
    </body>
</html>
