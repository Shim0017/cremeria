<?php

require_once 'conexion.php';

function agregar_ruta($nombre, $descripcion){

    $conn = conexion();
    $estado; //Se usara para devolver dos valores, true y mensaje en json
    $sql = "INSERT INTO ruta(nombre,descripcion,eliminado) VALUES('$nombre','$descripcion',0)";
    $result = $conn->query($sql);

    //capturamos el error
    if(!$result){
        $estado['estado'] = false;
        $estado['mensaje'] = $conn->error;
        return $estado;
    }

    // cerramos la conexion
    $conn->close;

    $estado['estado'] = true;
    $estado['mensaje'] = "Dato insertado.";
    $estado['idruta'] = mysqli_insert_id($conn);
    $estado['nombre'] = $nombre;
    $estado['descripcion'] = $descripcion;
    return $estado;
}

function eliminar_ruta($idruta){

    $conn = conexion();
    $estado;
    $sql = "UPDATE ruta SET eliminado=1 WHERE idruta=" . $idruta;
    $result = $conn->query($sql);

    //capturamos el error
     if(!$result){
        $estado['estado'] = false;
        $estado['mensaje'] = $conn->error;
        return $estado;
     }

    // cerramos la conexion
    $conn->close;

    $estado['estado'] = true;
    $estado['mensaje'] = "Dato eliminado.";
    return $estado;
}


function actualizar_ruta($idruta, $nombre, $descripcion){

    $conn = conexion();
    $arrayTabla = array();
    $sql = "UPDATE ruta SET nombre='$nombre', descripcion='$descripcion' WHERE idruta=" . $idruta;
    $result = $conn -> query($sql);

    //capturamos el error
    if(!$result){
        $estado['estado'] = false;
        $estado['mensaje'] = $conn->error;
        return $estado;
     }

    // cerramos la conexion
    $conn->close;

    $estado['estado'] = true;
    $estado['mensaje'] = "Dato eliminado.";
    $estado['idruta'] = $idruta;
    $estado['nombre'] = $nombre;
    $estado['descripcion'] = $descripcion;
    return $estado;

}

function ver_ruta(){

    $conn = conexion();
    $arrayTabla = array();
    $sql = "SELECT idruta, nombre, descripcion FROM ruta WHERE eliminado=0";
    $result = $conn -> query($sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $arrayTabla[] = $row;
    }

    // cerramos la conexion
    $conn->close;

    return $arrayTabla;
}

function buscar_ruta($idruta){

    $conn = conexion();
    $arrayTabla = array();
    $sql = "SELECT idruta, nombre, descripcion FROM ruta WHERE idruta =" . $idruta . " AND eliminado=0";
    $result = $conn -> query($sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $arrayTabla[] = $row;
    }

    // cerramos la conexion
    $conn->close;

    return $arrayTabla;
}

?>
