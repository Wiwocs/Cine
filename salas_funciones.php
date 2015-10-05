<?php
	// Recibir los parámetros de la sala y fecha vía get
	if (isset($_GET['nsal']) && isset($_GET['ffun'])) {
		$numerosala = $_GET['nsal'];
		$fechafuncion = $_GET['ffun'];	
	} else {
		die("<h1>No se han enviado parámetros</h1>");	
	} 
	
	// Conectando, seleccionando la base de datos
	$enlace = mysql_connect('localhost', 'root', '')
    	or die('No se pudo conectar: ' . mysql_error());
	// echo 'Conectado exitosamente';

	mysql_select_db('cine') or die('No se pudo seleccionar la base de datos');	

	$consulta = "SELECT p.nombre, f.horainicio, f.duracion, 
		case idioma 
			when 'I' then 'Inglés subtitulado'
			when 'E' then 'Español latino' 
		end as idioma 
		FROM funcion f LEFT JOIN pelicula p ON f.codpelicula = p.codpelicula 
		WHERE f.numero = $numerosala
		AND f.fecha = '$fechafuncion';";


	$resultado = mysql_query($consulta) or die('Consulta fallida: ' . mysql_error());
?>
<table border="1" style="background-color: Blue;">
<thead>
	<tr>
		<th>Nombre</th>
		<th>Hora inicio</th>
		<th>Duración</th>
		<th>Idioma</th>
	</tr>
</thead>
<tbody>
<?php
	while ($linea = mysql_fetch_array($resultado)) {
		$nombre = $linea['nombre'];
		$horainicio = $linea['horainicio'];
		$duracion = $linea['duracion'];
		$idioma = $linea['idioma'];

	    echo "\t<tr>\n";
        echo "\t\t<td>$nombre</td>\n";
        echo "\t\t<td>$horainicio</td>\n";
        echo "\t\t<td>$duracion</td>\n";
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