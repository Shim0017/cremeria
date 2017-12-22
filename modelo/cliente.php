<?php 
    
require_once 'conexion.php';

function agregar_cliente($nombre, $direccion, $telefono, $tipocliente,$limitecredito){

    $conn = conexion();
    $estado; //Se usara para devolver dos valores, true y mensaje en json
    $sql = "INSERT INTO cliente(nombre,direccion,telefono,tipocliente,limite_credito,eliminado) VALUES('$nombre','$direccion',$telefono,'$tipocliente',$limitecredito,0)";
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
    $estado['idcliente'] = mysqli_insert_id($conn);
    $estado['nombre'] = $nombre;
    $estado['direccion'] = $direccion;
    $estado['telefono'] = $telefono;
    $estado['tipocliente'] = $tipocliente;
    $estado['limitecredito'] = $limitecredito;
    return $estado;
}

function eliminar_cliente($idcliente){

    $conn = conexion();
    $estado;
    $sql = "UPDATE cliente SET eliminado=1 WHERE idcliente=" . $idcliente;

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


function actualizar_cliente($idcliente, $nombre, $direccion, $telefono, $tipocliente, $limitecredito){

    $conn = conexion();
    $estado; //Se usara para devolver dos valores, true y mensaje en json
    $sql = "UPDATE cliente SET nombre='$nombre',direccion='$direccion',telefono=$telefono,tipocliente='$tipocliente',limite_credito=$limitecredito WHERE idcliente=" . $idcliente;
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
    $estado['idcliente'] = $idcliente;
    $estado['nombre'] = $nombre;
    $estado['direccion'] = $direccion;
    $estado['telefono'] = $telefono;
    $estado['tipocliente'] = $tipocliente;
    $estado['limitecredito'] = $limitecredito;
    return $estado;
    
}

function ver_cliente(){
    
    $conn = conexion();
    $arrayTabla = array();
    $sql = "SELECT idcliente,nombre,direccion,telefono,tipocliente,limite_credito FROM cliente WHERE eliminado=0";
    $result = $conn -> query($sql);
    
    while ($row = mysqli_fetch_assoc($result)) {
        $arrayTabla[] = $row;
    }
    
    // cerramos la conexion
    $conn->close;
    
    return $arrayTabla;
}

?>