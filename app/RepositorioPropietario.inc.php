<?php
include_once 'Propietario.inc.php';

class RepositorioPropietario
{
    public static function get_all($conexion)
    {
        $propietarios = array();
        if (isset($conexion)) {
            try {
                include_once "Propietario.inc.php";
                $sql = "SELECT * FROM propietario";
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();
                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $propietarios[] = new Propietario(
                            $fila['user'],
                            $fila['pass'],
                            $fila['amig_ci']
                        );
                    }
                } else {
                    print "No hay resultados";
                }
            } catch (PDOException $ex) {
                print "EROOR: " . $ex->getMessage();
            }
        }
        return $propietarios;
    }

    public static function count_users($conexion)
    {
        $total_users = null;
        if (isset($conexion)) {
            try {
                $sql = "SELECT COUNT(*) as total FROM propietario";
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetch();

                $total_users = $resultado['total'];
            } catch (PDOException $ex) {
                print "EROOR: " . $ex->getMessage();
            }
        }
        return $total_users;
    }

    public static function insertar_usuario($conexion, $usuario)
    {
        $usuario_insertado = false;
        if (isset($conexion)) {
            try {
                $sql = "INSERT INTO usuarios(nombre, email, pass, fecha_registro, activo) VALUES (:nombre, :email, :pass, NOW(), 0 ) ";
                $sentencia = $conexion->prepare($sql);
                $nombre = $usuario->get_nombre();
                $email = $usuario->get_email();
                $pass = $usuario->get_password();
                $sentencia->bindParam(':nombre', $nombre, PDO::PARAM_STR);
                $sentencia->bindParam(':email', $email, PDO::PARAM_STR);
                $sentencia->bindParam(':pass', $pass, PDO::PARAM_STR);

                $usuario_insertado = $sentencia->execute();
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return $usuario_insertado;
    }

    public static function nombre_existe($conexion, $nombre)
    {
        $nombre_existe = true;
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM usuarios WHERE nombre = :nombre";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':nombre', $nombre, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();
                if (count($resultado)) {
                    $nombre_existe = true;
                } else {
                    $nombre_existe = false;
                }
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return $nombre_existe;
    }
    public static function email_existe($conexion, $email)
    {
        $email_existe = true;
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM usuarios WHERE email = :email";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':email', $email, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();
                if (count($resultado)) {
                    $email_existe = true;
                } else {
                    $email_existe = false;
                }
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return $email_existe;
    }

    public static function get_usuario($conexion, $user, $pass)
    {
        $propietario = null;
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM propietario WHERE prop_user = :user AND prop_passwd = :pass" ;
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':user', $user, PDO::PARAM_STR);
                $sentencia->bindParam(':pass', $pass, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetch();
                if (!empty($resultado)) {
                    $propietario = new Propietario(
                        $resultado['prop_user'],
                        $resultado['prop_pass'],
                        $resultado['amig_ci']
                    );
                }
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return $propietario;
    }
}
