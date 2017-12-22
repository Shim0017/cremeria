<?php 
/*
*Template Name: Page Cliente
*/
?>
<?php get_header(); ?>
<div class="container mt-3 mb-3">
  <div class="container-fluid mt-3">
    <!-- Button trigger modal -->
    <button type="button" id="cliente-button-agregar-activa" class="btn btn-primary" data-toggle="modal" data-target="#cliente-modal-agregar">
        Agregar Cliente
    </button>
  </div>

<!-- Tabla del sistema-->
  <div id="contenedor-tabla" class="container table-responsive mt-3">
      <table id="cliente-tabla" class="table" cellspacing="0">
          <thead class="bg-success text-light">
            <tr>
              <th scope="col" width="10%"></th>
              <th scope="col" width="5%">#</th>
              <th scope="col" width="15%">Nombre</th>
              <th scope="col" width="25%">Dirección</th>
              <th scope="col" width="5%">Telefono</th>
              <th scope="col" width="5%">Tipo de cliente</th>
              <th scope="col" width="5%">Limite de Credito</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
      </table>
  </div>


  <!-- Modal Agregar y Actualizar-->
  <div class="modal fade" id="cliente-modal-agregar" tabindex="-1" role="dialog" aria-labelledby="titulo-modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="titulo-modal-agregar">Agregar Finca</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
         <!-- Formulario de Cliente -->
         <form id="cliente-formulario">
          <div class="container-fluid">
            <div class="form-group">
              <label for="cliente-nombre">Nombre del Cliente</label>
              <input type="text" class="form-control" id="cliente-nombre" aria-describedby="nombre-ayuda" placeholder="Escriba el Nombre">
              <small id="nombre-ayuda" class="form-text text-muted">Obligatorio.</small>
            </div>
            <div class="form-group">
              <label for="cliente-direccion">Direccion</label>
              <input type="text" class="form-control" id="cliente-direccion" aria-describedby="direccion-ayuda" placeholder="Escriba la Direccion">
              <small id="direccion-ayuda" class="form-text text-muted">Obligatorio.</small>
            </div>
            <div class="form-group">
              <label for="cliente-telefono">Telefono</label>
              <input type="text" class="form-control" id="cliente-telefono" aria-describedby="telefono-ayuda" placeholder="Escriba el Telefono">
              <small id="telefono-ayuda" class="form-text text-muted">Obligatorio y solo número.</small>
            </div>
            <div class="form-group">
              <label for="cliente-limitecredito">Limite de Credito</label>
              <div class="input-group">
                <div class="input-group-addon">Q</div>
                <input type="number" class="form-control" id="cliente-limitecredito" aria-describedby="limitecredito-ayuda" value=0 placeholder="Escriba un limite de credito para el cliente">
                <div class="input-group-addon">.00</div>
              </div>
              <small id="limitecredito-ayuda" class="form-text text-muted">Obligatorio y solo número.</small>
            </div>
            <div class="form-group">
              <label for="cliente-tipocliente">Seleccione un Tipo de Cliente</label>
              <select id="cliente-tipocliente" class="form-control custom-select">
                <option value="0">Normal</option>
                <option value="1">Mayorista</option>
              </select>
            </div>
          </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="button" id="cliente-button-agregar" class="btn btn-primary">Guardar</button>
              <button type="button" id="cliente-button-actualizar" class="btn btn-success">Actualizar</button>
            </div>
          </form>
          <!-- Fin del Formulario -->
        </div>
      </div>
    </div>
  </div>
</div>

  <!-- Modal Eliminar -->
  <div class="modal fade" id="cliente-modal-eliminar" tabindex="-1" role="dialog" aria-labelledby="titulo-modal" aria-hidden="true">
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
            <p>Desea eliminar al Cliente: <label id="info_nombre" class="text-danger"></label></p> 
          <!-- Fin del mensaje eliminación -->
        </div>
        <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
           <button type="button" id="cliente-button-eliminar" class="btn btn-danger">Eliminar</button>
          </div>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>