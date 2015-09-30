<!DOCTYPE html>
<html>
	<head>
		<title>Salas</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<link rel="stylesheet" href="css/estilos.css" type="text/css" media="screen"/>
		<link rel="stylesheet" href="css/tablesorter.css" type="text/css" media="screen"/>
		<script src="js/jquery-2.1.4.js"></script>
		<script src="js/jquery.colorbox.js"></script>
		<script src="js/jquery.colorbox-es.js"></script>
		<script src="js/jquery.tablesorter.js"></script>
        <script>
			$(document).ready(function(){
				$(".tablesorter").tablesorter();
			})
		</script>
	</head>
    <body>
        <div id="wrapper">
            <?php
                $enlace = mysql_connect('localhost', 'root', '')
                or due('conexion fallida: '. mysql_error());
                mysql_select_db('cine') or die('no se pudo conectar a la base de datos');
                $consulta = "SELECT numero, capacidad FROM sala;";
                $resultado = mysql_query($consulta) or die('Consulta fallida: ' . mysql_error())
            ?>
            <table border="1" class="tablesorter">
                <thead>
                    <tr>
                        <th>Numero de Sala</th>
                        <th>Capacidad</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($linea = mysql_fetch_array($resultado, MYSQL_ASSOC)){
                            echo "\t<tr>\n";
                            foreach ($linea as $valor_columna){
                                echo "\t\t<td>$valor_columna</td>\n";
                            }
                        echo "\t</tr>\n";
                        }
                        echo "\t</tbody>\n";
                        echo "</table>\n";
                        mysql_free_result($resultado);
                        mysql_close($enlace);
                    ?>
        </div>
    </body>
</html>