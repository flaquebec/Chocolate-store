<?php
require '../system.php';

// Instance data base connection
$connection = new DB();

// Acao deletar
if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'delete') {
    $statement = $connection->prepare('DELETE FROM products WHERE id = ?');
    $statement->execute([$_GET['id']]);
    header('Location: /admin/adminProdutos.php?message=O produto foi removido com sucesso.');
    exit;
}


$sql = "
SELECT 
	p.id,
    p.status,
    CASE WHEN p.status = 1 THEN 'Ativo' ELSE 'Inativo' END status_name,
    p.name,
    p.description,
    c.name category,
    p.price,
    p.discount,
    CASE WHEN p.discount IS NULL THEN p.price ELSE p.price - (p.price * (p.discount / 100)) END price_discount,
    p.created_at,
    CASE WHEN p.updated_at = p.created_at THEN NULL ELSE p.updated_at END AS updated_at
FROM products p
	LEFT JOIN categories AS c ON p.category_id = c.id ";
$parameters = [];

if (isset($_GET['search'])) {
    $sql .= "WHERE p.name LIKE ? ";
    $parameters = ['%' . $_GET['search'] . '%'];
}

$orderBy = $_GET['orderBy'] ?? ['p.name' => 'ASC'];


$products = $connection
    ->query($sql)
    ->parameters($parameters)
    ->orderBy($orderBy)
    ->paginate();


require 'header.php';
?>

    <!--Admin/Produtos-->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item itemBC"><a href="/admin/index.php" class="">Admin</a></li>
          <li class="breadcrumb-item active" aria-current="page">Produtos</li>
        </ol>
    </nav>

    <!--Container de pesquisa e de novos Produtos -->
    <div class="container mt-5">
        <nav class="navbar navbar-light justify-content-between">
            <a href="/admin/produto.php" class="btn simpleBtn" role="button" id="btnNovoProduto">Novo Produto</a>
            <form class="form-inline">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search" value="<?php echo isset($_GET['search']) ? htmlentities($_GET['search']) : '';?>">
            <button class="btn  my-2 my-sm-0 simpleBtn" type="submit">Pesquisar</button>
          </form>
        </nav>
     </div>

    <div class="container-fluid mt-5">

        <?php if (empty($products['data'])) { ?>
            <div class="alert alert-primary" role="alert">
                Nenhum produto encontrado.
            </div>
        <?php } else { ?>
            <div class="table-responsive">
                <div class="table table-bordered table-hover table-striped">
                    <table class="table">
                        <thead>
                          <tr class="nomeDasColunas">
                              <th scope="col">&nbsp;</th>
                              <?php th_orderBy("ID", 'p.id') ?>
                              <?php th_orderBy("Nome", 'p.name') ?>
                              <?php th_orderBy("Status", 'status_name') ?>
                              <?php th_orderBy("Descrição", 'p.description') ?>
                              <?php th_orderBy("Categoria", 'category') ?>
                              <?php th_orderBy("Preço", 'p.price') ?>
                              <?php th_orderBy("Desconto %", 'p.discount') ?>
                              <?php th_orderBy("Preço com desconto", 'price_discount') ?>
                              <?php th_orderBy("Criado em", 'p.created_at') ?>
                              <?php th_orderBy("Alterado em", 'updated_at') ?>
                          </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products['data'] as $product) { ?>
                            <tr>
                               <td>
                                   <a class="btn btn-primary btn-sm" href="/admin/produto.php?id=<?php echo $product['id'];?>">Editar</a>
                                   <a class="btn btn-danger btn-sm"  href="/admin/adminProdutos.php?id=<?php echo $product['id'];?>&action=delete" onclick="return confirm('Deseja realmente remover o produto: <?php echo htmlentities($product['name']);?>?')">Excluir</a>
                               </td>
                               <th scope="row"><?php echo $product['id'];?></th>
                               <td><?php echo htmlentities($product['name']);?></td>
                               <td><?php echo htmlentities($product['status_name']);?></td>
                               <td><?php echo htmlentities($product['description']);?></td>
                               <td><?php echo htmlentities($product['category']);?></td>
                               <td><?php echo number_format($product['price'], 2, ',', '.');?></td>
                               <td><?php echo !is_null($product['discount']) && !empty($product['discount']) ? number_format($product['discount'], 2, ',', '.') : '-';?></td>
                               <td><?php echo number_format($product['price_discount'], 2, ',', '.');?></td>
                               <td><?php echo date_format(date_create($product['created_at']), 'd/m/Y H:i:s');?></td>
                               <td><?php echo $product['updated_at'] ? date_format(date_create($product['updated_at']), 'd/m/Y H:i:s') : '-';?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

        <?php pagination($products) ?>

        <?php } ?>

    </div>
<?php
require 'footer.php';?>