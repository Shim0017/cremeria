<?php 

// importando los modelos a usar en la base de datos
require_once 'modelo/finca.php';
require_once 'modelo/ruta.php';
require_once 'modelo/ingrediente.php';
require_once 'modelo/categoria.php';
require_once 'modelo/subcategoria.php';
require_once 'modelo/producto.php';
require_once 'modelo/calidad.php';
require_once 'modelo/compra.php';
require_once 'modelo/cliente.php';
require_once 'modelo/pedidos.php';

//incluir las vistas manualmente
function template( $template ) {
    
       // if the page has the slug contact-us
       // use the conditional tag is_page()
       if( is_page('Finca') ){
            if ( $new_template = locate_template( array( 'vistas/finca.php' ) ) )
                return $new_template ;
        }elseif ( is_page('Ruta') ) {
            if ( $new_template = locate_template( array( 'vistas/ruta.php' ) ) )
                return $new_template ;
        }elseif ( is_page('Compra') ) {
            if ( $new_template = locate_template( array( 'vistas/compra.php' ) ) )
                return $new_template ;
        }elseif ( is_page('Calidad') ) {
            if ( $new_template = locate_template( array( 'vistas/calidad.php' ) ) )
                return $new_template ;
        }elseif ( is_page('Ingrediente') ) {
            if ( $new_template = locate_template( array( 'vistas/ingrediente.php' ) ) )
                return $new_template ;
        }elseif ( is_page('Categoria') ) {
            if ( $new_template = locate_template( array( 'vistas/categoria.php' ) ) )
                return $new_template ;
        }elseif ( is_page('Subcategoria') ) {
            if ( $new_template = locate_template( array( 'vistas/subcategoria.php' ) ) )
                return $new_template ;
        }elseif ( is_page('Producto') ) {
            if ( $new_template = locate_template( array( 'vistas/producto.php' ) ) )
                return $new_template ;
        }elseif ( is_page('Cliente') ) {
            if ( $new_template = locate_template( array( 'vistas/cliente.php' ) ) )
                return $new_template ;
        }elseif ( is_page('Pedidos') ) {
            if ( $new_template = locate_template( array( 'vistas/pedidos.php' ) ) )
                return $new_template ;
        }
       return $template;
   }
   add_filter('template_include', 'template');

// Register Custom Navigation Walker
require_once get_template_directory() . '/wp-bootstrap-navwalker.php';

// Agregando el menú dinamico
if (function_exists('register_nav_menus')) {
    register_nav_menus( array( 'menu_principal' => 'Menu principal') );
}

// Para agregar a un ancla <a> del menú un estilo
function class_ancla_menu($atts, $item, $args){
    
    $atts['class'] = 'nav-link';

    return $atts;
}
add_filter('nav_menu_link_attributes','class_ancla_menu',10,3);

