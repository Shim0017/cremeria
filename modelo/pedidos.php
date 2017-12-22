<?php 
    
require_once 'conexion.php';

function agregar_pedidos($fecha, $total, $cliente, $credito){

    $conn = conexion();
    $estado; //Se usara para devolver dos valores, true y mensaje en json
    $sql = "INSERT INTO pedidos(fecha_pedido,total,cliente_idcliente,credito_contado,eliminado) VALUES('$fecha',$total,$cliente,$credito,0)";
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
    $estado['idpedidos'] = mysqli_insert_id($conn);
    $estado['fecha'] = $fecha;
    $estado['total'] = $total;
    $estado['cliente'] = $cliente;
    $estado['credito'] = $credito;
    return $estado;
}

function eliminar_pedidos($idpedidos){

    $conn = conexion();
    $estado;
    $sql = "UPDATE pedidos SET eliminado=1 WHERE idpedidos=" . $idpedidos;

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


function actualizar_pedidos($idpedidos, $fecha, $total, $cliente, $credito){

    $conn = conexion();
    $estado; //Se usara para devolver dos valores, true y mensaje en json
    $sql = "UPDATE pedidos SET fecha_pedido='$fecha',total=$total,cliente_idcliente=$cliente,credito_contado=$credito WHERE idpedidos=" . $idpedidos;
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
    $estado['idpedidos'] = $idpedidos;
    $estado['fecha'] = $fecha;
    $estado['total'] = $total;
    $estado['cliente'] = $cliente;
    $estado['credito'] = $credito;
    return $estado;
    
}

function ver_pedidos(){
    
    $conn = conexion();
    $arrayTabla = array();
    $sql = "SELECT pedidos.idpedidos,  pedidos.fecha_pedido, pedidos.total,cliente.nombre as cliente_idcliente, pedidos.credito_contado FROM pedidos,cliente WHERE pedidos.cliente_idcliente= cliente.idcliente and pedidos.eliminado=0";
    $result = $conn -> query($sql);
    
    while ($row = mysqli_fetch_assoc($result)) {
        $arrayTabla[] = $row;
    }
    
    // cerramos la conexion
    $conn->close;
    
    return $arrayTabla;
}

?>