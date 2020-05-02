<?php

// Instance data base connection
try {
  $connection = new PDO('mysql:host=mysql_app;dbname=app', 'root', 'secret');
  $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo 'ERROR: ' . $e->getMessage();
  exit;
}

// Prepare data base query
$statement = $connection->prepare("SELECT * FROM categories");

// Execute data base query
$statement->execute();


$categories = $statement->fetchAll();

?>
<!doctype html>
<html lang="en">
 <head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
   <link rel="stylesheet" href="style_chocolate.css">
   <link rel="stylesheet" href="adminPedidos.php">
   <link rel="stylesheet" href="adminProdutos.php"> 
   <link rel="stylesheet" href="adminCategoria.php"> 
   <link rel="stylesheet" href="adminClientes.php"> 
  
   <!--Icons-->

   <link href="/your-path-to-fontawesome/css/solid.css" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

   <!-- Fonts-->
   <link href="https://fonts.googleapis.com/css?family=Comic+Neue:400,700&display=swap" rel="stylesheet">
     <!--font-family: 'Comic Neue', cursive; -->
   
   <title>HomeCategoria</title>
 </head>
 
 <body>    
    
    <nav class="navbar navbar-expand-sm navbar-light bg-light navHomeAdmin">
      <div class="container-fluid">
        <a class="navbar-brand" href="/admin/homeAdmin.php"> <img src="/admin/imagem/logo.png" class="logoHome float-left d-block" ></a>
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
          <li class="breadcrumb-item itemBC"><a href="homeAdmin.php" class="">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Categorias</li>
        </ol>
      </nav>


<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nome</th>
      <th scope="col">Descrição</th>
    </tr>
  </thead>
  <tbody>
    
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
    </tr>
  </tbody>
</table>
    

   <!-- Optional JavaScript -->
   <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   <script src="/assets/js/jquery-3.4.1.slim.js"></script>
   <script src="/assets/js/popper.js"></script>
   <script src="/assets/js/bootstrap.js"></script>
  
 </body>
</html>