<?php
require 'header.php';?>

 <!--Admin/Categoria-->

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item itemBC"><a href="/admin/index.php" class="">Admin</a></li>
          <li class="breadcrumb-item active" aria-current="page">Categoria</li>
        </ol>
      </nav>

  <!--Container de pesquisa e de novos pedidos -->
<div class="container mt-5">
        <nav class="navbar navbar-light justify-content-between">
        <a href="/admin/produto.php" class="btn simpleBtn" role="button" id="btnNovoPedido">Novo Pedido</a>
            <form class="form-inline">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn  my-2 my-sm-0 simpleBtn" type="submit">Pesquisar</button>
          </form>
        </nav>
     </div>
     <div class="container-fluid mt-5">

        <div class="ultimosPC col-xl-10 col-sm-12 col-md-12 col-lg-10 m-auto">
         <table class="table">
           <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Categoria</th>
                <th scope="col">Data</th>
                <th scope="col">Valor</th>
               
              </tr>
           </thead>
           <tbody>
              <tr>
                <th scope="row">001</th>
                 <td>Categoria A</td>
                 <td>01/01/2020</td>
                 <td>R$30,00</td>
              </tr>
              
              <tr>
                <th scope="row">002</th>
                 <td>Categoria B</td>
                 <td>01/01/2020</td>
                 <td>R$53,00</td>
              </tr>                    
             </tbody>
         </table>      
        </div>
      </div>
      <div class= "container d-flex mt-5">
        <button type="button" class="btn simpleBtn">Anterior</button>
        <button type="button" class="btn simpleBtn ml-auto">Próximo</button>
      </div>

   

<?php
require 'footer.php';?>