// Cargar estilos y javascript
    function cargar_estilos(){
        wp_enqueue_style( 'style', get_stylesheet_uri() );
        wp_enqueue_style( 'bootstrap_css', get_template_directory_uri() . '/css/bootstrap.min.css',false,'4.0.0-beta.2','all');
        wp_enqueue_style( 'awesome_css', get_template_directory_uri() . '/css/font-awesome.min.css',false,'','all');
        

        // cargar datatable
        wp_enqueue_style( 'datatable_css', get_template_directory_uri() . '/css/datatables.min.css',false,'','all');
    }
    add_action('wp_enqueue_scripts','cargar_estilos');

    function cargar_jquery() {
        wp_deregister_script( 'jquery' );
        wp_register_script( 'jquery',  get_template_directory_uri() . '/js/jquery.min.js');
    
    }    
    add_action('init', 'cargar_jquery');

    function cargar_datatables_javascript(){
        wp_enqueue_script( 'datatable_javascript', get_template_directory_uri() . '/js/datatables.min.js', array ( 'jquery' ), '', true);
    }
    add_action('init', 'cargar_datatables_javascript');

    function cargar_javascript(){
        wp_enqueue_script( 'popper', get_template_directory_uri() . '/js/popper.min.js', array ( 'jquery' ), '', true);
        wp_enqueue_script( 'bootstrap_javascript', get_template_directory_uri() . '/js/bootstrap.min.js', array ( 'jquery','popper' ), '', true);
    }
    add_action('wp_enqueue_scripts','cargar_javascript');

    /* AQUI VA LOS CONTROLADORES Y SU LLAMADOS A LA DB*/

    function cargar_javascript_crud(){
        // cargar cotroladores
        if( is_page('Finca') ){
            wp_enqueue_script('script-ajax', get_template_directory_uri() . '/controlador/finca.js',   array ( 'jquery' ), 1.0 ,true);
        }elseif ( is_page('Ruta') ) {
            wp_enqueue_script('script-ajax', get_template_directory_uri() . '/controlador/ruta.js', array ( 'jquery' ), 1.0 ,true);
        }elseif ( is_page('Compra') ) {
            wp_enqueue_script('script-ajax', get_template_directory_uri() . '/controlador/compra.js', array ( 'jquery' ), 1.0 ,true);
        }elseif ( is_page('Calidad') ) {
            wp_enqueue_script('script-ajax', get_template_directory_uri() . '/controlador/calidad.js', array ( 'jquery' ), 1.0 ,true);
        }elseif ( is_page('Ingrediente') ) {
            wp_enqueue_script('script-ajax', get_template_directory_uri() . '/controlador/ingrediente.js', array ( 'jquery' ), 1.0 ,true);
        }elseif ( is_page('Categoria') ) {
            wp_enqueue_script('script-ajax', get_template_directory_uri() . '/controlador/categoria.js', array ( 'jquery' ), 1.0 ,true);
        }elseif ( is_page('Subcategoria') ) {
            wp_enqueue_script('script-ajax', get_template_directory_uri() . '/controlador/subcategoria.js', array ( 'jquery' ), 1.0 ,true);
        }elseif ( is_page('Producto') ) {
            wp_enqueue_script('script-ajax', get_template_directory_uri() . '/controlador/producto.js', array ( 'jquery' ), 1.0 ,true);
        }elseif ( is_page('Cliente') ) {
            wp_enqueue_script('script-ajax', get_template_directory_uri() . '/controlador/cliente.js', array ( 'jquery' ), 1.0 ,true);
        }elseif ( is_page('Pedidos') ) {
            wp_enqueue_script('script-ajax', get_template_directory_uri() . '/controlador/pedidos.js', array ( 'jquery' ), 1.0 ,true);
        }
        
        // cargar ajax
        wp_localize_script( 'script-ajax', 'ajax', array( 'url' => admin_url( 'admin-ajax.php' ) ) );
    }
    add_action('template_redirect','cargar_javascript_crud');

    // Cargar las funciones del controlador
    function crud_finca_callback() {
        
        /**
         * $opciones
         * 1: Crear
         * 2: Eliminar
         * 3: Actualizar
         * 4: Ver
         * 5: Buscar
         * 6: Llenar Combobox ruta finca
         */
        $opcion = $_POST['opcion'];
        
        if($opcion == 1){
            
            $nombre = $_POST['nombre'];
            $encargado = $_POST['encargado'];
            $direccion = $_POST['direccion'];
            $distancia = $_POST['distancia'];
            $telefono = $_POST['telefono'];
            $hora = $_POST['hora'];
            $ruta = $_POST['ruta'];
    
            //Aunque el content-type no sea un problema en la mayoría de casos, es recomendable especificarlo
            //header('Content-type: application/json; charset=utf-8');
            echo json_encode(agregar_finca($nombre,$encargado,$direccion,$distancia,$telefono,$hora,$ruta));
            die(); // Siempre hay que terminar con die
        }elseif ($opcion == 2) {

            $idfinca = $_POST['idfinca'];

            echo json_encode(eliminar_finca($idfinca));
            die();
        }elseif ($opcion == 3) {
            echo json_encode(agregar_finca($nombre,$encargado,$direccion,$distancia,$telefono,$hora,$ruta));
            die(); // Siempre hay que terminar con die
        }elseif ($opcion == 4) {
            echo json_encode(ver_finca());
            die();
        }elseif ($opcion == 5) {
            echo json_encode(ver_finca());
            die();
        }elseif ($opcion == 6) {
            echo json_encode(llenar_ruta_finca());
            die();
        }
        
      
      }
      add_action('wp_ajax_crud_finca', 'crud_finca_callback');
      add_action('wp_ajax_nopriv_crud_finca', 'crud_finca_callback');

    // Cargar las funciones del controlador
    function crud_ruta_callback() {
        
        /**
         * $opciones
         * 1: Crear
         * 2: Eliminar
         * 3: Actualizar
         * 4: Ver
         * 5: Buscar
         */
        $opcion = $_POST['opcion'];
        
        if($opcion == 1){
            
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
    
            //Aunque el content-type no sea un problema en la mayoría de casos, es recomendable especificarlo
            //header('Content-type: application/json; charset=utf-8');
            echo json_encode(agregar_ruta($nombre,$descripcion));
            die(); // Siempre hay que terminar con die
        }elseif ($opcion == 2) {

            $idruta = $_POST['idruta'];

            echo json_encode(eliminar_ruta($idruta));
            die();
        }elseif ($opcion == 3) {

            $idruta = $_POST['idruta'];
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];

            echo json_encode(actualizar_ruta($idruta, $nombre, $descripcion));
            die();
        }elseif ($opcion == 4) {
            echo json_encode(ver_ruta());
            die();
        }elseif ($opcion == 5) {
            echo json_encode(buscar_ruta($idruta));
            die();
        }
        
      
      }
      add_action('wp_ajax_crud_ruta', 'crud_ruta_callback');
      add_action('wp_ajax_nopriv_crud_ruta', 'crud_ruta_callback');

  
    // Cargar las funciones del controlador
    function crud_ingrediente_callback() {
        
        /**
         * $opciones
         * 1: Crear
         * 2: Eliminar
         * 3: Actualizar
         * 4: Ver
         */
        $opcion = $_POST['opcion'];
        
        if($opcion == 1){
            
            $nombre = $_POST['nombre'];
            $costo = $_POST['costo'];
    
            //Aunque el content-type no sea un problema en la mayoría de casos, es recomendable especificarlo
            //header('Content-type: application/json; charset=utf-8');
            echo json_encode(agregar_ingrediente($nombre,$costo));
            die(); // Siempre hay que terminar con die
        }elseif ($opcion == 2) {

            $idingrediente = $_POST['idingrediente'];

            echo json_encode(eliminar_ingrediente($idingrediente));
            die();
        }elseif ($opcion == 3) {
            $idingrediente = $_POST['idingrediente'];
			$nombre = $_POST['nombre'];
            $costo = $_POST['costo'];
            echo json_encode(modificar_ingrediente($idingrediente,$nombre,$costo));
            die();
        }elseif ($opcion == 4) {
            $aray["hola"] = "prueba";
            $aray["hola1"] = "prueba2";
            echo json_encode(ver_ingrediente());
            die();
        }
        
      
      }
      add_action('wp_ajax_crud_ingrediente', 'crud_ingrediente_callback');
      add_action('wp_ajax_nopriv_crud_ingrediente', 'crud_ingrediente_callback');
      
      
      
       // Cargar las funciones del controlador
    function crud_categoria_callback() {
        
        /**
         * $opciones
         * 1: Crear
         * 2: Eliminar
         * 3: Actualizar
         * 4: Ver
         */
        $opcion = $_POST['opcion'];
        
        if($opcion == 1){
            
            $nombre = $_POST['nombre'];
           // $costo = $_POST['costo'];
    
            //Aunque el content-type no sea un problema en la mayoría de casos, es recomendable especificarlo
            //header('Content-type: application/json; charset=utf-8');
            echo json_encode(agregar_categoria($nombre));
            die(); // Siempre hay que terminar con die
        }elseif ($opcion == 2) {

            $idcategoria = $_POST['idcategoria'];

            echo json_encode(eliminar_categoria($idcategoria));
            die();
        }elseif ($opcion == 3) {
            $idcategoria = $_POST['idcategoria'];
			$nombre = $_POST['nombre'];
         //   $costo = $_POST['costo'];
            echo json_encode(modificar_categoria($idcategoria,$nombre));
            die();
        }elseif ($opcion == 4) {
            echo json_encode(ver_categoria());
            die();
        }
        
      
      }
      add_action('wp_ajax_crud_categoria', 'crud_categoria_callback');
      add_action('wp_ajax_nopriv_crud_categoria', 'crud_categoria_callback');
      
      
    
    
          
       // Cargar las funciones del controlador
    function crud_subcategoria_callback() {
        
        /**
         * $opciones
         * 1: Crear
         * 2: Eliminar
         * 3: Actualizar
         * 4: Ver
         */
        $opcion = $_POST['opcion'];
        
        if($opcion == 1){
            
            $nombre = $_POST['nombre'];
            $categoria = $_POST['categoria_idcategoria'];
    
            //Aunque el content-type no sea un problema en la mayoría de casos, es recomendable especificarlo
            //header('Content-type: application/json; charset=utf-8');
            echo json_encode(agregar_subcategoria($nombre,$categoria));
            die(); // Siempre hay que terminar con die
        }elseif ($opcion == 2) {

            $idsubcategoria = $_POST['idcategoria'];

            echo json_encode(eliminar_subcategoria($idsubcategoria));
            die();
        }elseif ($opcion == 3) {
            $idsubcategoria = $_POST['idcategoria'];
			$nombre = $_POST['nombre'];
       $categoria_idcategoria = $_POST['categoria_idcategoria'];
            echo json_encode(modificar_subcategoria($idsubcategoria,$nombre,$categoria_idcategoria));
            die();
        }elseif ($opcion == 4) {
            echo json_encode(ver_subcategoria());
            die();
        }elseif ($opcion == 5) {
            echo json_encode(llenar_categoria_subcategoria());
            die();
        }
        
      
      }
      add_action('wp_ajax_crud_subcategoria', 'crud_subcategoria_callback');
      add_action('wp_ajax_nopriv_crud_subcategoria', 'crud_subcategoria_callback');
      
      
    
      
           
       // Cargar las funciones del controlador
    function crud_producto_callback() {
        
        /**
         * $opciones
         * 1: Crear
         * 2: Eliminar
         * 3: Actualizar
         * 4: Ver
         */
        $opcion = $_POST['opcion'];
        
        if($opcion == 1){
            
            $nombre = $_POST['nombre'];
            $cantidad = $_POST['cantidad'];
            $mayorista = $_POST['mayorista'];
            $normal = $_POST['normal'];
            $costo = $_POST['costo'];
            $inferior = $_POST['inferior'];
            $superior = $_POST['superior'];
            $minimo = $_POST['minimo'];
            $subcategoria = $_POST['subcategoria'];
            $ingrediente = $_POST['ingrediente_idingrediente'];
    
            //Aunque el content-type no sea un problema en la mayoría de casos, es recomendable especificarlo
            //header('Content-type: application/json; charset=utf-8');
            echo json_encode(agregar_producto($nombre,$cantidad,$mayorista,$normal,$costo,$inferior,$superior,$minimo,$subcategoria,$ingrediente));
            die(); // Siempre hay que terminar con die
        }elseif ($opcion == 2) {

            $idproducto = $_POST['idcategoria'];

            echo json_encode(eliminar_producto($idproducto));
            die();
        }elseif ($opcion == 3) {
            $idproducto = $_POST['idproducto'];
      $nombre = $_POST['nombre'];
            $cantidad = $_POST['cantidad'];
            $mayorista = $_POST['mayorista'];
            $normal = $_POST['normal'];
            $costo = $_POST['costo'];
            $inferior = $_POST['inferior'];
            $superior = $_POST['superior'];
            $minimo = $_POST['minimo'];
            $subcategoria = $_POST['subcategoria'];
            $ingrediente = $_POST['ingrediente_idingrediente'];
            echo json_encode(modificar_producto($idproducto,$nombre,$cantidad,$mayorista,$normal,$costo,$inferior,$superior,$minimo,$subcategoria,$ingrediente));
            die();
        }elseif ($opcion == 4) {
            echo json_encode(ver_producto());
            die();
        }elseif ($opcion == 5) {
            echo json_encode(llenar_categoria_subcategoria_producto());
            die();
        }elseif ($opcion == 6) {
			$categoria = $_POST['categoria_idcategoria'];
            echo json_encode(llenar_subcategoria_producto($categoria));
            die();
        }elseif ($opcion == 7) {
            echo json_encode(llenar_ingrediente_producto());
            die();
        }
        
      
      }
      add_action('wp_ajax_crud_producto', 'crud_producto_callback');
      add_action('wp_ajax_nopriv_crud_producto', 'crud_producto_callback');
      
      
       
       // Cargar las funciones del controlador
    function crud_calidad_callback() {
        
        /**
         * $opciones
         * 1: Crear
         * 2: Eliminar
         * 3: Actualizar
         * 4: Ver
         */
        $opcion = $_POST['opcion'];
        
        if($opcion == 1){
            
            $nombre = $_POST['nombre'];
           // $costo = $_POST['costo'];
    
            //Aunque el content-type no sea un problema en la mayoría de casos, es recomendable especificarlo
            //header('Content-type: application/json; charset=utf-8');
            echo json_encode(agregar_calidad($nombre));
            die(); // Siempre hay que terminar con die
        }elseif ($opcion == 2) {

            $idcalidad = $_POST['idcalidad'];

            echo json_encode(eliminar_calidad($idcalidad));
            die();
        }elseif ($opcion == 3) {
            $idcalidad = $_POST['idcalidad'];
			$nombre = $_POST['nombre'];
         //   $costo = $_POST['costo'];
            echo json_encode(modificar_calidad($idcalidad,$nombre));
            die();
        }elseif ($opcion == 4) {
            echo json_encode(ver_calidad());
            die();
        }
        
      
      }
      add_action('wp_ajax_crud_calidad', 'crud_calidad_callback');
      add_action('wp_ajax_nopriv_crud_calidad', 'crud_calidad_callback');
      
      
      
           // Cargar las funciones del controlador
    function crud_compra_callback() {
        
        /**
         * $opciones
         * 1: Crear
         * 2: Eliminar
         * 3: Actualizar
         * 4: Ver
         */
        $opcion = $_POST['opcion'];
        
        if($opcion == 1){
            
            $cantidad = $_POST['cantidad'];
            $costo = $_POST['costo'];
            $fecha = $_POST['fecha_recibido'];
            $observacion = $_POST['observacion'];
            $existente = $_POST['cantidad_existente'];
            $finca = $_POST['finca_idfinca'];
      
    
            //Aunque el content-type no sea un problema en la mayoría de casos, es recomendable especificarlo
            //header('Content-type: application/json; charset=utf-8');
            echo json_encode(agregar_compra($cantidad,$costo,$fecha,$observacion,$existente,$finca));
            die(); // Siempre hay que terminar con die
        }elseif ($opcion == 2) {

            $idcompra = $_POST['idcategoria'];

            echo json_encode(eliminar_compra($idcompra));
            die();
        }elseif ($opcion == 3) {
            $idcompra = $_POST['idcompra'];
			$cantidad = $_POST['cantidad'];
            $costo = $_POST['costo'];
            $fecha = $_POST['fecha_recibido'];
            $observacion = $_POST['observacion'];
            $existente = $_POST['cantidad_existente'];
            $finca = $_POST['finca_idfinca'];
            echo json_encode(modificar_compra($idcompra,$cantidad,$costo,$fecha,$observacion,$existente,$finca));
            die();
        }elseif ($opcion == 4) {
            echo json_encode(ver_compra());
            die();
        }elseif ($opcion == 5) {
            echo json_encode(llenar_ruta_finca_compra());
            die();
        }elseif ($opcion == 6) {
			$ruta = $_POST['ruta_idruta'];
            echo json_encode(llenar_finca_compra($ruta));
            die();
        }elseif ($opcion == 7) {
            echo json_encode(llenar_ingrediente_compra());
            die();
        }elseif ($opcion == 8){
            $idcalidad = $_POST['idcalidad'];
			$idcompra = $_POST['idcompra'];
            $porcentaje = $_POST['porcentaje'];
            echo json_encode(insertar_detalle_calidad($idcalidad,$idcompra,$porcentaje));
            die();           
        }elseif ($opcion == 9){
			$idcompra = $_POST['idcompra'];
            echo json_encode(ver_detalle_calidad($idcompra));
            die(); 
        }
      
      }
      add_action('wp_ajax_crud_compra', 'crud_compra_callback');
      add_action('wp_ajax_nopriv_crud_compra', 'crud_compra_callback');

       // Cargar las funciones del controlador
    function crud_cliente_callback() {
        
        /**
         * $opciones
         * 1: Crear
         * 2: Eliminar
         * 3: Actualizar
         * 4: Ver
         * 5: Buscar
         * 6: Llenar Combobox ruta finca
         */
        $opcion = $_POST['opcion'];
        
        if($opcion == 1){
            
            $nombre = $_POST['nombre'];
            $direccion = $_POST['direccion'];
            $telefono = $_POST['telefono'];
            $limitecredito = $_POST['limitecredito'];
            $tipocliente = $_POST['tipocliente'];

    
            //Aunque el content-type no sea un problema en la mayoría de casos, es recomendable especificarlo
            //header('Content-type: application/json; charset=utf-8');
            echo json_encode(agregar_cliente($nombre,$direccion,$telefono,$tipocliente,$limitecredito));
            die(); // Siempre hay que terminar con die
        }elseif ($opcion == 2) {

            $idcliente = $_POST['idcliente'];

            echo json_encode(eliminar_cliente($idcliente));
            die();
        }elseif ($opcion == 3) {

            $idcliente = $_POST['idcliente'];
            $nombre = $_POST['nombre'];
            $direccion = $_POST['direccion'];
            $telefono = $_POST['telefono'];
            $limitecredito = $_POST['limitecredito'];
            $tipocliente = $_POST['tipocliente'];

            echo json_encode(actualizar_cliente($idcliente,$nombre,$direccion,$telefono,$tipocliente, $limitecredito));
            die(); // Siempre hay que terminar con die
        }elseif ($opcion == 4) {
            echo json_encode(ver_cliente());
            die();
        }
      }
      add_action('wp_ajax_crud_cliente', 'crud_cliente_callback');
      add_action('wp_ajax_nopriv_crud_cliente', 'crud_cliente_callback');

      function crud_pedidos_callback() {
        
        /**
         * $opciones
         * 1: Crear
         * 2: Eliminar
         * 3: Actualizar
         * 4: Ver
         * 5: Buscar
         * 6: Llenar Combobox ruta finca
         */
        $opcion = $_POST['opcion'];
        
        if($opcion == 1){
            
            $fecha = $_POST['fecha'];
            $total = $_POST['total'];
            $cliente = $_POST['cliente'];
            $credito = $_POST['credito'];

    
            //Aunque el content-type no sea un problema en la mayoría de casos, es recomendable especificarlo
            //header('Content-type: application/json; charset=utf-8');
            echo json_encode(agregar_pedidos($fecha,$total,$cliente,$credito));
            die(); // Siempre hay que terminar con die
        }elseif ($opcion == 2) {

            $idpedidos = $_POST['idpedidos'];

            echo json_encode(eliminar_pedidos($idpedidos));
            die();
        }elseif ($opcion == 3) {

            $idpedidos = $_POST['idpedidos'];
            $fecha = $_POST['fecha'];
            $total = $_POST['total'];
            $cliente = $_POST['cliente'];
            $credito = $_POST['credito'];

            echo json_encode(actualizar_pedidos($idpedidos,$fecha,$total,$cliente,$credito));
            die(); // Siempre hay que terminar con die
        }elseif ($opcion == 4) {
            $prueba['hoola'] = "nanana";
            $prueba['hoola'] = "nanana";
            echo json_encode(ver_pedidos());
            die();
        }
      }
      add_action('wp_ajax_crud_pedidos', 'crud_pedidos_callback');
      add_action('wp_ajax_nopriv_crud_pedidos', 'crud_pedidos_callback');

      
      
?>