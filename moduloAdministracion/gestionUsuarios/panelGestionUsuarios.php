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
        </head>

        <body>
            <h1>Gestión de usuarios</h1>
            <table>
                <tr>
                    <th>Usuario</th>
                    <th>Nombre</th>
                    <th>Apellido paterno</th>
                    <th>Apellido materno</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
                <?php
                foreach ($usuarios as $usuario) {
                ?>
                    <tr>
                        <td><?php echo $usuario["usuario"]; ?></td>
                        <td><?php echo $usuario["nombre"]; ?></td>
                        <td><?php echo $usuario["apaterno"]; ?></td>
                        <td><?php echo $usuario["amaterno"]; ?></td>
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
                            <form method="post" action="panelEditarUsuario.php">
                                <input type="hidden" name="usuario" value="<?php echo $usuario["usuario"]; ?>">
                                <button type="submit" name="btnEditarUsuario" value="Editar">Editar</button>
                            </form>
                            <form method="post" action="panelEliminarUsuario.php">
                                <input type="hidden" name="usuario" value="<?php echo $usuario["usuario"]; ?>">
                                <button type="submit" name="btnEliminarUsuario" value="Eliminar">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </table>
            <a href="../../moduloSeguridad/autenticacionUsuario/prePanelPrincipal.php">Volver al menu principal</a>
        </body>

        </html>
<?php
    }
}
