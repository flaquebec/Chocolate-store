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
  
    
    <!-- Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Comic+Neue:400,700&display=swap" rel="stylesheet">
      <!--font-family: 'Comic Neue', cursive; -->
    <title>Home/Admin</title>
 
  </head>
 
 
  <body>    
    
    <nav class="navbar navbar-expand-sm navbar-light bg-light navHomeAdmin">
      <div class="container-fluid">
        <a class="navbar-brand" href="homeAdmin"> <img src="/admin/imagem/logo.png" class="logoHome float-left d-block" ></a>
        <div class="nav navbar menu">
          <ul class="navbar-nav ">
            <li class="nav-item pr-4 menuList">
              <a class="nav-link" href="/admin/adminCategoria.php#">Categoria</a>
            </li>
            <li class="nav-item pr-4 menuList">
              <a class="nav-link" href="admin/adminProdutos.php">Produtos</a>
            </li>
            <li class="nav-item pr-4 menuList">
              <a class="nav-link" href="admin/adminPedidos.php">Pedidos</a>
            </li>
            <li class="nav-item pr-4 menuList">
                <a class="nav-link" href="admin/adminClientes.php">Clientes</a>
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

      <!--Chart-->
    <div class="container-fluid mr-5 mt-5 ml-2">
      <canvas id="boxGraf" class="col-6 d-inline "></canvas>
      <div id="ultimosPedidos" class="col-5 float-right">Ultmos pedidos</div>
      <div id="ultimosClientesCadastrados" class="col-5 float-right">Ultimos Clientes Cadastrados</div>
    </div>
    
    <script>
      Chart.defaults.global.defaultFontFamily="'Comic Neue', 'cursive'";
      Chart.defaults.global.defaultFontColor="#996633";
      var ctx = document.getElementById('boxGraf').getContext('2d');
      var grafico = new Chart(ctx, {
  
        type: 'line',

    
        data: {
            labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junnho', 'Julho','Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            datasets: [{
            label: 'Vendas',
            backgroundColor: '#734d26',
            fill: 'false',
            borderColor: '#996633',
            data: [8, 10, 5, 4, 13, 18, 14,10,3,17,13,14]
            }]
        },

 
        options: {
            title:{      
                display: true,   
                fontSize:30,
                text:"Vendas",
                fontColor:'#ac7339',
                fontFamily:"'Comic Neue', 'cursive'",
                padding:15,
                lineHeight:2
            },
            legend:{
                display:false,
            },
            scales: {
            yAxes: [{
                stacked: true
            }]
        }
           
        },
    });


    </script>

   <!-- Optional JavaScript -->
   <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   <script src="/assets/js/jquery-3.4.1.slim.js"></script>
   <script src="/assets/js/popper.js"></script>
   <script src="/assets/js/bootstrap.js"></script>
  
 </body>
</html>
















