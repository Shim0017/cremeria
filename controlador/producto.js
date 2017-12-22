(function ($) {

    // variables globales
    var table = $('#producto-tabla').DataTable({
        "order": [1, 'asc']
    }); //variable de la tabla

    // evento
    document.getElementById("producto-button-agregar").addEventListener("click", agregar);
    document.getElementById("producto-button-agregar-activa").addEventListener("click", agregar_activo);
    $("#producto-tabla").on("click", ".eliminar", eliminar);
    $("#producto-tabla").on("click", ".modificar", actualizar);
	$("#producto-categoria").on("change", llenar_combobox_subcategoria);

    //Cargamos por primera vez la tabla.
    ver();
	llenar_combobox_categoria()
	llenar_combobox_subcategoria()
	llenar_combobox_ingrediente()
    // Definición de funciones
    function agregar_activo(){

        //Cambiamos nombre del titulo
        document.getElementById("titulo-modal-agregar").innerHTML = "Agregar producto";

        //Vaciamos el formulario
        document.getElementById("producto-nombre").value = "";        
		document.getElementById("producto-cantidad").value = "";        
		document.getElementById("producto-mayorista").value = "";        
		document.getElementById("producto-normal").value = "";        
		document.getElementById("producto-costo").value = "";        
		document.getElementById("producto-inferior").value = "";        
		document.getElementById("producto-superior").value = "";        
		document.getElementById("producto-minimo").value = "";       
        document.getElementById("producto-categoria").value = "";   
		document.getElementById("producto-subcategoria").value = "";        
		document.getElementById("producto-ingrediente").value = "";

        //Ocultamos el boton de actualizar y dejamos visible agregar
        document.getElementById("producto-button-actualizar").style.display = "none";
        document.getElementById("producto-button-agregar").style.display = "";
    }

    function agregar(){		

        var nombre = document.getElementById("producto-nombre");
		var cantidad= document.getElementById("producto-cantidad");        
		var mayorista= document.getElementById("producto-mayorista");        
		var normal= document.getElementById("producto-normal");        
		var costo= document.getElementById("producto-costo");        
		var inferior= document.getElementById("producto-inferior");        
		var superior= document.getElementById("producto-superior");        
		var minimo= document.getElementById("producto-minimo");        

		var subcategoria = document.getElementById("producto-subcategoria");
      	var ingrediente = document.getElementById("producto-ingrediente");
        
        jQuery.ajax({
            url: ajax.url,
            type: "post",
            dataType: "json",
            data: {
                action: "crud_producto",
                nombre: nombre.value,
                cantidad: cantidad.value,
               	mayorista: mayorista.value,
                normal: normal.value,
                costo: costo.value,
                inferior: inferior.value,
                superior: superior.value,
                minimo: minimo.value,
               	subcategoria: subcategoria.value,
                ingrediente_idingrediente: ingrediente.value,
                opcion: 1
                },
                success: function(response) {

					//console.log(response);
                    if(response.estado){
                        //console.log(response);
                        $("#producto-modal-agregar").modal("hide");
                        table.row.add(['<i class="modificar fa fa-pencil-square-o fa-lg mr-2" aria-hidden="true"></i><i class="eliminar fa fa-trash fa-lg" aria-hidden="true"></i>',response.id,response.nombre,response.cantidad,response.mayorista,response.normal,response.costo,response.inferior,response.superior,response.minimo,response.subcategoria, response.ingrediente_idingrediente]).draw();
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

        $("#producto-modal-eliminar").modal('show');

        document.getElementById("producto-button-eliminar").addEventListener("click", function (){
            jQuery.ajax({
                url: ajax.url,
                type: "post",
                dataType: "json",
                data: {
                    action: "crud_producto",
                    idcategoria: data[1],
                    opcion: 2
                    },
                    success: function(response) {
                        if(response.estado){
                            $("#producto-modal-eliminar").modal('hide');
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
        document.getElementById("titulo-modal-agregar").innerHTML = "Actualizar producto";
                
        //Ocultamos el boton de agregar y dejamos visible actualizar
        document.getElementById("producto-button-actualizar").style.display = "";
        document.getElementById("producto-button-agregar").style.display = "none";

        //guardamos el objeto de seleccion
        var object = this;

        //se obtine la data de la fila seleccionada
        var data = table.row( $(this).parents('tr') ).data();

        //Agregamos valor al formulario

		document.getElementById("producto-nombre").value = data[2];
		document.getElementById("producto-cantidad").value = data[3];        
		document.getElementById("producto-mayorista").value = data[4];        
		document.getElementById("producto-normal").value = data[5];      
		document.getElementById("producto-costo").value = data[6];        
		document.getElementById("producto-inferior").value = data[7];        
		document.getElementById("producto-superior").value = data[8];        
		document.getElementById("producto-minimo").value = data[9];       

		document.getElementById("producto-subcategoria").value = data[10];
      	document.getElementById("producto-ingrediente").value = data[11];


 		var nombre = document.getElementById("producto-nombre");
		var cantidad= document.getElementById("producto-cantidad");        
		var mayorista= document.getElementById("producto-mayorista");        
		var normal= document.getElementById("producto-normal");        
		var costo= document.getElementById("producto-costo");        
		var inferior= document.getElementById("producto-inferior");        
		var superior= document.getElementById("producto-superior");        
		var minimo= document.getElementById("producto-minimo");        

		var subcategoria = document.getElementById("producto-subcategoria");
      	var ingrediente = document.getElementById("producto-ingrediente");



        //console.log(data);

        $("#producto-modal-agregar").modal('show');

      	$("#producto-button-actualizar").on("click", function (){
        $("#producto-button-actualizar").unbind('click');
        

        jQuery.ajax({
                url: ajax.url,
                type: "post",
                dataType: "json",
                data: {
                    action: "crud_producto",
                    idproducto: data[1],
                   	nombre: nombre.value,
		            cantidad: cantidad.value,
		           	mayorista: mayorista.value,
		            normal: normal.value,
		            costo: costo.value,
		            inferior: inferior.value,
		            superior: superior.value,
		            minimo: minimo.value,
		           	subcategoria: subcategoria.value,
			   
                	ingrediente_idingrediente: ingrediente.value,
					opcion: 3
                    },
                    success: function(response) {
                       // console.log(response);
                        if(response.estado){
                            $("#producto-modal-agregar").modal('hide');
                        table.row( $(object).parents('tr') ).remove().draw();
                        table.row.add(['<i class="modificar fa fa-pencil-square-o fa-lg mr-2" aria-hidden="true"></i><i class="eliminar fa fa-trash fa-lg" aria-hidden="true"></i>',response.id,response.nombre,response.cantidad,response.mayorista,response.normal,response.costo,response.inferior,response.superior,response.minimo,response.subcategoria, response.ingrediente_idingrediente]).draw(); 
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
                action: "crud_producto",
                opcion: 5
                },
                success: function(response) {
                    $.each(response , function(index, value){
                        document.getElementById('producto-categoria').append( new Option(value.nombre,value.idcategoria));
                    });
                }
        });
    }



	function llenar_combobox_subcategoria(){
		$('#producto-subcategoria').html('');
 		var categoria= document.getElementById("producto-categoria").value;

        jQuery.ajax({
            url: ajax.url,
            type: "post",
            dataType: "json",
            data: {
                action: "crud_producto",
				categoria_idcategoria: categoria,
                opcion: 6
                },
                success: function(response) {

                    $.each(response , function(index, value){
                        document.getElementById('producto-subcategoria').append( new Option(value.nombre,value.idsubcategoria));
                    });
                }
        });
    }


	function llenar_combobox_ingrediente(){
        jQuery.ajax({
            url: ajax.url,
            type: "post",
            dataType: "json",
            data: {
                action: "crud_producto",
                opcion: 7
                },
                success: function(response) {
                    $.each(response , function(index, value){
                        document.getElementById('producto-ingrediente').append( new Option(value.nombre,value.idingrediente));
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
                action: "crud_producto",
                opcion: 4
                },
                success: function(response) {
                        
                    var trHTML;
                        
                    $.each(response , function(index, value){
                    table.row.add(['<i class="modificar fa fa-pencil-square-o fa-lg mr-2" aria-hidden="true"></i><i class="eliminar fa fa-trash fa-lg" aria-hidden="true"></i>',value.idproducto,value.nombre, value.cantidad, value.mayorista,value.normal,value.costo,value.inferior,value.superior,value.minimo, value.sub, value.ingrediente]).draw();
                    });
                }
        });
    }

})(jQuery);
