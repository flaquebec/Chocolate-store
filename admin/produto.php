<?php 

try {
  $connection = new PDO('mysql:host=mysql_app;dbname=app', 'root', 'secret');
  $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo 'ERROR: ' . $e->getMessage();
  exit;
}

$action = null;
$id = null;

if (isset($_GET['id']) && !empty($_GET['id'])) {
  $id = $_GET['id'];
}

if (isset($_GET['action']) && !empty($_GET['action'])) {
  $action = $_GET['action'];
}

if (isset($_GET['product_image_id']) && !empty($_GET['product_image_id'])) {
  $product_image_id = $_GET['product_image_id'];
  
  if ($action && $action == 'delete_product_image') {

    $statement = $connection->prepare("SELECT * FROM product_images WHERE id = ?");
    $statement->execute([$product_image_id]);
    
    $product_image = $statement->fetch();

    if ($product_image && file_exists(__DIR__ . '/../assets/img/' . $product_image['image'])) {
      unlink(__DIR__ . '/../assets/img/' . $product_image['image']);
      
      $statement = $connection->prepare("DELETE FROM product_images WHERE id = ?");
      $statement->execute([$product_image_id]);
    
      header("Location: /admin/produto.php?id=$id&message=A imagem foi excluída com sucesso!");
      exit;
    }

  }


}





if ($id !== null) {

  $statement = $connection->prepare("SELECT * FROM products WHERE id = ?");
  $statement->execute([$id]);
  
  $product = $statement->fetch();

  $statement = $connection->prepare("SELECT * FROM product_images WHERE product_id = ? ORDER BY position ASC");
  $statement->execute([$id]);
  
  $product_images = $statement->fetchAll();
  
  if (!$product) {
    header('Location: /admin/adminProdutos.php?message=Produto não encontrado.');
    exit;
  }
  
  $name = $product['name'];

  $status = $product['status'];

  $category_id = $product['category_id'];

  $description = $product['description'];

  $price = $product['price'];

  $discount = $product['discount'];
}

if (!empty($_POST)) {

  $name = trim($_POST['name']);

  $status = boolval($_POST['status']);

  $category_id = $_POST['category_id'];

  $description = trim($_POST['description']);

  $price = $_POST['price'];

  $discount = $_POST['discount'];

  if (isset($_FILES['images'])) {
    $images = $_FILES['images'];
  }

  $validations = [];

  if (empty($name)) {
    $validations['name'] = 'O campo Nome deve ser informado.';
  } elseif (strlen($name) > 125) {
    $validations['name'] = 'O campo Nome deve ter no máximo 125 caracteres.';
  } else {
    $statement = $connection->prepare("SELECT 1 FROM products WHERE name = ? and id <> ?");
    $statement->execute([$name, $id]);
    
    if ($statement->fetch()) {
      $validations['name'] = 'Já existe um produto com este nome.';
    }
  }

  if (empty($category_id)) {
    $validations['category_id'] = 'O campo Categoria deve ser informado.';
  } else {
    $statement = $connection->prepare("SELECT 1 FROM categories WHERE id = ?");
    $statement->execute([$category_id]);
    
    if (!$statement->fetch()) {
      $validations['category_id'] = 'O campo Categoria é inválido.';
    }
  }

  if (strlen($description) > 4000) {
    $validations['description'] = 'O campo Descrição deve ter no máximo 4000 caracteres.';
  }

  if (empty($price)) {
    $validations['price'] = 'O campo Preço deve ser informado.';
  } elseif (!is_numeric($price)) {
    $validations['price'] = 'O campo Preço deve ser um valor numérico.';
  } elseif ($price < 0) {
    $validations['price'] = 'O campo Preço deve ser um valor numérico maior ou igual a zero.';
  }

  if (!empty($discount)) {
    if (!is_numeric($discount)) {
      $validations['discount'] = 'O campo Desconto deve ser um valor numérico.';
    } elseif ($discount < 0) {
      $validations['discount'] = 'O campo Desconto deve ser um valor numérico maior ou igual a zero.';
    } elseif ($discount > 100) {
      $validations['discount'] = 'O campo Desconto não deve ser maior que 100%.';
    }
  }

  if (empty($validations)) {

    if (isset($id) && !empty($id)) {
    
      $sql = "UPDATE products SET status = ?, name = ?, category_id = ?, description = ?, price = ?, discount = ? WHERE id = ?";

      $statement = $connection->prepare($sql);
      $statement->execute([$status, $name, $category_id, $description, $price, $discount, $id]);

    } else {
      $sql = "INSERT INTO products(status, name, category_id, description, price, discount) VALUES (?, ?, ?, ?, ?, ?)";
      
      $statement = $connection->prepare($sql);
      $statement->execute([$status, $name, $category_id, $description, $price, $discount]);
      
      $id = $connection->lastInsertId();
    }

    if (isset($images) && !empty($images["name"])) {
      
      $position = 0;
      if (isset($product_images)) {
        $position = count($product_images);
      }

      for ($i = 0; $i < count($images["name"]); $i++) {

        if (!empty($images["name"][$i])) {

          // A funcao pathinfo nos retorna varias informacoes sobre o arquivo, 
          // como o nome do diretorio do arquivo    $image_info['dirname']
          // nome com extensao                      $image_info['basename']
          // extensao                               $image_info['extension']
          // nome sem extensao                      $image_info['filename']
          $image_info = pathinfo($images['name'][$i]);

          // A funcao uniqid, nos retorna uma string com um nome unico
          // isso evita sobrescrever um arquivo
          $image_name = uniqid('product_' . $id . '_') . '.' . $image_info['extension'];

          // A constante __DIR__ contem qual diretorio estamos     
          $target_file = __DIR__ . '/../assets/img/' . $image_name;

          // Grava a imagem recebida no diretorio
          move_uploaded_file($images["tmp_name"][$i], $target_file);

          $sql = "INSERT INTO product_images(product_id, image, position) VALUES(?, ?, ?)";

          $statement = $connection->prepare($sql);
          $statement->execute([$id, $image_name, $position]);

          $position++;
        }

      }

    }
    
    header("Location: /admin/produto.php?id=$id");
    exit;
  }

}



