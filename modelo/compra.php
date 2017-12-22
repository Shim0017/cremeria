<?php 
    
require_once 'conexion.php';

function agregar_compra($cantidad,$costo,$fecha,$observacion,$existente,$finca){

    $conn = conexion();
    $estado; //Se usara para devolver dos valores, true y mensaje en json
    $sql = "INSERT INTO compra(cantidad, costo, fecha_recibido, observacion, finca_idfinca,cantidad_existente,eliminado) 
    VALUES('$cantidad','$costo','$fecha','$observacion',$finca,'$existente',0)";
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
    $estado['cantidad'] = $cantidad;
    $estado['costo'] = $costo;
    $estado['fecha_recibido'] = $fecha;
    $estado['observacion'] = $observacion;
    $estado['cantidad_existente'] = $existente;
	$estado['finca_idfinca'] = $finca;
    return $estado;
}

function eliminar_compra($idcompra){

    $conn = conexion();
    $estado;
    $sql = "UPDATE compra SET eliminado='1'  WHERE idcompra=" . $idcompra;

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


function modificar_compra($idcompra, $cantidad,$costo,$fecha,$observacion,$existente,$finca){
    $conn = conexion();
    $estado; //Se usara para devolver dos valores, true y mensaje en json
    $sql = "UPDATE compra SET cantidad='$cantidad', costo='$costo', fecha_recibido='$fecha', observacion='$observacion', 
    cantidad_existente='$existente',finca_idfinca='$finca' WHERE idcompra=" . $idcompra;
    
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
    $estado['id'] = $idcompra;
    $estado['cantidad'] = $cantidad;
    $estado['costo'] = $costo;
    $estado['fecha_recibido'] = $fecha;
    $estado['observacion'] = $observacion;
    $estado['cantidad_existente'] = $existente;
	$estado['finca_idfinca'] = $finca;

    return $estado;
}
    
function ver_compra(){
    
    $conn = conexion();
    $arrayTabla = array();
    $sql = "select compra.idcompra, compra.cantidad, compra.costo, compra.fecha_recibido,compra.observacion,compra.cantidad_existente,finca.nombre from compra,finca 
    where finca.idfinca=compra.finca_idfinca and compra.eliminado=0";
    $result = $conn -> query($sql);
    
    while ($row = mysqli_fetch_assoc($result)) {
        $arrayTabla[] = $row;
    }
    
    // cerramos la conexion
    $conn->close;
    
    return $arrayTabla;
}

function llenar_ruta_finca_compra(){
    
    $conn = conexion();
    $arrayTabla = array();
    $sql = "SELECT idruta, nombre FROM ruta where eliminado=0";
    $result = $conn -> query($sql);
    
    while ($row = mysqli_fetch_assoc($result)) {
        $arrayTabla[] = $row;
    }
    
    // cerramos la conexion
    $conn->close;
    
    return $arrayTabla;
}

function llenar_finca_compra($ruta){
    
    $conn = conexion();
    $arrayTabla = array();
    $sql = "SELECT idfinca, nombre FROM finca where eliminado=0 and ruta_idruta=" . $ruta;
    $result = $conn -> query($sql);
    
    while ($row = mysqli_fetch_assoc($result)) {
        $arrayTabla[] = $row;
    }
    
    // cerramos la conexion
    $conn->close;
    
    return $arrayTabla;
}

function insertar_detalle_calidad($idcalidad,$idcompra,$porcentaje){

    $conn = conexion();
    $estado; //Se usara para devolver dos valores, true y mensaje en json
    $sql = "INSERT INTO detalle_calidad(calidad_idcalidad,compra_idcompra,porcentaje) 
    VALUES($idcalidad,$idcompra,'$porcentaje')";
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
    return $estado;
}

function ver_detalle_calidad($idcompra){

    $conn = conexion();
    $arrayTabla = array();
    $sql = "SELECT calidad.nombre, detalle_calidad.porcentaje FROM calidad, detalle_calidad, compra WHERE compra.idcompra=$idcompra AND calidad.idcalidad=detalle_calidad.calidad_idcalidad AND
    compra.idcompra=detalle_calidad.compra_idcompra";
    $result = $conn -> query($sql);
    
    while ($row = mysqli_fetch_assoc($result)) {
        $arrayTabla[] = $row;
    }
    
    // cerramos la conexion
    $conn->close;
    
    return $arrayTabla;

}



?>
