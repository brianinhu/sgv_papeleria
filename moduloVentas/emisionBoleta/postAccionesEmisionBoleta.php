<?php
require_once "controllerGestionUsuarios.php";
require_once "../../compartido/mensajeVulnerabilidadSistema.php";
require_once "panelGestionUsuarios.php";
$controller = new ControllerGestionUsuarios();
$mensajeSistema = new MensajeVulnerabilidadSistema();
$objPanelEmisionBoleta = new PanelEmisionBoleta();

if ($controller->validarSesion()) {
    $objPanelEmisionBoleta->mostrarPanelEmisionBoleta();
} else {
    $mensajeSistema->mostrarMensaje($controller->title, $controller->message);
    exit;
}