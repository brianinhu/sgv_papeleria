<?php
require_once "controllerEmisionBoleta.php";
require_once "../../compartido/mensajeVulnerabilidadSistema.php";
require_once "panelEmisionBoleta.php";
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