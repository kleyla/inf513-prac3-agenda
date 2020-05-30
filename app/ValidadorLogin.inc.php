<?php
include_once 'RepositorioPropietario.inc.php';


class ValidadorLogin
{
    private $usuario;
    private $error;
    public function __construct($user, $pass, $conexion)
    {
        $this->error = "";
        if (!$this->variable_iniciada($user) && !$this->variable_iniciada($pass)) {
            $this->usuario = null;
            $this->error = "Debes introducir tu user y  contrasenha";
        } else {
            $this->usuario = RepositorioPropietario::get_usuario($conexion, $user, $pass);
            // if (is_null($this->usuario) || !password_verify($pass, $this->usuario->get_password())) {
            if (is_null($this->usuario)) {
                $this->error = "Datos incorrectos";
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

    public function get_usuario()
    {
        return $this->usuario;
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
