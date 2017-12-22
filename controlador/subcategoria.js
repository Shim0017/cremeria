(function ($) {

    // variables globales
    var table = $('#subcategoria-tabla').DataTable({
        "order": [1, 'asc']
    }); //variable de la tabla

    // evento
    document.getElementById("subcategoria-button-agregar").addEventListener("click", agregar);
    document.getElementById("subcategoria-button-agregar-activa").addEventListener("click", agregar_activo);
    $("#subcategoria-tabla").on("click", ".eliminar", eliminar);
    $("#subcategoria-tabla").on("click", ".modificar", actualizar);

    //Cargamos por primera vez la tabla.
    ver();
	llenar_combobox_categoria();

    // Definición de funciones
    function agregar_activo(){

        //Cambiamos nombre del titulo
        document.getElementById("titulo-modal-agregar").innerHTML = "Agregar Subcategoria";

        //Vaciamos el formulario
        document.getElementById("subcategoria-nombre").value = "";
		document.getElementById("subcategoria-categoria").value = "";

        //Ocultamos el boton de actualizar y dejamos visible agregar
        document.getElementById("subcategoria-button-actualizar").style.display = "none";
        document.getElementById("subcategoria-button-agregar").style.display = "";
    }

    function agregar(){
        
       	var nombre = document.getElementById("subcategoria-nombre");
       	var descripcion = document.getElementById("subcategoria-categoria");
        
        jQuery.ajax({
            url: ajax.url,
            type: "post",
            dataType: "json",
            data: {
                action: "crud_subcategoria",
                nombre: nombre.value,
                categoria_idcategoria: descripcion.value,
                opcion: 1
                },
                success: function(response) {

                    if(response.estado){
                        //console.log(response);
                        $("#subcategoria-modal-agregar").modal("hide");
                        table.row.add(['<i class="modificar fa fa-pencil-square-o fa-lg mr-2" aria-hidden="true"></i><i class="eliminar fa fa-trash fa-lg" aria-hidden="true"></i>',response.id, response.nombre,response.categoria_idcategoria]).draw();
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

        $("#subcategoria-modal-eliminar").modal('show');

        document.getElementById("subcategoria-button-eliminar").addEventListener("click", function (){
            jQuery.ajax({
                url: ajax.url,
                type: "post",
                dataType: "json",
                data: {
                    action: "crud_subcategoria",
                    idcategoria: data[1],
                    opcion: 2
                    },
                    success: function(response) {
                        if(response.estado){
                            $("#subcategoria-modal-eliminar").modal('hide');
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
        document.getElementById("titulo-modal-agregar").innerHTML = "Actualizar Subcategoria";
                
        //Ocultamos el boton de agregar y dejamos visible actualizar
        document.getElementById("subcategoria-button-actualizar").style.display = "";
        document.getElementById("subcategoria-button-agregar").style.display = "none";

        //guardamos el objeto de seleccion
        var object = this;

        //se obtine la data de la fila seleccionada
        var data = table.row( $(this).parents('tr') ).data();

        //Agregamos valor al formulario
        document.getElementById("subcategoria-nombre").value = data[2];
      	document.getElementById("subcategoria-categoria").value = data[3];

        //console.log(data);

        $("#subcategoria-modal-agregar").modal('show');

       	$("#subcategoria-button-actualizar").on("click", function (){
        $("#subcategoria-button-actualizar").unbind('click');
        

        jQuery.ajax({
                url: ajax.url,
                type: "post",
                dataType: "json",
                data: {
                    action: "crud_subcategoria",
                    idcategoria: data[1],
                    nombre: document.getElementById("subcategoria-nombre").value,
                    categoria_idcategoria: document.getElementById("subcategoria-categoria").value,
                    opcion: 3
                    },
                    success: function(response) {
                        
                        if(response.estado){
                            $("#subcategoria-modal-agregar").modal('hide');
                        table.row( $(object).parents('tr') ).remove().draw();
                        table.row.add(['<i class="modificar fa fa-pencil-square-o fa-lg mr-2" aria-hidden="true"></i><i class="eliminar fa fa-trash fa-lg" aria-hidden="true"></i>',response.id, response.nombre,response.categoria_idcategoria]).draw(); 
                         }
                    }
            });
        });
    }



	function llenar_combobox_categoria(){
        jQuery.ajax({
            url: ajax.url,
            type: "post",
            dataType: "json",
            data: {
                action: "crud_subcategoria",
                opcion: 5
                },
                success: function(response) {
                    $.each(response , function(index, value){
                        document.getElementById('subcategoria-categoria').append( new Option(value.nombre,value.idcategoria));
                    });
                }
        });
    }


    function ver(){
        
        jQuery.ajax({
            url: ajax.url,
            type: "post",
            dataType: "json",
            data: {
                action: "crud_subcategoria",
                opcion: 4
                },
                success: function(response) {
                        
                    var trHTML;
                        
                    $.each(response , function(index, value){
                    table.row.add(['<i class="modificar fa fa-pencil-square-o fa-lg mr-2" aria-hidden="true"></i><i class="eliminar fa fa-trash fa-lg" aria-hidden="true"></i>',value.idsubcategoria, value.sub, value.categoria]).draw();
                    });
                }
        });
    }

})(jQuery);
