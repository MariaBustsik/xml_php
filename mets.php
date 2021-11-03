
<?php
$andmed=simplexml_load_file('andmeteBaas.xml');
if(isset($_POST['submit'])){
    $xmlDoc = new DOMDocument("1.0","UTF-8");
    $xmlDoc->preserveWhiteSpace = false;
    $xmlDoc->load('andmeteBaas.xml');
    $xmlDoc->formatOutput = true;

    $xml_root = $xmlDoc->documentElement;
    $xmlDoc->appendChild($xml_root);

    $xml_toode = $xmlDoc->createElement("toode");
    $xmlDoc->appendChild($xml_toode);
    $xml_root->appendChild($xml_toode);
    $xml_lisad = $xmlDoc->createElement("lisad");
    $xml_toode->appendChild($xml_lisad);
    unset($_POST['submit']);
    foreach($_POST as $voti=>$vaartus){
         if ($voti == "lnimi" or $voti == "suurus") {

             $kirje = $xmlDoc->createElement($voti,$vaartus);
             $xml_lisad->appendChild($kirje);

        }
         else {
             $kirje = $xmlDoc->createElement($voti,$vaartus);
             $xml_toode->appendChild($kirje);
         }

    }
    $xmlDoc->save('andmeteBaas.xml');
    header("refresh: 0;");
}
?>


<!DOCTYPE html>
<html lang="et">
<head>
    <title>XML andmete lugemine PHP abil</title>
    <link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>
<ul>
    <li><a href="mets.php">Andmete salvestamine XML faili, kus andmed lisatakse juurde</a></li>
    <li><a href="mets2.php">Andmete salvestamine XML faili, kus igakord luuakse uus fail</a></li>
</ul>
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


