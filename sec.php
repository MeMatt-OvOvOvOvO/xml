<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XML</title>
    <style>
        table{
            width: 55%;
        }
        tbody td {
        text-align: center;
        }
        .divek{
            background-color: lightgray;
            margin-left: 46%;
        }
        .divek1{
            background-color: lightgray;
            margin-left: 10px;
        }
        .image{
            height: 200px;
            width: 170px;
        }
        table.center {
            margin-left: auto; 
            margin-right: auto;
            margin-top:20px;
        }
    </style>
</head>
<body>
    <div >
        <a class="divek" href="index.php">Artikel</a>
        <a class="divek1" href="sec.php">Vorschau</a>
        <a class="divek1"  href="export.php">Export</a>
    </div>
    <table class="center">
        <thead>
            <tr>
                <!-- <th>ID</th> -->
                <th>Name</th>
                <th>Bild</th>
                <th>Autor</th>
                <th>Zeitschrift</th>
            </tr>
        </thead>
        <tbody>
            <?php
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

                ?>
                <?php for($a = 0; $a<count($IDArr); $a++ ):?>
            <tr>
                    <!-- <td>
                        <?php# echo($IDArr[$a]);?>
                    </td> -->
                    <td><?php echo($NameArr[$a]);?></td>
                    <td><img src="img/<?php 
                    
                    if($BildArr[$a] !== "Cyberpunk.jpg" & $BildArr[$a] !== "DOOM-Eternal.jpg" & $BildArr[$a] !== "God-Of-War.jpg" & $BildArr[$a] !== "Valhalla.jpg" & $BildArr[$a] !== "WatchDogs2.jpg"){
                        echo("default.png");
                    }else{
                        echo($BildArr[$a]);
                    }
                
                    
                    
                    ?>" class="image"></td>
                    <td><?php echo($AutorArr[$a]);?></td>
                    <td><?php echo($ZeitschriftArr[$a]);?></td>
            </tr>
            <?php endfor; ?>      
        </tbody>
    </table>
</body>
</html>