<?php
require_once("../../modelo/usuario.php");
require_once("../../modelo/rol_privilegio.php");
class ControllerAutenticacionUsuario
{
    public $message = "";

    public function validarBoton($nombreBoton)
    {
        return isset($_POST[$nombreBoton]) && !empty($_POST[$nombreBoton]);
    }

    public function validarTextoRespuestaAntiRobot($respuestaAntiRobot)
    {
        if (empty($respuestaAntiRobot)) {
            $this->message = "Complete la respuesta de la suma";
        } elseif (!ctype_digit($respuestaAntiRobot)) {
            $this->message = "La respuesta debe ser un número entero";
        } elseif ($respuestaAntiRobot != $_SESSION['captchaResultadoCorrecto']) {
            $this->message = "La respuesta es incorrecta";
        } else {
            return true;
        }
        return false;
    }

    public function validarTextoUsuario($usuario)
    { 
        if (empty($usuario)) {
            $this->message = "Complete el campo usuario";
        } elseif (strlen($usuario) < 5) {
            $this->message = "El usuario debe tener al menos 5 caracteres";
        } elseif (!ctype_alnum($usuario)) {
            $this->message = "El usuario debe contener solo caracteres alfanuméricos";
        } else {
            return true;
        }
        return false;
    }

    public function validarUsuario($usuario)
    {
        $objUsuario = new Usuario();
        return $objUsuario->verificarUsuario($usuario);
    }

    public function validarTextoContraseña($contraseña) {
        if (empty($contraseña)) {
            $this->message = "Complete el campo contraseña";
        } elseif (strlen($contraseña) < 8) {
            $this->message = "La contraseña debe tener al menos 8 caracteres";
        } elseif (!preg_match('/[A-Za-z]/', $contraseña) || !preg_match('/[0-9]/', $contraseña) || !preg_match('/[^A-Za-z0-9]/', $contraseña)) {
            $this->message = "La contraseña debe contener al menos un caracter alfabético, numérico y un caracter especial";
        } else {
            return true;
        }
        return false;
    }
    
    public function validarContraseña($usuario, $contraseña)
    {
        $objUsuario = new Usuario();
        return $objUsuario->verificarContraseña($usuario, $contraseña);
    }

    public function validarEstadoUsuario($usuario)
    {
        $objUsuario = new Usuario();
        return $objUsuario->verificarEstadoUsuario($usuario);
    }

    public function obtenerPrivilegios($usuario)
    {
        $objRolPrivilegio = new Rol_privilegio();
        return $objRolPrivilegio->obtenerPrivilegios($usuario);
    }

    public function obtenerRol($usuario)
    {
        $objUsuario = new Usuario();
        return $objUsuario->obtenerRol($usuario);
    }

    public function obtenerIDUsuario($usuario)
    {
        $objUsuario = new Usuario();
        return $objUsuario->obtenerIDUsuario($usuario);
    }
}
