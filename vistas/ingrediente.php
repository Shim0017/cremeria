<?php 
/*
*Template Name: Page Ingrediente
*/
?>
<?php get_header(); ?>

<div class="container mt-3 mb-3">
  <div class="container-fluid mt-3">
    <!-- Button trigger modal -->
    <button id="ingrediente-button-agregar-activa" type="button" class="btn btn-primary" data-toggle="modal" data-target="#ingrediente-modal-agregar">
        Agregar Ingrediente
    </button>
  </div>

<!-- Tabla del sistema-->
  <div id="contenedor-tabla" class="container table-responsive mt-3">
      <table id="ingrediente-tabla" class="table" cellspacing="0">
          <thead class="bg-success text-light">
            <tr>
              <th scope="col" width="10%"></th>
              <th scope="col" width="10%">#</th>
              <th scope="col" width="40%">Nombre</th>
              <th scope="col" width="40%">Costo</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
      </table>
  </div>

  <!-- Modal Agregar y actualizar -->
  <div class="modal fade" id="ingrediente-modal-agregar" tabindex="-1" role="dialog" aria-labelledby="titulo-modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="titulo-modal-agregar">Agregar Ingrediente</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
         <!-- Formulario de Ingrediente -->
         <form id="ingrediente-formulario">
          <div class="container-fluid">
            <div class="form-group">
              <label for="ingrediente-nombre">Nombre</label>
              <input type="text" class="form-control" id="ingrediente-nombre" aria-describedby="nombre-ayuda" placeholder="Escriba Nombre">
              <small id="nombre-ayuda" class="form-text text-muted">Obligatorio.</small>
            </div>
            <div class="form-group">
              <label for="ingrediente-costo">Costo</label>
              <textarea class="form-control" id="ingrediente-costo" rows="2" placeholder="Costo"></textarea>
            </div>
          </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="button" id="ingrediente-button-agregar" class="btn btn-primary">Guardar</button>
              <button type="button" id="ingrediente-button-actualizar" class="btn btn-success">Actualizar</button>
            </div>
          </form>
          <!-- Fin del Formulario -->
        </div>
      </div>
    </div>
  </div>
</div>




  <!-- Modal Eliminar -->
  <div class="modal fade" id="ingrediente-modal-eliminar" tabindex="-1" role="dialog" aria-labelledby="titulo-modal" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="titulo-modal">Eliminar Ingrediente</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
         <!-- mensaje de eliminación -->
            <h5>Codigo: <label id="info_codigo"></label></h5>
            <p>Deseas eliminar el Ingrediente: <label id="info_nombre" class="text-danger"></label></p> 
          <!-- Fin del mensaje eliminación -->
        </div>
        <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
           <button type="button" id="ingrediente-button-eliminar" class="btn btn-danger">Eliminar</button>
          </div>
      </div>
    </div>
  </div>
</div>




<?php get_footer(); ?>
