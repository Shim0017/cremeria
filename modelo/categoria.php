<?php 
    
require_once 'conexion.php';

function agregar_categoria($nombre){

    $conn = conexion();
    $estado; //Se usara para devolver dos valores, true y mensaje en json
    $sql = "INSERT INTO categoria(nombre,eliminado) VALUES('$nombre',0)";
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
    $estado['id'] = mysqli_insert_id($conn);
    $estado['nombre'] = $nombre;
   // $estado['costo'] = $costo;
    return $estado;
}

function eliminar_categoria($idcategoria){

    $conn = conexion();
    $estado;
	//  $sql = "DELETE FROM categoria WHERE idcategoria=" . $idcategoria;
	$sql = "UPDATE categoria SET eliminado= '1' WHERE idcategoria=" . $idcategoria;
 
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


function modificar_categoria($idcategoria, $nombre){
    $conn = conexion();
    $estado; //Se usara para devolver dos valores, true y mensaje en json
    $sql = "UPDATE categoria SET nombre= '$nombre' WHERE idcategoria=" . $idcategoria;
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
    $estado['mensaje'] = "Dato modificado.";
    $estado['id'] = $idcategoria;
    $estado['nombre'] = $nombre;
    //$estado['costo'] = $costo;

    return $estado;
}
    
    
    


function ver_categoria(){
    
    $conn = conexion();
    $arrayTabla = array();
    $sql = "SELECT idcategoria, nombre FROM categoria where eliminado =0";
    $result = $conn -> query($sql);
    
    while ($row = mysqli_fetch_assoc($result)) {
        $arrayTabla[] = $row;
    }
    
    // cerramos la conexion
    $conn->close;
    
    return $arrayTabla;
}

?>
