
<?php
$andmed=simplexml_load_file('lingid.xml');

if(isset($_POST['submit'])){
    $xmlDoc = new DOMDocument("1.0","UTF-8");
    $xmlDoc->formatOutput = true;
    $xmlDoc->preserveWhiteSpace = false;

    $xml_root = $xmlDoc->createElement("tooted");
    $xmlDoc->appendChild($xml_root);


    $xml_toode = $xmlDoc->createElement("toode");
    $xmlDoc->appendChild($xml_toode);

    $xml_root->appendChild($xml_toode);
    $xml_lisad = $xmlDoc->createElement("lisad");
    $xml_toode->appendChild($xml_lisad);


    $xmlDocc = new DOMDocument("1.0","UTF-8");
    $xmlDocc->preserveWhiteSpace = false;
    $xmlDocc->load('lingid.xml');
    $xmlDocc->formatOutput = true;

    $xml_roott = $xmlDocc->documentElement;
    $xmlDocc->appendChild($xml_roott);

    $xml_link = $xmlDocc->createElement("link");
    $xmlDocc->appendChild($xml_link);
    $xml_roott->appendChild($xml_link);

    unset($_POST['submit']);
    foreach($_POST as $voti=>$vaartus){
        if ($voti == "fname") {

            $xmlDocc->appendChild($xml_roott);
            $kirjet = $xmlDocc->createElement($voti,$vaartus);
            $xml_link->appendChild($kirjet);

        }
        else if ($voti == "lnimi" or $voti == "suurus") {

            $kirje = $xmlDoc->createElement($voti,$vaartus);
            $xml_lisad->appendChild($kirje);

        }
        else {
            $kirje = $xmlDoc->createElement($voti,$vaartus);
            $xml_toode->appendChild($kirje);

        }
    }


    $fname=$_POST['fname'];

    $xmlDocc->save("lingid.xml");
    $xmlDoc->save($fname);
    header("refresh: 0;");
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toote lisamine</title>
</head>

<body>
<h2>Toote sisestamine</h2>
<table>
    <form action="" method="post" name="vorm1">
        <tr>
            <td><label for="nimetus">Toote nimetus:</label></td>
            <td><input type="text" name="nimetus" id="nimetus" autofocus></td>
        </tr>
        <tr>
            <td><label for="hind">Hind:</label></td>
            <td><input type="text" name="hind" id="hind"></td>
        </tr>
        <tr>
            <td><label for="varv">Värv:</label></td>
            <td><input type="text" name="varv" id="varv"></td>
        </tr>

        <tr>
            <td><label for="lnimi">Lisade nimi:</label></td>
            <td><input type="text" name="lnimi" id="lnimi"></td>
        </tr>

        <tr>
            <td><label for="suurus">Lisade suurus:</label></td>
            <td><input type="text" name="suurus" id="suurus"></td>
        </tr>

        <tr>
            <td><label for="fname">Faili nimi:</label></td>
            <td><input type="text" name="fname" id="fname"></td>
        </tr>
        <tr>
            <td><input type="submit" name="submit" id="submit" value="Sisesta"></td>
            <td></td>
        </tr>
    </form>
</table>

<table>
    <tr>
        <th>Nimetus</th>
        <th>Hind</th>
        <th>Värv</th>
        <th>Lisade nimi</th>
        <th>Lisade suurus</th>
    </tr>
    <?php
    foreach ($andmed->link as $link){

        $andmedd = simplexml_load_file(($link->fname));
    foreach ($andmedd->toode as $toode){
        echo "<tr>";
        echo "<td>".($toode->nimetus)."</td>";
        echo "<td>".($toode->hind)."</td>";
        echo "<td>".($toode->varv)."</td>";
        echo "<td>".($toode->lisad->lnimi)."</td>";
        echo "<td>".($toode->lisad->suurus)."</td>";
        echo "</tr>";
    }
    }
    ?>
</table>
</body>
</html>
