<?php
require('db.php');

$db = new DB();

$categories = $db->query("SELECT id, name, description FROM categories WHERE status = 1 ORDER BY name")->get();

$sql = '
        SELECT 
          p.id, 
          p.name, 
          p.description,
          p.price,
          p.discount,
          pi.image
        FROM products AS p
          INNER JOIN product_images AS pi ON p.id = pi.product_id 
          WHERE p.status = 1
          AND pi.position = 0
          ORDER BY RAND() LIMIT 8
';

$products = $db->query($sql)->get();

include 'header.php';
?>

<!-- CAROUSEL-->  
<div class="container-fluid " id="containerCarousel">
  <div id="boxCarousel p-0" class="slideCarousel carousel slide" data-ride="carousel">
    <ul class="carousel-indicators">
      <li data-target="#boxCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#boxCarousel" data-slide-to="1"></li>
      <li data-target="#boxCarousel" data-slide-to="2"></li>
    </ul>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block w-100" src="image/carousel/diaDosPais.jpg" alt="Dia dos Namorados">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="image/carousel/coffee.jpg" alt="Dia dos Pais">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="image/carousel/diaNam.jpg" alt="Dia das Maes">
      </div>
    </div>
    <a class="carousel-control-prev" href="#boxCarousel" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#boxCarousel" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>

<!-- MAIN CONTAINER-->
<!--SEPARADOR CAROUSEL E CONTAINER PRINCIPAL-->
<div class="container-fluid tituloContainer">
  <h2 class="titulo"> Nossos Produtos</h2>
</div>


<div class="containerPrincipal container-fluid d-flex flex-wrap">
<?php foreach ($products as $product):?>
  <div class="boxProduto col-xl-3 col-lg-4 col-md-4 col-sm-6 col-xs-6">
      <div class="itemImagemContainer">
          <a href="/product_detail.php?id=<?php echo $product['id'] ?>">
            <img src="/assets/img/<?php echo $product['image'] ?>" class="img-fluid itemImage">
          </a>
      </div>
      <div class="itemInfoContainer col-12 p-0">
          <div class="itemInfo pr-1 pl-1">
              <p class="itemName"><?php echo $product['name'] ?></p>
              <?php if ($product['discount']): ?>
              <p class="itemProm">Preço com desconto</p>
              <?php endif ?>
              <p class="itemPrice">R$ <?php echo number_format($product['price'], 2, ',', '.') ?></p>
              <p class="itemLink"><a href="/product_detail.php?id=<?php echo $product['id'] ?>"> Leia mais</a></p>
          </div>                 
      </div>
  </div>
<?php endforeach ?>
</div>

<?php 
include 'footer.php';
?>