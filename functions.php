<?php
// auteur: Lorenzo van der Horst
// functie: algemene functies tbv hergebruik
 function ConnectDb(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "3dplus";
   
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        //echo "Connected successfully";
        return $conn;
    } 
    catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

 }

 
 // selecteer de data uit de opgeven table
 function GetData($table){
    // Connect database
    $conn = ConnectDb();

    // Select data uit de opgegeven table methode query
    // query: is een prepare en execute in 1 zonder placeholders
    // $result = $conn->query("SELECT * FROM $table")->fetchAll();

    // Select data uit de opgegeven table methode prepare
    $query = $conn->prepare("SELECT * FROM $table");
    $query->execute();
    $result = $query->fetchAll();

    return $result;
 }

 // selecteer de rij van de opgeven filmid uit de table film
 function Getfilm($filmid){
    // Connect database
    $conn = ConnectDb();

    // Select data uit de opgegeven table methode prepare
    
    $query = $conn->prepare("SELECT * FROM film WHERE filmid = :filmid");
    $query->execute([':filmid'=>$filmid]);
    $result = $query->fetch();

    return $result;
 }


 function Ovz3dplus(){

    // Haal alle film record uit de tabel 
    $result = GetData("film");
    
    //print table
    PrintTable($result);
    //PrintTableTest($result);
    
 }

 
// Function 'PrintTable' print een HTML-table met data uit $result.
function PrintTable($result){
    // Zet de hele table in een variable en print hem 1 keer 
    $table = "<table border = 1px>";

    // Print header table

    // haal de kolommen uit de eerste [0] van het array $result mbv array_keys
    $headers = array_keys($result[0]);
    $table .= "<tr>";
    foreach($headers as $header){
        $table .= "<th bgcolor=gray>" . $header . "</th>";   
    }

    // print elke rij
    foreach ($result as $row) {
        
        $table .= "<tr>";
        // print elke kolom
        foreach ($row as $cell) {
            $table .= "<td>" . $cell . "</td>";
        }
        $table .= "</tr>";
    }
    $table.= "</table>";

    echo $table;
}


function Crud3dplus(){

    // Menu-item   insert
    $txt = "
    <h1>Crud film</h1>
    <nav>
		<a href='insert_film.php'>Toevoegen nieuw filmtje</a>
    </nav>";
    echo $txt;

    // Haal alle film record uit de tabel 
    $result = GetData("film");

    //print table
    PrintCrudfilm($result);
    
 }
 // Function 'PrintCrudfilm' print een HTML-table met data uit $result 
 // en een wzg- en -verwijder-knop.
function PrintCrudfilm($result){
    // Zet de hele table in een variable en print hem 1 keer 
    $table = "<table border = 1px>";

    // Print header table

    // haal de kolommen uit de eerste [0] van het array $result mbv array_keys
    $headers = array_keys($result[0]);
    $table .= "<tr>";
    foreach($headers as $header){
        $table .= "<th bgcolor=gray>" . $header . "</th>";   
    }
    $table .= "</tr>";

    // print elke rij
    foreach ($result as $row) {
        
        $table .= "<tr>";
        // print elke kolom
        foreach ($row as $cell) {
            $table .= "<td>" . $cell . "</td>";
            
        }
        
        // Wijzig knopje
        $table .= "<td>". 
            "<form method='post' action='update_film.php?filmid=$row[filmid]' >       
                    <button name='wzg'>Wzg</button>	 
            </form>" . "</td>";

        // Delete via linkje href
        $table .= '<td><a href="delete_film.php?filmid='.$row["filmid"].'">verwijder</a></td>';
        
        $table .= "</tr>";
    }
    $table.= "</table>";

    echo $table;
}


function Updatefilm($row){
       
    try{
        // Connect database
        $conn = ConnectDb();
        
        // Update data uit de opgegeven table methode prepare
        $sql = "UPDATE film
        SET 
            filmnaam = '$row[filmnaam]', 
            genreid = '$row[genreid]', 
            releasejaar = '$row[releasejaar]', 
            regisseur = '$row[regisseur]', 
            landherkomst = '$row[landherkomst]' 
            duur = '$row[duur]' 
        WHERE filmid = $row[filmid]";
        
        $query = $conn->prepare($sql);
        $query->execute();
        
    }

    catch(PDOException $e) {
        echo "Update failed: " . $e->getMessage();
    }
}

function InsertFilm($post){
    try {
        $conn = ConnectDb();

        
        $query = $conn->prepare("
        INSERT INTO film (filmnaam, genreid, releasejaar, regisseur, landherkomst, duur) 
        VALUES (:filmnaam, :genreid, :releasejaar, :regisseur, :landherkomst, :duur)");

        //Oplossing 2
        $query->execute(
            [
                ':filmnaam'=>$post['filmnaam'],
                ':genreid'=>$post['genreid'],
                ':releasejaar'=>$post['releasejaar'],
                ':regisseur'=>$post['regisseur'],
                ':landherkomst'=>$post['landherkomst'],
                ':duur'=>$post['duur']
            ]
        );
    }

    catch(PDOException $e) {
        echo "Insert failed: " . $e->getMessage();

    }
}

function Deletefilm($filmid){
    echo "Delete row<br>";
    try{
        // Connect database
        $conn = ConnectDb();
        
        // Update data uit de opgegeven table methode prepare
        $sql = "DELETE FROM film
                WHERE filmid = '$filmid'";
                
        $query = $conn->prepare($sql);
        $result = $query->execute();

    }

    catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();

    }
}

function dropDown2($label, $data, $row_selected=-1){
    $text = "<label for='$label'>Choose a $label:</label>
            <select name='$label' id='$label'>";

    foreach($data as $row){
        $text .= "<option value='$row[landherkomst]'>$row[filmnaam]</option>\n";
    }

    $text .= "</select>";

    echo "$text";

}

function dropDownBrouwer($label, $row_selected){
    $data = GetData('brouwer');
    $txt = "
    <label for='$label'>Choose a $label:</label>
        <select name='$label' id='$label'>";


    $txt .= "</select>";

    echo $txt;
    
}


?>