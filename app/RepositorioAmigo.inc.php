<?php

include_once 'config.inc.php';
include_once 'Conexion.inc.php';
include_once 'Amigo.inc.php';

class RepositorioAmigo
{
    public static function insetar_amigo($conexion, $amigo)
    {
        $comentario_insertado = false;
        if (isset($conexion)) {
            try {
                $sql = "INSERT INTO amigo(amig_ci, amig_nombre, amig_appm, amig_telf, amig_cel, amig_dir, amig_fnac) VALUES (:amig_ci, :amig_nombre, :amig_appm, :amig_telf, :amig_cel, :amig_dir, amig_fnac ) ";
                $sentencia = $conexion->prepare($sql);
                $amig_ci = $amigo->get_amig_ci();
                $amig_nombre = $amigo->get_amig_nombre();
                $amig_appm = $amigo->get_amig_appm();
                $amig_telf = $amigo->get_amig_telf();
                $amig_cel = $amigo->get_amig_cel();
                $amig_dir = $amigo->get_amig_dir();
                $amig_fnac = $amigo->get_amig_fnac();

                $sentencia->bindParam(':amig_ci', $amig_ci, PDO::PARAM_STR);
                $sentencia->bindParam(':amig_nombre', $amig_nombre, PDO::PARAM_STR);
                $sentencia->bindParam(':amig_appm', $amig_appm, PDO::PARAM_STR);
                $sentencia->bindParam(':amig_telf', $amig_telf, PDO::PARAM_STR);
                $sentencia->bindParam(':amig_cel', $amig_cel, PDO::PARAM_STR);
                $sentencia->bindParam(':amig_dir', $amig_dir, PDO::PARAM_STR);
                $sentencia->bindParam(':amig_fnac', $amig_fnac, PDO::PARAM_STR);

                $amigo_insertado = $sentencia->execute();
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return $amigo_insertado;
    }
    public static function get_all($conexion)
    {
        $amigos = array();
        if (isset($conexion)) {
            try {
                include_once "Amigo.inc.php";
                $sql = "SELECT * FROM amigo";
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();
                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $amigos[] = new Amigo(
                            $fila['amig_ci'],
                            $fila['amig_nombre'],
                            $fila['amig_appm'],
                            $fila['amig_telf'],
                            $fila['amig_cel'],
                            $fila['amig_dir'],
                            $fila['amig_fnac'],
                            $fila['amig_foto']
                        );
                    }
                } else {
                    print "No hay resultados";
                }
            } catch (PDOException $ex) {
                print "EROOR: " . $ex->getMessage();
            }
        }
        return $amigos;
    }
    public static function get_amigo($conexion, $ci)
    {
        $amigo = null;
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM amigo WHERE amig_ci = :ci";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':ci', $ci, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetch();
                if (!empty($resultado)) {
                    $amigo = new Amigo(
                        $resultado['amig_ci'],
                        $resultado['amig_nombre'],
                        $resultado['amig_appm'],
                        $resultado['amig_telf'],
                        $resultado['amig_cel'],
                        $resultado['amig_dir'],
                        $resultado['amig_fnac'],
                        $resultado['amig_foto']
                    );
                }
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return $amigo;
    }
    public static function update_amigo($conexion, $ci, $nombre, $apellido, $tel, $cel, $dir, $fnac)
    {
        $amigo = null;
        if (isset($conexion)) {
            try {
                $sql = "UPDATE amigo SET amig_nombre=:amig_nombre, amig_appm=:amig_appm, amig_telf=:amig_telf, amig_cel=:amig_cel, amig_dir=:amig_dir, amig_fnac=:amig_fnac WHERE amig_ci=:ci";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':ci', $ci, PDO::PARAM_STR);
                $sentencia->bindParam(':amig_nombre', $nombre, PDO::PARAM_STR);
                $sentencia->bindParam(':amig_appm', $apellido, PDO::PARAM_STR);
                $sentencia->bindParam(':amig_telf', $tel, PDO::PARAM_STR);
                $sentencia->bindParam(':amig_cel', $cel, PDO::PARAM_STR);
                $sentencia->bindParam(':amig_dir', $dir, PDO::PARAM_STR);
                $sentencia->bindParam(':amig_fnac', $fnac, PDO::PARAM_STR);

                $resultado = $sentencia->execute();
                if (!empty($resultado)) {
                    $amigo = new Amigo(
                        $resultado['amig_ci'],
                        $resultado['amig_nombre'],
                        $resultado['amig_appm'],
                        $resultado['amig_telf'],
                        $resultado['amig_cel'],
                        $resultado['amig_dir'],
                        $resultado['amig_fnac']
                    );
                }
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        return $amigo;
    }
    public static function update_foto($conexion, $ci, $foto)
    {
        $amigo = null;
        if (isset($conexion)) {
            try {
                $sql = "UPDATE amigo SET amig_foto=:amig_foto WHERE amig_ci=:ci";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':ci', $ci, PDO::PARAM_STR);
                $sentencia->bindParam(':amig_foto', $foto, PDO::PARAM_STR);

                $resultado = $sentencia->execute();
                // if (!empty($resultado)) {
                //     $amigo = new Amigo(
                //         $resultado['amig_ci'],
                //         $resultado['amig_nombre'],
                //         $resultado['amig_appm'],
                //         $resultado['amig_telf'],
                //         $resultado['amig_cel'],
                //         $resultado['amig_dir'],
                //         $resultado['amig_fnac'],
                //         $resultado['amig_foto']
                //     );
                // }
            } catch (PDOException $ex) {
                print 'ERROR: ' . $ex->getMessage();
            }
        }
        // return $amigo;
    }
}
