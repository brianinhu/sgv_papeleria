<?php
class controlRegistrarDespacho
{
    public function listarBoletasBD()
    {
        include_once("../modelos/boleta.php");
        $objBoleta = new boleta();
        $listaBoletas = $objBoleta->listarBoletas();
        if ($listaBoletas === null) {
            include_once ("../shared/mensajeSistema.php");
            $objMensajeSistema = new mensajeSistema();
            $objMensajeSistema->mensajeSistemaShow("No hay boletas pendientes", "");
        } else {
            include_once("../moduloVentas/formRegistrarDespacho.php");
            $objFormRegistrarDespacho = new formRegistrarDespacho();
            $objFormRegistrarDespacho->formRegistrarDespachoShow($listaBoletas);
        }
    }

    public function listarBoletasBusqueda($txtBuscarBoleta)
    {
        include_once("../modelos/boleta.php");
        $objBoleta = new boleta();
        $listaBoletas = $objBoleta->listarBoletasBusqueda($txtBuscarBoleta);
        include_once("../moduloVentas/formRegistrarDespacho.php");
        $objFormRegistrarDespacho = new formRegistrarDespacho();
        $objFormRegistrarDespacho->formRegistrarDespachoShow($listaBoletas);
    }

    public function obtenerDatosDetalleBoleta($idBoleta)
    {
        include_once("../modelos/detalle_boleta.php");
        $objDetalleBoleta = new detalle_boleta();
        $detalleBoleta = $objDetalleBoleta->obtenerDetalleBoleta($idBoleta);
        include_once("../moduloVentas/formVerDetalleBoleta.php");
        $objFormVerDetalleBoleta = new formVerDetalleBoleta();
        $objFormVerDetalleBoleta->formVerDetalleBoletaShow($detalleBoleta);
    }

    public function despacharBoleta($idBoleta)
    {
        include_once("../shared/mensajeSistema.php");
        $objMensajeSistema = new mensajeSistema();
        include_once("../modelos/boleta.php");
        $objBoleta = new boleta();
        $respuesta = $objBoleta->actualizarBoleta($idBoleta);
        if ($respuesta) {
            $objMensajeSistema->mensajeSistemaShow("Boleta actualizada con éxito", "index.php", "systemOut", true);
        } else {
            $objMensajeSistema->mensajeSistemaShow("Oops! Parece que algo salió mal.", "index.php", "systemOut");
        }
    }
}
