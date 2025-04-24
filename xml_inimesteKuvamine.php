<?php
$inimene=simplexml_load_file("inimesed.xml")
?>
<!DOCTYPE html>
<html>
<head>
    <title>XML inimeste lugemine PHP abil</title>
</head>
<body>
<h2>inimesed.xml failist sisu</h2>
<ul>
    <?php
    echo "<strong>1.inimese andmed:</strong>";
    echo $inimene->inimene[0]->eesnimi." ";
    echo $inimene->inimene[0]->perekonnanimi.", ";
    //xml atribuuti lugemine
    echo $inimene->inimene[0]->attributes()->isikukood;
    ?>
    <table>
        <tr>
            <th>Id</th>
            <th>Nimi</th>
            <th>Perenimi</th>
            <th>Sugu</th>
            <th>e-mail</th>
            <th>LapseAndmed</th>
        </tr>
        <?php
        foreach($inimene->inimene as $isik){
            echo "<tr>";
            echo "<td>".$isik->id."</td>";
            echo "<td>".$isik->eesnimi."</td>";
            echo "<td>".$isik->perekonnanimi."</td>";
            echo "<td>".$isik->sugu."</td>";
            echo "<td>".$isik->email."</td>";
            echo "<td>".$isik->laps."</td>";
            echo "</tr>";
        }
        ?>
    </table>
</ul>
</body>
</html>