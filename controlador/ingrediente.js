(function ($) {

    // variables globales
    var table = $('#ingrediente-tabla').DataTable({

	"order": [1,"asc"]
}


); //variable de la tabla

    // evento
    document.getElementById("ingrediente-button-agregar").addEventListener("click", agregar);
    document.getElementById("ingrediente-button-agregar-activa").addEventListener("click", agregar_activo);
    $("#ingrediente-tabla").on("click", ".eliminar", eliminar);
    $("#ingrediente-tabla").on("click", ".modificar", actualizar);

    //Cargamos por primera vez la tabla.
    ver();


  // Definición de funciones
    function agregar_activo(){

        //Cambiamos nombre del titulo
        document.getElementById("titulo-modal-agregar").innerHTML = "Agregar Ingrediente";

        //Vaciamos el formulario
        document.getElementById("ingrediente-nombre").value = "";
        document.getElementById("ingrediente-costo").value = "";

        //Ocultamos el boton de actualizar y dejamos visible agregar
        document.getElementById("ingrediente-button-actualizar").style.display = "none";
        document.getElementById("ingrediente-button-agregar").style.display = "";
    }

    // Definición de funciones
    function agregar(){
        
        var nombre = document.getElementById("ingrediente-nombre");
        var costo = document.getElementById("ingrediente-costo");
     
        jQuery.ajax({
            url: ajax.url,
            type: "post",
            dataType: "json",
            data: {
                action: "crud_ingrediente",
                nombre: nombre.value,
                costo: costo.value,
                opcion: 1
                },
                success: function(response) {

                    if(response.estado){
                        //console.log(response);
                        $("#ingrediente-modal-agregar").modal("hide");
                        table.row.add(['<i class="modificar fa fa-pencil-square-o fa-lg mr-2" aria-hidden="true"></i><i class="eliminar fa fa-trash fa-lg" aria-hidden="true"></i>',response.id, response.nombre, response.costo]).draw();
                    }
        
             }
        });
    }

 function actualizar(){
                   


	//Cambiamos nombre del titulo
        document.getElementById("titulo-modal-agregar").innerHTML = "Actualizar ingrediente";
                
        //Ocultamos el boton de agregar y dejamos visible actualizar
        document.getElementById("ingrediente-button-actualizar").style.display = "";
        document.getElementById("ingrediente-button-agregar").style.display = "none";


    //guardamos el objeto de seleccion
        var object = this;
        //se obtine la data de la fila seleccionada
        var data = table.row( $(this).parents('tr') ).data();
     
        //Agregamos valor al formulario
        document.getElementById("ingrediente-nombre").value = data[2];
        document.getElementById("ingrediente-costo").value = data[3];


        $("#ingrediente-modal-agregar").modal('show');
		
		$("#ingrediente-button-actualizar").on("click", function (){
        $("#ingrediente-button-actualizar").unbind('click');		
            jQuery.ajax({
                url: ajax.url,
                type: "post",
                dataType: "json",
                data: {
                    action: "crud_ingrediente",
                    idingrediente: data[1],
                    nombre: document.getElementById("ingrediente-nombre").value,
                    costo: document.getElementById("ingrediente-costo").value,
                    opcion: 3
                    },
                    success: function(response) {
                        
                        if(response.estado){
                            $("#ingrediente-modal-agregar").modal('hide');
                        table.row( $(object).parents('tr') ).remove().draw();
                        table.row.add(['<i class="modificar fa fa-pencil-square-o fa-lg mr-2" aria-hidden="true"></i><i class="eliminar fa fa-trash fa-lg" aria-hidden="true"></i>',response.id, response.nombre, response.costo]).draw(); 
                         }
                    }
            });
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

        $("#ingrediente-modal-eliminar").modal('show');

        document.getElementById("ingrediente-button-eliminar").addEventListener("click", function (){
                
            jQuery.ajax({
                url: ajax.url,
                type: "post",
                dataType: "json",
                data: {
                    action: "crud_ingrediente",
                    idingrediente: info_codigo.innerHTML,
                    opcion: 2
                    },
                    success: function(response) {
                        if(response.estado){
                            $("#ingrediente-modal-eliminar").modal('hide');
                                table.row( $(object).parents('tr') ).remove().draw();
                                //console.log(response.mensaje);
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
                action: "crud_ingrediente",
                opcion: 4
                },
                success: function(response) {
                        
                    console.log(response);
                    var trHTML;
                        
                    $.each(response , function(index, value){
                    table.row.add(['<i class="modificar fa fa-pencil-square-o fa-lg mr-2" aria-hidden="true"></i><i class="eliminar fa fa-trash fa-lg" aria-hidden="true"></i>',value.idingrediente, value.nombre, value.costo]).draw();
                    });
                }
        });
    }

})(jQuery);
