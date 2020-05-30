<?php
include_once 'app/Conexion.inc.php';
include_once 'app/RepositorioAmigo.inc.php';
include_once 'app/ValidadorModificarAmigo.inc.php';
include_once 'app/Redireccion.inc.php';

$id  = $_GET['id'];
// echo $id;
Conexion::open_conexion();
$amigo = RepositorioAmigo::get_amigo(Conexion::get_conexion(), $id);
if (isset($_POST['modificar'])) {
    Conexion::open_conexion();
    $path = "public/img/";
    $path = $path . basename($_FILES['foto']['name']);
    $validador = new ValidadorModificarAmigo(
        // $id,
        $_POST['ci'],
        $_POST['nom'],
        $_POST['app'],
        $_POST['tel'],
        $_POST['cel'],
        $_POST['dir'],
        $_POST['fnac'],
        Conexion::get_conexion()
    );
    if ($validador->get_error() === '' && !is_null($validador->get_amigo())) {
        if (!empty($_FILES['foto'])) {
            $temp = explode(".", $_FILES["foto"]["name"]);
            $extension = end($temp);
            $new_name = $_POST['ci'] . '.' . $extension;
            $path = "public/img/";
            // $path = $path . basename($_FILES['foto']['name']);

            if (move_uploaded_file($_FILES['foto']['tmp_name'], $path . $new_name)) {
                RepositorioAmigo::update_foto(Conexion::get_conexion(), $_POST['ci'], $new_name);
            }
            // else {
            //     echo "Error subiendo la foto";
            // }
        }
        Redireccion::redirigir(RUTA_INDEX);
    } else {
        echo "Modificacion fallido";
    }
    Conexion::close_conexion();
}
$titulo = 'Modificar';
include_once 'layout/header.inc.php';
include_once 'layout/navbar.inc.php';
?>
<div class="container" style="margin-top: 50px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
    <h3 style="margin-bottom: 30px;">Modificar amigo</h3>
    <form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
        <div class="card" style="width: 50rem; display: flex; flex-direction: row;">
            <div class="card-body" style="width: 250px; height: 250px;">
                <img src="public/img/<?php echo $amigo->get_amig_foto() ?>" alt="" style="width: 100%; height: 100%; border-radius: 50%;">
            </div>
            <div class="card-body" style="font-size: 14px;">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nom">Nombre</label>
                        <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $amigo->get_amig_nombre() ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="app">Apellido</label>
                        <input type="text" class="form-control" id="app" name="app" value="<?php echo $amigo->get_amig_appm() ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="ci">CI</label>
                        <input type="number" class="form-control" id="ci" name="ci" readonly value="<?php echo $amigo->get_amig_ci() ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="fnac">Fecha de nacimiento</label>
                        <input type="" class="form-control" id="fnac" name="fnac" value="<?php echo $amigo->get_amig_fnac() ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="tel">Telefono</label>
                        <input type="" class="form-control" id="tel" name="tel" value="<?php echo $amigo->get_amig_telf() ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="cel">Celular</label>
                        <input type="" class="form-control" id="cel" name="cel" value="<?php echo $amigo->get_amig_cel() ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="dir">Direccion</label>
                        <input name="dir" type="text" class="form-control" id="dir" value="<?php echo $amigo->get_amig_dir() ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <div class="custom-file mb-3">
                            <label for="foto">Select a file:</label>
                            <input type="file" id="foto" name="foto" accept="image/*">
                        </div>
                    </div>
                </div>
                <div style="text-align: end;">
                    <button type="submit" class="btn btn-primary" name="modificar">Confirmar</button>
                    <button type="reset" class="btn btn-danger">Limpiar</button>
                </div>
            </div>
        </div>
    </form>
</div>

<?php
include_once 'layout/footer.inc.php';
?>