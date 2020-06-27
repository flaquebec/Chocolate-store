<?php
require 'header.php';?>

 <!--Admin/Clientes-->

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item itemBC"><a href="/admin/index.php" class="">Admin</a></li>
          <li class="breadcrumb-item active" aria-current="page">Clientes</li>
        </ol>
      </nav>

    
<!--Container de pesquisa e de novos Clientes -->
<div class="container mt-5">
      <nav class="navbar navbar-light justify-content-between">
        <a href="/admin/produto.php" class="btn simpleBtn" role="button" id="btnNovoCliente">Novo Cliente</a>
          <form class="form-inline">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn  my-2 my-sm-0 simpleBtn" type="submit">Pesquisar</button>
          </form>
      </nav>
</div>

<div class="container-fluid pr-5 pl-5 mt-5 ">  

<div class="table-responsive">
         <table class="table table-bordered table-hover table-striped">
           <thead>
           <tr class="nomeDasColunas">
              <th scope="col">&nbsp;</th>
              <th scope="col">ID</th>
              <th scope="col">Data</th>
              <th scope="col">Nome</th>
              <th scope="col">Endereço</th>
              <th scope="col">UF</th>                
              <th scope="col">Telefone</th>
            </tr>
           </thead>
          <tbody>
             <tr>
              <td>
                <a class="btn btnEE btn-sm"  href=""> Editar</a>
                <a class="btn btnEE btn-sm"  href="" onclick=""> Excluir</a>
              </td>
              <th scope="row">001</th>
              <td>01/01/2020</td>
              <td>Pedro da Silva</td>
              <td>Rua Brasil, 27</td>
              <td>SP</td>
              <td>11 4652-3266</td>
             </tr>
              
             <tr>
             <td>
                <a class="btn btnEE btn-sm"  href=""> Editar</a>
                <a class="btn btnEE btn-sm"  href="" onclick=""> Excluir</a>
              </td>
              <th scope="row">002</th>
              <td>01/01/2020</td>
              <td>Maria dos Santos</td>
              <td>Rua Brasil, 27</td>
              <td>SP</td>
              <td>11 4652-3266</td>
             </tr>
       
             <tr>
             <td>
                <a class="btn btnEE btn-sm"  href=""> Editar</a>
                <a class="btn btnEE btn-sm"  href="" onclick=""> Excluir</a>
              </td>
               <th scope="row">003</th>
               <td>01/01/2020</td>
               <td>José Nunes</td>
               <td>Rua Brasil, 27</td>
               <td>SP</td>
               <td>11 4652-3266</td>
              </tr>
           </tbody>
      </table>      
  </div>
      </div>

<!--PAGINATION-->
<nav class="pageBox mt-4" aria-label="Navegação de página">
  <ul class="pagination justify-content-center">
    <li class="page-item"><a class="page-link btn simpleBtn" href="#">Anterior</a></li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item"><a class="page-link" href="#">4</a></li>
    <li class="page-item"><a class="page-link" href="#">5</a></li>
    <li class="page-item"><a class="page-link btn simpleBtn" href="#">Próximo</a></li>
  </ul>
</nav>

 

<?php
require 'footer.php';?>