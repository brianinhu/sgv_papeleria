<?php

class PanelGestionUsuarios
{
    public function mostrarPanel($usuarios)
    {
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Gestión de usuarios</title>
            <!-- CSS DataTable -->
            <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
            <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap5.min.css" />
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

                #table_wrapper {
                    width: 70%;
                    margin: 0 auto;
                }

                a {
                    display: block;
                    text-align: center;
                    margin-top: 20px;
                }

                a:hover {
                    background-color: #f2f2f2;
                }
            </style>
        </head>

        <body>
            <h1>Gestión de usuarios</h1>
            <table id="table">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Nombre</th>
                        <th>Apellido paterno</th>
                        <th>Apellido materno</th>
                        <th>DNI</th>
                        <th>Rol</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($usuarios as $usuario) {
                    ?>
                        <tr>
                            <td><?php echo $usuario["usuario"]; ?></td>
                            <td><?php echo $usuario["nombre"]; ?></td>
                            <td><?php echo $usuario["apaterno"]; ?></td>
                            <td><?php echo $usuario["amaterno"]; ?></td>
                            <td><?php echo $usuario["DNI"]; ?></td>
                            <td><?php if ($usuario['idrol'] == 1) {
                                    echo "Vendedor";
                                } elseif ($usuario['idrol'] == 2) {
                                    echo "Cajero";
                                } elseif ($usuario['idrol'] == 3) {
                                    echo "Despachador";
                                } elseif ($usuario['idrol'] == 4) {
                                    echo "Administrador";
                                } ?></td>
                            <td><?php if ($usuario["estado"] == 1) {
                                    echo "Habilitado";
                                } else {
                                    echo "Deshabilitado";
                                } ?></td>
                            <td>
                                <form method="POST" action="validacionPostPanelGestionUsuarios.php">
                                    <input type="hidden" name="idusuario" value="<?php echo $usuario["idusuario"]; ?>">
                                    <button type="submit" name="btnEditarUsuario" value="Editar">Editar</button>
                                </form>
                                <form method="POST" action="validacionPostPanelGestionUsuarios.php">
                                    <input type="hidden" name="idusuario" value="<?php echo $usuario["idusuario"]; ?>">
                                    <button type="submit" name="btnEliminarUsuario" value="Eliminar">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <form method="POST" action="validacionPostPanelGestionUsuarios.php">
                <button type="submit" name="btnAgregarUsuario" value="Agregar">Agregar usuario</button>
            </form>

            <a href="../../moduloSeguridad/autenticacionUsuario/prePanelPrincipal.php">Volver al menu principal</a>

            <!-- JavaScript JQuery -->
            <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
            <!-- JavaScript DataTable -->
            <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
            <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap5.min.js"></script>
            <!-- JavaScript SweetAlert2 -->
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                $(document).ready(function() {
                    $('#table').DataTable({
                        responsive: true,
                        pagingType: 'full_numbers',
                        lengthMenu: [4, 8, 12, 16],
                        pageLength: 4,
                        language: {
                            url: '../../assets/json/es-MX.json'
                        }
                    });
                });
            </script>
        </body>

        </html>
<?php
    }
}
