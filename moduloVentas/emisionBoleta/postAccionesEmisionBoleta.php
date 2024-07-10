<?php
require_once "controllerGestionUsuarios.php";
require_once "../../compartido/mensajeVulnerabilidadSistema.php";
require_once "panelGestionUsuarios.php";
$controller = new ControllerEmisionBoleta();
$mensajeSistema = new MensajeVulnerabilidadSistema();
$objPanelEmisionBoleta = new PanelEmisionBoleta();


session_start();
if ($controller->validarSesion()) {
    $lista = $controller->listarProformas();
    $objPanelEmisionBoleta->mostrarPanelEmisionBoleta($lista);
} else {
    $mensajeSistema->mostrarMensaje("Error", "No se ha iniciado sesión");
    exit;
}