<?php

//include './moverRuleta.php';

$apuestas = $_POST['apuesta'];
$tipos = $_POST['tipo'];
$numeros = $_POST['numero'];

$numerosRuleta = array(0, 32, 15, 19, 4, 21, 2, 25, 17, 34, 6, 27, 13, 36, 11, 30, 8, 23, 10, 5, 24, 16, 33, 1, 20, 14, 31, 9, 22, 18, 29, 7, 28, 12, 35, 3, 26);
$numerosColor = array();

for ($x = 0; $x < count($numeros); $x++) {
    $color;
    if ($x == 0) {
        $color = 'verde';
    } else {
        if (($x % 2) == 0) {
            $color = 'negro';
        }
        else
            $color = 'rojo';
    }
    $numerosColor[$numeros[$x]] = $color;
}

$columna1 = array(1, 4, 7, 10, 13, 16, 19, 22, 25, 28, 31, 34);
$columna2 = array(2, 5, 8, 11, 14, 17, 20, 23, 26, 29, 32, 35);
$columna3 = array(3, 6, 9, 12, 15, 18, 21, 24, 27, 30, 33, 36);

$premio_simple = 35;
$premio_faltapasa = 1;
$premio_parimpar = 1;
$premio_rojonegro = 1;
$premio_docena = 2;
$premio_columna = 2;
$premio_sisena = 5;
$premio_cuadro=8;
$premio_transversal=11;
$premio_caballo=17;


$jugadas = array();

$ganador = rand(0, 36);

for ($x = 0; $x < sizeof($apuestas); $x++) {
    $jugadas[$x]["apuesta"] = $apuestas[$x];
    $jugadas[$x]["tipo"] = $tipos[$x];
    $jugadas[$x]["numero"] = $numeros[$x];
    $jugadas[$x]["premio"] = 0;
}

echo '<img src="moverRuleta.php?ID=' . $ganador . '"/>';

