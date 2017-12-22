<?php 
/*
*Template Name: Page Finca
*/
?>
<?php get_header(); ?>
<div class="container mt-3 mb-3">
  <div class="container-fluid mt-3">
    <!-- Button trigger modal -->
    <button type="button" id="finca-button-agregar-activa" class="btn btn-primary" data-toggle="modal" data-target="#finca-modal-agregar">
        Agregar Finca
    </button>
  </div>

<!-- Tabla del sistema-->
  <div id="contenedor-tabla" class="container table-responsive mt-3">
      <table id="finca-tabla" class="table" cellspacing="0">
          <thead class="bg-success text-light">
            <tr>
              <th scope="col" width="10%"></th>
              <th scope="col" width="5%">#</th>
              <th scope="col" width="15%">Nombre</th>
              <th scope="col" width="15%">Encargado</th>
              <th scope="col" width="25%">Dirección</th>
              <th scope="col" width="5%">Distancia</br>(KM)</th>
              <th scope="col" width="5%">Telefono</th>
              <th scope="col" width="5%">Hora</br>Entrega</th>
              <th scope="col" class="d-none" width="5%">idruta</th>
              <th scope="col" width="15%">Ruta</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
      </table>
  </div>


  <!-- Modal Agregar y Actualizar-->
  <div class="modal fade" id="finca-modal-agregar" tabindex="-1" role="dialog" aria-labelledby="titulo-modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="titulo-modal-agregar">Agregar Finca</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
         <!-- Formulario de Finca -->
         <form id="finca-formulario">
          <div class="container-fluid">
            <div class="form-group">
              <label for="finca-nombre">Nombre de la finca</label>
              <input type="text" class="form-control" id="finca-nombre" aria-describedby="nombre-ayuda" placeholder="Escriba el nombre">
              <small id="nombre-ayuda" class="form-text text-muted">Obligatorio.</small>
            </div>
            <div class="form-group">
              <label for="finca-encargado">Nombre del encargado</label>
              <input type="text" class="form-control" id="finca-encargado" aria-describedby="encargado-ayuda" placeholder="Escriba el nombre">
              <small id="enargado-ayuda" class="form-text text-muted">Obligatorio.</small>
            </div>
            <div class="form-group">
              <label for="finca-direccion">Dirección</label>
              <input type="text" class="form-control" id="finca-direccion" aria-describedby="direccion-ayuda" placeholder="Escriba la dirección">
              <small id="direccion-ayuda" class="form-text text-muted">Obligatorio.</small>
            </div>
            <div class="form-group">
              <label for="finca-distancia">Distancia</label>
              <div class="input-group">
                <input type="number" class="form-control" id="finca-distancia" aria-describedby="distancia-ayuda" value=0 placeholder="Escriba la distancia">
                <div class="input-group-addon">KM</div>
              </div>
              <small id="distancia-ayuda" class="form-text text-muted">Obligatorio y solo número.</small>
            </div>
            <div class="form-group">
              <label for="finca-telefono">Telefono</label>
              <input type="text" class="form-control" id="finca-telefono" aria-describedby="telefono-ayuda" placeholder="Escriba el telefono">
              <small id="telefono-ayuda" class="form-text text-muted">Obligatorio.</small>
            </div>
            <div class="form-group">
              <label for="finca-hora-entrega">Hora de entrega</label>
              <input type="time" class="form-control" id="finca-hora-entrega" aria-describedby="hora-entrega-ayuda" placeholder="Escriba la hora entrega">
              <small id="hora-entrega-ayuda" class="form-text text-muted">Obligatorio.</small>
            </div>
            <div class="form-group">
              <label for="finca-ruta">Seleccione Ruta</label>
              <select id="finca-ruta" class="form-control custom-select"></select>
            </div>
          </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="button" id="finca-button-agregar" class="btn btn-primary">Guardar</button>
              <button type="button" id="finca-button-actualizar" class="btn btn-success">Actualizar</button>
            </div>
          </form>
          <!-- Fin del Formulario -->
        </div>
      </div>
    </div>
  </div>
</div>

  <!-- Modal Eliminar -->
  <div class="modal fade" id="finca-modal-eliminar" tabindex="-1" role="dialog" aria-labelledby="titulo-modal" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="titulo-modal">Eliminar Finca</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
         <!-- mensaje de eliminación -->
            <h5>Codigo: <label id="info_codigo"></label></h5>
            <p>Deseas eliminar la Finca: <label id="info_nombre" class="text-danger"></label></p> 
          <!-- Fin del mensaje eliminación -->
        </div>
        <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
           <button type="button" id="finca-button-eliminar" class="btn btn-danger">Eliminar</button>
          </div>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>