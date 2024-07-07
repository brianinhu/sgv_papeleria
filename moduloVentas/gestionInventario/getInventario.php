<?php
session_start();

function verificarSesion()
{
    return isset($_SESSION['idUsuario']);
}

function validarBoton($boton)
{
    return isset($boton);
}

function verificarCamposVacios($txtBuscarProducto)
{
    return ($txtBuscarProducto != "");
}

function verificarCaracteresEspeciales($txtBuscarProducto)
{
    if (preg_match("/[^a-zA-Z0-9áéíóúÁÉÍÓÚ\s]/", $txtBuscarProducto)) {
        return true;
    } else {
        return false;
    }
}

function verificarCampos($nom_producto, $descripcion, $precio, $stock, $idcategoria){
    
}

$btnGestionarInventario = $_POST['btnGestionarInventario'] ?? null;
$btnBuscarProducto = $_POST['btnBuscarProducto'] ?? null;
$btnAgregarProducto = $_POST['btnAgregarProducto'] ?? null;
$btnRegistrarProducto = $_POST['btnRegistrarProducto'] ?? null;
$btnEditarProducto = $_POST['btnEditarProducto'] ?? null;
$btnGuardarCambios = $_POST['btnGuardarCambios'] ?? null;

//Validación de botones -------------------------------------
if (validarBoton($btnGestionarInventario)) {
    include_once ("../moduloVentas/controlGestionarInventario.php");
    $objControlGestionarInventario = new controlGestionarInventario();
    $objControlGestionarInventario->listarProductosBD();

} else if (validarBoton($btnBuscarProducto)) {
    $txtBuscarProducto = strtolower($_POST['txtBuscarProducto']);

    if (verificarCamposVacios($txtBuscarProducto)) {
        if (!verificarCaracteresEspeciales($txtBuscarProducto)) {
            include_once ("../moduloVentas/controlGestionarInventario.php");
            $objControlGestionarInventario = new controlGestionarInventario();
            $objControlGestionarInventario->listarBusquedaProductos($txtBuscarProducto);

        } else {
            include_once ("../moduloVentas/controlGestionarInventario.php");
            $objControlGestionarInventario = new controlGestionarInventario();
            $objControlGestionarInventario->listarProductosBD();

            include_once ("../shared/mensajeSistema.php");
            $objMensajeSistema = new mensajeSistema();
            $objMensajeSistema->mensajeSistemaShow("Se detectaron caracteres no válidos", "");
        }

    } else {
        include_once ("../moduloVentas/controlGestionarInventario.php");
        $objControlGestionarInventario = new controlGestionarInventario();
        $objControlGestionarInventario->listarProductosBD();

        include_once ("../shared/mensajeSistema.php");
        $objMensajeSistema = new mensajeSistema();
        $objMensajeSistema->mensajeSistemaShow("Ingrese id o nombre de producto válido", "");
    }

} else if (validarBoton($btnAgregarProducto)) {
    include_once ("../moduloVentas/controlGestionarInventario.php");
    $objControlGestionarInventario = new controlGestionarInventario();
    $objControlGestionarInventario->mostrarFormAgregarProducto();

} else if (validarBoton($btnRegistrarProducto)) {

} else if (validarBoton($btnEditarProducto)) {
    $idProducto = (int) $_POST['idproducto'];
    include_once ("../moduloVentas/controlGestionarInventario.php");
    $objControlGestionarInventario = new controlGestionarInventario();
    $objControlGestionarInventario->mostrarFormEditarProducto($idProducto);
} else {
    include_once ("../shared/mensajeSistema.php");
    $objMensajeSistema = new mensajeSistema();
    $objMensajeSistema->mensajeSistemaShow("Alto acceso no permitido", "index.php", "systemOut");
}
