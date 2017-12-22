(function ($) {

    // variables globales
    var table = $('#calidad-tabla').DataTable({
    "order": [1, 'asc']
    }); //variable de la tabla

    // evento
    document.getElementById("calidad-button-agregar").addEventListener("click", agregar);
    document.getElementById("calidad-button-agregar-activa").addEventListener("click", agregar_activo);
    $("#calidad-tabla").on("click", ".eliminar", eliminar);
    $("#calidad-tabla").on("click", ".modificar", actualizar);

    //Cargamos por primera vez la tabla.
    ver();

    // Definición de funciones
    function agregar_activo(){

        //Cambiamos nombre del titulo
        document.getElementById("titulo-modal-agregar").innerHTML = "Agregar calidad";

        //Vaciamos el formulario
        document.getElementById("calidad-nombre").value = ""

        //Ocultamos el boton de actualizar y dejamos visible agregar
        document.getElementById("calidad-button-actualizar").style.display = "none";
        document.getElementById("calidad-button-agregar").style.display = "";
    }

    function agregar(){
        
        var nombre = document.getElementById("calidad-nombre");
        
        jQuery.ajax({
            url: ajax.url,
            type: "post",
            dataType: "json",
            data: {
                action: "crud_calidad",
                nombre: nombre.value,
                opcion: 1
                },
                success: function(response) {

                    if(response.estado){
                        //console.log(response);
                        $("#calidad-modal-agregar").modal("hide");
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

        $("#calidad-modal-eliminar").modal('show');

        document.getElementById("calidad-button-eliminar").addEventListener("click", function (){
            jQuery.ajax({
                url: ajax.url,
                type: "post",
                dataType: "json",
                data: {
                    action: "crud_calidad",
                    idcalidad: data[1],
                    opcion: 2
                    },
                    success: function(response) {
                        if(response.estado){
                            $("#calidad-modal-eliminar").modal('hide');
                                table.row( $(object).parents('tr') ).remove().draw();
                                console.log(response.mensaje);
                        }
                    }
            });
        });
    }

    function actualizar(){

        var ciclo_e = 0;
        ciclo_e++;
        

        //Cambiamos nombre del titulo
        document.getElementById("titulo-modal-agregar").innerHTML = "Actualizar calidad";
                
        //Ocultamos el boton de agregar y dejamos visible actualizar
        document.getElementById("calidad-button-actualizar").style.display = "";
        document.getElementById("calidad-button-agregar").style.display = "none";

        //guardamos el objeto de seleccion
        var object = this;

        //se obtine la data de la fila seleccionada
        var data = table.row( $(this).parents('tr') ).data();

        //Agregamos valor al formulario
        document.getElementById("calidad-nombre").value = data[2];

        

        $("#calidad-modal-agregar").modal('show');

        $("#calidad-button-actualizar").on("click", function (){
        $("#calidad-button-actualizar").unbind('click');
        

        jQuery.ajax({
                url: ajax.url,
                type: "post",
                dataType: "json",
                data: {
                    action: "crud_calidad",
                    idcalidad: data[1],
                    nombre: document.getElementById("calidad-nombre").value,
                    opcion: 3
                    },
                    success: function(response) {
                        
                        if(response.estado){
                            $("#calidad-modal-agregar").modal('hide');
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
                action: "crud_calidad",
                opcion: 4
                },
                success: function(response) {
                        
                    var trHTML;
                        
                    $.each(response , function(index, value){
                    table.row.add(['<i class="modificar fa fa-pencil-square-o fa-lg mr-2" aria-hidden="true"></i><i class="eliminar fa fa-trash fa-lg" aria-hidden="true"></i>',value.idcalidad, value.nombre]).draw();
                    });
                }
        });
    }

})(jQuery);
