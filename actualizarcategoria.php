<?php
include("conexion.php");

$conn=new controlDB();

if ($_POST['Categoria']=='' || $_POST['Descripcion']=='') {
	echo("<script>alert('No puede registrar datos vacios');window.location='categorias.php';</script>");
}
else{
	$update="UPDATE catalogocategorias SET DescripcionCategoria='$_POST[Descripcion]' WHERE IdCategoria='$_POST[Categoria]'";
	$resultado=$conn->actualizar_Categoria($update);
}

?>