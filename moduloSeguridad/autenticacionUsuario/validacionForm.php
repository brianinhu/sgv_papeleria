<?php
session_start();
include_once("controllerAutenticacionUsuario.php");
$controller = new ControllerAutenticacionUsuario();
if ($controller->validarBoton("btnIngresar")) {
    $response = array();
    $txtUsuario = $_POST['txtUsuario'];
    $txtPassword = $_POST['txtPassword'];
    $txtRespuestaAntiRobot = $_POST['txtRespuestaAntiRobot'];
    if ($controller->validarTextoRespuestaAntiRobot($txtRespuestaAntiRobot)) {
        if ($controller->validarTextoUsuario($txtUsuario)) {
            if ($controller->validarUsuario($txtUsuario)) {
                if ($controller->validarTextoContraseña($txtPassword)) {
                    if ($controller->validarContraseña($txtUsuario, $txtPassword)) {
                        if ($controller->validarEstadoUsuario($txtUsuario)) {
                            $privilegios = $controller->obtenerPrivilegios($txtUsuario);
                            $rol = $controller->obtenerRol($txtUsuario);
                            $idusuario = $controller->obtenerIdUsuario($txtUsuario);
                            $_SESSION['usuario'] = $txtUsuario;
                            $_SESSION['rol'] = $rol;
                            $_SESSION['idusuario'] = $idusuario;
                            $_SESSION['privilegios'] = $privilegios;
                            $response['flag'] = 1;
                            $response['redirect'] = "./moduloSeguridad/autenticacionUsuario/prePanelPrincipal.php";
                            header('Content-Type: application/json');
                            echo json_encode($response);
                        } else {
                            $response['flag'] = 0;
                            $response['message'] = "El usuario ingresado se encuentra inactivo. Comuníquese con el administrador.";
                            header('Content-Type: application/json');
                            echo json_encode($response);
                            exit;
                        }
                    } else {
                        $response['flag'] = 0;
                        $response['message'] = "La contraseña ingresada es incorrecta. Intente nuevamente.";
                        header('Content-Type: application/json');
                        echo json_encode($response);
                        exit;
                    }
                } else {
                    $response['flag'] = 0;
                    $response['message'] = $controller->message;
                    header('Content-Type: application/json');
                    echo json_encode($response);
                    exit;
                }
            } else {
                $response['flag'] = 0;
                $response['message'] = "El usuario ingresado no existe. Intente nuevamente.";
                header('Content-Type: application/json');
                echo json_encode($response);
                exit;
            }
        } else {
            $response['flag'] = 0;
            $response['message'] = $controller->message;
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }
    } else {
        $response['flag'] = 0;
        $response['message'] = $controller->message;
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
} else {
    include_once("../../compartido/mensajeSistema.php");
    $modal = new MensajeSistema();
    $modal->mostrarMensajeSistema("Acceso denegado", "Se identificó un intento de vulnerabilidad del sistema.");
}
