<?php
class MensajeSistema
{
    public function mostrarMensajeSistema($title, $mensaje)
    {
?>
        <div>
            <div>
                <h1><?php echo $title; ?></h1>
                <p><?php echo $mensaje; ?></p>
            </div>
            <div>
                <a href="../index.php">Volver</a>
            </div>
        </div>
<?php
    }
}
