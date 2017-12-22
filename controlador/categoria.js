(function ($) {

    // variables globales
    var table = $('#categoria-tabla').DataTable({
        "order": [1, 'asc']
    }); //variable de la tabla

    // evento
    document.getElementById("categoria-button-agregar").addEventListener("click", agregar);
    document.getElementById("categoria-button-agregar-activa").addEventListener("click", agregar_activo);
    $("#categoria-tabla").on("click", ".eliminar", eliminar);
    $("#categoria-tabla").on("click", ".modificar", actualizar);

    //Cargamos por primera vez la tabla.
    ver();

    // Definición de funciones
    function agregar_activo(){

        //Cambiamos nombre del titulo
        document.getElementById("titulo-modal-agregar").innerHTML = "Agregar categoria";

        //Vaciamos el formulario
        document.getElementById("categoria-nombre").value = "";


        //Ocultamos el boton de actualizar y dejamos visible agregar
        document.getElementById("categoria-button-actualizar").style.display = "none";
        document.getElementById("categoria-button-agregar").style.display = "";
    }

    function agregar(){
        
        var nombre = document.getElementById("categoria-nombre");
        
        jQuery.ajax({
            url: ajax.url,
            type: "post",
            dataType: "json",
            data: {
                action: "crud_categoria",
                nombre: nombre.value,
                opcion: 1
                },
                success: function(response) {

                    if(response.estado){
                        //console.log(response);
                        $("#categoria-modal-agregar").modal("hide");
                        table.row.add(['<i class="modificar fa fa-pencil-square-o fa-lg mr-2" aria-hidden="true"></i><i class="eliminar fa fa-trash fa-lg" aria-hidden="true"></i>',response.id, response.nombre]).draw();
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

        $("#categoria-modal-eliminar").modal('show');

        document.getElementById("categoria-button-eliminar").addEventListener("click", function (){
            jQuery.ajax({
                url: ajax.url,
                type: "post",
                dataType: "json",
                data: {
                    action: "crud_categoria",
                    idcategoria: data[1],
                    opcion: 2
                    },
                    success: function(response) {
                        if(response.estado){
                            $("#categoria-modal-eliminar").modal('hide');
                                table.row( $(object).parents('tr') ).remove().draw();
                                //console.log(response.mensaje);
                        }
                    }
            });
        });
    }

    function actualizar(){

        var ciclo_e = 0;
        ciclo_e++;
        //console.log("Es ciclo e" + ciclo_e);

        //Cambiamos nombre del titulo
        document.getElementById("titulo-modal-agregar").innerHTML = "Actualizar categoria";
                
        //Ocultamos el boton de agregar y dejamos visible actualizar
        document.getElementById("categoria-button-actualizar").style.display = "";
        document.getElementById("categoria-button-agregar").style.display = "none";

        //guardamos el objeto de seleccion
        var object = this;

        //se obtine la data de la fila seleccionada
        var data = table.row( $(this).parents('tr') ).data();

        //Agregamos valor al formulario
        document.getElementById("categoria-nombre").value = data[2];
       // document.getElementById("categoria-descripcion").value = data[3];

        //console.log(data);

        $("#categoria-modal-agregar").modal('show');

        $("#categoria-button-actualizar").on("click", function (){
        $("#categoria-button-actualizar").unbind('click');
        

        jQuery.ajax({
                url: ajax.url,
                type: "post",
                dataType: "json",
                data: {
                    action: "crud_categoria",
                    idcategoria: data[1],
                    nombre: document.getElementById("categoria-nombre").value,
                    opcion: 3
                    },
                    success: function(response) {
                        
                        if(response.estado){
                            $("#categoria-modal-agregar").modal('hide');
                        table.row( $(object).parents('tr') ).remove().draw();
                        table.row.add(['<i class="modificar fa fa-pencil-square-o fa-lg mr-2" aria-hidden="true"></i><i class="eliminar fa fa-trash fa-lg" aria-hidden="true"></i>',response.id, response.nombre]).draw(); 
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
                action: "crud_categoria",
                opcion: 4
                },
                success: function(response) {
                        
                    var trHTML;
                        
                    $.each(response , function(index, value){
                    table.row.add(['<i class="modificar fa fa-pencil-square-o fa-lg mr-2" aria-hidden="true"></i><i class="eliminar fa fa-trash fa-lg" aria-hidden="true"></i>',value.idcategoria, value.nombre]).draw();
                    });
                }
        });
    }

})(jQuery);
