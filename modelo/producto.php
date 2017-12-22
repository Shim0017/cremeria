<?php 
    
require_once 'conexion.php';

function agregar_producto($nombre,$cantidad,$mayorista,$normal,$costo,$inferior,$superior,$minimo,$subcategoria,$ingrediente){

    $conn = conexion();
    $estado; //Se usara para devolver dos valores, true y mensaje en json
    $sql = "INSERT INTO producto(nombre,cantidad, precio_mayorista, precio_normal, costo_real, rango_superior, rango_inferior, cantidad_minima,subcategoria_idsubcategoria,ingrediente_idingrediente,eliminado) 
    VALUES('$nombre',$cantidad,$mayorista,$normal,$costo,$superior,$inferior,$minimo,$subcategoria,$ingrediente,0)";
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
    $estado['cantidad'] = $cantidad;
    $estado['mayorista'] = $mayorista;
    $estado['normal'] = $normal;
    $estado['costo'] = $costo;
    $estado['inferior'] = $inferior;
    $estado['superior'] = $superior;
    $estado['minimo'] = $minimo;
	$estado['subcategoria'] = $subcategoria;
	$estado['ingrediente_idingrediente'] = $ingrediente;
    return $estado;
}

function eliminar_producto($idproducto){

    $conn = conexion();
    $estado;
    $sql = "UPDATE producto SET eliminado='1'  WHERE idproducto=" . $idproducto;

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


function modificar_producto($idproducto, $nombre,$cantidad,$mayorista,$normal,$costo,$inferior,$superior,$minimo,$subcategoria,$ingrediente){
    $conn = conexion();
    $estado; //Se usara para devolver dos valores, true y mensaje en json
    $sql = "UPDATE producto SET nombre= '$nombre', cantidad='$cantidad', precio_mayorista='$mayorista', precio_normal='$normal', costo_real='$costo', rango_superior='$superior', rango_inferior='$inferior', 
    cantidad_minima='$minimo',subcategoria_idsubcategoria='$subcategoria',ingrediente_idingrediente='$ingrediente' WHERE idproducto=" . $idproducto;
    
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
    $estado['id'] = $idproducto;
    $estado['nombre'] = $nombre;
    $estado['cantidad'] = $cantidad;
    $estado['mayorista'] = $mayorista;
    $estado['normal'] = $normal;
    $estado['costo'] = $costo;
    $estado['inferior'] = $inferior;
    $estado['superior'] = $superior;
    $estado['minimo'] = $minimo;
	$estado['subcategoria'] = $subcategoria;
	$estado['ingrediente_idingrediente'] = $ingrediente;

    return $estado;
}
    
    
    


function ver_producto(){
    
    $conn = conexion();
    $arrayTabla = array();
    $sql = "SELECT idproducto, producto.nombre as nombre, producto.cantidad, producto.precio_mayorista as mayorista, producto.precio_normal as normal,
	producto.costo_real as costo, producto.rango_superior as superior, producto.rango_inferior as inferior, producto.cantidad_minima as minimo,
	sub_categoria.nombre as sub,ingrediente.nombre as ingrediente  
    FROM sub_categoria, producto, ingrediente 
    where producto.subcategoria_idsubcategoria=sub_categoria.idsubcategoria 
    and producto.ingrediente_idingrediente= ingrediente.idingrediente and producto.eliminado=0";
    $result = $conn -> query($sql);
    
    while ($row = mysqli_fetch_assoc($result)) {
        $arrayTabla[] = $row;
    }
    
    // cerramos la conexion
    $conn->close;
    
    return $arrayTabla;
}



function llenar_categoria_subcategoria_producto(){
    
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

function llenar_subcategoria_producto($categoria){
    
    $conn = conexion();
    $arrayTabla = array();
    $sql = "SELECT idsubcategoria, nombre FROM sub_categoria where eliminado =0 and categoria_idcategoria=" . $categoria;
    $result = $conn -> query($sql);
    
    while ($row = mysqli_fetch_assoc($result)) {
        $arrayTabla[] = $row;
    }
    
    // cerramos la conexion
    $conn->close;
    
    return $arrayTabla;
}


function llenar_ingrediente_producto(){
    
    $conn = conexion();
    $arrayTabla = array();
    $sql = "SELECT idingrediente, nombre FROM ingrediente where eliminado =0";
    $result = $conn -> query($sql);
    
    while ($row = mysqli_fetch_assoc($result)) {
        $arrayTabla[] = $row;
    }
    
    // cerramos la conexion
    $conn->close;
    
    return $arrayTabla;
}

?>