$statement = $connection->prepare("SELECT * FROM categories ORDER BY name");
$statement->execute();

$categories = $statement->fetchAll();

include 'header.php';
?>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item itemBC"><a href="/admin/index.php">Admin</a></li>
    <li class="breadcrumb-item active" aria-current="page">Produto</li>
  </ol>
</nav>
    
  <div class="container-fluid cadastroBox col-xs-12 col-sm-6 col-md-6 col-lg-6">
   
   
   
    <form 
      action="/admin/produto.php<?php if (isset($_GET['id'])) { echo '?id=' . $_GET['id']; }?>" 
      method="POST"
      enctype="multipart/form-data">
      <div class="row">
        <div class="col-9 form-group">
          <label for="name">Nome:</label>
          <input class="form-control<?php if (isset($validations['name'])) { echo ' is-invalid'; } ?>" id="name" name="name" value="<?php if (isset($name)) { echo $name; } ?>">
          <?php 
          if (isset($validations['name'])) {
            echo '<div class="invalid-feedback">' . $validations['name'] . '</div>';
          } 
          ?>
        </div>
        <div class="col-3 form-group">
          <label for="status">Status</label>
          <select class="form-control<?php if (isset($validations['status'])) { echo ' is-invalid'; } ?>" id="status" name="status">
            <option value="1"<?php if (isset($status) && $status == '1') { echo ' selected'; }?>>Ativo</option>
            <option value="0"<?php if (isset($status) && $status == '0') { echo ' selected'; }?>>Inativo</option>
          </select>
          <?php 
          if (isset($validations['status'])) {
            echo '<div class="invalid-feedback">' . $validations['status'] . '</div>';
          } 
          ?>
        </div>
      </div>
     
      <div class="form-group">
        <label for="category_id">Categoria</label>
        <select class="form-control<?php if (isset($validations['category_id'])) { echo ' is-invalid'; } ?>" id="category_id" name="category_id">
          <option value="">
          <?php 
            if (empty($categories)) {
              echo 'Nenhum categoria encontrada...';
            } else {
              echo 'Selecione uma categoria...';
            }
          ?>
          </option>
          <?php
          foreach ($categories as $category) { ?>
            <option value="<?php echo $category['id']; ?>"<?php if (isset($category_id) && $category_id == $category['id']) { echo 'selected'; }?>>
              <?php echo htmlentities($category['name']); ?>
            </option>
          <?php
          } ?>
        </select>
        <?php 
        if (isset($validations['category_id'])) {
          echo '<div class="invalid-feedback">' . $validations['category_id'] . '</div>';
        } 
        ?>
      </div>
      
      <div class="form-group">
        <label for="description">Descrição</label>
        <textarea class="form-control<?php if (isset($validations['description'])) { echo ' is-invalid'; } ?>" rows="5" id="description" name="description"><?php if (isset($description)) { echo $description; } ?></textarea>
        <?php 
        if (isset($validations['description'])) {
          echo '<div class="invalid-feedback">' . $validations['description'] . '</div>';
        } 
        ?>
      </div>    

      <div class="form-group">
        <label for="price">Preço</label>
        <input type="number" step=".01" class="form-control<?php if (isset($validations['price'])) { echo ' is-invalid'; } ?>" id="price" name="price" value="<?php if (isset($price)) { echo $price; } ?>">
        <?php 
        if (isset($validations['price'])) {
          echo '<div class="invalid-feedback">' . $validations['price'] . '</div>';
        } 
        ?>
      </div>

      <div class="form-group">
        <label for="discount">Desconto %</label>
        <input type="number" step=".01" class="form-control<?php if (isset($validations['discount'])) { echo ' is-invalid'; } ?>" id="discount" name="discount" value="<?php if (isset($discount)) { echo $discount; } ?>">
        <?php 
        if (isset($validations['discount'])) {
          echo '<div class="invalid-feedback">' . $validations['discount'] . '</div>';
        } 
        ?>
      </div>
             
      <div class="form-group">
        <label for="images">Imagens</label>
        <input type="file" class="form-control" id="images" name="images[]" multiple>
      </div>  
     
      <button class="btnSalvarCancelar btn btn-secondary btn-inline-block">Salvar</button>
      <button type="reset" class="btnSalvarCancelar btn btn-secondary btn-inline-block float-right">Cancelar</button>
      
    </form>
  </div>
  
  <div class="container">
        <div class="row">
    <?php 
      if (isset($product_images) && !empty($product_images)) { 
        
        foreach ($product_images as $image) {
        
    ?>
      
        <div class="col">
          <div class="card" style="width: 18rem;">
            <img src="/assets/img/<?php echo $image['image'] ?>" class="card-img-top" alt="...">
            <div class="card-body">
              <a href="/admin/produto.php?id=<?php echo $id; ?>&product_image_id=<?php echo $image['id']; ?>&action=delete_product_image" class="btn btn-danger">Remover</a>
            </div>
          </div>
        </div>
      
    <?php
      }
    } 
    ?>
    </div>
  </div>
  
<?php 
include 'footer.php'; ?>
