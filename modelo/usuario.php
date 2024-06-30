<?php
require_once("conexion.php");

class Usuario extends Conexion
{
    public function verificarUsuario($usuario)
    {
        $sql = "SELECT * FROM usuario WHERE usuario = '$usuario'";
        $resultado = $this->conectar()->query($sql);
        $this->desconectar();
        if ($resultado->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function verificarContraseña($usuario, $contraseña)
    {
        $sql = "SELECT * FROM usuario WHERE usuario = '$usuario' AND contraseña = '$contraseña'";
        $resultado = $this->conectar()->query($sql);
        $this->desconectar();
        if ($resultado->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function verificarEstadoUsuario($usuario)
    {
        $sql = "SELECT estado FROM usuario WHERE usuario = '$usuario'";
        $resultado = $this->conectar()->query($sql);
        $this->desconectar();
        $fila = $resultado->fetch_assoc();
        return $fila['estado'] == 1;
    }

    public function obtenerRol($usuario)
    {
        $sql = "SELECT r.rol FROM usuario u
                JOIN rol r ON u.idrol = r.idrol 
                WHERE u.usuario = '$usuario'";
        $resultado = $this->conectar()->query($sql);
        $this->desconectar();
        $fila = $resultado->fetch_assoc();
        return $fila['rol'];
    }
}
