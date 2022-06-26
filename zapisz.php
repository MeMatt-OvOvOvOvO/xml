<?php
$doc = new DOMDocument();
$doc->load('plik.xml');
$xpath = new DOMXpath($doc);
if(isset($_POST["Zapisz"])){
    $ID = $_POST["ID"];
    $NewName = $_POST["Name"];
    $NewBild = $_POST["Bild"];
    $NewAutor = $_POST["Autor"];
    $NewZeitschrift = $_POST["Zeitschrift"];

    $pathh = $xpath->query('//Spiel[ID="' . $ID . '"]')->item(0);
    $xpath->query('//Spiel[ID="' . $ID . '"]/Name')->item(0)->nodeValue = $NewName;
    $xpath->query('//Spiel[ID="' . $ID . '"]/Bild')->item(0)->nodeValue = $NewBild;
    $xpath->query('//Spiel[ID="' . $ID . '"]/Autor')->item(0)->nodeValue = $NewAutor;
    $xpath->query('//Spiel[ID="' . $ID . '"]/Zeitschrift')->item(0)->nodeValue = $NewZeitschrift;
    $doc->save("plik.xml");


}


header("Location: index.php");
exit();