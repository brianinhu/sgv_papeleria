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

                input[type="text"],
                input[type="password"],
                input[type="email"],
                select {
                    width: 100%;
                    padding: 12px 20px;
                    margin: 8px 0;
                    display: inline-block;
                    border: 1px solid #ccc;
                    box-sizing: border-box;
                }

                input[type="submit"] {
                    width: 100%;
                    background-color: #4CAF50;
                    color: white;
                    padding: 14px 20px;
                    margin: 8px 0;
                    border: none;
                    cursor: pointer;
                }

                input[type="submit"]:hover {
                    background-color: #45a049;
                }
            </style>
        </head>

        <body>
            <h1>Editar usuario</h1>
            <form action="validacionEditarUsuario.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" value="<?php echo $usuario['nombre']; ?>">
                <label for="apellido">Apellido</label>
                <input type="text" name="apellido" value="<?php echo $usuario['apellido']; ?>">
                <label for="email">Email</label>
                <input type="email" name="email" value="<?php echo $usuario['email']; ?>">
                <label for="rol">Rol</label>
                <select name="rol">
                    <option value="1" <?php echo $usuario['rol'] == 1 ? 'selected' : ''; ?>>Administrador</option>
                    <option value="2" <?php echo $usuario['rol'] == 2 ? 'selected' : ''; ?>>Usuario</option>
                </select>
                <input type="submit" value="Editar">
            </form>
            <form method="post" action="validacionPrePanelGestionUsuarios.php">
                <button type="submit" name="btnGestionUsuarios" value="btnGestionUsuarios">Volver</button>
            </form>
        </body>

        </html>
<?php
    }
}
