<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>Peliculas</title>
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
  	      $(".ventana").colorbox();
	    } 
	); 	    
</script>	
<div id="wrapper">
	<h1>Películas</h1>
<?php
	// Conectando, seleccionando la base de datos
	$enlace = mysql_connect('localhost', 'root', '')
    	or die('No se pudo conectar: ' . mysql_error());
	// echo 'Conectado exitosamente';

	mysql_select_db('ejemplo2') or die('No se pudo seleccionar la base de datos');	

	$consulta = "SELECT codpelicula, nombre, genero, fechalanzamiento FROM pelicula;";
	$resultado = mysql_query($consulta) or die('Consulta fallida: ' . mysql_error());
?>
	<table border="1" class="tablesorter">
		<thead>
			<tr>
				<th>Nombre</th>
				<th>Género</th>
				<th>Fecha de lanzamiento</th>
			</tr>
		</thead>
		<tbody>
<?php
	while ($linea = mysql_fetch_array($resultado)) {
		$codpelicula = $linea['codpelicula'];
		$nombre = $linea['nombre'];
		$genero = $linea['genero'];
		$fechalanzamiento = $linea['fechalanzamiento'];

	    echo "\t<tr>\n";
        echo "\t\t<td><a href='peliculas_funciones.php?cpel=$codpelicula' title='$nombre' class='ventana'>$nombre</a></td>\n";
        echo "\t\t<td>$genero</td>\n";
        echo "\t\t<td>$fechalanzamiento</td>\n";
        
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