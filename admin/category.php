<?php

// Instance data base connection
try {
  $connection = new PDO('mysql:host=mysql_app;dbname=app', 'root', 'secret');
  $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo 'ERROR: ' . $e->getMessage();
  exit;
}

// Verifica se o parametro id foi enviado pela url
if (isset($_GET['id']) && !empty($_GET['id'])) {

  // Recebe o parametro id enviado pela url
  $id = $_GET['id'];

  // Prepara a consulta no banco de dados
  $statement = $connection->prepare("SELECT * FROM categories WHERE id = ?");

  // Executa a consulta no banco de dados passando a variavel id como parametro
  $statement->execute([$id]);

  // Recebe a categoria registrada no banco de dados
  $category = $statement->fetch();

  // Se a categoria nao foi encontrada, redireciona para a lista de categorias
  if (!$category) {
    header('Location: /admin/categories.php');
    exit; // exit faz o programa parar aqui, nada alem eh executado
  }
  
  // Recebe o nome da categoria
  $name = $category['name'];

  // Recebe a descricao da categoria
  $description = $category['description'];
}

// Verify if form sended, $_POST variable is a array with all input, select, textarea submited from form
// Verifica se o formulario foi submetido, a variavel $_POST vai conter todos os dado
if (!empty($_POST)) {

  // Cria um array vazio para as mensagens de validacao
  $validations = [];
  
  // Recebe nome da categoria
  // a funcao trim remove espaços em brancos no começo e no fim de uma string, ex: " nome " fica "nome"
  // eh importante usar o trim, pois ao verificar o valor informado ex: if(empty("  ")), esse if retorna falso, ou seja, 
  // o valor com espacos eh considerado preenchido
  $name = trim($_POST['name']);

  // Recebe descricao da categoria
  $description = trim($_POST['description']);

  // Recebe a imagem da categoria se essa foi enviada
  if (isset($_FILES['image'])) {
    $image = $_FILES['image'];
  }

  // Verifica se o nome da categoria está vazio
  if (empty($name)) {
    $validations['name'] = 'O campo Nome deve ser informado.';
  }

  // Verifica se a quantidade de caracteres informado excede 4000 caracteres
  if (strlen($description) > 4000) {
    $validations['description'] = 'O campo Descrição deve ter no máximo 4000 caracteres.';
  }

  // Verifica se o parametro id esta vazio e se a imagem esta vazia
  if (empty($_GET['id']) && empty($_FILES['image']['tmp_name'])) {
    $validations['image'] = 'O campo Imagem deve ser informado.';
  }
  
  // Verifica se a imagem foi enviada e se foi armazenada temporareamente com sucesso
  if (isset($image) && !empty($image["tmp_name"])) {
    
    // Recebe o tamanho da imagem
    $image_size = getimagesize($image["tmp_name"]);
    
    // Se a variavel image_size nao tiver valor eh por que o arquivo enviado nao era uma imagem
    if (!$image_size) {
      $validations['image'] = 'Informe uma imagem válida.';
    }
  
  }


    
  // Verifica se a variavel $validations esta vazia
  // Se estiver, significa que todas as informacoes enviadas estao validas para serem armazenadas no banco de dados
  if (empty($validations)) {


    // Verifica se a variavel $image foi instanciada e se o arquivo foi temporareamente armazenado
    // Isso significa que a imagem pode ser gravada no diretorio
    if (isset($image) && !empty($image["tmp_name"])) {

      // A funcao pathinfo nos retorna varias informacoes sobre o arquivo, 
      // como o nome do diretorio do arquivo    $image_info['dirname']
      // nome com extensao                      $image_info['basename']
      // extensao                               $image_info['extension']
      // nome sem extensao                      $image_info['filename']
      $image_info = pathinfo($image['name']);

      // A funcao uniqid, nos retorna uma string com um nome unico
      // isso evita sobrescrever um arquivo
      $image_name = uniqid("category_") . '.' . $image_info['extension'];

      // A constante __DIR__ contem qual diretorio estamos      
      $target_file = __DIR__ . '/../assets/img/categories/' . $image_name;
      
      // Grava a imagem recebida no diretorio
      move_uploaded_file($image["tmp_name"], $target_file);
    }
    


    if (isset($id) && !empty($id)) {

      $sql = "UPDATE categories SET name = ?, description = ?";

      $values = [$name, $description];

      if (isset($image_name)) {
        $sql .= ", image = ?";

        $values[] = $image_name;

        unlink(dirname(__DIR__) . '/assets/img/categories/' . $category['image']);
      }

      $sql .= " WHERE id = ?";
      $values[] = $id;

      $statement = $connection->prepare($sql);
      $statement->execute($values);

    } else {
      $statement = $connection->prepare("INSERT INTO categories (status, name, description, image) VALUES (1, ?, ?, ?)");
      $statement->execute([$name, $description, $image_name]);
    }
    
    header('Location: /admin/categories.php');
  }

}

include('header.php');
?>


    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item itemBC"><a href="homeAdmin.php" class="">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Categoria</li>
      </ol>
    </nav>

   <div class="cadastro container-fluid cadastroBox col-xs-12 col-sm-6 col-md-6 col-lg-6">
      <p class="text-center">Categoria</p>
    </div>
    
  <div class="container-fluid categoriaBox col-xs-12 col-sm-6 col-md-6 col-lg-6">
      
    <form 
      action="/admin/category.php<?php if (isset($_GET['id'])) { echo '?id=' . $_GET['id']; }?>" 
      method="POST" 
      enctype="multipart/form-data">

      <div class="form-group">
        <label for="name">Nome:</label>
        <input class="form-control<?php if (isset($validations['name'])) { echo ' is-invalid'; } ?>" id="name" name="name" value="<?php if (isset($name)) { echo $name; } ?>">
        <?php 
        if (isset($validations['name'])) {
          echo '<div class="invalid-feedback">' . $validations['name'] . '</div>';
        } 
        ?>
      </div>
      
      <div class="form-group">
        <label for="description">Descrição:</label>
        <textarea class="form-control<?php if (isset($validations['description'])) { echo ' is-invalid'; } ?>" rows="5" id="description" name="description"><?php if (isset($description)) { echo $description; } ?></textarea>
        <?php
          if (isset($validations['description'])) {
            echo '<div class="invalid-feedback">' . $validations['description'] . '</div>';
          } 
        ?>
      </div>

      <div class="form-group">
        <label for="image">Imagem:</label>
        <input type="file" class="form-control<?php if (isset($validations['image'])) { echo ' is-invalid'; } ?>" id="image" name="image">
        <?php
          if (isset($validations['image'])) {
            echo '<div class="invalid-feedback">' . $validations['image'] . '</div>';
          } 
        ?>
      </div>  

      <?php
      if (isset($category['image'])) {
      ?>
        <img src="/assets/img/categories/<?php echo $category['image'] ?>" class="img-thumbnail">
      <?php 
      }
      ?> 
     
        <button type="submit" class="btnSalvarCancelar btn btn-secondary btn-inline-block">Salvar</button>
        <button type="reset" class="btnSalvarCancelar btn btn-secondary btn-inline-block float-right">Cancelar</button>
      

    </form>
  </div>
  
<?php 
include('footer.php');
?>