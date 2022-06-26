<?php
error_reporting(0);
ini_set('display_errors', 0);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XML</title>
    <style>
        table{
            width: 75%;
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
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <!-- <th>ID</th> -->
                <th>Name</th>
                <th>Bild</th>
                <th>Autor</th>
                <th>Zeitschrift</th>
                <th></th>
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
                <?php for($a = 0; $a<count($IDArr); $a++ ):
                // print_r($IDArr[$a]);
                    if($IDArr[$a] === $_POST["IDDOPOB"]): ?>
                    <tr>
                    <form name="zapisz" method="POST" action="zapisz.php">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><input type="hidden" name="ID" value="<?php echo($IDArr[$a]);?>"></td>
                        <td><input type="text" name="Name" value="<?php echo($NameArr[$a]);?>"></td>
                        <td><input type="text" name="Bild" value="<?php echo($BildArr[$a]);?>"></td>
                        <td><input type="text" name="Autor" value="<?php echo($AutorArr[$a]);?>"></td>
                        <td><input type="text" name="Zeitschrift" value="<?php echo($ZeitschriftArr[$a]);?>"></td>
                        <td><input type='submit' name="Zapisz" value='Sparen'/></td>
                    </form>
                    </tr>





                    <?php else:?>
                    <tr>
                        <td><input type='submit' value='↑'/></td>
                        <td><input type='submit' value='↓'/></td>

                        <form name="edit" method="POST" action="index.php">
                            <td><input type='hidden' name="IDDOPOB" value='<?php echo($IDArr[$a]); ?>'/></td>
                            <td><input type='submit' name="Edit" value='A'/></td>
                        </form>
                        <!-- <td>
                            <?php# echo($IDArr[$a]);?>
                        </td> -->
                        <form name="delete" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <td><?php echo($NameArr[$a]);?></td>
                            <td><?php echo($BildArr[$a]);?></td>
                            <td><?php echo($AutorArr[$a]);?></td>
                            <td><?php echo($ZeitschriftArr[$a]);?></td>
                            <td><input type='submit' name="<?php echo($IDArr[$a]);?>" value='Löschen'/></td>
                        </form>
                    </tr>
            <?php
            endif; 
            if(isset($_POST[$IDArr[$a]])){
                $file = "plik.xml";
                delete_Spiel($IDArr[$a], $file);
                header("Refresh:0");
            }
        endfor; 

        function delete_Spiel($id, $file)
        {
            $xml = new DOMDocument();
            $xml->load($file);
            
            $mySpiel = $xml->getElementsByTagName('Spiel');
            foreach ($mySpiel as $Spielek) {
                $Spiel_id = $Spielek->getElementsByTagName('ID')->item(0)->nodeValue;
                if ($Spiel_id == $id) {
                    $id_matched = true;
                    $Spielek->parentNode->removeChild($Spielek);
                    break;
                }
            }
            if ($id_matched == true) {
                if ($xml->save($file)) {
                    return true;
                }
            }
            
        }
            ?>      
            <tr>
                <form name="myForm" method="POST" action="Addieren.php">
                    <td></td>
                    <td>Neue</td>
                    <td></td>
                    <td>Hinzufügen</td>
                    <!-- <td><input type='text'/></td> -->
                    <td><input type='text' name='Name'/></td>
                    <td><input type='text' name='Bild'/></td>
                    <td><input type='text' name='Autor'/></td>
                    <td><input type='text' name='Zeitschrift'/></td>
                    <td><input type='submit' name='Addieren' value='Addieren'/></td>
                </form>
            </tr>
        </tbody>
    </table>
    <a href="https://drive.google.com/file/d/19Rj9U9OCz-BH-uHioRNV2HT-2UqNWM31/view?usp=sharing">hrefff</a>
</body>
</html>