<?php
include("conexion.php");
$conn=new controlDB();

if ($_POST['Id']=='' || $_POST['Descripcion']=='') {
	echo ("<script>alert('No puede registrar datos vacios');window.location='marcas.php';</script>");
}
else{
	$update="UPDATE catalogomarcas SET DescripcionMarca='$_POST[Descripcion]' WHERE IdMarca='$_POST[Id]'";
	$resultado=$conn->actualizar_Marca($update);
}

?>