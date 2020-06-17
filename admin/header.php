<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="/admin/style_chocolate.css">
        
   <!--chart.js-->
  
   <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script> 
  
   <!--Icons-->

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

   <!-- Fonts-->
   <link href="https://fonts.googleapis.com/css?family=Comic+Neue:400,700&display=swap" rel="stylesheet">
     <!--font-family: 'Comic Neue', cursive; -->

    <title>Administrador</title>
 
  </head>
 
 
  <body>    
  <div class="container-fluid p-0">  
    <nav class="navbar navbar-expand-md navbar-light bg-light navHomeAdmin">      
          <a class="navbar-brand" href="/admin"> 
            <img src="/admin/imagem/logo.png" class="logoHome float-left d-block" >
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#barraMenu">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse " id="barraMenu">
              <ul class="navbar-nav ml-auto ">
                 <li class="nav-item pr-2 menuList">
                   <a class="nav-link" href="/admin/adminCategoria.php">Categorias</a>
                 </li>
                 <li class="nav-item pr-2 menuList">
                   <a class="nav-link" href="/admin/adminProdutos.php">Produtos</a>
                 </li>
                 <li class="nav-item pr-2 menuList">
                   <a class="nav-link" href="/admin/adminPedidos.php">Pedidos</a>
                 </li>
                 <li class="nav-item pr-2 menuList">
                     <a class="nav-link" href="/admin/adminClientes.php">Clientes</a>
                 </li>
                 <li class="nav-item dropdown w-50 menuList">
                    <a class="nav-link" type="text" id="dropdownMenuBtn" role="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <div class="d-inline"><i class="fa fa-user-o"></i>
                     <span >Flavia</span>
                     </div>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuBtn">
                     <a class="dropdown-item" href="">Administrador</a>
                     <a class="dropdown-item" href="">Alterar</a>
                     <div class="dropdown-divider"></div>
                     <a class="dropdown-item" href="">Sair</a>
                    </div>
                 </li>                           
              </ul>
          </div>
    </nav>
  </div>