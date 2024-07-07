<?php
include_once('conexion.php');
class categoria extends conexion
{
    public function listarCategoria()
    {
        $sql = "SELECT * FROM categoria;";
        $resultado = $this->conectar()->query($sql);
        $filas = $resultado->num_rows;
        $this->desconectar();
        if ($filas == 0)
            return NULL;
        else {
            for ($i = 0; $i < $filas; $i++)
                $respuesta[$i] = mysqli_fetch_array($resultado);
            return $respuesta;
        }
    }
}