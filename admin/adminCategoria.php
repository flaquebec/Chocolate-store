<?php
require '../system.php';

// Instance data base connection
$connection = new DB();

// Acao deletar
if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'delete') {
  $statement = $connection->prepare('DELETE FROM categories WHERE id = ?');
  $statement->execute([$_GET['id']]);
  header('Location: /admin/adminCategoria.php?message=A categoria foi removida com sucesso.');
  exit;
}



$sql = "
SELECT 
	c1.id, 
  c1.status, 
  CASE WHEN c1.status = 1 THEN 'Ativo' ELSE 'Inativo' END status_name, 
  c1.name,
  c1.description,
  c2.name as category,
  c1.created_at,
  CASE WHEN c1.updated_at = c1.created_at THEN NULL ELSE c1.updated_at END AS updated_at
FROM categories AS c1
  LEFT JOIN categories AS c2 ON c1.category_id = c2.id ";
$parameters = [];

if (isset($_GET['search'])) {
  $sql .= "WHERE c1.name LIKE ? ";
  $parameters = ['%' . $_GET['search'] . '%'];
}

$orderBy = $_GET['orderBy'] ?? ['c1.id' => 'ASC'];


$categories = $connection
                  ->query($sql)
                  ->parameters($parameters)
                  ->orderBy($orderBy)
                  ->paginate();



require 'header.php';?>

  
 <!--Admin/Categorias-->

 <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item itemBC"><a href="/admin/index.php" class="">Admin</a></li>
          <li class="breadcrumb-item active" aria-current="page">Categorias</li>
        </ol>
      </nav>

  <!--Container de categorias e de novas categorias -->
  <div class="container mt-5">
     
    <nav class="navbar navbar-light justify-content-between">
      <a href="/admin/categoria.php" class="btn simpleBtn" role="button" id="btnNovoPedido">Nova</a>
      <form class="form-inline">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" 
          name="search"
          value="<?php echo isset($_GET['search']) ? htmlentities($_GET['search']) : '';?>">
        <button class="btn  my-2 my-sm-0 simpleBtn" type="submit">Pesquisar</button>
      </form>
    </nav>
  </div>

       
    
   
 <div class="container-fluid pr-5 pl-5 mt-5 ">  

    <?php if (empty($categories['data'])) { ?>
      <div class="alert alert-primary" role="alert">
        Nenhuma categoria encontrada.
      </div>
    <?php } else { ?>
     <div class="table-responsive">
         <table class="table table-bordered table-hover table-striped">
           <thead>
            <tr class="nomeDasColunas">
              <th scope="col">&nbsp;</th>
              <?php th_orderBy("ID", 'c1.id') ?>
              <?php th_orderBy("Nome", 'c1.name') ?>
              <?php th_orderBy("Status", 'status_name') ?>
              <?php th_orderBy("Descrição", 'c1.description') ?>
              <?php th_orderBy("Categoria", 'category') ?>
              <?php th_orderBy("Criado em", 'c1.created_at') ?>
              <?php th_orderBy("Alterado em", 'updated_at') ?>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($categories['data'] as $category) { ?>
              <tr >        
               
               
                <td>
                  <a 
                    class="btn btnEE btn-sm" 
                    href="/admin/categoria.php?id=<?php echo $category['id'];?>">
                    Editar
                  </a>
                  <a 
                    class="btn btnEE btn-sm" 
                    href="/admin/adminCategoria.php?id=<?php echo $category['id'];?>&action=delete"
                    onclick="return confirm('Deseja realmente remover a categoria: <?php echo htmlentities($category['name']);?>?')">
                    Excluir
                  </a>
                </td>
                <th scope="row"><?php echo $category['id'];?></th>
                <td><?php echo htmlentities($category['name']);?></td>
                <td><?php echo htmlentities($category['status_name']);?></td>
                <td><?php echo htmlentities($category['description']);?></td>
                <td><?php echo htmlentities($category['category']);?></td>
                <td><?php echo date_format(date_create($category['created_at']), 'd/m/Y H:i:s');?></td>
                <td><?php echo $category['updated_at'] ? date_format(date_create($category['updated_at']), 'd/m/Y H:i:s') : '-';?></td>
                <?php } ?>
            </tbody>
        </table>      
      </div>
    </div>

    <div class= "container d-flex mt-5">
      <button type="button" class="btn simpleBtn">Anterior</button>
      <button type="button" class="btn simpleBtn ml-auto">Próximo</button>
    </div>

    <?php } ?>

  </div>
  

  
<?php
require 'footer.php';?>