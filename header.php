<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cremeria</title>
    <?php wp_head(); ?>

</head>
<body>
<!-- header -->
    <div class="container-fluid bg-dark">
        <nav class="navbar navbar-expand-lg navbar-dark container">
            <a class="navbar-brand" href="#">Logo</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu -->
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <ul class="navbar-nav ml-auto text-center">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo get_permalink( get_page_by_title( 'Ruta' ) )  ?>">Ruta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo get_permalink( get_page_by_title( 'Finca' ) )  ?>">Finca</a>
                    </li>
                     <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           Leche
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="<?php echo get_permalink( get_page_by_title( 'Compra' ) )  ?>">Compra</a>
                            <a class="dropdown-item" href="<?php echo get_permalink( get_page_by_title( 'Calidad' ) )  ?>">Calidad</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           Inventario Productos
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2">
                            <a class="dropdown-item" href="<?php echo get_permalink( get_page_by_title( 'Producto' ) )  ?>">Producto</a>
                            <a class="dropdown-item" href="<?php echo get_permalink( get_page_by_title( 'Ingrediente' ) )  ?>">Ingrediente</a>
                            <a class="dropdown-item" href="<?php echo get_permalink( get_page_by_title( 'Categoria' ) )  ?>">Categoría</a>
                            <a class="dropdown-item" href="<?php echo get_permalink( get_page_by_title( 'Subcategoria' ) )  ?>">Sub Categoría</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           Consumidor
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink3">
                            <a class="dropdown-item" href="<?php echo get_permalink( get_page_by_title( 'Cliente' ) )  ?>">Cliente</a>
                            <a class="dropdown-item" href="<?php echo get_permalink( get_page_by_title( 'Pedidos' ) )  ?>">Pedido</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo get_permalink( get_page_by_title( 'Cliente' ) )  ?>">Clientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo get_permalink( get_page_by_title( 'Pedidos' ) )  ?>">Pedido</a>
                    </li>
                </ul>
             </div>
             <!-- Fin del menu -->
             <?php /*wp_nav_menu( array(
                 'theme_location' => 'menu_principal',
                 'container' =>  'div',
                 'container_class' => 'collapse navbar-collapse',
                 'container_id' => 'navbarNavAltMarkup',
                 'items_wrap' => '<ul class="navbar-nav ml-auto text-center">%3$s</ul>',
                 'menu_class' => 'nav-item',
                 'walker' => new WP_Bootstrap_Navwalker()
             ) );*/ ?>

        </nav>
    </div>

    <div class="container-fluid banner d-flex flex-column justify-content-center align-items-center">
        <div class="text-center">
            <h1 class="display-4">FABRICA PRODCUTOS LACTEOS BETHEL</h1>
        </div>
    </div>
<!-- fin de header -->
