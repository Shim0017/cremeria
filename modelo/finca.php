<?php 
    
require_once 'conexion.php';

function agregar_finca($nombre, $encargado, $direccion, $distancia, $telefono, $hora, $ruta){

    $conn = conexion();
    $estado; //Se usara para devolver dos valores, true y mensaje en json
    $sql = "INSERT INTO finca(nombre,encargado,direccion,distancia,telefono,hora_entrega,ruta_idruta,eliminado) VALUES('$nombre','$encargado','$direccion','$distancia','$telefono','$hora',$ruta,0)";
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
    $estado['idfinca'] = mysqli_insert_id($conn);
    $estado['nombre'] = $nombre;
    $estado['encargado'] = $encargado;
    $estado['direccion'] = $direccion;
    $estado['distancia'] = $distancia;
    $estado['telefono'] = $telefono;
    $estado['hora'] = $hora;
    return $estado;
}

function eliminar_finca($idfinca){

    $conn = conexion();
    $estado;
    $sql = "UPDATE finca SET eliminado=1 WHERE idfinca=" . $idfinca;

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


function actualizar_finca($idfinca, $nombre, $encargado, $direccion, $distancia, $telefono, $hora, $ruta){

    $conn = conexion();
    $estado; //Se usara para devolver dos valores, true y mensaje en json
    $sql = "UPDATE finca SET nombre='$nombre',encargado='$encargado',direccion='$direccion',distancia='$distancia',telefono='$telefono',hora_entrega='$hora',ruta_idruta=$ruta WHERE idfinca=$idfinca";
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
    $estado['idfinca'] = $idfinca;
    $estado['nombre'] = $nombre;
    $estado['encargado'] = $encargado;
    $estado['direccion'] = $direccion;
    $estado['distancia'] = $distancia;
    $estado['telefono'] = $telefono;
    $estado['hora'] = $hora;
    return $estado;
    
}

function ver_finca(){
    
    $conn = conexion();
    $arrayTabla = array();
    $sql = "SELECT f.idfinca,f.nombre AS nombre_finca,f.encargado,f.direccion,f.distancia,f.hora_entrega,f.telefono,r.idruta,r.nombre AS nombre_ruta FROM finca AS f INNER JOIN ruta AS r ON f.ruta_idruta=r.idruta WHERE f.eliminado=0";
    $result = $conn -> query($sql);
    
    while ($row = mysqli_fetch_assoc($result)) {
        $arrayTabla[] = $row;
    }
    
    // cerramos la conexion
    $conn->close;
    
    return $arrayTabla;
}

function llenar_ruta_finca(){
    
    $conn = conexion();
    $arrayTabla = array();
    $sql = "SELECT idruta, nombre FROM ruta WHERE eliminado=0";
    $result = $conn -> query($sql);
    
    while ($row = mysqli_fetch_assoc($result)) {
        $arrayTabla[] = $row;
    }
    
    // cerramos la conexion
    $conn->close;
    
    return $arrayTabla;
}

?>