<?php
$andmed=simplexml_load_file('andmeteBaas.xml');

//andmete salvestamine xml faili, kus andmed lisatakse juurde

/*
 * andmevahetusvormingud
 */
if(isset($_POST['submit'])){


    $toodenimi=$_POST['nimi'];
    $toodehind=$_POST['hind'];
    $toodevarv=$_POST['varv'];
    $lisadenimi=$_POST['lnimi'];
    $lisadesuurus=$_POST['suurus'];

    $xml_tooded=$andmed->addChild('toode');
    $xml_tooded->addChild('nimi', $toodenimi);
    $xml_tooded->addChild('hind', $toodehind);
    $xml_tooded->addChild('varv', $toodevarv);



    $lisad=$xml_tooded->addChild('lisad');
    $lisad->addChild('lnimi', $lisadenimi);
    $lisad->addChild('suurus', $lisadesuurus);

    $xmlDoc = new DOMDocument("1.0", "UTF-8");
    $xmlDoc->loadXML($andmed->asXML(), LIBXML_NOBLANKS);
    $xmlDoc->formatOutput=true;
    $xmlDoc->preserveWhiteSpace=false;
    $xmlDoc->save('andmeteBaas.xml');
    header("refresh: 0;");
}
?>

<!DOCTYPE html>
<html lang="et">
    <head>
        <title>XML andmete lugemine PHP abil</title>
    </head>
<body>
<h1>XML andmete lugemine PHP abil</h1>
<h3>Esimese toode nimi:</h3>
<?php
echo $andmed->toode[0]->nimi;
?>
<table>
    <tr>
        <th>Toode nimi</th>
        <th>Hind</th>
        <th>Värv</th>
        <th>Lisade nimi</th>
        <th>Lisade suurus</th>
    </tr>
    <?php
    foreach ($andmed->toode as $toode){
        echo "<tr>";
        echo "<td>".($toode->nimi)."</td>";
        echo "<td>".($toode->hind)."</td>";
        echo "<td>".($toode->varv)."</td>";
        echo "<td>".($toode->lisad->lnimi)."</td>";
        echo "<td>".($toode->lisad->suurus)."</td>";
        echo "</tr>";
    }
    ?>
</table>

<h1>Vormista saadud andmete lisamine XML faili</h1>
<form method="post" action="">
    <label for="nimi">Toode nimi</label>
    <input type="text" id="nimi" name="nimi">
    <br>
    <label for="hind">Toode hind</label>
    <input type="text" id="hind" name="hind">
    <br>
    <label for="varv">Toode värv</label>
    <input type="text" id="varv" name="varv">
    <br>
    <label for="lnimi">Lisade nimi</label>
    <input type="text" id="lnimi" name="lnimi">
    <br>
    <label for="suurus">Lisade suurus</label>
    <input type="text" id="suurus" name="suurus">
    <input type="submit" value="Sisesta" id="submit" name="submit">

</form>
</body>
</html>
