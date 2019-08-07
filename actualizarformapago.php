<?php
include("conexion.php");
$conn=new controlDB();

if ($_POST['Descripcion']=='') {
	echo ("<script>alert('No puede registrar datos vacios');window.location='formapago.php';</script>");
}
else{
	$conn->actualizar_FormaPago("UPDATE formapago SET DescripcionPago='$_POST[Descripcion]' WHERE IdFormaPago='$_POST[Id]'");
}
?>