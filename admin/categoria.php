<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style_chocolate.css">
  
        <!-- Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Comic+Neue:400,700&display=swap" rel="stylesheet">
      <!--font-family: 'Comic Neue', cursive; -->
    
    <title>Admin/Categoria</title>
  </head>
 
  <body>
   <div class=" cadastro container-fluid cadastroBox col-xs-12 col-sm-6 col-md-6 col-lg-6">
      <p class="text-center">Categoria</p>
    </div>
    
  <div class="container-fluid categoriaBox col-xs-12 col-sm-6 col-md-6 col-lg-6">
   
   
   
    <form action="/action_page.php">
      <div class="form-group">
        <label for="name">Nome:</label>
        <input type="" class="form-control" id="nome" value="" placeholder="" name="email">
      </div>
      
      <div class="form-group">
        <label for="comment">Descrição:</label>
        <textarea class="form-control" rows="5" id="comment"></textarea>
      </div>

      <div class="form-group">
        <label for="Imagem">Imagem:</label>
        <div class="input-group">
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="inputGroupFile04">
            <label class="custom-file-label" for="inputGroupFile04"></label>
          </div>
        </div>
      </div>   
     
        <button onclick="btnSalvar()"  type="button" class="btnSalvarCancelar btn btn-secondary btn-inline-block">Salvar</button>
        <button onclick="btnCancelar()" type="button" class="btnSalvarCancelar btn btn-secondary btn-inline-block float-right">Cancelar</button>
      

    </form>
  </div>
  

  
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="/assets/js/jquery-3.4.1.slim.js"></script>
    <script src="/assets/js/popper.js"></script>
    <script src="/assets/js/bootstrap.js"></script>
   
  </body>
</html>