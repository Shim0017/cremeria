(function ($) {

    // variables globales
    var table = $('#cliente-tabla').DataTable({
        "order": [1, 'asc']
    }); //variable de la tabla

    // Definición de eventos
    document.getElementById("cliente-button-agregar").addEventListener("click", agregar);
    document.getElementById("cliente-button-agregar-activa").addEventListener("click", agregar_activo);
    $("#cliente-tabla").on("click", ".eliminar", eliminar);
    $("#cliente-tabla").on("click", ".modificar", modificar);


    //Cargamos por primera vez la tabla y combobox.
    ver();

    // Definición de funciones
    function agregar_activo(){
        //Cambiamos nombre del titulo
        document.getElementById("titulo-modal-agregar").innerHTML = "Agregar Cliente";
        
        //Vaciamos el formulario
        document.getElementById("cliente-nombre").value = "";
        document.getElementById("cliente-direccion").value = "";
        document.getElementById("cliente-telefono").value = "";
        document.getElementById("cliente-limitecredito").value = "";
        document.getElementById("cliente-tipocliente").value = 0;

        //Ocultamos el boton de actualizar y dejamos visible agregar
        document.getElementById("cliente-button-actualizar").style.display = "none";
        document.getElementById("cliente-button-agregar").style.display = "";
    }

    function agregar(){

        jQuery.ajax({
            url: ajax.url,
            type: "post",
            dataType: "json",
            data: {
                action: "crud_cliente",
                nombre: document.getElementById("cliente-nombre").value,
                direccion: document.getElementById("cliente-direccion").value,
                telefono: document.getElementById("cliente-telefono").value,
                limitecredito: document.getElementById("cliente-limitecredito").value,
                tipocliente: document.getElementById("cliente-tipocliente").options[document.getElementById("cliente-tipocliente").selectedIndex].text,
                opcion: 1
            },
            success: function(response) {
                console.log("fasdfhgsg");
                if(response.estado){
                   $("#cliente-modal-agregar").modal("hide");
                   table.row.add(['<i class="modificar fa fa-pencil-square-o fa-lg mr-2" aria-hidden="true"></i><i class="eliminar fa fa-trash fa-lg" aria-hidden="true"></i>',response.idcliente, response.nombre, response.direccion,response.telefono,response.tipocliente,response.limitecredito]).draw();

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

        $("#cliente-modal-eliminar").modal('show');

        document.getElementById("cliente-button-eliminar").addEventListener("click", function (){
            $("#cliente-button-eliminar").unbind('click'); //evitamos que se corra 2 o mas el evento
            jQuery.ajax({
                url: ajax.url,
                type: "post",
                dataType: "json",
                data: {
                    action: "crud_cliente",
                    idcliente: data[1],
                    opcion: 2
                    },
                    success: function(response) {


                        if(response.estado){
                            $("#cliente-modal-eliminar").modal('hide');
                                table.row( $(object).parents('tr') ).remove().draw();
                        }
                    }
            });
        });
    }

    function modificar(){

        //Cambiamos nombre del titulo
        document.getElementById("titulo-modal-agregar").innerHTML = "Actualizar Cliente";
               
       //Ocultamos el boton de agregar y dejamos visible actualizar
       document.getElementById("cliente-button-actualizar").style.display = "";
       document.getElementById("cliente-button-agregar").style.display = "none";

        //guardamos el objeto de seleccion
        var object = this;
               
        //se obtine la data de la fila seleccionada
        var data = table.row( $(this).parents('tr') ).data();

        //abrir el formulario
        $("#cliente-modal-agregar").modal('show');

        //Cargando datos al formulario
        document.getElementById("cliente-nombre").value = data[2];
        document.getElementById("cliente-direccion").value = data[3];
        document.getElementById("cliente-telefono").value = data[4];

        if(data[5] == "Normal"){;
            document.getElementById("cliente-tipocliente").value = 0;
        }else{
            document.getElementById("cliente-tipocliente").value = 1;
        }
        
        document.getElementById("cliente-limitecredito").value = data[6];

        $("#cliente-button-actualizar").on("click", function (){
            
            $("#cliente-button-actualizar").unbind('click');
            jQuery.ajax({
                url: ajax.url,
                type: "post",
                dataType: "json",
                data: {
                    action: "crud_cliente",
                    idcliente: data[1],
                    nombre: document.getElementById("cliente-nombre").value,
                    direccion: document.getElementById("cliente-direccion").value,
                    telefono: document.getElementById("cliente-telefono").value,
                    tipocliente: document.getElementById("cliente-tipocliente").options[document.getElementById("cliente-tipocliente").selectedIndex].text,
                    limitecredito: document.getElementById("cliente-limitecredito").value,
                    opcion: 3
                },

                success: function(response) {

                    if(response.estado){
                    $("#cliente-modal-agregar").modal("hide");
                    table.row( $(object).parents('tr') ).remove().draw();
                    table.row.add(['<i class="modificar fa fa-pencil-square-o fa-lg mr-2" aria-hidden="true"></i><i class="eliminar fa fa-trash fa-lg" aria-hidden="true"></i>',response.idcliente, response.nombre, response.direccion, response.telefono,response.tipocliente,response.limitecredito]).draw();
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
                action: "crud_cliente",
                opcion: 4
                },
                success: function(response) {

                    var trHTML;

                    $.each(response , function(index, value){
                    table.row.add(['<i class="modificar fa fa-pencil-square-o fa-lg mr-2" aria-hidden="true"></i><i class="eliminar fa fa-trash fa-lg" aria-hidden="true"></i>',value.idcliente, value.nombre, value.direccion, value.telefono, value.tipocliente,value.limite_credito]).draw();
                    });
                }
        });
    }

})(jQuery);
