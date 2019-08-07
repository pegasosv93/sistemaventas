<?php
include("conexion.php");

$conn=new controlDB();

if ($_POST['Nombres']=='' and $_POST['Apellidos']=='' and $_POST['Email']=='' and $_POST['Telefono']=='') {
	echo ("<script>alert('No puede enviar datos vacios');window.location='clientes.php';</script>");
}

else{
	if ($_POST['Nombres']!='') {
		$updateNombre="UPDATE catalogoclientes SET NombresClientes = '$_POST[Nombres]' WHERE IdCliente='$_POST[Id]'";
		$resultado=$conn->actualizar_Cliente($updateNombre);
	}
	if ($_POST['Apellidos']!='') {
		$updateApellido="UPDATE catalogoclientes SET Apellidos = '$_POST[Apellidos]' WHERE IdCliente='$_POST[Id]'";
		$resultado=$conn->actualizar_Cliente($updateApellido);
	}
	if ($_POST['Email']!='') {
		$updateEmail="UPDATE catalogoclientes SET EmailCliente = '$_POST[Email]' WHERE IdCliente='$_POST[Id]'";
		$resultado=$conn->actualizar_Cliente($updateEmail);
	}
	if ($_POST['Telefono']!='') {
		$updateTelefono="UPDATE catalogoclientes SET TelefonoCliente = '$_POST[Telefono]' WHERE IdCliente='$_POST[Id]'";
		$resultado=$conn->actualizar_Cliente($updateTelefono);
	}
}
?>