<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>Funciones</title>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <link rel="stylesheet" type="text/css" href="css/estilo.css" media="screen">
  <link rel="stylesheet" type="text/css" href="css/tablesorter.css" media="screen">
  <script src="js/jquery-2.1.4.js"></script>
  <script src="js/jquery.tablesorter.js"></script>  
  <script src="js/jquery.colorbox.js"></script>
  <script src="js/jquery.colorbox-es.js"></script>  

</head>

<body>
<script>
	$(document).ready(function() 
	    { 
  	      $(".tablesorter").tablesorter(); 
	    } 
	); 	    
</script>

<div id="wrapper">
	<h1>Funciones</h1>
<?php
	// Conectando, seleccionando la base de datos
	$enlace = mysql_connect('localhost', 'root', '')
    	or die('No se pudo conectar: ' . mysql_error());
	// echo 'Conectado exitosamente';

	mysql_select_db('ejemplo2') or die('No se pudo seleccionar la base de datos');	

/*
SELECT p.nombre, p.genero, s.numero, f.horainicio, f.duracion,
case f.idioma  
  when 'I' then 'Inglés subtitulado'  
  when 'E' then 'Español latino'  
end as idioma
FROM funcion f
LEFT JOIN pelicula p ON
	p.codpelicula = f.codpelicula
LEFT JOIN sala s ON 
	s.numero = f.numero 

*/

	$consulta = "SELECT p.nombre, p.genero, s.numero, f.horainicio, f.duracion,
case f.idioma  
  when 'I' then 'Inglés subtitulado'  
  when 'E' then 'Español latino'  
end as idioma, f.fecha
FROM funcion f
LEFT JOIN pelicula p ON
	p.codpelicula = f.codpelicula
LEFT JOIN sala s ON 
	s.numero = f.numero; ";
	$resultado = mysql_query($consulta) or die('Consulta fallida: ' . mysql_error());
?>
	<table border="1" class="tablesorter">
		<thead>
			<tr>
				<th>Nombre</th>
				<th>Género</th>
				<th>Sala</th>
				<th>Hora inicio</th>
				<th>Duracion</th>
				<th>Idioma</th>
				<th>Fecha</th>
			</tr>
		</thead>
		<tbody>
<?php
	while ($linea = mysql_fetch_array($resultado)) {
		$nombre = $linea['nombre'];
		$genero = $linea['genero'];
		$numero = $linea['numero'];
		$horainicio = $linea['horainicio'];
		$duracion = $linea['duracion'];
		$idioma = $linea['idioma'];
		$fecha = $linea['fecha'];

	    echo "\t<tr>\n";
        echo "\t\t<td>$nombre</td>\n";
        echo "\t\t<td>$genero</td>\n";
        echo "\t\t<td>$numero</td>\n";
        echo "\t\t<td>$horainicio</td>\n";
        echo "\t\t<td>$duracion</td>\n";
        echo "\t\t<td>$idioma</td>\n";
        echo "\t\t<td>$fecha</td>\n";

	    echo "\t</tr>\n";
	}
	echo "</tbody>\n";
	echo "</table>\n";

	// Liberar resultados
	mysql_free_result($resultado);

	// Cerrar la conexión
	mysql_close($enlace);
?>
	<br />

</div> <!-- div wrapper -->
</body>
</html>