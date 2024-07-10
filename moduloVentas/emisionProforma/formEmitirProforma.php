<?php
class formEmitirProforma
{
    public function formEmitirProformaShow($listaProductos, $listaCategoria)
    { ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Emisión de Proforma</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
            <link rel="stylesheet" href="../../assets/css/emitirProforma.css">
        </head>

        <body>
            <div>
                <a href="../../moduloSeguridad/autenticacionUsuario/prePanelPrincipalUsuario.php">Volver al panel principal</a>
            </div>
            <div>
                <p>Usuario conectado: <?php echo $_SESSION['usuario'] ?></p>
            </div>
            <form action="getProforma.php" method="POST">
                <div class="input-group">
                    <input class="form-control" type="text" name="txtBuscarProducto" placeholder="Buscar producto" aria-label="Search">
                    <button class="btn btn-light" type="submit" name="btnBuscarProducto">Buscar</button>
                </div>
            </form>
            <div>
                <table class="table">
                    <thead>
                        <tr>
                            <td>ID Producto</td>
                            <td>Nombre</td>
                            <td>Descripción</td>
                            <td>Categoría</td>
                            <td>Precio</td>
                            <td>Stock</td>
                            <td>Estado</td>
                            <td>Acción</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($listaProductos)) {
                            $categoriasPorId = [];
                            foreach ($listaCategoria as $categoria) {
                                $categoriasPorId[$categoria['idcategoria']] = $categoria['categoria'];
                            }

                            foreach ($listaProductos as $producto) {
                                $idProducto = $producto['idproducto'];
                                $nombre = $producto['producto'];
                                $descripcion = $producto['descripcion'];
                                $categoriaId = $producto['idcategoria'];
                                $precio = $producto['precio'];
                                $stock = $producto['stock'];
                                $nombreCategoria = isset($categoriasPorId[$categoriaId]) ? $categoriasPorId[$categoriaId] : 'null';
                        ?>
                                <tr>
                                    <td class="datosProducto"><?php echo $idProducto ?></td>
                                    <td class="datosProducto"><?php echo $nombre; ?></td>
                                    <td><?php echo $descripcion; ?></td>
                                    <td><?php echo $nombreCategoria; ?></td>
                                    <td class="datosProducto"><?php echo $precio; ?></td>
                                    <td class="datosProducto"><?php echo $stock; ?></td>
                                    <td><?php echo $stock == 0 ? 'Agotado' : 'Disponible'; ?></td>
                                    <td>
                                        <input type="button" class="btn <?php echo $stock == 0 ? 'btn-secondary' : 'btn-warning'; ?>" name="btnAgregarProducto" value="Agregar" <?php echo $stock == 0 ? 'disabled' : ''; ?>>
                                    </td>
                                </tr>
                            <?php
                            }
                        } else { ?>
                            <tr>
                                <td colspan='8'>No hay productos disponibles.</td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <input type="button" name="btnVisualizarLista" id="verListaProforma" value="Ver lista de productos" class="btn btn-primary">
            </div>
            <div class="resumenProforma">
                <form action="getProforma.php" method="POST" class="formEmitirProforma">
                    <h2 class="subtitle">Lista de productos</h2>
                    <div>
                        <p style="text-align: left;">Productos seleccionados</p>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Subtotal</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody class="listaProductos">

                            </tbody>
                        </table>
                    </div>
                    <p>Total</p>
                    <input type="text" name="totalProforma" class="totalProforma" readonly>

                    <input type="submit" name="btnGenerarProforma" value="Generar Proforma" class="btn btn-primary">
                </form>
            </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
            <script src="../../assets/js/emitirProforma.js"></script>
            <script>
                $(document).ready(function() {
                    $('#verListaProforma').click(function() {
                        $('.resumenProforma').toggle();
                    });
                });
            </script>
        </body>

        </html>
<?php
    }
}
?>