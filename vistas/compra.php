<?php 
/*
*Template Name: Page compra
*/
?>
<?php get_header(); ?>

<div class="container mt-3 mb-3">
  <div class="container-fluid mt-3">
    <!-- Button trigger modal -->
    <button id="compra-button-agregar-activa" type="button" class="btn btn-primary" data-toggle="modal" data-target="#compra-modal-agregar">
        Agregar Compra
    </button>
  </div>

<!-- Tabla del sistema-->
  <div id="contenedor-tabla" class="container table-responsive mt-3">
      <table id="compra-tabla" class="table" cellspacing="0">
          <thead class="bg-success text-light">
            <tr>
              <th scope="col" width="10%"></th>
              <th scope="col" width="5%">#</th>
              <th scope="col" width="15%">Finca</th>
              <th scope="col" width="10%">Cantidad</th>
              <th scope="col" width="10%">Costo</th>
              <th scope="col" width="15%">Fecha Recibido</th>
              <th scope="col" width="15%">Observacion</th>
              <th scope="col" width="10%">Cantidad Existente</th>
              <th scope="col" width="10%">Calidad</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
      </table>
  </div>

  <!-- Modal Agregar y Actualizar -->
  <div class="modal fade" id="compra-modal-agregar" tabindex="-1" role="dialog" aria-labelledby="titulo-modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="titulo-modal-agregar">Agregar Compra</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
         <!-- Formulario de Subcategoria -->
         <form id="compra-formulario">
          <div class="container-fluid">
   
            <div class="form-group">
              <label for="compra-cantidad">Cantidad</label>
              <input type="number" class="form-control" id="compra-cantidad" aria-describedby="nombre-ayuda" placeholder="Escriba cantidad">
            </div>
            <div class="form-group">
              <label for="compra-costo">Costo</label>
              <input type="number" class="form-control" id="compra-costo" aria-describedby="nombre-ayuda" placeholder="Escriba el costo">
            </div>
            <div class="form-group">
              <label for="compra-fecha">Fecha</label>
              <input type="date" class="form-control" id="compra-fecha" aria-describedby="nombre-ayuda" placeholder="Escriba fecha">
            </div>
            <div class="form-group">
              <label for="compra-observacion">Observacion</label>
              <input type="text" class="form-control" id="compra-observacion" aria-describedby="nombre-ayuda" placeholder="Escriba observacion">
            </div>
              
            <div class="form-group">
              <label for="compra-existente">Cantidad existente</label>
              <input type="number" class="form-control" id="compra-existente" aria-describedby="nombre-ayuda" placeholder="Escriba cantidad existente">
            </div>
    
			<div class="form-group">
              <label for="compra-ruta">Seleccione Ruta</label>
              <select id="compra-ruta" class="form-control custom-select">
              <option value=""></option></select>
			</div>

            <div class="form-group">
              <label for="compra-finca">Seleccione Finca</label>
              <select id="compra-finca" class="form-control custom-select"></select>
            </div>
            
      
          <!-- información calidad detalle -->

          <p>
          <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Agregar calidad de producto
          </a>
        </p>
        <div class="collapse" id="collapseExample">
          <div class="card card-body">
            <!-- Trabajo extra -->
            <form class="form-inline">
            <label class="mr-sm-2" for="calidad-detalle">Calidad</label>
            <select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="calidad-detalle">
              <option selected>Seleccione la Calidad evaluar</option>
              <option value="1">Agua</option>
              <option value="2">PH</option>
            </select>
            <button type="button" id="calidad-detalle-agregar" class="btn btn-primary">
              <i class="fa fa-plus-circle" aria-hidden="true"></i>
            </button>
          </form>


          <!-- Tabla del sistema-->
            <div id="contenedor-tabla-detalle" class="container table-responsive mt-3">
                <table id="calidad-detalle-tabla" class="table" cellspacing="0">
                    <thead class="bg-success text-light">
                      <tr>
                        <th scope="col" width="5%"></th>
                        <th scope="col" width="10%">#</th>
                        <th scope="col" width="40%">Nombre</th>
                        <th scope="col" width="45%">Valor %</th>
                      </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <!-- Fin trabajo Extra -->
          </div>
        </div>

          <!-- fin de información calidad detalle -->
	
        
          </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="button" id="compra-button-agregar" class="btn btn-primary">Guardar</button>
              <button type="button" id="compra-button-actualizar" class="btn btn-success">Actualizar</button>
            </div>
          </form>
          <!-- Fin del Formulario -->
        </div>
      </div>
    </div>
  </div>
</div>

  <!-- Modal Eliminar -->
  <div class="modal fade" id="compra-modal-eliminar" tabindex="-1" role="dialog" aria-labelledby="titulo-modal" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="titulo-modal-eliminar">Eliminar Subcategoria</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
         <!-- mensaje de eliminación -->
            <h5>Codigo: <label id="info_codigo"></label></h5>
            <p>Deseas eliminar el compra: <label id="info_nombre" class="text-danger"></label></p> 
          <!-- Fin del mensaje eliminación -->
        </div>
        <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
           <button type="button" id="compra-button-eliminar" class="btn btn-danger">Eliminar</button>
          </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Ver detalle de calidad-->
<div class="modal fade" id="compra-modal-detalle-calidad" tabindex="-1" role="dialog" aria-labelledby="titulo-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="titulo-modal-detalle-calidad">Información de calidad Compra</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
         <!-- mensaje de eliminación -->
            <h5># Compra: <label id="info_codigo_compra"></label></h5>
            <h5>Finca: <label id="info_mombre_finca"></label></h5> 


            <!-- Tabla del sistema-->
            <div id="contenedor-tabla-detalle-info" class="container table-responsive mt-3">
                  <table id="calidad-detalle-tabla-info" class="table" cellspacing="0">
                      <thead class="bg-success text-light">
                        <tr>
                          <th scope="col" width="50%">Nombre</th>
                          <th scope="col" width="50%">Valor %</th>
                        </tr>
                      </thead>
                      <tbody></tbody>
                  </table>
              </div>
          <!-- Fin del mensaje eliminación -->
        </div>
        <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>  
        </div>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>
