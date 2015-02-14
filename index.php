<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <h1>Ruleta francesa</h1>
        <h2>Hagan apuestas:</h2>
        <form action="jugar.php" method="post">
        <?php
            for ($x=0;$x<6;$x++){
            
                echo '<input type="number" name="apuesta[]" min="0" step="5"><font> €</font>
            <select name="tipo[]">
                    <option value="sencilla">Sencilla</option>
                    <option value="falta/pasa">Falta/pasa</option>
                    <option value="par/impar">Par/Impar</option>
                    <option value="rojo/negro">Rojo/negro</option>
                    <option value="docena">Docena</option>
                    <option value="sisena">Sisena</option>
                    <option value="cuadro">Cuadro</option>
                    <option value="transversal">Transversal</option>
                    <option value="caballo">Caballo</option>
                    <option value="columna">Columna</option>
            </select>
            <input type="text" name="numero[]"><font> Número</font></br>';
            }
        ?>

            <input type="submit" value="enviar">
        </form>
    </body>
</html>
