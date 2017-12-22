<?php 
/*
*Template Name: Page producto
*/
?>
<?php get_header(); ?>

<div class="container mt-3 mb-3">
  <div class="container-fluid mt-3">
    <!-- Button trigger modal -->
    <button id="producto-button-agregar-activa" type="button" class="btn btn-primary" data-toggle="modal" data-target="#producto-modal-agregar">
        Agregar Producto
    </button>
  </div>

<!-- Tabla del sistema-->
  <div id="contenedor-tabla" class="container table-responsive mt-3">
      <table id="producto-tabla" class="table" cellspacing="0">
          <thead class="bg-success text-light">
            <tr>
              <th scope="col" width="10%"></th>
              <th scope="col" width="5%">#</th>
              <th scope="col" width="15%">Nombre</th>
              <th scope="col" width="5%">Cantidad</th>
              <th scope="col" width="5%">Precio Mayorista</th>
              <th scope="col" width="5%">Precio Normal</th>
              <th scope="col" width="5%">Costo</th>
              <th scope="col" width="10%">Rang Inf</th>
              <th scope="col" width="10%">Rango Sup</th>
              <th scope="col" width="10%">Minimo</th>
              <th scope="col" width="10%">Subcategoria</th>
              <th scope="col" width="10%">Ingrediente</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
      </table>
  </div>

  <!-- Modal Agregar y Actualizar -->
  <div class="modal fade" id="producto-modal-agregar" tabindex="-1" role="dialog" aria-labelledby="titulo-modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="titulo-modal-agregar">Agregar Producto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
         <!-- Formulario de Subcategoria -->
         <form id="producto-formulario">
          <div class="container-fluid">
            <div class="form-group">
              <label for="producto-nombre">Nombre</label>
              <input type="text" class="form-control" id="producto-nombre" aria-describedby="nombre-ayuda" placeholder="Escriba Nombre">
              <small id="nombre-ayuda" class="form-text text-muted">Obligatorio.</small>
            </div>
       
              <div class="form-group">
              <label for="producto-cantidad">Cantidad</label>
              <input type="number" class="form-control" id="producto-cantidad" aria-describedby="nombre-ayuda" placeholder="Escriba cantidad">
              </div>
              <div class="form-group">
              <label for="producto-mayorista">Precio Mayorista</label>
              <input type="number" class="form-control" id="producto-mayorista" aria-describedby="nombre-ayuda" placeholder="Escriba precio">
              </div>
              <div class="form-group">
              <label for="producto-normal">Precio Normal</label>
              <input type="number" class="form-control" id="producto-normal" aria-describedby="nombre-ayuda" placeholder="Escriba precio">
              </div>
              <div class="form-group">
              <label for="producto-costo">Costo</label>
              <input type="number" class="form-control" id="producto-costo" aria-describedby="nombre-ayuda" placeholder="Escriba costo">
              </div>
              
              <div class="form-group">
              <label for="producto-inferior">Rango Inferior</label>
              <input type="number" class="form-control" id="producto-inferior" aria-describedby="nombre-ayuda" placeholder="Escriba rango inferior">
              </div>
              <div class="form-group">
              <label for="producto-superior">Rango Superior</label>
              <input type="number" class="form-control" id="producto-superior" aria-describedby="nombre-ayuda" placeholder="Escriba rango superior">
              </div>
              <div class="form-group">
              <label for="producto-minimo">Minimo</label>
              <input type="number" class="form-control" id="producto-minimo" aria-describedby="nombre-ayuda" placeholder="Escriba cantidad minima">
              </div>

			<div class="form-group">
              <label for="producto-categoria">Seleccione Categoria</label>
              <select id="producto-categoria" class="form-control custom-select">
              <option value=""></option></select>
            </div>

            <div class="form-group">
              <label for="producto-subcategoria">Seleccione SubCategoria</label>
              <select id="producto-subcategoria" class="form-control custom-select"></select>
            </div>
            
            
            <div class="form-group">
              <label for="producto-ingrediente">Seleccione Ingrediente</label>
              <select id="producto-ingrediente" class="form-control custom-select"></select>
            </div>
              
	
        
          </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="button" id="producto-button-agregar" class="btn btn-primary">Guardar</button>
              <button type="button" id="producto-button-actualizar" class="btn btn-success">Actualizar</button>
            </div>
          </form>
          <!-- Fin del Formulario -->
        </div>
      </div>
    </div>
  </div>
</div>

  <!-- Modal Eliminar -->
  <div class="modal fade" id="producto-modal-eliminar" tabindex="-1" role="dialog" aria-labelledby="titulo-modal" aria-hidden="true">
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
            <p>Deseas eliminar el producto: <label id="info_nombre" class="text-danger"></label></p> 
          <!-- Fin del mensaje eliminación -->
        </div>
        <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
           <button type="button" id="producto-button-eliminar" class="btn btn-danger">Eliminar</button>
          </div>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>
