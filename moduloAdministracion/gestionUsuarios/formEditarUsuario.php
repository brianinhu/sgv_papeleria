<?php

class FormEditarUsuario
{
    public function mostrarFormulario($usuario)
    {
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Editar usuario</title>
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

                form {
                    width: 50%;
                    margin: 0 auto;
                }
            </style>
        </head>

        <body>
            <h1>Editar usuario</h1>
            <form>
                <input type="hidden" id="idusuario" value="<?php echo $usuario['idusuario']; ?>">
                <div>
                    <label>Nombre</label>
                    <input type="text" disabled value="<?php echo $usuario['nombre']; ?>">
                </div>
                <div>
                    <label>Apellido paterno</label>
                    <input type="text" disabled value="<?php echo $usuario['apaterno']; ?>">
                </div>
                <div>
                    <label>Apellido materno</label>
                    <input type="text" disabled value="<?php echo $usuario['amaterno']; ?>">
                </div>
                <div>
                    <label>DNI</label>
                    <input type="text" disabled value="<?php echo $usuario['DNI']; ?>">
                </div>
                <div>
                    <label for="txtEditNuevaContraseña">Nueva contraseña</label>
                    <input type="password" id="txtEditNuevaContraseña">
                </div>
                <div>
                    <label for="txtEditConfNuevaContraseña">Confirme la nueva contraseña</label>
                    <input type="password" id="txtEditConfNuevaContraseña">
                </div>
                <div>
                    <label for="txtEditUsuario">Usuario</label>
                    <input type="text" id="txtEditUsuario" value="<?php echo $usuario['usuario']; ?>">
                </div>
                <div>
                    <label for="cbxEditRol">Rol</label>
                    <select id="cbxEditRol">
                        <option value="1" <?php if ($usuario['idrol'] == 1) echo "selected"; ?>>Vendedor</option>
                        <option value="2" <?php if ($usuario['idrol'] == 2) echo "selected"; ?>>Cajero</option>
                        <option value="3" <?php if ($usuario['idrol'] == 3) echo "selected"; ?>>Despachador</option>
                        <option value="4" <?php if ($usuario['idrol'] == 4) echo "selected"; ?>>Administrador</option>
                    </select>
                </div>
                <div>
                    <label for="cbxEditEstado">Estado</label>
                    <select id="cbxEditEstado">
                        <option value="1" <?php if ($usuario['estado'] == 1) echo "selected"; ?>>Habilitado</option>
                        <option value="0" <?php if ($usuario['estado'] == 0) echo "selected"; ?>>Deshabilitado</option>
                    </select>
                </div>
                <div>
                    <label for="cbxEditPreguntaSeguridad">Pregunta de seguridad</label>
                    <input type="hidden" id="idpregunta" value="<?php echo $usuario['idpregunta']; ?>">
                    <select id="cbxEditPreguntaSeguridad">
                        <option value="1" <?php if ($usuario['idpregunta'] == 1) echo "selected"; ?>>¿Cuál es su comida favorita?</option>
                        <option value="2" <?php if ($usuario['idpregunta'] == 2) echo "selected"; ?>>¿Cuál es el nombre de su abuela?</option>
                    </select>
                </div>
                <div>
                    <label for="txtEditRespuestaSecreta">Respuesta secreta</label>
                    <input type="text" id="txtEditRespuestaSecreta">
                </div>
                <button type="button" id="btnEditGuardarCambios" value="btnEditGuardarCambios" onclick="javascript:guardarCambios()">Guardar cambios</button>
            </form>
            <form method="post" action="validacionPrePanelGestionUsuarios.php">
                <button type="submit" name="btnGestionUsuarios" value="btnGestionUsuarios">Volver</button>
            </form>

            <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                function guardarCambios() {
                    var idusuario = document.getElementById("idusuario").value;
                    var contraseña = document.getElementById("txtEditNuevaContraseña").value;
                    var confContraseña = document.getElementById("txtEditConfNuevaContraseña").value;
                    var usuario = document.getElementById("txtEditUsuario").value;
                    var rol = document.getElementById("cbxEditRol").value;
                    var estado = document.getElementById("cbxEditEstado").value;
                    var idpregunta = document.getElementById("idpregunta").value;
                    var preguntaSeguridad = document.getElementById("cbxEditPreguntaSeguridad").value;
                    var respuesta = document.getElementById("txtEditRespuestaSecreta").value;
                    var boton = document.getElementById("btnEditGuardarCambios").value;
                    $.ajax({
                        type: "POST",
                        url: "validacionEditarUsuario.php",
                        data: {
                            idusuario: idusuario,
                            txtEditNuevaContraseña: contraseña,
                            txtEditConfNuevaContraseña: confContraseña,
                            txtEditUsuario: usuario,
                            cbxEditRol: rol,
                            cbxEditEstado: estado,
                            idpregunta: idpregunta,
                            cbxEditPreguntaSeguridad: preguntaSeguridad,
                            txtEditRespuestaSecreta: respuesta,
                            btnEditGuardarCambios: boton
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
