(function ($) {

    // variables globales
    var table = $('#pedidos-tabla').DataTable({
        "order": [1, 'asc']
    }); //variable de la tabla

    // Definición de eventos
    document.getElementById("pedidos-button-agregar").addEventListener("click", agregar);
    document.getElementById("pedidos-button-agregar-activa").addEventListener("click", agregar_activo);
    $("#pedidos-tabla").on("click", ".eliminar", eliminar);
    $("#pedidos-tabla").on("click", ".modificar", modificar);


    //Cargamos por primera vez la tabla y combobox.
    ver();

    // Definición de funciones
    function agregar_activo(){
        
        //Cambiamos nombre del titulo
        document.getElementById("titulo-modal-agregar").innerHTML = "Agregar Pedido";
        
        //Vaciamos el formulario
        document.getElementById("pedidos-fecha").value = "";
        document.getElementById("pedidos-total").value = "";
        document.getElementById("pedidos-cliente").value = "";
        document.getElementById("pedidos-credito").value = "";

        //Ocultamos el boton de actualizar y dejamos visible agregar
        document.getElementById("pedidos-button-actualizar").style.display = "none";
        document.getElementById("pedidos-button-agregar").style.display = "";
    }

    function agregar(){

        jQuery.ajax({
            url: ajax.url,
            type: "post",
            dataType: "json",
            data: {
                action: "crud_pedidos",
                fecha: document.getElementById("pedidos-fecha").value,
                total: document.getElementById("pedidos-total").value,
                cliente: document.getElementById("pedidos-cliente").value,
                credito: document.getElementById("pedidos-credito").value,
                opcion: 1
            },
            success: function(response) {

                if(response.estado){
                   $("#pedidos-modal-agregar").modal("hide");
                   table.row.add(['<i class="modificar fa fa-pencil-square-o fa-lg mr-2" aria-hidden="true"></i><i class="eliminar fa fa-trash fa-lg" aria-hidden="true"></i>',response.idpedidos, response.fecha, response.total,response.cliente,response.credito]).draw();

                }

            }
        });
    }

    function eliminar(){

        //guardamos el objeto de seleccion
        var object = this;
        //se obtine la data de la fila seleccionada
        var data = table.row( $(this).parents('tr') ).data();
        //obtenemos el label
        var info_codigo = document.getElementById('info_codigo');
        var info_nombre = document.getElementById('info_nombre');

        info_codigo.innerHTML = data[1];
        info_nombre.innerHTML = data[2];

        $("#pedidos-modal-eliminar").modal('show');

        document.getElementById("pedidos-button-eliminar").addEventListener("click", function (){
            $("#pedidos-button-eliminar").unbind('click'); //evitamos que se corra 2 o mas el evento
            jQuery.ajax({
                url: ajax.url,
                type: "post",
                dataType: "json",
                data: {
                    action: "crud_pedidos",
                    idpedidos: data[1],
                    opcion: 2
                    },
                    success: function(response) {


                        if(response.estado){
                            $("#pedidos-modal-eliminar").modal('hide');
                                table.row( $(object).parents('tr') ).remove().draw();
                        }
                    }
            });
        });
    }

    function modificar(){

        //Cambiamos nombre del titulo
        document.getElementById("titulo-modal-agregar").innerHTML = "Actualizar Pedido";
               
       //Ocultamos el boton de agregar y dejamos visible actualizar
       document.getElementById("pedidos-button-actualizar").style.display = "";
       document.getElementById("pedidos-button-agregar").style.display = "none";

        //guardamos el objeto de seleccion
        var object = this;
               
        //se obtine la data de la fila seleccionada
        var data = table.row( $(this).parents('tr') ).data();

        //abrir el formulario
        $("#pedidos-modal-agregar").modal('show');

        //Cargando datos al formulario
        document.getElementById("pedidos-fecha").value = data[2];
        document.getElementById("pedidos-total").value = data[3];
        document.getElementById("pedidos-cliente").value = data[4];
        if(data[5] == 0){
            document.getElementById("pedidos-credito").value = 0;
        }else{
            document.getElementById("pedidos-credito").value = 1;
        }

        $("#pedidos-button-actualizar").on("click", function (){
            
            $("#pedidos-button-actualizar").unbind('click');
            jQuery.ajax({
                url: ajax.url,
                type: "post",
                dataType: "json",
                data: {
                    action: "crud_pedidos",
                    idpedidos: data[1],
                    fecha: document.getElementById("pedidos-fecha").value,
                    total: document.getElementById("pedidos-total").value,
                    cliente: document.getElementById("pedidos-cliente").value,
                    credito: document.getElementById("pedidos-credito").value,
                    opcion: 3
                },

                success: function(response) {
                    
                    if(response.estado){
                    $("#pedidos-modal-agregar").modal("hide");
                    table.row( $(object).parents('tr') ).remove().draw();
                    table.row.add(['<i class="modificar fa fa-pencil-square-o fa-lg mr-2" aria-hidden="true"></i><i class="eliminar fa fa-trash fa-lg" aria-hidden="true"></i>',response.idpedidos, response.fecha, response.total, response.cliente,response.credito]).draw();
                    }

                }
            });
        });
    }

    function ver(){

        jQuery.ajax({
            url: ajax.url,
            type: "post",
            dataType: "json",
            data: {
                action: "crud_pedidos",
                opcion: 4
                },
                success: function(response) {

                    console.log(response);
                    $.each(response , function(index, value){
                    table.row.add(['<i class="modificar fa fa-pencil-square-o fa-lg mr-2" aria-hidden="true"></i><i class="eliminar fa fa-trash fa-lg" aria-hidden="true"></i>',value.idpedidos, value.fecha_pedido, value.total, value.cliente_idcliente, value.credito_contado]).draw();
                    });
                }
        });
    }

})(jQuery);
