<?php 
/*
*Template Name: Page Cliente
*/
?>
<?php get_header(); ?>
<div class="container mt-3 mb-3">
  <div class="container-fluid mt-3">
    <!-- Button trigger modal -->
    <button type="button" id="pedidos-button-agregar-activa" class="btn btn-primary" data-toggle="modal" data-target="#pedidos-modal-agregar">
        Agregar Pedido
    </button>
  </div>

<!-- Tabla del sistema-->
  <div id="contenedor-tabla" class="container table-responsive mt-3">
      <table id="pedidos-tabla" class="table" cellspacing="0">
          <thead class="bg-success text-light">
            <tr>
              <th scope="col" width="10%"></th>
              <th scope="col" width="5%">#</th>
              <th scope="col" width="15%">Fecha Pedido</th>
              <th scope="col" width="15%">Total</th>
              <th scope="col" width="25%">Cliente</th>
              <th scope="col" width="5%">Credito Contado</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
      </table>
  </div>


  <!-- Modal Agregar y Actualizar-->
  <div class="modal fade" id="pedidos-modal-agregar" tabindex="-1" role="dialog" aria-labelledby="titulo-modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="titulo-modal-agregar">Agregar Pedido</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
         <!-- Formulario de Cliente -->
         <form id="pedidos-formulario">
          <div class="container-fluid">
            <div class="form-group">
              <label for="pedidos-fecha">Fecha del Pedido</label>
              <input type="date" class="form-control" id="pedidos-fecha" aria-describedby="fecha-ayuda" placeholder="Seleccione la Fecha del pedido">
              <small id="fecha-ayuda" class="form-text text-muted">Obligatorio.</small>
            </div>
            <div class="form-group">
              <label for="pedidos-total">Costo Total del Pedido</label>
              <div class="input-group">
                <div class="input-group-addon">Q</div>
                <input type="number" class="form-control" id="pedidos-total" aria-describedby="total-ayuda" value=0 placeholder="Escriba un Total">
                <div class="input-group-addon">.00</div>
              </div>
              <small id="total-ayuda" class="form-text text-muted">Obligatorio y solo número.</small>
            </div>
            <div class="form-group">
              <label for="pedidos-cliente">Cliente</label>
              <input type="text" class="form-control" id="pedidos-cliente" aria-describedby="cliente-ayuda" placeholder="Seleccione un Cliente">
              <small id="cliente-ayuda" class="form-text text-muted">Obligatorio.</small>
            </div>
            <div class="form-group">
              <label for="pedidos-credito">Seleccione un Modo de Pago</label>
              <select id="pedidos-credito" class="form-control custom-select">
                <option value="0">Contado</option>
                <option value="1">Credito</option>
              </select>
            </div>
          </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="button" id="pedidos-button-agregar" class="btn btn-primary">Guardar</button>
              <button type="button" id="pedidos-button-actualizar" class="btn btn-success">Actualizar</button>
            </div>
          </form>
          <!-- Fin del Formulario -->
        </div>
      </div>
    </div>
  </div>
</div>

  <!-- Modal Eliminar -->
  <div class="modal fade" id="pedidos-modal-eliminar" tabindex="-1" role="dialog" aria-labelledby="titulo-modal" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="titulo-modal">Eliminar Pedido</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
         <!-- mensaje de eliminación -->
            <h5>Codigo: <label id="info_codigo"></label></h5>
            <p>Desea eliminar el Pedido <label id="info_nombre" class="text-danger"></label></p> 
          <!-- Fin del mensaje eliminación -->
        </div>
        <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
           <button type="button" id="pedidos-button-eliminar" class="btn btn-danger">Eliminar</button>
          </div>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>