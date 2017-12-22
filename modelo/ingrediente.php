<?php 
    
require_once 'conexion.php';

function agregar_ingrediente($nombre, $costo){

    $conn = conexion();
    $estado; //Se usara para devolver dos valores, true y mensaje en json
    $sql = "INSERT INTO ingrediente(nombre,costo,eliminado) VALUES('$nombre','$costo',0)";
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
    $estado['costo'] = $costo;
    return $estado;
}

function eliminar_ingrediente($idingrediente){

    $conn = conexion();
    $estado;
	//  $sql = "DELETE FROM ingrediente WHERE idingrediente=" . $idingrediente;
	$sql = "UPDATE ingrediente SET eliminado= '1' WHERE idingrediente=" . $idingrediente;
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


function modificar_ingrediente($idingrediente, $nombre, $costo){
    $conn = conexion();
    $estado; //Se usara para devolver dos valores, true y mensaje en json
    $sql = "UPDATE ingrediente SET nombre= '$nombre', costo= '$costo' WHERE idingrediente=" . $idingrediente;
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
    $estado['id'] = $idingrediente;
    $estado['nombre'] = $nombre;
    $estado['costo'] = $costo;

    return $estado;
}
    
 

function ver_ingrediente(){
    
    $conn = conexion();
    $arrayTabla = array();
    $sql = "SELECT idingrediente, nombre, costo FROM ingrediente where eliminado =0";
    $result = $conn -> query($sql);
    
    while ($row = mysqli_fetch_assoc($result)) {
        $arrayTabla[] = $row;
    }
    
    // cerramos la conexion
    $conn->close;
    
    return $arrayTabla;
}

?>
