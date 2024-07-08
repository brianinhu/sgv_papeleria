<?php
require_once "controllerGestionUsuarios.php";
require_once "../../compartido/mensajeSistema.php";
$controller = new ControllerGestionUsuarios();
$mensaje = new MensajeSistema();

if ($controller->validarSesion()) {
    if ($controller->validarBoton("btnCreateAgregar")) {
        $txtNombre = $_POST['txtNombre'];
        $txtAPaterno = $_POST['txtAPaterno'];
        $txtAMaterno = $_POST['txtAMaterno'];
        $txtDNI = $_POST['txtDNI'];
        $txtContraseña = $_POST['txtContraseña'];
        $txtConfContraseña = $_POST['txtConfContraseña'];
        $txtUsuario = $_POST['txtUsuario'];
        $cbxRol = $_POST['cbxRol'];
        $cbxEstado = $_POST['cbxEstado'];
        $cbxPreguntaSeguridad = $_POST['cbxPreguntaSeguridad'];
        $txtRespuestaSecreta = $_POST['txtRespuestaSecreta'];
        $response = array();
        if ($controller->validarTextoNombreApellidos($txtNombre, $txtAPaterno, $txtAMaterno)) {
            if ($controller->validarTextoDNI($txtDNI)) {
                if ($controller->validarDNI($txtDNI)) {
                    if ($controller->validarTextoContraseña($txtContraseña)) {
                        if ($controller->validarTextoIgualdadContraseñayConfContraseña($txtContraseña, $txtConfContraseña)) {
                            if ($controller->validarTextoUsuario($txtUsuario)) {
                                if ($controller->validarUsuario($txtUsuario)) {
                                    if ($controller->validarSeleccionRol($cbxRol)) {
                                        if ($controller->validarSeleccionEstado($cbxEstado)) {
                                            if ($controller->validarSeleccionPreguntaSeguridad($cbxPreguntaSeguridad)) {
                                                if ($controller->validarTextoRespuestaSecreta($txtRespuestaSecreta)) {
                                                    if ($controller->agregarUsuario($txtNombre, $txtAPaterno, $txtAMaterno, $txtDNI, $txtContraseña, $txtUsuario, $cbxRol, $cbxEstado, $cbxPreguntaSeguridad, $txtRespuestaSecreta)) {
                                                        $response['flag'] = 1;
                                                        $response['title'] = $controller->title;
                                                        $response['message'] = $controller->message;
                                                        $response['redirect'] = "validacionPostAgregarUsuario.php";
                                                        header('Content-Type: application/json');
                                                        echo json_encode($response);
                                                    } else {
                                                        $response['flag'] = 0;
                                                        $response['title'] = $controller->title;
                                                        $response['message'] = $controller->message;
                                                        header('Content-Type: application/json');
                                                        echo json_encode($response);
                                                        exit;
                                                    }
                                                } else {
                                                    $response['flag'] = 0;
                                                    $response['title'] = $controller->title;
                                                    $response['message'] = $controller->message;
                                                    header('Content-Type: application/json');
                                                    echo json_encode($response);
                                                    exit;
                                                }
                                            } else {
                                                $response['flag'] = 0;
                                                $response['title'] = $controller->title;
                                                $response['message'] = $controller->message;
                                                header('Content-Type: application/json');
                                                echo json_encode($response);
                                                exit;
                                            }
                                        } else {
                                            $response['flag'] = 0;
                                            $response['title'] = $controller->title;
                                            $response['message'] = $controller->message;
                                            header('Content-Type: application/json');
                                            echo json_encode($response);
                                            exit;
                                        }
                                    } else {
                                        $response['flag'] = 0;
                                        $response['title'] = $controller->title;
                                        $response['message'] = $controller->message;
                                        header('Content-Type: application/json');
                                        echo json_encode($response);
                                        exit;
                                    }
                                } else {
                                    $response['flag'] = 0;
                                    $response['title'] = $controller->title;
                                    $response['message'] = $controller->message;
                                    header('Content-Type: application/json');
                                    echo json_encode($response);
                                    exit;
                                }
                            } else {
                                $response['flag'] = 0;
                                $response['title'] = $controller->title;
                                $response['message'] = $controller->message;
                                header('Content-Type: application/json');
                                echo json_encode($response);
                                exit;
                            }
                        } else {
                            $response['flag'] = 0;
                            $response['title'] = $controller->title;
                            $response['message'] = $controller->message;
                            header('Content-Type: application/json');
                            echo json_encode($response);
                            exit;
                        }
                    } else {
                        $response['flag'] = 0;
                        $response['title'] = $controller->title;
                        $response['message'] = $controller->message;
                        header('Content-Type: application/json');
                        echo json_encode($response);
                        exit;
                    }
                } else {
                    $response['flag'] = 0;
                    $response['title'] = $controller->title;
                    $response['message'] = $controller->message;
                    header('Content-Type: application/json');
                    echo json_encode($response);
                    exit;
                }
            } else {
                // json
                $response['flag'] = 0;
                $response['title'] = $controller->title;
                $response['message'] = $controller->message;
                header('Content-Type: application/json');
                echo json_encode($response);
                exit;
            }
        } else {
            // response para json
            $response['flag'] = 0;
            $response['title'] = $controller->title;
            $response['message'] = $controller->message;
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }
    } else {
        $mensaje->mensajeSistemaShow($controller->title, $controller->message);
    }
} else {
    $mensaje->mensajeSistemaShow($controller->title, $controller->message);
}
