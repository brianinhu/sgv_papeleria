<?php
class controlEmitirProforma
{
    public function listarProductosBD()
    {
        include_once ("../../modelo/producto.php");
        $objProducto = new producto();
        $listaProductos = $objProducto->listarProductos();
        include_once ("../../modelo/categoria.php");
        $objCategoria = new categoria();
        $listaCategoria = $objCategoria->listarCategoria();
        include_once ("formEmitirProforma.php");
        $objFormEmitirProforma = new formEmitirProforma();
        $objFormEmitirProforma->formEmitirProformaShow($listaProductos, $listaCategoria);
    }

    public function listarBusquedaProductos($txtBuscarProducto)
    {
        include_once ("../../modelo/producto.php");
        $objProducto = new producto();
        $listaProductos = $objProducto->obtenerProductosBusqueda($txtBuscarProducto);
        include_once ("../../modelo/categoria.php");
        $objCategoria = new categoria();
        $listaCategoria = $objCategoria->listarCategoria();
        include_once ("formEmitirProforma.php");
        $objFormEmitirProforma = new formEmitirProforma();
        $objFormEmitirProforma->formEmitirProformaShow($listaProductos, $listaCategoria);
    }

    public function emitirProforma($listaProductos, $totalProforma)
    {
        include_once ("../compartidoModuloVentas/mensajeSistema.php");
        $objMensajeSistema = new mensajeSistema();
        date_default_timezone_set('America/Lima');
        $fecha = date("Y-m-d");
        $hora = date("H:i:s");
        $idUsuario = $_SESSION["usuario"];
        include_once ("../../modelo/proforma.php");
        $objProforma = new proforma();
        $idProforma = $objProforma->insertarProforma($idUsuario, $fecha, $hora, $totalProforma);
        include_once ("../../modelo/detalle_proforma.php");
        $objDetalleProforma = new detalle_proforma();
        foreach ($listaProductos as $listaProducto) {
            $idProducto = $listaProducto["idProducto"];
            $cantidad = $listaProducto["cantidad"];
            $subtotal = $listaProducto["subtotal"];
            $respuesta = $objDetalleProforma->registrarDetalleProforma($idProforma, $idProducto, $cantidad, $subtotal);
        }
        if ($respuesta) {
            $objMensajeSistema->mensajeSistemaShow("Proforma generada con éxito", "index.php", "systemOut", true);
        } else {
            $objMensajeSistema->mensajeSistemaShow("Oops! Parece que algo salió mal.", "index.php", "systemOut");
        }
    }
}
