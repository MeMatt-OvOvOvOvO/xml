<?php
$doc = new DOMDocument();
$doc->load('plik.xml');
$ID = $doc->getElementsByTagName('ID');
$IDArr = array();
foreach($ID as $idek){
    $id_text = $idek->textContent;
    $IDArr[] = $id_text;
    if(in_array($idek, $IDArr, true)){
        array_push($IDArr, $id_text);
    };
}
$Name = strip_tags($_POST['Name']);
$Bild = strip_tags($_POST['Bild']);
$Autor = strip_tags($_POST['Autor']);
$Zeitschrift = $_POST['Zeitschrift'];
$lastID = end($IDArr);
if(isset($_POST['Addieren'])){
    if($Name == ''| $Bild == ''| $Autor == ''| $Zeitschrift == ''){
        print_r("");
    }else{
        $Spiele=$doc->firstChild;
        $Spiel=$doc->createElement("Spiel");
        $Spiele->appendChild($Spiel);
        $addID=$doc->createElement("ID", $lastID+1);
        $Spiel->appendChild($addID);
        // $addEdit=$doc->createElement("Edit", "No");
        // $Spiel->appendChild($addEdit);
        $addName=$doc->createElement("Name", $Name);
        $Spiel->appendChild($addName);
        $addBild=$doc->createElement("Bild", $Bild);
        $Spiel->appendChild($addBild);
        $addAutor=$doc->createElement("Autor", $Autor);
        $Spiel->appendChild($addAutor);
        $addZeitschrift=$doc->createElement("Zeitschrift", $Zeitschrift);
        $Spiel->appendChild($addZeitschrift);
        $doc->save("plik.xml");
    }
}
header("Location: index.php");
exit();
?>