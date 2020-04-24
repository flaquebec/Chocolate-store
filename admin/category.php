<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="cssTest.css">
    <di
    
    <!-- Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Comic+Neue:400,700&display=swap" rel="stylesheet">
      <!--font-family: 'Comic Neue', cursive; -->
    
    <title>Admin</title>
  </head>
 
  <body>
  
    <div class="opsMessage alert alert-danger container-fluid text-center d-none col-xs-12 col-sm-6 col-md-6 col-lg-4">
      <strong>Ops!</strong> Email and/or password invalid.
    </div>
  <div class="container-fluid loginBox col-xs-12 col-sm-6 col-md-6 col-lg-4">
    <div id="logoLogin"  class="mx-auto d-block">
      
        <img src="imagem/logo.jpg"  id="logoImage"class="mx-auto d-block">
       
    </div>
    <div class="admin ">
      <p class="text-center">Administrator</p>
    </div>
   
    <form action="/action_page.php">
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" value="" placeholder="Enter email" name="email">
      </div>
      <div class="form-group">
        <label for="pwd">Password:</label>
        <input type="password" class="form-control" id="pwd" value="" placeholder="Enter password" name="pswd">
      </div>
     
      <button onclick="emailValidation()" id="btnLogin" type="button" class="btn btn-primary btn-block">Login</button>
    </form>
  </div>
  

  
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="/assets/js/jquery-3.4.1.slim.js"></script>
    <script src="/assets/js/popper.js"></script>
    <script src="/assets/js/bootstrap.js"></script>
   
  </body>
</html>