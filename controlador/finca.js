(function ($) {

    // variables globales
    var table = $('#finca-tabla').DataTable({
        "order": [1, 'asc'],
        "columnDefs": [
            { className: "d-none", "targets": [ 8 ] }
          ]
    }); //variable de la tabla

    // Definición de eventos
    document.getElementById("finca-button-agregar").addEventListener("click", agregar);
    document.getElementById("finca-button-agregar-activa").addEventListener("click", agregar_activo);
    $("#finca-tabla").on("click", ".eliminar", eliminar);
    $("#finca-tabla").on("click", ".modificar", modificar);


    //Cargamos por primera vez la tabla y combobox.
    ver();
    llenar_combobox_ruta();

    // Definición de funciones
    function agregar_activo(){
        
        //Cambiamos nombre del titulo
        document.getElementById("titulo-modal-agregar").innerHTML = "Agregar Finca";
        
        //Vaciamos el formulario
        document.getElementById("finca-formulario").reset();

        //Ocultamos el boton de actualizar y dejamos visible agregar
        document.getElementById("finca-button-actualizar").style.display = "none";
        document.getElementById("finca-button-agregar").style.display = "";
    }

    function agregar(){

        jQuery.ajax({
            url: ajax.url,
            type: "post",
            dataType: "json",
            data: {
                action: "crud_finca",
                nombre: document.getElementById("finca-nombre").value,
                encargado: document.getElementById("finca-encargado").value,
                direccion: document.getElementById("finca-direccion").value,
                distancia: document.getElementById("finca-distancia").value,
                telefono: document.getElementById("finca-telefono").value,
                hora: document.getElementById("finca-hora-entrega").value,
                ruta: document.getElementById("finca-ruta").value,
                opcion: 1
            },
            success: function(response) {

                if(response.estado){
                   $("#finca-modal-agregar").modal("hide");
                   table.row.add(['<i class="modificar fa fa-pencil-square-o fa-lg mr-2" aria-hidden="true"></i><i class="eliminar fa fa-trash fa-lg" aria-hidden="true"></i>',response.idfinca, response.nombre, response.encargado,response.direccion,response.distancia,response.telefono,response.hora,document.getElementById("finca-ruta").value,document.getElementById("finca-ruta").options[document.getElementById("finca-ruta").selectedIndex].text]).draw();

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

        $("#finca-modal-eliminar").modal('show');

        document.getElementById("finca-button-eliminar").addEventListener("click", function (){
            $("#finca-button-eliminar").unbind('click'); //evitamos que se corra 2 o mas el evento
            jQuery.ajax({
                url: ajax.url,
                type: "post",
                dataType: "json",
                data: {
                    action: "crud_finca",
                    idfinca: data[1],
                    opcion: 2
                    },
                    success: function(response) {
                        if(response.estado){
                            $("#finca-modal-eliminar").modal('hide');
                                table.row( $(object).parents('tr') ).remove().draw();
                        }
                    }
            });
        });
    }

    function modificar(){

        //Cambiamos nombre del titulo
        document.getElementById("titulo-modal-agregar").innerHTML = "Actualizar Ruta";
               
       //Ocultamos el boton de agregar y dejamos visible actualizar
       document.getElementById("finca-button-actualizar").style.display = "";
       document.getElementById("finca-button-agregar").style.display = "none";

        //guardamos el objeto de seleccion
        var object = this;
               
        //se obtine la data de la fila seleccionada
        var data = table.row( $(this).parents('tr') ).data();

        //abrir el formulario
        $("#finca-modal-agregar").modal('show');

        //Cargando datos al formulario
        document.getElementById("finca-nombre").value = data[2];
        document.getElementById("finca-encargado").value = data[3];
        document.getElementById("finca-direccion").value = data[4];
        document.getElementById("finca-distancia").value = data[5];
        document.getElementById("finca-telefono").value = data[6];
        document.getElementById("finca-hora-entrega").value = data[7];
        document.getElementById("finca-ruta").value = data[8];


        $("#finca-button-actualizar").on("click", function (){
            
            $("#finca-button-actualizar").unbind('click');
            jQuery.ajax({
                url: ajax.url,
                type: "post",
                dataType: "json",
                data: {
                    action: "crud_finca",
                    nombre: document.getElementById("finca-nombre").value,
                    encargado: document.getElementById("finca-encargado").value,
                    direccion: document.getElementById("finca-direccion").value,
                    distancia: document.getElementById("finca-distancia").value,
                    telefono: document.getElementById("finca-telefono").value,
                    hora: document.getElementById("finca-hora-entrega").value,
                    ruta: document.getElementById("finca-ruta").value,
                    opcion: 3
                },
                success: function(response) {

                    if(response.estado){
                    $("#finca-modal-agregar").modal("hide");
                    table.row( $(object).parents('tr') ).remove().draw();
                    table.row.add(['<i class="modificar fa fa-pencil-square-o fa-lg mr-2" aria-hidden="true"></i><i class="eliminar fa fa-trash fa-lg" aria-hidden="true"></i>',response.idfinca, response.nombre, response.encargado,response.direccion,response.distancia,response.telefono,response.hora,document.getElementById("finca-ruta").value,document.getElementById("finca-ruta").options[document.getElementById("finca-ruta").selectedIndex].text]).draw();
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
                action: "crud_finca",
                opcion: 4
                },
                success: function(response) {

                    var trHTML;
                    console.log(response);

                    $.each(response , function(index, value){
                    table.row.add(['<i class="modificar fa fa-pencil-square-o fa-lg mr-2" aria-hidden="true"></i><i class="eliminar fa fa-trash fa-lg" aria-hidden="true"></i>',value.idfinca, value.nombre_finca, value.encargado, value.direccion, value.distancia, value.telefono, value.hora_entrega,value.idruta, value.nombre_ruta]).draw();
                    });
                }
        });
    }

    function llenar_combobox_ruta(){
        jQuery.ajax({
            url: ajax.url,
            type: "post",
            dataType: "json",
            data: {
                action: "crud_finca",
                opcion: 6
                },
                success: function(response) {
                    $.each(response , function(index, value){
                        document.getElementById('finca-ruta').append( new Option(value.nombre,value.idruta));
                    });
                }
        });
    }

})(jQuery);
