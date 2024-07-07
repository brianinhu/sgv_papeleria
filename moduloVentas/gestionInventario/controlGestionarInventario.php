<?php
class controlGestionarInventario
{
    public function listarProductosBD()
    {
        include_once ("../modelos/producto.php");
        $objProducto = new producto();
        $listaProductos = $objProducto->listarProductos();
        include_once ("../modelos/categoria.php");
        $objCategoria = new categoria();
        $listaCategoria = $objCategoria->listarCategoria();
        include_once ("../moduloVentas/formGestionarInventario.php");
        $objFormGestionarInventario = new formGestionarInventario();
        $objFormGestionarInventario->formGestionarInventarioShow($listaProductos, $listaCategoria);
    }

    public function listarBusquedaProductos($txtBuscarProducto)
    {
        include_once ("../modelos/producto.php");
        $objProducto = new producto();
        $listaProductos = $objProducto->obtenerProductosBusqueda($txtBuscarProducto);
        include_once ("../modelos/categoria.php");
        $objCategoria = new categoria();
        $listaCategoria = $objCategoria->listarCategoria();
        include_once ("../moduloVentas/formGestionarInventario.php");
        $objFormGestionarInventario = new formGestionarInventario();
        $objFormGestionarInventario->formGestionarInventarioShow($listaProductos, $listaCategoria);
    }

    public function mostrarFormAgregarProducto(){
        include_once ("../modelos/categoria.php");
        $objCategoria = new categoria();
        $listaCategoria = $objCategoria->listarCategoria();
        include_once ("../moduloVentas/formAgregarProducto.php");
        $objFormAgregarProducto = new formAgregarProducto();
        $objFormAgregarProducto->formAgregarProductoShow($listaCategoria);
    }

    public function mostrarFormEditarProducto($idProducto){
        include_once ("../modelos/producto.php");
        $objProducto = new producto();
        $datosProducto = $objProducto->obtenerDatosProducto($idProducto);
        include_once ("../modelos/categoria.php");
        $objCategoria = new categoria();
        $listaCategoria = $objCategoria->listarCategoria();
        include_once ("../moduloVentas/formEditarProducto.php");
        $objFormEditarProducto = new formEditarProducto();
        $objFormEditarProducto->formEditarProductoShow($datosProducto, $listaCategoria);
    }

}