<?php
require_once "controllerPanelPrincipalUsuario.php";
require_once "../compartido/mensajeSistema.php";
$controller = new ControllerPanelPrincipalUsuario();
if ($controller->validarSesion()) {
    if ($controller->validarBoton()) {
        switch ($_POST['btnPrivilegio']) {
            case 'btnGestionUsuarios':
                $usuarios = $controller->obtenerUsuarios();
                require_once("../moduloAdministracion/gestionUsuarios/panelGestionUsuarios.php");
                $panelGestionUsuarios = new PanelGestionUsuarios();
                $panelGestionUsuarios->mostrarPanel($usuarios);
                break;
            case 'btnEmisionTicketReembolso':
                
                break;
            case 'btnEmisionProforma':
                // Code for button3
                break;
        }
    } else {
        $mensajeSistema = new MensajeSistema();
        $mensajeSistema->mostrarMensajeSistema($controller->title, $controller->message);
        exit;
    }
} else {
    $mensajeSistema = new MensajeSistema();
    $mensajeSistema->mostrarMensajeSistema($controller->title, $controller->message);
    exit;
}
