<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

		<form method="post" enctype="multipart/form-data">
			<input type="file" name="archivo">
			<input type="submit" name="subir">
		</form>

</body>
</html>

<?php

	if (isset($_POST["subir"])) {
		$archivoTem = $_FILES['archivo']['tmp_name'];
		$nombre = $_FILES['archivo']['name'];
		$tipo = $_FILES['archivo']['type'];
		$tamanno = $_FILES['archivo']['size'];

		$destino = "img/postImg/".$nombre;

		if (move_uploaded_file($archivoTem, $destino)) {
			echo "subido";
		}else{
			echo "no subido";
		}

	}

?>