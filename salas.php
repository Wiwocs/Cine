<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>Salas</title>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <link rel="stylesheet" type="text/css" href="css/estilo.css" media="screen">
  <link rel="stylesheet" type="text/css" href="css/tablesorter.css" media="screen">
  <link rel="stylesheet" type="text/css" href="css/fm.datetator.jquery.css" media="screen">
  <script src="js/jquery-2.1.4.js"></script>
  <script src="js/jquery.tablesorter.js"></script>  
  <script src="js/jquery.colorbox.js"></script>
  <script src="js/jquery.colorbox-es.js"></script>
  <script src="js/fm.datetator.jquery.js"></script>
</head>

<body>
<script>
	// Función para ver las funciones de una sala
	function verFunciones(numeroSala) {
		var fechaSeleccionada = $("#fecha").val();
		var urlAjax = "salas_funciones.php?nsal="+numeroSala+"&ffun="+fechaSeleccionada;
		console.log(urlAjax);
		$.colorbox({href:urlAjax, title:"Sala numero "+numeroSala});
	}

	$(document).ready(function() 
	    { 
  	      $(".tablesorter").tablesorter();
  	      $("#fecha").datetator();
	    } 
	); 	    
</script>
<div id="wrapper">
	<h1>Salas de cine</h1>
<?php
	// Conectando, seleccionando la base de datos
	$enlace = mysql_connect('localhost', 'root', '')
    	or die('No se pudo conectar: ' . mysql_error());
	// echo 'Conectado exitosamente';

	mysql_select_db('cine') or die('No se pudo seleccionar la base de datos');	

	$consulta = "SELECT numero, capacidad FROM sala;";
	$resultado = mysql_query($consulta) or die('Consulta fallida: ' . mysql_error());
?>
	<form>
		<label for="fecha">Fecha de función</label>
		<input type="text" name="fecha" id="fecha">
	</form> <br />
	<table border="1" class="tablesorter">
		<thead>
			<tr>
				<th>Número sala</th>
				<th>Capacidad</th>
			</tr>
		</thead>
		<tbody>
<?php
	while ($linea = mysql_fetch_array($resultado)) {
		$numero = $linea['numero'];
		$capacidad = $linea['capacidad'];

	    echo "\t<tr>\n";
        echo "\t\t<td><a href='javascript:verFunciones($numero)'>Número $numero</a></td>\n";
        echo "\t\t<td>$capacidad</td>\n";
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