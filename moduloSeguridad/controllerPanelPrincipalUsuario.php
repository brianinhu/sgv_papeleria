<?php
session_start();
require_once "../modelo/usuario.php";
class ControllerPanelPrincipalUsuario {
    public $title;
    public $message;
    public function validarSesion() {
        if (!isset($_SESSION['usuario'])) {
            $this->title = "Error";
            $this->message = "Usuario no autenticado. Acceso denegado.";
            return false;
        }
        return true;
    }

    public function validarBoton() {
        if (!isset($_POST['btnPrivilegio'])) {
            $this->title = "Error";
            $this->message = "Se identificó un intento de vulnerabilidad del sistema. Acceso denegado.";
            return false;
        }
        return true;
    }

    public function obtenerUsuarios()
    {
        $objUsuario = new Usuario();
        return $objUsuario->obtenerUsuarios();
    }
}