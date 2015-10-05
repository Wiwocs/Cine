<?php
	// Recibir el parámetro de la película vía get
	if (isset($_GET['cpel'])) {
		$codpelicula = $_GET['cpel'];	
	} else {
		die("<h1>No se han enviado parámetros</h1>");	
	} 
	
	// Conectando, seleccionando la base de datos
	$enlace = mysql_connect('localhost', 'root', '')
    	or die('No se pudo conectar: ' . mysql_error());
	// echo 'Conectado exitosamente';

	mysql_select_db('ejemplo2') or die('No se pudo seleccionar la base de datos');	

	$consulta = "SELECT horainicio, fecha, 
		case idioma 
			when 'I' then 'Inglés subtitulado'
			when 'E' then 'Español latino' 
		end as idioma FROM funcion WHERE codpelicula = $codpelicula;";


	$resultado = mysql_query($consulta) or die('Consulta fallida: ' . mysql_error());
?>
<table border="1" style="background-color: HotPink;">
<thead>
	<tr>
		<th>Fecha</th>
		<th>Hora inicio</th>
		<th>Idioma</th>
	</tr>
</thead>
<tbody>
<?php
	while ($linea = mysql_fetch_array($resultado)) {
		$fecha = $linea['fecha'];
		$horainicio = $linea['horainicio'];
		$idioma = $linea['idioma'];

	    echo "\t<tr>\n";
        echo "\t\t<td>$fecha</td>\n";
        echo "\t\t<td>$horainicio</td>\n";
        echo "\t\t<td>$idioma</td>\n";
        
	    echo "\t</tr>\n";
	}


	// Liberar resultados
	mysql_free_result($resultado);

	// Cerrar la conexión
	mysql_close($enlace);
?>		
</tbody>
</table>
