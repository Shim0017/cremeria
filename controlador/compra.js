(function ($) {

    // variables globales
    var table = $('#compra-tabla').DataTable({
        "order": [1, 'asc']
    }); //variable de la tabla

    
    var tableDetalleCalidad = $('#calidad-detalle-tabla').DataTable({
        "order": [1, 'asc'],
        "paging": false,
        "info": false,
        "searching": false
    });

    var tabledetallecalidadver = $('#calidad-detalle-tabla-info').DataTable({
        "order": [1, 'asc'],
        "paging": false,
        "info": false,
        "searching": false
    });


    document.getElementById("calidad-detalle-agregar").addEventListener("click", agregar_detalle_table);

    function agregar_detalle_table(){

        var comboboxDetalle =  document.getElementById("calidad-detalle");

        tableDetalleCalidad.row.add(["X",comboboxDetalle.value,comboboxDetalle.options
        [comboboxDetalle.selectedIndex].text,'<input type="text" id='+comboboxDetalle.value+' class="form-control" >']).draw();
    }

    function calidad_detalle_guardar(idcompra){

        var tableInformacion = tableDetalleCalidad.rows().data();

        $.each(tableInformacion , function(index, value){

            jQuery.ajax({
                url: ajax.url,
                type: "post",
                dataType: "json",
                data: {
                    action: "crud_compra",
                    idcalidad: value[1],
                    idcompra: idcompra,
                    porcentaje: document.getElementById(value[1]).value,
                    opcion: 8
                    },
                    success: function(response) {
                            console.log(response);
                    }
            });
        });

    }

    // evento
    document.getElementById("compra-button-agregar").addEventListener("click", agregar);
    document.getElementById("compra-button-agregar-activa").addEventListener("click", agregar_activo);
    $("#compra-tabla").on("click", ".eliminar", eliminar);
    $("#compra-tabla").on("click", ".modificar", actualizar);
    $("#compra-tabla").on("click", ".ver-detalle-calidad", ver_detalle_calidad);
	$("#compra-ruta").on("change", llenar_combobox_finca);

    //Cargamos por primera vez la tabla.
    ver();
	llenar_combobox_ruta()
	llenar_combobox_finca()
    // Definición de funciones
    function ver_detalle_calidad(){


        $('#compra-modal-detalle-calidad').modal('show');
        
        tabledetallecalidadver.clear().draw();
        //guardamos el objeto de seleccion
        var object = this;
        //se obtine la data de la fila seleccionada
        var data = table.row( $(this).parents('tr') ).data();
        //obtenemos el label
        document.getElementById('info_codigo_compra').innerHTML = data[1];
        document.getElementById('info_mombre_finca').innerHTML = data[2];

        jQuery.ajax({
            url: ajax.url,
            type: "post",
            dataType: "json",
            data: {
                action: "crud_compra",
                idcompra: data[1],
			   	opcion: 9
                },
                success: function(response) {
                    console.log(response);
                    $.each(response , function(index, value){
                            tabledetallecalidadver.row.add([value.nombre,value.porcentaje]).draw();
                    });
                    
             }
        });

    }

    function agregar_activo(){

        //Cambiamos nombre del titulo
        document.getElementById("titulo-modal-agregar").innerHTML = "Agregar compra";

        //Vaciamos el formulario
		document.getElementById("compra-cantidad").value = "";      
		document.getElementById("compra-costo").value = "";        
		document.getElementById("compra-fecha").value = "";        
		document.getElementById("compra-observacion").value = "";        
		document.getElementById("compra-existente").value = "";       
        document.getElementById("compra-ruta").value = "";   
		document.getElementById("compra-finca").value = "";  
        //Ocultamos el boton de actualizar y dejamos visible agregar
        document.getElementById("compra-button-actualizar").style.display = "none";
        document.getElementById("compra-button-agregar").style.display = "";
    }

    function agregar(){		

		var cantidad= document.getElementById("compra-cantidad");    
		var costo= document.getElementById("compra-costo");        
		var fecha= document.getElementById("compra-fecha");        
		var observacion= document.getElementById("compra-observacion");        
		var existente= document.getElementById("compra-existente");        

		var finca = document.getElementById("compra-finca");
        jQuery.ajax({
            url: ajax.url,
            type: "post",
            dataType: "json",
            data: {
                action: "crud_compra",
                
                cantidad: cantidad.value,
               	costo: costo.value,
                fecha_recibido: fecha.value,
                observacion: observacion.value,
                cantidad_existente: existente.value,
               	finca_idfinca: finca.value,
			   	opcion: 1
                },
                success: function(response) {

					//console.log(response);
                    if(response.estado){
                        //console.log(response);
                        $("#compra-modal-agregar").modal("hide");
                        table.row.add(['<i class="modificar fa fa-pencil-square-o fa-lg mr-2" aria-hidden="true"></i><i class="eliminar fa fa-trash fa-lg" aria-hidden="true"></i>',response.id,response.finca_idfinca,response.cantidad,response.costo,response.fecha_recibido,response.observacion,response.cantidad_existente,'<i class="ver-detalle-calidad fa fa-search fa-lg mr-2" aria-hidden="true"></i>']).draw();
                        calidad_detalle_guardar(response.id);
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

        $("#compra-modal-eliminar").modal('show');

        document.getElementById("compra-button-eliminar").addEventListener("click", function (){
            jQuery.ajax({
                url: ajax.url,
                type: "post",
                dataType: "json",
                data: {
                    action: "crud_compra",
                    idcategoria: data[1],
                    opcion: 2
                    },
                    success: function(response) {
                        if(response.estado){
                            $("#compra-modal-eliminar").modal('hide');
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
        document.getElementById("titulo-modal-agregar").innerHTML = "Actualizar compra";
                
        //Ocultamos el boton de agregar y dejamos visible actualizar
        document.getElementById("compra-button-actualizar").style.display = "";
        document.getElementById("compra-button-agregar").style.display = "none";

        //guardamos el objeto de seleccion
        var object = this;

        //se obtine la data de la fila seleccionada
        var data = table.row( $(this).parents('tr') ).data();

        //Agregamos valor al formulario



		document.getElementById("compra-cantidad").value = data[3];       
		document.getElementById("compra-costo").value = data[4];        
		document.getElementById("compra-fecha").value = data[5];        
		document.getElementById("compra-observacion").value = data[6];        
		document.getElementById("compra-existente").value = data[7];       

		document.getElementById("compra-finca").value = data[1];

 		
		var cantidad= document.getElementById("compra-cantidad");        
		var costo= document.getElementById("compra-costo");        
		var fecha= document.getElementById("compra-fecha");        
		var observacion= document.getElementById("compra-observacion");        
		var existente= document.getElementById("compra-existente");        

		var finca= document.getElementById("compra-finca");


        //console.log(data);

        $("#compra-modal-agregar").modal('show');

       	$("#compra-button-actualizar").on("click", function (){
        $("#compra-button-actualizar").unbind('click');
        

        jQuery.ajax({
                url: ajax.url,
                type: "post",
                dataType: "json",
                data: {
                    action: "crud_compra",
                    idcompra: data[1],
		            cantidad: cantidad.value,
		            costo: costo.value,
		            fecha_recibido: fecha.value,
		            observacion: observacion.value,
		            cantidad_existente: existente.value,
		           	finca_idfinca: finca.value,
					opcion: 3
                    },
                    success: function(response) {
                        //console.log(response);
                        if(response.estado){
                            $("#compra-modal-agregar").modal('hide');
                        table.row( $(object).parents('tr') ).remove().draw();
                        table.row.add(['<i class="modificar fa fa-pencil-square-o fa-lg mr-2" aria-hidden="true"></i><i class="eliminar fa fa-trash fa-lg" aria-hidden="true"></i>',response.id,response.finca_idfinca,response.cantidad,response.costo,response.fecha_recibido,response.observacion,response.cantidad_existente]).draw(); 
                         }
                    }
            });
        });
    }


	function llenar_combobox_ruta(){ 
		    jQuery.ajax({
		        url: ajax.url,
		        type: "post",
		        dataType: "json",
		        data: {
		            action: "crud_compra",
		            opcion: 5
		            },
		            success: function(response) {
		                $.each(response , function(index, value){
		                    document.getElementById('compra-ruta').append( new Option(value.nombre,value.idruta));
		                });
		            }
		    });
		}



	function llenar_combobox_finca(){
		$('#compra-finca').html('');

	 	var ruta= document.getElementById("compra-ruta").value;
	  
		 jQuery.ajax({
				    url: ajax.url,
				    type: "post",
				    dataType: "json",
				    data: {
				        action: "crud_compra",
						ruta_idruta: ruta,
				        opcion: 6
				        },
				        success: function(response) {

				            $.each(response , function(index, value){
				                document.getElementById('compra-finca').append( new Option(value.nombre,value.idfinca));
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
                action: "crud_compra",
                opcion: 4
                },
                success: function(response) {

                    $.each(response , function(index, value){
                    table.row.add(['<i class="modificar fa fa-pencil-square-o fa-lg mr-2" aria-hidden="true"></i><i class="eliminar fa fa-trash fa-lg" aria-hidden="true"></i>',value.idcompra,value.nombre,value.cantidad, value.costo, value.fecha_recibido,value.observacion,value.cantidad_existente,'<i class="ver-detalle-calidad fa fa-search fa-lg mr-2" aria-hidden="true"></i>']).draw();
                    });
                }
        });
    }

})(jQuery);
