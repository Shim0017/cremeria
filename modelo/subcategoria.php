<?php 
    
require_once 'conexion.php';

function agregar_subcategoria($nombre,$categoria){

    $conn = conexion();
    $estado; //Se usara para devolver dos valores, true y mensaje en json
    $sql = "INSERT INTO sub_categoria(nombre,categoria_idcategoria,eliminado) VALUES('$nombre',$categoria,0)";
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
	$estado['categoria_idcategoria'] = $categoria;
    return $estado;
}

function eliminar_subcategoria($idsubcategoria){

    $conn = conexion();
    $estado;
    //$sql = "DELETE FROM sub_categoria WHERE idsubcategoria=" . $idsubcategoria;
	$sql = "UPDATE sub_categoria SET eliminado= '1' WHERE idsubcategoria=" . $idsubcategoria;
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


function modificar_subcategoria($idsubcategoria, $nombre,$categoria_idcategoria){
    $conn = conexion();
    $estado; //Se usara para devolver dos valores, true y mensaje en json
    $sql = "UPDATE sub_categoria SET nombre= '$nombre', categoria_idcategoria= '$categoria_idcategoria' WHERE idsubcategoria=" . $idsubcategoria;
    
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
    $estado['id'] = $idsubcategoria;
    $estado['nombre'] = $nombre;
    $estado['categoria_idcategoria'] = $categoria_idcategoria;

    return $estado;
}
    
    
    


function ver_subcategoria(){
    
    $conn = conexion();
    $arrayTabla = array();
    $sql = "SELECT idsubcategoria, sub_categoria.nombre as sub,categoria.nombre as categoria FROM sub_categoria, categoria
    where sub_categoria.eliminado =0 and sub_categoria.categoria_idcategoria=categoria.idcategoria";
    $result = $conn -> query($sql);
    
    while ($row = mysqli_fetch_assoc($result)) {
        $arrayTabla[] = $row;
    }
    
    // cerramos la conexion
    $conn->close;
    
    return $arrayTabla;
}



function llenar_categoria_subcategoria(){
    
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
