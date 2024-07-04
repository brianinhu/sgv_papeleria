<?php
require_once("conexion.php");

class Usuario extends Conexion
{
    public function verificarUsuario($usuario)
    {
        $sql = "SELECT * FROM usuario WHERE usuario = '$usuario'";
        $resultado = $this->conectar()->query($sql);
        $this->desconectar();
        return $resultado->num_rows > 0;
    }

    public function verificarContraseña($usuario, $contraseña)
    {
        $sql = "SELECT * FROM usuario WHERE usuario = '$usuario' AND contraseña = '$contraseña'";
        $resultado = $this->conectar()->query($sql);
        $this->desconectar();
        return $resultado->num_rows > 0;
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

    public function obtenerPreguntaSeguridad($usuario)
    {
        $sql = "SELECT p.pregunta FROM usuario u JOIN pregunta p ON u.idpregunta = p.idpregunta WHERE usuario = '$usuario'";
        $resultado = $this->conectar()->query($sql);
        $this->desconectar();
        $fila = $resultado->fetch_assoc();
        return $fila['pregunta'];
    }

    public function verificarRespuesta($usuario, $respuesta)
    {
        $sql = "SELECT * FROM usuario WHERE usuario = '$usuario' AND respuesta = '$respuesta'";
        $resultado = $this->conectar()->query($sql);
        $this->desconectar();
        return $resultado->num_rows > 0;
    }

    public function cambiarContraseña($usuario, $contraseña)
    {
        $sql = "UPDATE usuario SET contraseña = '$contraseña' WHERE usuario = '$usuario'";
        $resultado = $this->conectar()->query($sql);
        $this->desconectar();
        return $resultado;
    }
}
