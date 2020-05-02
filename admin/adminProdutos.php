<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style_chocolate.css">
    <link rel="stylesheet" href="/admin/adminPedidos.php">
    <link rel="stylesheet" href="/admin/adminProdutos.php"> 
    <link rel="stylesheet" href="/admin/adminCategoria.php"> 
    <link rel="stylesheet" href="/admin/adminClientes.php"> 
    <link rel="stylesheet" href="/admin/categoria.php"> 
    <link rel="stylesheet" href="/admin/login.php"> 
    <link rel="stylesheet" href="/admin/index.php"> 
  
    
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
    
    <nav class="navbar navbar-expand-sm navbar-light bg-light navHomeAdmin">
      <div class="container-fluid">
        <a class="navbar-brand" href="/admin/index.php"> <img src="/admin/imagem/logo.png" class="logoHome float-left d-block" ></a>
        <div class="nav navbar menu">
          <ul class="navbar-nav ">
            <li class="nav-item pr-4 menuList">
              <a class="nav-link" href="/admin/adminCategoria.php">Categoria</a>
            </li>
            <li class="nav-item pr-4 menuList">
              <a class="nav-link" href="/admin/adminProdutos.php">Produtos</a>
            </li>
            <li class="nav-item pr-4 menuList">
              <a class="nav-link" href="/admin/adminPedidos.php">Pedidos</a>
            </li>
            <li class="nav-item pr-4 menuList">
                <a class="nav-link" href="/admin/adminClientes.php">Clientes</a>
            </li>
            <li class="dropdown float-right menuList ">
              <a class="nav-link" type="text" id="dropdownMenuButton" role="botton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="d-inline">
                <i class="fa fa-user-o"></i>                              
                <span >Flavia</span>
                </div>
              </a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="">Administrador</a>
                <a class="dropdown-item" href="">Alterar</a>
                <a class="dropdown-item" href="">Sair</a>
              </div>
            </li>                           
          
          </ul>
        </div>
      </div>
    </nav>

      
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item itemBC"><a href="/admin/index.php" class="">Admin</a></li>
          <li class="breadcrumb-item active" aria-current="page">Produtos</li>
        </ol>
    </nav>

    

   <!-- Optional JavaScript -->
   <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   <script src="/assets/js/jquery-3.4.1.slim.js"></script>
   <script src="/assets/js/popper.js"></script>
   <script src="/assets/js/bootstrap.js"></script>
  
 </body>
</html>