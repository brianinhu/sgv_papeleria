<?php
require_once "controllerGestionUsuarios.php";
require_once "../../compartido/mensajeSistema.php";

$controller = new ControllerGestionUsuarios();
$mensaje = new MensajeSistema();

if ($controller->validarSesion()) {
    if ($controller->validarBoton("btnEliminarUsuario")) {
        $response = array();
        $idusuario = $_POST["idusuario"];
        $usuario = $controller -> obtenerUsuario($idusuario);
        $response['flag'] = 1;
        $response['usuario'] = $usuario;
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    } else {
        $mensaje->mostrarMensajeSistema($controller->title, $controller->message);
    }

} else {
    $mensaje->mostrarMensajeSistema($controller->title, $controller->message);
}