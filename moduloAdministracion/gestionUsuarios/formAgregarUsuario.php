<?php

class FormAgregarUsuario
{
    public function mostrarFormulario()
    {
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Agregar usuario</title>
            <style>
                * {
                    font-family: system-ui, arial;
                }

                body {
                    margin: 0 5rem;
                }

                h1 {
                    text-align: center;
                }

                #formAgregar {
                    display: flex;
                    flex-direction: column;
                }
            </style>
        </head>

        <body>
            <h1>Agregar usuario</h1>
            <form id="formAgregar">
                <div>
                    <label for="txtNombre">Nombre:</label>
                    <input type="text" id="txtNombre" name="txtNombre">
                </div>
                <div>
                    <label for="txtAPaterno">Apellido paterno:</label>
                    <input type="text" id="txtAPaterno" name="txtAPaterno">
                </div>
                <div>
                    <label for="txtAMaterno">Apellido materno:</label>
                    <input type="text" id="txtAMaterno" name="txtAMaterno">
                </div>
                <div>
                    <label for="txtDNI">DNI:</label>
                    <input type="text" id="txtDNI" name="txtDNI">
                </div>
                <div>
                    <label for="txtContraseña">Contraseña:</label>
                    <input type="password" id="txtContraseña" name="txtContraseña">
                </div>
                <div>
                    <label for="txtConfContraseña">Confirme su contraseña:</label>
                    <input type="password" id="txtConfContraseña" name="txtConfContraseña">
                </div>
                <div>
                    <label for="txtUsuario">Usuario:</label>
                    <input type="text" id="txtUsuario" name="txtUsuario">
                </div>
                <div>
                    <label for="cbxRol">Rol:</label>
                    <select id="cbxRol" name="cbxRol">
                        <option value="0">Seleccione un rol</option>
                        <option value="1">Vendedor</option>
                        <option value="2">Cajero</option>
                        <option value="3">Despachador</option>
                        <option value="4">Administrador</option>
                    </select>
                </div>
                <div>
                    <label for="cbxEstado">Estado:</label>
                    <select id="cbxEstado" name="cbxEstado">
                        <option value="-1">Seleccione un estado</option>
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>
                <div>
                    <label for="cbxPreguntaSeguridad">Pregunta de seguridad:</label>
                    <select id="cbxPreguntaSeguridad" name="cbxPreguntaSeguridad">
                        <option value="0">Seleccione una pregunta</option>
                        <option value="1">¿Cuál es tu comida favorita?</option>
                        <option value="2">¿Cuál es el nombre de su abuela?</option>
                    </select>
                </div>
                <div>
                    <label for="txtRespuestaSecreta">Respuesta secreta:</label>
                    <input type="text" id="txtRespuestaSecreta" name="txtRespuestaSecreta">
                </div>
                <div>
                    <button type="button" value="btnCreateAgregar" id="btnCreateAgregar" onclick="javascript:createAgregar()">Agregar usuario</button>
                </div>
            </form>
            <form method="post" action="validacionPrePanelGestionUsuarios.php">
                <button type="submit" name="btnGestionUsuarios" value="btnGestionUsuarios">Volver al panel</button>
            </form>


            <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                function createAgregar() {
                    var nombre = document.getElementById("txtNombre").value;
                    var aPaterno = document.getElementById("txtAPaterno").value;
                    var aMaterno = document.getElementById("txtAMaterno").value;
                    var dni = document.getElementById("txtDNI").value;
                    var contraseña = document.getElementById("txtContraseña").value;
                    var confContraseña = document.getElementById("txtConfContraseña").value;
                    var usuario = document.getElementById("txtUsuario").value;
                    var rol = document.getElementById("cbxRol").value;
                    var estado = document.getElementById("cbxEstado").value;
                    var preguntaSeguridad = document.getElementById("cbxPreguntaSeguridad").value;
                    var respuesta = document.getElementById("txtRespuestaSecreta").value;
                    var btnCreateAgregar = document.getElementById("btnCreateAgregar").value;
                    $.ajax({
                        type: "POST",
                        url: "validacionAgregarUsuario.php",
                        data: {
                            txtNombre: nombre,
                            txtAPaterno: aPaterno,
                            txtAMaterno: aMaterno,
                            txtDNI: dni,
                            txtContraseña: contraseña,
                            txtConfContraseña: confContraseña,
                            txtUsuario: usuario,
                            cbxRol: rol,
                            cbxEstado: estado,
                            cbxPreguntaSeguridad: preguntaSeguridad,
                            txtRespuestaSecreta: respuesta,
                            btnCreateAgregar: btnCreateAgregar
                        },
                        success: function(response) {
                            if (response['flag'] == 1) {
                                Swal.fire({
                                    icon: 'success',
                                    title: response['title'],
                                    text: response['message'],
                                    showConfirmButton: false,
                                    timer: 3000
                                }).then(function() {
                                    window.location.href = response['redirect'];
                                });
                            } else if (response['flag'] == 0) {
                                Swal.fire({
                                    icon: 'error',
                                    title: response['title'],
                                    text: response['message']
                                });
                            }
                        },
                        error: function(response) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Error en la solicitud'
                            });
                        }
                    });
                }
            </script>
        </body>

        </html>
<?php
    }
}
