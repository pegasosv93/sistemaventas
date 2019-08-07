<?php 
	class controlDB{
		function __construct(){
			try{

	$hostname = 'localhost';
	$usuario = 'root';
	$pass = '';
	$bd = "db_ventas";

	$this->con = mysqli_connect($hostname, $usuario, $pass) or die("Error al conectar el servidor");
			mysqli_select_db($this->con,$bd) or die("Error al conectarse a la base");

		}catch(Exception $ex){
			echo "conexion correcta";
			throw $ex;	
		}
	}

	function consulta($sql){
	$resultado = mysqli_query($this->con,$sql);
	$data = NULL;

	while ($fila = mysqli_fetch_assoc($resultado)) {

		$data[]=$fila;
	}
	return $data;
}

function login($sql){
	
	session_start();
$result = mysqli_query($this->con,$sql);

    /* determinar el número de filas del resultado */
    $row_cnt = $result->num_rows;

    if ($row_cnt!=0) {
    	
    	$fila = mysqli_fetch_assoc($result);
	
    $_SESSION['Idusuario']=$fila['IdUsuario'];
	$_SESSION['usuario']=$fila['Usuario'];
	$_SESSION['rol']=$fila['IdRol'];
	$_SESSION['sesion']=session_id();
	
    echo ("<script>alert('Ingreso satisfactorio');window.location='inicio.php';</script>");	
    }
   else{
echo ("<script>alert('Usuario/Clave incorrecto');window.location='login.php';</script>");
}
    /* cerrar el resultset */
    $result->close();
}

function agregar_marca ($insertar,$consulta){
		$verificar=$this->con->query($consulta);
		if (($verificar->num_rows)<=0) {
			mysqli_query($this->con, $insertar);
			echo ("<script>alert('OPERACION EXITOSA');window.location='marcas.php';</script>");
			die();	
		}
		else{
			echo ("<script>alert('Ya existe el registro');window.location='marcas.php';</script>");
		}	
}

function agregar_proveedor ($insertar,$consulta){
		$verificar=$this->con->query($consulta);
		if (($verificar->num_rows)<=0) {
			mysqli_query($this->con, $insertar);
			echo ("<script>alert('OPERACION EXITOSA');window.location='proveedores.php';</script>");
			die();
		}
		else{
			echo ("<script>alert('Este registro ya existe');window.location='proveedores.php';</script>");
		}
}

function agregar_categoria ($insertar,$consulta){
		$verificar=$this->con->query($consulta);
		if (($verificar->num_rows)<=0) {
			mysqli_query($this->con, $insertar);
			echo ("<script>alert('OPERACION EXITOSA');window.location='categorias.php';</script>");
			die();
		}
		else{
			echo ("<script>alert('El registro ya existe');window.location='categorias.php';</script>");
		}		
}

function agregar_cliente ($sql){
		mysqli_query($this->con, $sql);
			echo ("<script>alert('OPERACION EXITOSA');window.location='clientes.php';</script>");
			die();	
}

function agregar_formaPago ($insertar,$consulta){
		$verificar=$this->con->query($consulta);
		if (($verificar->num_rows)<=0) {
			mysqli_query($this->con, $insertar);
			echo ("<script>alert('OPERACION EXITOSA');window.location='formapago.php';</script>");
			die();
		}
		else{
			echo ("<script>alert('Ya existe el registro');window.location='formapago.php';</script>");
		}
	}
//hasta aquí
function agregar_modelo ($insertar,$consulta){
		$verificar=$this->con->query($consulta);
		if (($verificar->num_rows)<=0) {
			mysqli_query($this->con, $insertar);
			echo ("<script>alert('OPERACION EXITOSA');window.location='modelos.php';</script>");
			die();
		}
		else{
			echo ("<script>alert('El regsitro ya existe');window.location='modelos.php';</script>");
		}	
}

function agregar_Producto ($insertar,$consulta){
	$verificar=$this->con->query($consulta);
	if (($verificar->num_rows)<=0) {
		mysqli_query($this->con, $insertar);
			echo ("<script>alert('OPERACION EXITOSA');window.location='productos.php';</script>");
			die();
	}
	else{
		echo ("<script>alert('El regsitro ya existe');window.location='productos.php';</script>");
	}
}


function agregar_TipoDocumento ($insertar,$consulta){
		$verificar=$this->con->query($consulta);
		if (($verificar->num_rows)<=0) {
			mysqli_query($this->con, $insertar);
			echo ("<script>alert('OPERACION EXITOSA');window.location='tipodocumento.php';</script>");
			die();
		}
		else{
			echo ("<script>alert('El regsitro ya existe');window.location='tipodocumento.php';</script>");
		}		
}

function agregar_Usuario ($insertar,$consulta){
		$verificar=$this->con->query($consulta);
		if (($verificar->num_rows)<=0) {
			mysqli_query($this->con, $insertar);
			echo ("<script>alert('OPERACION EXITOSA');window.location='usuarios.php';</script>");
			die();
		}
		else{
			echo ("<script>alert('El registro ya existe');window.location='usuarios.php';</script>");
		}	
}

function precio_Producto($insertar,$consulta,$update,$producto,$precio){
		session_start();
	$verificar=$this->con->query($consulta);
		if (($verificar->num_rows)<=0) {
			mysqli_query($this->con,$insertar);
			$FechaMovimiento=date("Y-m-d");
			$HistoricoMovimiento="INSERT INTO historicomovimientos (IdProducto,TipoMovimiento,Cantidad,UsuarioMovimiento,FechaMovimiento) VALUES('$producto',12,'$precio','$_SESSION[Idusuario]','$FechaMovimiento')";
			$ejecutar=$this->con->query($HistoricoMovimiento);
			echo ("<script>alert('OPERACION EXITOSA');window.location='precioproductos.php';</script>");
			die();
		}		
		else{
			mysqli_query($this->con,$update);
			$FechaMovimiento=date("Y-m-d");
			$HistoricoMovimiento="INSERT INTO historicomovimientos (IdProducto,TipoMovimiento,Cantidad,UsuarioMovimiento,FechaMovimiento) VALUES('$producto',13,'$precio','$_SESSION[Idusuario]','$FechaMovimiento')";
			$ejecutar=$this->con->query($HistoricoMovimiento);
			echo ("<script>alert('ACTUALIZACION DE PRECIO EXITOSA');window.location='precioproductos.php';</script>");
			die();
		}
}

function existencia_Producto($insertar,$consulta){
		$verificar=$this->con->query($consulta);

		if (($verificar->num_rows)<=0) {
			mysqli_query($this->con, $insertar);
			//$AjusteEncabezadoQuery="INSERT INTO movimientoajusteencabezado (UsuarioCreacion,)"
			echo ("<script>alert('OPERACION EXITOSA');window.location='existenciaproducto.php';</script>");
			die();
		}
		
		else{
			echo ("<script>alert('Para realizar la modificacion de existencia, debe realizarse por medio del proceso conteo cicliclo');window.location='existenciaproducto.php';</script>");
			die();
		}
}

function encabezado_Conteociclico($insertar,$consulta){
		$verificar=$this->con->query($consulta);
		if (($verificar->num_rows)<=0) {
			mysqli_query($this->con,$insertar);
			$QUERYnumeroconteo="SELECT * FROM db_ventas.movimientoajusteencabezado WHERE UsuarioCreacion='$_SESSION[Idusuario]' AND  EstadoMovimiento=1";
			$result = mysqli_query($this->con,$QUERYnumeroconteo);
			$fila = mysqli_fetch_assoc($result);
			$_SESSION['NumeroConteo']=$fila['IdMovimiento'];
			echo ("<script>alert('Encabezado creado correctamente');window.location='conteociclico.php';</script>");
			die();
		}
		else{
			echo ("<script>alert('Ya tiene pendiente de aprobacion un conteo ciclico');window.location='conteociclico.php';</script>");
			die();
		}

		}
function detalle_Conteociclico($producto,$consulta,$ajuste){
	$estado=$this->con->query("SELECT * FROM movimientoajusteencabezado WHERE IdMovimiento='$_SESSION[NumeroConteo]' AND EstadoMovimiento=1");
	if (($estado->num_rows)<=0) {
		echo ("<script>alert('El estado del conteo seleccionado es distinto a abierto, por lo tanto no puede modificar el detalle');window.location='conteociclico.php';</script>");
	}
	else{
		$verificar=$this->con->query($consulta);
		if (($verificar->num_rows)<=0) {
			$QueryExistencia="SELECT * FROM db_ventas.existenciaproducto WHERE IdProducto='$producto'";
			$verificarExistencia=$this->con->query($QueryExistencia);
			if (($verificarExistencia->num_rows)<=0) {
				$Queryinsertar="INSERT INTO db_ventas.movimientoajustedetalle (IdProducto,SaldoActual,SaldoAjuste,AjusteEncabezado) VALUES('$producto',0,'$ajuste','$_SESSION[NumeroConteo]')";
				mysqli_query($this->con,$Queryinsertar);
				echo ("<script>alert('Producto agregado correctamente sin existencia anterior');window.location='conteociclico.php';</script>");
				die();
			}
			else{
				$ExistenciaQuery="SELECT ExistenciaProducto FROM db_ventas.existenciaproducto WHERE IdProducto='$producto'";
				$result = mysqli_query($this->con,$ExistenciaQuery);
				$fila = mysqli_fetch_assoc($result);
			$existencia=$fila['ExistenciaProducto'];
			$Queryinsertar="INSERT INTO db_ventas.movimientoajustedetalle (IdProducto,SaldoActual,SaldoAjuste,AjusteEncabezado) VALUES('$producto','$existencia','$ajuste','$_SESSION[NumeroConteo]')";
				mysqli_query($this->con,$Queryinsertar);
				echo ("<script>alert('Producto agregado correctamente con existencia anterior');window.location='conteociclico.php';</script>");
				die();
			}
		}
		else{
			echo ("<script>alert('Este producto ya ha sido agregado. Si desea cambiar la cantidad, elimine este producto de la lista y vuelva a agregarlo con la cantidad de ajuste correcta');window.location='conteociclico.php';</script>");
			die();
		}
	}
}

function estado_ConteoCiclico($updateEstado,$estado,$id){
	if ($estado==2) {
		$queryexistencia="SELECT *  FROM movimientoajustedetalle WHERE AjusteEncabezado='$id'";
			$existencia=mysqli_query($this->con, $queryexistencia);
			foreach ($existencia as $listadoExistencia) {
				$queryupdate="UPDATE  existenciaproducto  SET existenciaproducto='$listadoExistencia[SaldoAjuste]' WHERE IdProducto='$listadoExistencia[IdProducto]'";
				mysqli_query($this->con,$queryupdate);
			}
			mysqli_query($this->con,$updateEstado);
			echo ("<script>alert('El estado del ajuste ha sido actualizado correctamente');window.location='aprobacionconteo.php';</script>");
				die();
	}
	else{
			mysqli_query($this->con,$updateEstado);
			echo ("<script>alert('El estado del ajuste ha sido actualizado correctamente');window.location='aprobacionconteo.php';</script>");
				die();
	}
}

function finalizar_Conteociclico($update){
	mysqli_query($this->con,$update);
		echo ("<script>alert('Proceso finalizado correctamente');window.location='conteociclico.php';</script>");
				die();
}

function encabezado_Compra($insertar){
		mysqli_query($this->con,$insertar);
		$result=mysqli_query($this->con,"SELECT  * FROM db_ventas.compraencabezado where UsuarioCreacion='$_SESSION[Idusuario]' order by IdCompra desc limit 1");
		$fila=mysqli_fetch_assoc($result);
		$_SESSION['NumeroCompra']=$fila['IdCompra'];
		echo ("<script>alert('Encabezado de orden de compra creado correctamente');window.location='compras.php';</script>");
		die();
}

function detalle_Compra($orden,$producto,$insertar){
	$_SESSION['DetalleCompra']=1;
	$verificar=mysqli_query($this->con,"SELECT * FROM db_ventas.compradetalle WHERE IdCompra='$orden' AND IdProducto='$producto'");
	if (($verificar->num_rows)<=0) {
		mysqli_query($this->con, $insertar);
		echo ("<script>alert('Producto agregado correctamente');window.location='compras.php';</script>");
		die();
	}

	else{
		echo ("<script>alert('Este producto ya ha sido agregado a la orden de compra');window.location='compras.php';</script>");
	}
}

function estado_Compra($update){
		mysqli_query($this->con, $update);
		echo ("<script>alert('Estado actualizado correctamente');window.location='aprobacioncompras.php';</script>");
}

function finalizar_Compra($id){
	session_start();
	unset($_SESSION['NumeroCompra']);
	unset($_SESSION['DetalleCompra']);
		$resultado=mysqli_query($this->con,"SELECT * FROM compradetalle WHERE IdCompra='$id'");
		foreach ($resultado as $key) {
			mysqli_query($this->con,"UPDATE existenciaproducto SET existenciaproducto= existenciaproducto+'$key[CantidadProducto]' 
				WHERE IdProducto='$key[IdProducto]'");
		}
		mysqli_query($this->con, "UPDATE  compraencabezado SET EstadoCompra=4 WHERE IdCompra='$id'");
		echo ("<script>alert('Proceso finalizado correctamente');window.location='compras.php';</script>");
}

function facturacion_Encabezado($insertar){
	mysqli_query($this->con,$insertar);
	$resultado=mysqli_query($this->con,"SELECT IdVenta FROM db_ventas.ventaencabezado WHERE UsuarioCreacion='$_SESSION[Idusuario]' order by IdVenta desc limit 1 ");
	$fila=mysqli_fetch_assoc($resultado);
	$_SESSION['Factura']=$fila['IdVenta'];
	echo ("<script>alert('Encabezado creado correctamente. Ya puede agregar detalle a la orden');window.location='facturacion.php';</script>");
	die();
}

function facturacion_Detalle($cantidad,$producto,$factura){
	$resultado=mysqli_query($this->con,"SELECT * FROM precioproductos WHERE IdProducto='$producto'");
	$precio=mysqli_fetch_assoc($resultado);
	mysqli_query($this->con,"INSERT INTO ventadetalle (VentaEncabezado,IdProducto,Precio,Cantidad) VALUES('$factura','$producto','$precio[PrecioProducto]','$cantidad')");
}

function facturar_Orden($factura){
		$resultado=mysqli_query($this->con," SELECT IdProducto,Cantidad from ventadetalle where VentaEncabezado='$factura'");
	foreach ($resultado as $fila1) {
		mysqli_query($this->con,"UPDATE existenciaproducto SET ExistenciaProducto= ExistenciaProducto-'$fila1[Cantidad]' WHERE IdProducto='$fila1[IdProducto]'");
	}
		mysqli_query($this->con,"UPDATE  ventaencabezado SET IdEstado=2 WHERE IdVenta='$factura'");
		unset($_SESSION['Factura']);
		echo ("<script>alert('Orden facturada correctamente');window.location='facturacion.php';</script>");
		die();
}

function actualizar_Categoria($update){
		mysqli_query($this->con,$update);
		echo ("<script>alert('Categoria catualizada correctamente');window.location='categorias.php';</script>");
}

function actualizar_Cliente($update){
		mysqli_query($this->con,$update);
		echo ("<script>alert('Cliente actualizado correctamente');window.location='clientes.php';</script>");
}

function actualizar_Marca($update){
	mysqli_query($this->con,$update);
	echo ("<script>alert('Marca actualizada correctamente');window.location='marcas.php';</script>");
	die();

}

function actualizar_Proveedor($update){
	mysqli_query($this->con,$update);
	echo ("<script>alert('Proveedor actualizado correctamente');window.location='proveedores.php';</script>");
	die();
}

function actualizar_FormaPago($update){
	mysqli_query($this->con,$update);
	echo ("<script>alert('Forma de pago actualizada correctamente');window.location='formapago.php';</script>");
	die();
}

function actualizar_TipoDocumento($update){
	mysqli_query($this->con,$update);
	echo ("<script>alert('Tipo de coumento actualizado correctamente');window.location='tipodocumento.php';</script>");
	die();
}

function actualizar_Usuario($update){
	mysqli_query($this->con,$update);
	echo ("<script>alert('Usuario actualizado correctamente');window.location='usuarios.php';</script>");
	die();
}

function quitar_PermisoUrl($delete){
	mysqli_query($this->con,$delete);
	echo ("<script>alert('Permiso removido correctamente');window.location='usuarios.php';</script>");
	die();
}

function actualizar_Modelo($update){
	mysqli_query($this->con,$update);
	echo ("<script>alert('Modelo actualizado correctamente');window.location='modelos.php';</script>");
	die();
}

function actualizar_Producto($update){
	mysqli_query($this->con,$update);
	echo ("<script>alert('Producto actualizado correctamente');window.location='productos.php';</script>");
	die();
}

function agregar_PermisoUrl($insertar){
	mysqli_query($this->con,$insertar);
	echo ("<script>alert('Permiso agregado correctamente');window.location='usuarios.php';</script>");
	die();
}

function quitar_ProductoConteo($NumeroConteo,$Producto){

		$resultado=$this->con->query("SELECT * FROM movimientoajusteencabezado WHERE IdMovimiento='$NumeroConteo' AND EstadoMovimiento=1");
		if (($resultado->num_rows)<=0) {
			echo ("<script>alert('El estado del conteo seleccionado es distinto a abierto, por lo tanto no puede modificar el detalle');window.location='conteociclico.php';</script>");
		}

		else{
			mysqli_query($this->con,"DELETE FROM  movimientoajustedetalle WHERE AjusteEncabezado='$NumeroConteo' AND IdProducto='$Producto'");

			echo ("<script>alert('Producto eliminado del detalle correctamente');window.location='conteociclico.php';</script>");
		}

}

}

?>