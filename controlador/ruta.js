(function ($) {

    // variables globales
    var table = $('#ruta-tabla').DataTable({
        "order": [1, 'asc']
    }); //variable de la tabla


    // evento
    document.getElementById("ruta-button-agregar").addEventListener("click", agregar);
    document.getElementById("ruta-button-agregar-activa").addEventListener("click", agregar_activo);
    $("#ruta-tabla").on("click", ".eliminar", eliminar);
    $("#ruta-tabla").on("click", ".modificar", actualizar);

    document.getElementById("ruta-button-agregar").addEventListener("click", agregar);

    //Cargamos por primera vez la tabla.
    ver();

    // Definición de funciones
    function agregar_activo(){

        //Cambiamos nombre del titulo
        document.getElementById("titulo-modal-agregar").innerHTML = "Agregar Ruta";

        //Vaciamos el formulario
        document.getElementById("ruta-nombre").value = "";
        document.getElementById("ruta-descripcion").value = "";

        //Ocultamos el boton de actualizar y dejamos visible agregar
        document.getElementById("ruta-button-actualizar").style.display = "none";
        document.getElementById("ruta-button-agregar").style.display = "";
    }

    function agregar(){
        
        jQuery.ajax({
            url: ajax.url,
            type: "post",
            dataType: "json",
            data: {
                action: "crud_ruta",
                nombre: document.getElementById("ruta-nombre").value,
                descripcion: document.getElementById("ruta-descripcion").value,
                opcion: 1
                },
                success: function(response) {

                    if(response.estado){
                        $("#ruta-modal-agregar").modal("hide");
                        table.row.add(['<i class="modificar fa fa-pencil-square-o fa-lg mr-2" aria-hidden="true"></i><i class="eliminar fa fa-trash fa-lg" aria-hidden="true"></i>',response.idruta, response.nombre, response.descripcion]).draw();
                    }
        
             }
        });
    }

    function eliminar(){
        
        //guardamos el objeto de seleccion
        var object = this;
        //se obtine la data de la fila seleccionada
        var data = table.row( $(this).parents('tr') ).data();
        //obtenemos los labes y lo guardamos
        document.getElementById('info_codigo').innerHTML = data[1];
        document.getElementById('info_nombre').innerHTML = data[2];

        $("#ruta-modal-eliminar").modal('show');
        
        document.getElementById("ruta-button-eliminar").addEventListener("click", function (){
            $("#ruta-button-eliminar").unbind('click'); //evitamos que se corra 2 o mas el evento
            jQuery.ajax({
                url: ajax.url,
                type: "post",
                dataType: "json",
                data: {
                    action: "crud_ruta",
                    idruta: data[1],
                    opcion: 2
                    },
                    success: function(response) {
                        if(response.estado){
                            $("#ruta-modal-eliminar").modal('hide');
                                table.row( $(object).parents('tr') ).remove().draw();
                                console.log(response.mensaje);
                        }
                    }
            });
        });
    }

    function actualizar(){

        //Cambiamos nombre del titulo
        document.getElementById("titulo-modal-agregar").innerHTML = "Actualizar Ruta";
                
        //Ocultamos el boton de agregar y dejamos visible actualizar
        document.getElementById("ruta-button-actualizar").style.display = "";
        document.getElementById("ruta-button-agregar").style.display = "none";

        //guardamos el objeto de seleccion
        var object = this;

        //se obtine la data de la fila seleccionada
        var data = table.row( $(this).parents('tr') ).data();

        //Agregamos valor al formulario
        document.getElementById("ruta-nombre").value = data[2];
        document.getElementById("ruta-descripcion").value = data[3];


        $("#ruta-modal-agregar").modal('show');

        $("#ruta-button-actualizar").on("click", function (){
        
            $("#ruta-button-actualizar").unbind('click');
            jQuery.ajax({
                url: ajax.url,
                type: "post",
                dataType: "json",
                data: {
                    action: "crud_ruta",
                    idruta: data[1],
                    nombre: document.getElementById("ruta-nombre").value,
                    descripcion: document.getElementById("ruta-descripcion").value,
                    opcion: 3
                    },
                    success: function(response) {
                        
                        if(response.estado){
                            $("#ruta-modal-agregar").modal('hide');
                        table.row( $(object).parents('tr') ).remove().draw();
                        table.row.add(['<i class="modificar fa fa-pencil-square-o fa-lg mr-2" aria-hidden="true"></i><i class="eliminar fa fa-trash fa-lg" aria-hidden="true"></i>',response.idruta, response.nombre, response.descripcion]).draw(); 
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
                action: "crud_ruta",
                opcion: 4
                },
                success: function(response) {
                        
                    var trHTML;
                        
                    $.each(response , function(index, value){
                    table.row.add(['<i class="modificar fa fa-pencil-square-o fa-lg mr-2" aria-hidden="true"></i><i class="eliminar fa fa-trash fa-lg" aria-hidden="true"></i>',value.idruta, value.nombre, value.descripcion]).draw();
                    });
                }
        });
    }

})(jQuery);