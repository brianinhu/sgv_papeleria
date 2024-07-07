<?php
include_once ('conexion.php');
class producto extends conexion
{
    public function listarProductos()
    {
        $conexion = $this->conectar();
        $sql = "SELECT * FROM producto";
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $productos = $resultado->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        $this->desconectar();
        return $productos;
    }

    public function obtenerProductosBusqueda($txtBuscarProducto)
    {
        $terminos = explode(' ', $txtBuscarProducto);
        $condiciones = [];
        $parametros = [];
        $tipos = '';

        foreach ($terminos as $termino) {
            $condiciones[] = "(idproducto LIKE ? OR LOWER(producto) LIKE ? OR LOWER(descripcion) LIKE ?)";
            $paramTerm = '%' . $termino . '%';
            $parametros[] = $paramTerm;
            $parametros[] = $paramTerm;
            $parametros[] = $paramTerm;
            $tipos .= 'sss';
        }

        $sql = "SELECT * FROM producto WHERE " . implode(' AND ', $condiciones);
        $conexion = $this->conectar();
        $stmt = $conexion->prepare($sql);
        
        $stmt->bind_param($tipos, ...$parametros);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $productos = $resultado->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        $this->desconectar();
        return $productos;
    }

    public function obtenerDatosProducto($idProducto)
    {
        $conexion = $this->conectar();
        $sql = "SELECT * FROM producto WHERE idproducto = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $idProducto);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $datosProducto = $resultado->fetch_assoc();
        $stmt->close();
        $this->desconectar();
        return $datosProducto;
    }

}