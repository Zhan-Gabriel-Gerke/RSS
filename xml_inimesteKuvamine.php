<?php

if (isset($_GET['code'])) {
    die(highlight_file(__FILE__, 1));
}

$inimene=simplexml_load_file("inimesed.xml");

if(isset($_POST['submit'])){
    $xmlDoc = new DOMDocument("1.0","UTF-8");
    $xmlDoc->preserveWhiteSpace = false;
    $xmlDoc->load('inimesed.xml');
    $xmlDoc->formatOutput = true;
    $xml_root = $xmlDoc->documentElement;
    $xmlDoc->appendChild($xml_root);
    $xml_inimene = $xmlDoc->createElement("inimene");
    $xmlDoc->appendChild($xml_inimene);
    $xml_root->appendChild($xml_inimene);

    $inimesed = $xml_root->getElementsByTagName('inimene');
    $new_id = $inimesed->length;
    $idElement = $xmlDoc->createElement("id", $new_id);
    $xml_inimene->appendChild($idElement);

    unset($_POST['submit']);
    foreach($_POST as $voti=>$vaartus){
        $kirje = $xmlDoc->createElement($voti,$vaartus);
        $xml_inimene->appendChild($kirje);
    }
    $xmlDoc->save('inimesed.xml');
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>XML inimeste lugemine PHP abil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h2>inimesed.xml failist sisu</h2>
<form action="" method="post" name="form1">
    <label for="eesnimi">Eesnimi </label>
    <input type="text" name="eesnimi" id="eesnimi" autofocus>
    <br>
    <label for="perekonnanimi">Perekonnanimi </label>
    <input type="text" name="perekonnanimi" id="perekonnanimi">
    <br>
    <label for="sugu">Sugu </label>
    <select name="sugu" name="sugu" id="sugu">
        <option value="Tundmatu">vali</option>
        <option value="Female">Female</option>
        <option value="Male">Male</option>
    </select>
    <br>
    <label for="email">E-mail </label>
    <input type="email" name="email" id="email" placeholder="zangerke3@gmail.com">
    <br>
    <input type="submit" name="submit" id="submit" value="Sisesta">
</form>
<ul>
    <?php
    /*echo "<strong>1.inimese andmed:</strong>";
    echo $inimene->inimene[0]->eesnimi." ";
    echo $inimene->inimene[0]->perekonnanimi.", ";
    //xml atribuuti lugemine
    echo $inimene->inimene[0]->attributes()->isikukood;*/
    ?>
    <table>
        <tr>
            <th>Id</th>
            <th>Nimi</th>
            <th>Perenimi</th>
            <th>Sugu</th>
            <th>e-mail</th>
            <th colspan='2'>LapseAndmed</th>
        </tr>
        <?php
        foreach ($inimene->inimene as $isik) {
            echo "<tr>";
            echo "<td>".$isik->id."</td>";
            echo "<td>".$isik->eesnimi."</td>";
            echo "<td>".$isik->perekonnanimi."</td>";
            echo "<td>".$isik->sugu."</td>";
            echo "<td>".$isik->email."</td>";
            if (isset($isik->laps)) {
                $laste_arv=count($isik->laps->inimene); //
                if ($laste_arv==1) {
                    $laps=$isik->laps->inimene;
                    echo "<td colspan='2'>";
                    echo "<div class='laps-andmed'>";
                    echo $laps->eesnimi." ".$laps->perekonnanimi."<br>";
                    echo $laps->sugu."<br>";
                    echo $laps->email;
                    echo "</div>";
                    echo "</td>";
                } else {
                    foreach($isik->laps->inimene as $laps){
                        echo "<td>";
                        echo "<div class='laps-andmed'>";
                        echo $laps->eesnimi." ".$laps->perekonnanimi."<br>";
                        echo $laps->sugu."<br>";
                        echo $laps->email;
                        echo "</div>";
                        echo "</td>";
                    }
                }
            } else {
                // Kui laps puudub, ühendame kaheks veeruks (colspan=2)
                echo "<td colspan='2'> </td>";
            }
            echo "</tr>";
        }
        ?>
    </table>
</ul>
</body>
</html>