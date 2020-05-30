<?php
include_once 'app/Conexion.inc.php';
include_once 'app/RepositorioAmigo.inc.php';
Conexion::open_conexion();
$usuarios = RepositorioAmigo::get_all(Conexion::get_conexion());

$titulo = 'tecno';
include_once 'layout/header.inc.php';
include_once 'layout/navbar.inc.php';
?>

<div class="container" style="margin-top: 50px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
    <h3 style="margin-bottom: 30px;">Lista de amigos</h3>
    <table class="table table-bordered" style="font-size: 14px;">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Foto</th>
                <th scope="col">Nombres</th>
                <th scope="col">Apellidos</th>
                <th scope="col">Telefono</th>
                <th scope="col">Celular</th>
                <th scope="col">Direccion</th>
                <th scope="col">Fecha de nacimiento</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($usuarios as $user) {
                $tr = "<tr>";
                $tr .= "<th scope='row'>" . $user->get_amig_ci() . "</th>";
                $tr .= "<td> <img src='public/img/" . $user->get_amig_foto() . "' class='img-circle' alt='foto de perfil'></td>";
                $tr .= "<td>" . $user->get_amig_nombre() . "</td>";
                $tr .= "<td>" . $user->get_amig_appm() . "</td>";
                $tr .= "<td>" . $user->get_amig_telf() . "</td>";
                $tr .= "<td>" . $user->get_amig_cel() . "</td>";
                $tr .= "<td>" . $user->get_amig_dir() . "</td>";
                $tr .= "<td>" . $user->get_amig_fnac() . "</td>";
                $tr .= "<td> <a href='modificar.php?id=" . $user->get_amig_ci() . "' role=''> <button type='button' class='btn btn-primary'><small>Modificar</small></button></a>";
                $tr .= "<a href='modificar.php?id=" . $user->get_amig_ci() . "'><button type=type='button' class='btn btn-danger'><small>Eliminar</small></button></a></td>";
                $tr .= "<tr/>";
                echo $tr;
            }
            ?>
        </tbody>
    </table>
</div>

<?php
include_once 'layout/footer.inc.php';
?>