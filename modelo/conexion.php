<?php
class Conexion
{
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "papeleriaelangel_1";
    private $conexion;

    public function conectar()
    {
        if ($this->conexion == null) {
            $this->conexion = mysqli_connect($this->host, $this->user, $this->password, $this->database);
        }
        return $this->conexion;
    }

    public function desconectar()
    {
        if ($this->conexion != null) {
            mysqli_close($this->conexion);
            $this->conexion = null; // Asegura que la conexión se marca como cerrada.
        }
    }

    // Destructor para cerrar la conexión automáticamente
    function __destruct()
    {
        $this->desconectar();
    }
}