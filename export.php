<?php
require './vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$doc = new DOMDocument();
$doc->load('plik.xml');

$ID = $doc->getElementsByTagName('ID');
$Name = $doc->getElementsByTagName('Name');
$Bild = $doc->getElementsByTagName('Bild');
$Autor = $doc->getElementsByTagName('Autor');
$Zeitschrift = $doc->getElementsByTagName('Zeitschrift');

$IDArr = array();
foreach($ID as $idek){
    $id_text = $idek->textContent;
    $IDArr[] = $id_text;
    if(in_array($idek, $IDArr, true)){
        array_push($IDArr, $id_text);
    };
}
$NameArr = array();
foreach($Name as $namek){
    $name_text = $namek->textContent;
    $NameArr[] = $name_text;
    if(in_array($namek, $NameArr, true)){
        array_push($NameArr, $name_text);
    };
}
$BildArr = array();
foreach($Bild as $bildek){
    $bild_text = $bildek->textContent;
    $BildArr[] = $bild_text;
    if(in_array($bildek, $BildArr, true)){
        array_push($BildArr, $bild_text);
    };
}
$AutorArr = array();
foreach($Autor as $authorek){
    $autor_text = $authorek->textContent;
    $AutorArr[] = $autor_text;
    if(in_array($authorek, $AutorArr, true)){
        array_push($AutorArr, $autor_text);
    };
}
$ZeitschriftArr = array();
foreach($Zeitschrift as $zeitschriftek){
    $zeitschrift_text = $zeitschriftek->textContent;
    $ZeitschriftArr[] = $zeitschrift_text;
    if(in_array($zeitschriftek, $ZeitschriftArr, true)){
        array_push($ZeitschriftArr, $zeitschrift_text);
    };
}
for($i = 0;$i<count($IDArr);$i++){
    $sheet->setCellValue('A'.strval($i+1), $BildArr[$i]);
    $drawing = new Drawing();
    $drawing->setName($BildArr[$i]);

    if($BildArr[$i] !== "Cyberpunk.jpg" & $BildArr[$i] !== "DOOM-Eternal.jpg" & $BildArr[$i] !== "God-Of-War.jpg" & $BildArr[$i] !== "Valhalla.jpg" & $BildArr[$i] !== "WatchDogs2.jpg"){
        $drawing->setPath("./img/default.png");
    }else{
       $drawing->setPath("./img/".$BildArr[$i]);
    }
    $comment = $sheet->getComment('A'.strval($i+1));
    $comment->setBackgroundImage($drawing); 
    
    // Set the size of the comment equal to the size of the image 
    $comment->setHeight(170);

    $sheet->setCellValue('B'.strval($i+1), $NameArr[$i]);
    $sheet->setCellValue('C'.strval($i+1), $AutorArr[$i]);
    $sheet->setCellValue('D'.strval($i+1), $ZeitschriftArr[$i]);
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="xml.xlsx"');


$writer = new Xlsx($spreadsheet);
$writer->save('php://output');


header("Location: index.php");
exit();

?>