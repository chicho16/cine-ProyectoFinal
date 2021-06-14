<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Cine Bella Vista</title>
        <link src="admin/assets/font-awesome/css/all.js"/>
        <script src="admin/assets/vendor/jquery/jquery.min.js"></script>
        <script src="admin/assets/font-awesome/js/all.js"></script>
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container">
                <!-- Logo en cabecera -->
                <img src="assets/img/logo1.png" alt="Cine_Logo" class="nav-brand">
                <a class="navbar-brand js-scroll-trigger" href="#page-top">Cine Bella Vista</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <!-- Acciones de los botones Home y Cartelera -->
                    <ul class="navbar-nav ml-auto my-2 my-lg-0">
                        <li class="nav-item"><a class="nav-link" href="index.php?page=home">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="index.php?page=cartelera">Cartelera</a></li>
                    </ul>
                </div>
            </div>
        </nav>      
       <?php
            
            $page = isset($_GET['page']) ? $_GET['page'] : 'home';
            include($page.'.php');
       ?>
        
        <!-- Footer Links -->
        <div class="footer-links">
            <div class="footer-container">               
                <ul>
                    <li>
                    <a href="#">
                        <h3>NOSOTROS</h3>
                    </a>
                    </li>
                    <li>
                    <a href="https://www.facebook.com">Conócenos</a>
                    </li>
                    <li>
                    <a href="#">Términos y condiciones</a>
                    </li>      
                </ul>
                <ul>
                    <li>
                    <a href="#">
                        <h3>PROGRAMACIÓN</h3>
                    </a>
                    </li>
                    <li>
                    <a href="index.php?page=cartelera">Cartelera</a>
                    </li>                    
                </ul>
                <ul>
                    <li>
                    <a href="#">
                        <h3>CONTACTO</h3>
                    </a>
                    </li>
                   
                    <li>
                    <a href="https://www.facebook.com">Consultas</a>
                    </li>
                    <li>
                    <a href="https://www.facebook.com">Trabaja con nosotros</a>
                    </li>       
                </ul>
            </div>
        </div>
        <!-- Footer-->
        <footer class="footer">
            <h3>Cine Bella Vista</h3>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
        <!-- Third party plugin JS-->
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
