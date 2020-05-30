<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/ValidadorLogin.inc.php';
include_once 'app/ControlSesion.inc.php';
include_once 'app/Redireccion.inc.php';

if (ControlSesion::sesion_iniciada()) {
    Redireccion::redirigir(SERVIDOR);
}
if (isset($_POST['login'])) {
    Conexion::open_conexion();
    $validador = new ValidadorLogin(
        $_POST['user'],
        $_POST['pass'],
        Conexion::get_conexion()
    );
    if ($validador->get_error() === '' && !is_null($validador->get_usuario())) {
        //iniciar sesion
        // echo "Inicio de sesion";
        ControlSesion::iniciar_sesion(
            $validador->get_usuario()->get_user()
        );
        echo $validador->get_usuario()->get_user();
        Redireccion::redirigir(RUTA_INDEX);
    } else {
        echo "Inicio de sesion fallido";
    }
    Conexion::close_conexion();
}
$titulo = "Login";

include_once 'layout/header.inc.php';
// include_once 'layout/navbar.inc.php';

?>

<body class="login-page">
    <div class="back">
        <div class="login">
            <h2 class="titulo"><?php echo $titulo ?></h2>
            <div class="card" style="width: 25rem;">
                <div class="card-body">
                    <h5 class="card-title">Login</h5>
                    <form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                        <div class="form-group">
                            <label for="user">Usuario</label>
                            <input name="user" type="text" class="form-control" id="user" <?php
                                                                                            if (isset($_POST['login']) && isset($_POST['user']) && !empty($_POST['user'])) {
                                                                                                echo 'value="' . $_POST['user'] . '"';
                                                                                            }
                                                                                            ?> required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="pass">Contrasenha</label>
                            <input type="password" class="form-control" id="pass" name="pass">
                        </div>
                        <?php
                        if (isset($_POST['login'])) {
                            $validador->show_error();
                        }
                        ?>
                        <div style="text-align: end;">
                            <button type="submit" name="login" class="btn btn-primary">Confirmar</button>
                            <button type="reset" class="btn btn-danger">Limpiar</button>
                        </div>
                        <br>
                        <div style="text-align: center;">
                            <a href="{$pcregistrar}">Registrarme</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <?php
    include_once 'layout/footer.inc.php';
    ?>