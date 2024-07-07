<?php
class PanelPrincipalUsuario
{
    public function mostrarPanel()
    {
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
            <style>
                table {
                    border-collapse: collapse;
                }

                table,
                th,
                td {
                    border: 1px solid black;
                }

                th,
                td {
                    padding: 15px;
                    text-align: left;
                }

                th {
                    background-color: #f2f2f2;
                }

                img {
                    width: 50px;
                    height: 50px;
                }
            </style>
        </head>

        <body>
            <div>
                <h1>Panel principal</h1>
                <p>Bienvenido al panel principal, <strong><?php echo $_SESSION['usuario']; ?></strong> </p>
                <p>Rol: <strong><?php echo $_SESSION['rol']; ?></strong> </p>
                <p>Privilegios:</p>
                <table>
                    <?php
                    foreach ($_SESSION['privilegios'] as $privilegio) {
                    ?>
                        <tr>
                            <td>
                                <img src="<?php echo $privilegio['icono']; ?>" alt="<?php echo basename($privilegio['icono']); ?>">
                            </td>
                            <td>
                                <form method="post" action="<?php echo $privilegio['ruta']; ?>">
                                    <button type="submit" name="<?php echo $privilegio['name']; ?>" value="<?php echo $privilegio['name']; ?>"><?php echo $privilegio['label'] ?></button>
                                </form>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
                <a href="../cerrarSesion.php">Cerrar sesión</a>
            </div>
        </body>

        </html>
<?php
    }
}
