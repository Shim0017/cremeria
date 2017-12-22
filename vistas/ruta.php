<?php 
/*
*Template Name: Page Ruta
*/
?>
<?php get_header(); ?>

<div class="container mt-3 mb-3">
  <div class="container-fluid mt-3">
    <!-- Button trigger modal -->
    <button id="ruta-button-agregar-activa" type="button" class="btn btn-primary" data-toggle="modal" data-target="#ruta-modal-agregar">
        Agregar Ruta
    </button>
  </div>

<!-- Tabla del sistema-->
  <div id="contenedor-tabla" class="container table-responsive mt-3">
      <table id="ruta-tabla" class="table" cellspacing="0">
          <thead class="bg-success text-light">
            <tr>
              <th scope="col" width="10%"></th>
              <th scope="col" width="10%">#</th>
              <th scope="col" width="30%">Nombre</th>
              <th scope="col" width="50%">Descripción</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
      </table>
  </div>

  <!-- Modal Agregar y Actualizar -->
  <div class="modal fade" id="ruta-modal-agregar" tabindex="-1" role="dialog" aria-labelledby="titulo-modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="titulo-modal-agregar">Agregar Ruta</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
         <!-- Formulario de Ruta -->
         <form id="ruta-formulario">
          <div class="container-fluid">
            <div class="form-group">
              <label for="ruta-nombre">Nombre</label>
              <input type="text" class="form-control" id="ruta-nombre" aria-describedby="nombre-ayuda" placeholder="Escriba Nombre de Ruta">
              <small id="nombre-ayuda" class="form-text text-muted">Obligatorio.</small>
            </div>
            <div class="form-group">
              <label for="ruta-descripcion">Descripcion</label>
              <textarea class="form-control" id="ruta-descripcion" rows="2" placeholder="Describa la Ruta"></textarea>
            </div>
          </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="button" id="ruta-button-agregar" class="btn btn-primary">Guardar</button>
              <button type="button" id="ruta-button-actualizar" class="btn btn-success">Actualizar</button>
            </div>
          </form>
          <!-- Fin del Formulario -->
        </div>
      </div>
    </div>
  </div>
</div>

  <!-- Modal Eliminar -->
  <div class="modal fade" id="ruta-modal-eliminar" tabindex="-1" role="dialog" aria-labelledby="titulo-modal" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="titulo-modal-eliminar">Eliminar Ruta</h5>
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
           <button type="button" id="ruta-button-eliminar" class="btn btn-danger">Eliminar</button>
          </div>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>