for ($x=0; $x<count($jugadas); $x++) {
    if ($jugadas[$x]["apuesta"] != '') {
//        echo '<div class="apuesta"><h1>Jugada: ' . (array_search($jugadas[$x], $jugadas) + 1) . '</h1>';
//        echo '<p> Apuesta ' . $jugadas[$x]["apuesta"] . ' euros en ' . $jugadas[$x]["tipo"] . ' al ' . $jugadas[$x]["numero"] . '</p></div>';
        
        if (!isset($jugadas[$x]["premio"])) {
            $jugadas[$x]["premio"] = '';
        }
                    
        switch ($jugadas[$x]["tipo"]) {
            case "sencilla";
                //echo '<p>apuesta sencilla</p>';
                if ($jugadas[$x]["numero"] == $ganador) {
                    $jugadas[$x]["premio"] = $jugadas[$x]["apuesta"] * $premio_simple;
                    //echo '<p>Premio!!!</p>';
                }
                else
//                    $value["premio"] = '';
//                echo '<p>No hay premio!!</p>';
                break;
            case "falta/pasa";
//                echo '<p>falta/pasa</p>';
                if ($ganador <= 10 && $jugadas[$x]["numero"] <= 10) {
                    $jugadas[$x]["premio"] = $jugadas[$x]["apuesta"] * $premio_faltapasa;
//                    echo '<p>Premio!!!</p>';
                }
                else
                    $jugadas[$x]["premio"] = $jugadas[$x]["apuesta"] / 2;
                break;
            case "par/impar";
//                echo '<p>par/impar</p>';
                if (($ganador % 2 == 0 && $jugadas[$x]["numero"] % 2 == 0) || ($ganador % 2 != 0 && $jugadas[$x]["numero"] % 2 != 0)) {
                    $jugadas[$x]["premio"] = $jugadas[$x]["apuesta"] * $premio_parimpar;
//                    echo '<p>Premio!!!</p>';
                }
                else
                    $jugadas[$x]["premio"] = $jugadas[$x]["apuesta"] / 2;
                break;
            case "rojo/negro";
//                echo '<p>rojo/negro</p>';
                if ($ganador == $jugadas[$x]["numero"]) {
                    $jugadas[$x]["premio"] = $jugadas[$x]["apuesta"] * $premio_rojonegro = 1;
                }
                else
                    $jugadas[$x]["premio"] = $jugadas[$x]["apuesta"] / 2;
                break;
            case "docena";
                if (($ganador <= 12 && $jugadas[$x]["numero"] <= 12) || ($ganador >= 13 && $jugadas[$x]["numero"] >= 13) && ($ganador <= 24 && $jugadas[$x]["numero"] <= 24) || ($ganador >= 25 && $jugadas[$x]["numero"] >= 25)) {
                    $jugadas[$x]["premio"] = $jugadas[$x]["apuesta"] * $premio_docena;
                }
                break;
            case "sisena";
                echo '<p>apuesta sisena</p>';
                $sisena = explode("-", $jugadas[$x]["numero"]);
                echo '<p>' . $sisena[0] . ' - ' . $sisena[1] . ' sisena</p>';
                echo '<p>' . $ganador . ' ganador</p>';
                if ($sisena[0] <= $ganador && $ganador <= $sisena[1]) {
                    $jugadas[$x]["premio"] = $jugadas[$x]["apuesta"] * $premio_sisena;
                    echo '<h1>Premio ' . $jugadas[$x]["premio"] . '</h1>';
                }
                break;
            case "cuadro";
                echo '<p>apuesta sencilla</p>';
                $cuadro = explode("-", $jugadas[$x]["numero"]);
                if ($ganador==$cuadro[0]||$ganador==($cuadro[0]+1)||$ganador==$cuadro[1]||$ganador==($cuadro[0]-1)){
                    $jugadas[$x]["premio"] = $jugadas[$x]["apuesta"] * $premio_cuadro;
                    echo '<h1>Premio ' . $jugadas[$x]["premio"] . '</h1>';
                }
                break;
            case "transversal";
                echo '<p>apuesta sencilla</p>';
                $transversal = explode("-", $jugadas[$x]["numero"]);
                if ($ganador==$transversal[0]||$ganador==($transversal[0]+1)||$ganador==$transversal[1]){
                    $jugadas[$x]["premio"] = $jugadas[$x]["apuesta"] * $premio_transversal;
                    echo '<h1>Premio ' . $jugadas[$x]["premio"] . '</h1>';
                }
                break;
            case "caballo";
                echo '<p>apuesta sencilla</p>';
                $caballo = explode("-", $jugadas[$x]["numero"]);
                if ($ganador==$caballo[0]||$ganador==$caballo[1]){
                    $jugadas[$x]["premio"] = $jugadas[$x]["apuesta"] * $premio_caballo;
                    echo '<h1>Premio ' . $jugadas[$x]["premio"] . '</h1>';
                }
                break;
            case "columna";
                if ((in_array($ganador, $columna1) && in_array($jugadas[$x]["numero"], $columna1)) || (in_array($ganador, $columna2) && in_array($jugadas[$x]["numero"], $columna2)) || (in_array($ganador, $columna3) && in_array($jugadas[$x]["numero"], $columna3)))
                    $jugadas[$x]["premio"][] = $jugadas[$x]["apuesta"] * $premio_columna;
                break;
            default:
                break;
        }
//        print_r($jugadas[$x]);
    }
}

for ($x=0; $x<count($jugadas); $x++) {
    if ($jugadas[$x]["apuesta"] != '') {

            if ($jugadas[$x]["premio"] > $jugadas[$x]["apuesta"]) {
                echo '<div class="resultado"><h1>Enhorabuena!!!</h1>';
                echo '<p> Tu apuesta de ' . $jugadas[$x]["apuesta"] . ' euros en ' . $jugadas[$x]["tipo"] . ' al ' . $jugadas[$x]["numero"] . ' resultó ganadora.</br>
                       Has obtenido' . $jugadas[$x]["premio"] . ' euros. ;)</p></div>';
            } else {
                echo '<div class="resultado"><h2>Mala suerte :(</h2>';
                echo '<p> Tu apuesta de ' . $jugadas[$x]["apuesta"] . ' euros en ' . $jugadas[$x]["tipo"] . ' al ' . $jugadas[$x]["numero"] . ' no obtubo premio.</br>
                       Sigue probando. ;)</p></div>';
            }
//            print_r($jugadas[$x]);
    }
}

$sum = 0;
foreach ($jugadas as $item) {
    $sum += $item["premio"];
}
echo '<h1>Has ganado : '.$sum.'</h1>';

//print_r($jugadas);
echo '<p><a href="index.php"/>Pulsa para hacer más apuestas</a></p>';
?>
