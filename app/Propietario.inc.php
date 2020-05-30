<?php

class Propietario
{

    private $user;
    private $password;
    private $amig_ci;

    public function __construct($user, $password, $amig_ci)
    {
        $this->user = $user;
        $this->password = $password;
        $this->amig_ci = $amig_ci;
    }

    public function get_user()
    {
        return $this->user;
    }
    public function get_password()
    {
        return $this->password;
    }
    public function get_amig()
    {
        return $this->amig_ci;
    }

    public function set_user($user)
    {
        $this->user = $user;
    }
    public function set_password($password)
    {
        $this->password = $password;
    }
    public function set_amig($amig)
    {
        $this->amig_ci = $amig;
    }
}
