<?php
session_start();
 //$dado;
 $diametro=290;
 $arco=9.729;
 $numeros=array(0,32,15,19,4,21,2,25,17,34,6,27,13,36,11,30,8,23,10,5,24,16,33,1,20,14,31,9,22,18,29,7,28,12,35,3,26);
 $porciones=array();
 $arcoGiro=0;
 $num=$_GET['ID'];

  // Crear array numeros => color
  for($x=0; $x<  count($numeros);$x++) {
    $color;
    if ($x==0) {$color='verde';}
    else{
        if (($x%2)==0){$color='negro';}
        else $color='rojo';
    }
    $porciones[$numeros[$x]]=$color;
}

//$porciones=tirar_apuesta($porciones, 3); 

if (posicionesGiro($porciones, $num)!=0){
     
     $arcoGiro=$arco*posicionesGiro($porciones, $num);
 }

 // Crear una imagen en blanco.
 // Seleccionar el color de fondo.
 $imagen = imagecreatetruecolor(310, 310);
 $fondo = imagecolorallocate($imagen, 255, 255, 255);

 // Rellenar el fondo con el color seleccionado arriba.
 imagefill($imagen, 0, 0, $fondo);
 // Escoger un color para la elipse.
 $fill_ellipse = imagecolorallocate($imagen, 255, 255, 255);
 $border_ellipse = imagecolorallocate($imagen, 0, 0, 0);
 
// Dibujar la elipse
imagefilledellipse ($imagen, 155, 155, 300, 300, $fill_ellipse);
imageellipse ($imagen, 155, 155, 300, 300, $border_ellipse);
 
rellenar($imagen, $arco, $arcoGiro, $diametro);
 
imagefilledellipse($imagen, 155, 155, 225, 225, $fill_ellipse);
imageellipse($imagen, 155, 155, 225, 225, $border_ellipse);

rellenar($imagen, $arco, $arcoGiro, 215);

imagefilledellipse($imagen, 155, 155, 150, 150, $fill_ellipse);
imageellipse($imagen, 155, 155, 150, 150, $border_ellipse);

imagefilledellipse($imagen, 155, 155, 25, 25, $fill_ellipse);
imageellipse($imagen, 155, 155, 25, 25, $border_ellipse);
 
imagefilledellipse($imagen, 155, 155, 15, 15, $fill_ellipse);
imageellipse($imagen, 155, 155, 15, 15, $border_ellipse);

imageellipse($imagen, 155, 155, 290, 290, $border_ellipse);
imageellipse($imagen, 155, 155, 140, 140, $border_ellipse);
imageellipse($imagen, 155, 155, 215, 215, $border_ellipse);
 
colocarNum($imagen, $arco, $arcoGiro, $diametro, $porciones);
 
imageline($imagen, 170, 0, 170 , 25, imagecolorallocate($imagen, 0, 0, 255));

 function rellenar($imagen, $arco, $arcoGiro, $diametro){
     
    $blanco = imagecolorallocate($imagen, 255, 255, 255);
    $rojo = imagecolorallocate($imagen, 255, 0, 0);
    $negro = imagecolorallocate($imagen, 0, 0, 0);
    $verde = imagecolorallocate($imagen, 0, 255, 0);
    imagefilledarc ( $imagen , 155 , 155 , $diametro , $diametro , -90-$arcoGiro , -90-$arcoGiro+$arco , $verde , IMG_ARC_PIE );
    for ($x=1; $x<37;$x++){
        if ($x%2!=0){
            imagefilledarc ( $imagen , 155 , 155 , $diametro , $diametro , -($arcoGiro+($x*$arco))-90 , -($arcoGiro+($x*$arco))-90+$arco , $rojo , IMG_ARC_PIE );
        }
        else   imagefilledarc ( $imagen , 155 , 155 , $diametro , $diametro , -($arcoGiro+($x*$arco))-90 , -($arcoGiro+($x*$arco))-90+$arco , $negro , IMG_ARC_PIE );
    }
    //imagettftext ( $imagen , 12 , -$arco/2 , $radio+($radio*cos(deg2rad($arco))), $radio+($radio*sin(deg2rad($arco))) , $negro , $font , '32' );
    //imagettftext ( $imagen , 200 , $arco , pow($diametro,2)*cos(deg2rad($arco)) , pow($diametro,2)*sin(deg2rad($arco)) , $negro , $font , 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAa' );

 }
 
 function colocarNum($imagen, $arco, $arcoGiro, $diametro, $porcion){
     $index=1;
     foreach ($porcion as $key => $value) {

        imagettftext ( $imagen , 10 , -(($arco)*$index-$arcoGiro) , (310/2)+((($diametro/2.30))*cos(deg2rad(-98+(($arco)*$index)-$arcoGiro))), (310/2)+((($diametro/2.30))*sin(deg2rad(-98+(($arco)*$index)-$arcoGiro))) , imagecolorallocate($imagen, 255, 255, 255) , 'arial.ttf' , $key );
        $index++;
    }
 }
 
// function tirar_apuesta($array, $num){
//     $new_array = array_slice($array, array_search($num, array_keys($array)),NULL,TRUE)+
//                  array_slice($array, 0,array_search($num, array_keys($array)),TRUE);
//     return $new_array;
// }
 
 function posicionesGiro ($array, $num) {
     
     return $moves=array_search($num, array_keys($array));
     
 }
 // Imprimir la imagen
 //header("Content-type: image/jpeg");
 imagejpeg($imagen);

 ?>
