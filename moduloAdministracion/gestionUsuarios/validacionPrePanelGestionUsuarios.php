<?php
require_once "controllerGestionUsuarios.php";
require_once "../../compartido/mensajeSistema.php";
require_once "panelGestionUsuarios.php";
$controller = new ControllerGestionUsuarios();
$mensajeSistema = new MensajeSistema();
$objPaenlGestionUsuarios = new PanelGestionUsuarios();
if ($controller->validarSesion()) {
    if ($controller->validarBoton("btnGestionUsuarios")) {
        $usuarios = $controller->obtenerUsuarios();
        $objPaenlGestionUsuarios->mostrarPanel($usuarios);
        exit;
    } else {
        $mensajeSistema->mostrarMensajeSistema($controller->title, $controller->message);
        exit;
    }
} else {
    $mensajeSistema->mostrarMensajeSistema($controller->title, $controller->message);
    exit;
}
