<?php 
/*
*Template Name: Page subcategoria
*/
?>
<?php get_header(); ?>

<div class="container mt-3 mb-3">
  <div class="container-fluid mt-3">
    <!-- Button trigger modal -->
    <button id="subcategoria-button-agregar-activa" type="button" class="btn btn-primary" data-toggle="modal" data-target="#subcategoria-modal-agregar">
        Agregar Subcategoria
    </button>
  </div>

<!-- Tabla del sistema-->
  <div id="contenedor-tabla" class="container table-responsive mt-3">
      <table id="subcategoria-tabla" class="table" cellspacing="0">
          <thead class="bg-success text-light">
            <tr>
              <th scope="col" width="10%"></th>
              <th scope="col" width="20%">#</th>
              <th scope="col" width="40%">Nombre</th>
              <th scope="col" width="30%">Categoria</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
      </table>
  </div>

  <!-- Modal Agregar y Actualizar -->
  <div class="modal fade" id="subcategoria-modal-agregar" tabindex="-1" role="dialog" aria-labelledby="titulo-modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="titulo-modal-agregar">Agregar Subcategoria</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
         <!-- Formulario de Subcategoria -->
         <form id="subcategoria-formulario">
          <div class="container-fluid">
            <div class="form-group">
              <label for="subcategoria-nombre">Nombre</label>
              <input type="text" class="form-control" id="subcategoria-nombre" aria-describedby="nombre-ayuda" placeholder="Escriba Nombre">
              <small id="nombre-ayuda" class="form-text text-muted">Obligatorio.</small>
            </div>
  
                  <div class="form-group">
              <label for="subcategoria-categoria">Seleccione Categoria</label>
              <select id="subcategoria-categoria" class="form-control custom-select"></select>
            </div>
            
            
          </div>
          
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="button" id="subcategoria-button-agregar" class="btn btn-primary">Guardar</button>
              <button type="button" id="subcategoria-button-actualizar" class="btn btn-success">Actualizar</button>
            </div>
          </form>
          <!-- Fin del Formulario -->
        </div>
      </div>
    </div>
  </div>
</div>

  <!-- Modal Eliminar -->
  <div class="modal fade" id="subcategoria-modal-eliminar" tabindex="-1" role="dialog" aria-labelledby="titulo-modal" aria-hidden="true">
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
            <p>Deseas eliminar la Subcategoria: <label id="info_nombre" class="text-danger"></label></p> 
          <!-- Fin del mensaje eliminación -->
        </div>
        <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
           <button type="button" id="subcategoria-button-eliminar" class="btn btn-danger">Eliminar</button>
          </div>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>
