<?php
include_once 'RepositorioAmigo.inc.php';

class ValidadorModificarAmigo
{
    private $amigo;
    private $error;

    public function __construct($ci, $nombre, $apellido, $tel, $cel, $dir, $fnac, $conexion)
    {
        $this->error = "";
        if (!$this->variable_iniciada($nombre) && !$this->variable_iniciada($apellido) && !$this->variable_iniciada($tel) && !$this->variable_iniciada($cel) && !$this->variable_iniciada($dir) && !$this->variable_iniciada($fnac)) {
            $this->amigo = null;
            $this->error = "Debes introducir datos";
        } else {
            $this->amigo = RepositorioAmigo::get_amigo($conexion, $ci);
            if (is_null($this->amigo)) {
                $this->error = "Datos incorrectos";
            } else {
                RepositorioAmigo::update_amigo($conexion, $ci, $nombre, $apellido, $tel, $cel, $dir, $fnac);
            }
        }
    }
    private function variable_iniciada($variable)
    {
        if (isset($variable) && !empty($variable)) {
            return true;
        } else {
            return false;
        }
    }
    public function get_amigo()
    {
        return $this->amigo;
    }
    public function get_error()
    {
        return $this->error;
    }
    public function show_error()
    {
        if ($this->error !== "") {
            echo "<br><div class='alert alert-danger' role='alert'>";
            echo $this->error;
            echo "</div><br>";
        }
    }
}
