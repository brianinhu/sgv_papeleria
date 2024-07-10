<?php
include_once "controlRegistrarDespacho.php";
include_once "../compartidoModuloVentas/mensajeSistema.php";
include_once "formRegistrarDespacho.php";
include_once "formVerDetalleBoleta.php";
include_once "formEditarProducto.php";
include_once("../../modelo/boleta.php");
include_once("../../modelo/detalle_boleta.php");
include_once("../../modelo/categoria.php");

session_start();

//Funciones -----------------------------
function validarBoton($boton)
{
    if (isset($boton)) {
        return true;
    } else {
        return false;
    }
}

function verificarCamposVacios($txtBuscarBoleta)
{
    return ($txtBuscarBoleta != "");
}

function verificarSoloNúmeros($txtBuscarBoleta)
{
    if (preg_match('/^\d+$/', $txtBuscarBoleta)) {
        return true;
    } else {
        return false;
    }
}

$btnRegistrarDespacho = $_POST['btnRegistrarDespacho'] ?? null;
$btnBuscarBoleta = $_POST['btnBuscarBoleta'] ?? null;
$btnVerDetalleBoleta = $_POST['btnVerDetalleBoleta'] ?? null;
$btnDespacharBoleta = $_POST['btnDespacharBoleta'] ?? null;

if (validarBoton($btnRegistrarDespacho)) {
    include_once("../moduloVentas/controlRegistrarDespacho.php");
    $objControlRegistrarDespacho = new controlRegistrarDespacho();
    $objControlRegistrarDespacho->listarBoletasBD();
} else if (validarBoton($btnBuscarBoleta)) {
    $txtBuscarBoleta = $_POST['txtBuscarBoleta'];
    if (verificarCamposVacios($txtBuscarBoleta)) {
        if (verificarSoloNúmeros($txtBuscarBoleta)) {
            include_once("../moduloVentas/controlRegistrarDespacho.php");
            $objControlRegistrarDespacho = new controlRegistrarDespacho();
            $objControlRegistrarDespacho->listarBoletasBusqueda($txtBuscarBoleta);
        } else {
            include_once("../modelos/boleta.php");
            $objBoleta = new boleta();
            $listaBoletas = $objBoleta->listarBoletas();
            include_once("../moduloVentas/formRegistrarDespacho.php");
            $objFormRegistrarDespacho = new formRegistrarDespacho();
            $objFormRegistrarDespacho->formRegistrarDespachoShow($listaBoletas);

            include_once("../shared/mensajeSistema.php");
            $objMensajeSistema = new mensajeSistema();
            $objMensajeSistema->mensajeSistemaShow("Ingrese sólo dígitos numéricos", "");
        }
    } else {
        include_once("../modelos/boleta.php");
        $objBoleta = new boleta();
        $listaBoletas = $objBoleta->listarBoletas();
        include_once("../moduloVentas/formRegistrarDespacho.php");
        $objFormRegistrarDespacho = new formRegistrarDespacho();
        $objFormRegistrarDespacho->formRegistrarDespachoShow($listaBoletas);

        include_once("../shared/mensajeSistema.php");
        $objMensajeSistema = new mensajeSistema();
        $objMensajeSistema->mensajeSistemaShow("Complete los campos", "");
    }
} else if (validarBoton($btnVerDetalleBoleta)) {
    $idBoleta = (int) $_POST['idBoleta'];
    include_once("../moduloVentas/controlRegistrarDespacho.php");
    $objControlRegistrarDespacho = new controlRegistrarDespacho();
    $objControlRegistrarDespacho->obtenerDatosDetalleBoleta($idBoleta);
} else if (validarBoton($btnDespacharBoleta)) {
    $idBoleta = (int) $_POST['idBoleta'];
    include_once("../moduloVentas/controlRegistrarDespacho.php");
    $objControlRegistrarDespacho = new controlRegistrarDespacho();
    $objControlRegistrarDespacho->despacharBoleta($idBoleta);
} else {
    include_once("../shared/mensajeSistema.php");
    $objMensajeSistema = new mensajeSistema();
    $objMensajeSistema->mensajeSistemaShow("Alto acceso no permitido", "index.php", "systemOut");
}
