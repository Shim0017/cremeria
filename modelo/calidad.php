<?php 
    
require_once 'conexion.php';

function agregar_calidad($nombre){

    $conn = conexion();
    $estado; //Se usara para devolver dos valores, true y mensaje en json
    $sql = "INSERT INTO calidad(nombre,eliminado) VALUES('$nombre',0)";
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

function eliminar_calidad($idcalidad){

    $conn = conexion();
    $estado;
	//  $sql = "DELETE FROM calidad WHERE idcalidad=" . $idcalidad;
	$sql = "UPDATE calidad SET eliminado= '1' WHERE idcalidad=" . $idcalidad;
 
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


function modificar_calidad($idcalidad, $nombre){
    $conn = conexion();
    $estado; //Se usara para devolver dos valores, true y mensaje en json
    $sql = "UPDATE calidad SET nombre= '$nombre' WHERE idcalidad=" . $idcalidad;
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
    $estado['id'] = $idcalidad;
    $estado['nombre'] = $nombre;
    //$estado['costo'] = $costo;

    return $estado;
}
    
    
    


function ver_calidad(){
    
    $conn = conexion();
    $arrayTabla = array();
    $sql = "SELECT idcalidad, nombre FROM calidad where eliminado =0";
    $result = $conn -> query($sql);
    
    while ($row = mysqli_fetch_assoc($result)) {
        $arrayTabla[] = $row;
    }
    
    // cerramos la conexion
    $conn->close;
    
    return $arrayTabla;
}

?>
