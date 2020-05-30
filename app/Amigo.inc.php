<?php

class Amigo
{

    private $amig_ci;
    private $amig_nombre;
    private $amig_appm;
    private $amig_telf;
    private $amig_cel;
    private $amig_dir;
    private $amig_fnac;
    private $amig_foto;

    public function __construct($amig_ci, $amig_nombre, $amig_appm, $amig_telf, $amig_cel, $amig_dir, $amig_fnac, $foto = "profile.png")
    {
        $this->amig_ci = $amig_ci;
        $this->amig_nombre = $amig_nombre;
        $this->amig_appm = $amig_appm;
        $this->amig_telf = $amig_telf;
        $this->amig_cel = $amig_cel;
        $this->amig_dir = $amig_dir;
        $this->amig_fnac = $amig_fnac;
        $this->amig_foto = $foto;
    }

    public function get_amig_ci()
    {
        return $this->amig_ci;
    }
    public function get_amig_nombre()
    {
        return $this->amig_nombre;
    }
    public function get_amig_appm()
    {
        return $this->amig_appm;
    }
    public function get_amig_telf()
    {
        return $this->amig_telf;
    }
    public function get_amig_cel()
    {
        return $this->amig_cel;
    }
    public function get_amig_dir()
    {
        return $this->amig_dir;
    }
    public function get_amig_fnac()
    {
        return $this->amig_fnac;
    }
    public function get_amig_foto()
    {
        return $this->amig_foto;
    }

    public function set_amig_ci($amig_ci)
    {
        $this->amig_ci = $amig_ci;
    }
    public function set_amig_nombre($amig_nombre)
    {
        $this->amig_nombre = $amig_nombre;
    }
    public function set_amig_appm($app)
    {
        $this->amig_appm = $app;
    }
    public function set_amig_telf($amig_telf)
    {
        $this->amig_telf = $amig_telf;
    }
    public function set_amig_cel($amig_cel)
    {
        $this->amig_cel = $amig_cel;
    }
    public function set_amig_dir($amig_dir)
    {
        $this->amig_dir = $amig_dir;
    }
    public function set_amig_fnac($amig_fnac)
    {
        $this->amig_fnac = $amig_fnac;
    }
    public function set_amig_foto($amig_foto)
    {
        $this->amig_foto = $amig_foto;
    }
}
