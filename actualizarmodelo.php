<?php
include("conexion.php");
$conn=new controlDB();

if ($_POST['Marca']=='' and $_POST['Descripcion']=='') {
	echo ("<script>alert('No puede actualizar con campos vacios');window.location='modelos.php';</script>");
}
else{
	if ($_POST['Marca']!='') {
		$conn->actualizar_Modelo("UPDATE catalogomodelos SET Marca='$_POST[Marca]' WHERE IdModelo='$_POST[Id]'");
	}
	if ($_POST['Descripcion']!='') {
		$conn->actualizar_Modelo("UPDATE catalogomodelos SET Descripcion='$_POST[Descripcion]' WHERE IdModelo='$_POST[Id]'");
	}
}

?>