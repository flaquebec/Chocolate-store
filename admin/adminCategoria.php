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

    
  <div class="container-fluid pr-5 pl-5 mt-5 ">      
       <div class="table-responsive">
         <table class="table table-bordered table-hover table-striped">
           <thead>
              <tr class="bg-dark text-white" >
                <th scope="col"></th>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">Status</th>
                <th scope="col">Descrição</th>
                <th scope="col">Categoria</th>
                <th scope="col">Criado em</th>
                <th scope="col">Alterado em</th>
               
              </tr>
           </thead>
           <tbody>
              <tr>
                 <td><button type="button" class="btn simpleBtn bt-sm">Editar</button> <button type="button" class="btn simpleBtn bt-sm">Excluir</button></td>
                 <td>001</td>
                 <td>Categoria A</td>
                 <td>Ativo</td>
                 <td>Descrição da Categoria</td>
                 <td>Categoria 1</td>
                 <td>01/06/2020</td>
                 <td>01/06/2020</td>
              </tr>
              
              <tr>
                 <td><button type="button" class="btn simpleBtn bt-sm">Editar</button> <button type="button" class="btn simpleBtn bt-sm">Excluir</button></td>
                 <td>002</td>
                 <td>Categoria B</td>
                 <td>Ativo</td>
                 <td>Descrição da Categoria</td>
                 <td>Categoria 1</td>
                 <td>01/06/2020</td>
                 <td>01/06/2020</td>
              </tr>   
              
              <tr>
                 <td><button type="button" class="btn simpleBtn bt-sm">Editar</button> <button type="button" class="btn simpleBtn bt-sm">Excluir</button></td>
                 <td>00</td>
                 <td>Categoria B</td>
                 <td>Ativo</td>
                 <td>Descrição da Categoria</td>
                 <td>Categoria 1</td>
                 <td>01/06/2020</td>
                 <td>01/06/2020</td>
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