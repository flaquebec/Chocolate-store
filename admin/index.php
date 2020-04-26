<?php

// Start session memory
session_start();

// Instance data base connection
try {
  $connection = new PDO('mysql:host=mysql_app;dbname=app', 'root', 'secret');
  $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo 'ERROR: ' . $e->getMessage();
  exit;
}


// Verify if form sended, $_POST variable is a array with all input, select, textarea submited from form
if (!empty($_POST)) {

  // Create empty array validations errors variable
  $validations = [];

  
  // Get email sended from form
  $email = trim($_POST['email']);

  // Get password sended from form
  $pswd = trim($_POST['pswd']);

  
  
  // Verify is email variable is empty
  if (empty($email)) {
    $validations['email'] = 'E-mail required';
  }
  
  // Verify if pswd variable is empty
  if (empty($pswd)) {
    $validations['pswd'] = 'Password required';
  }

  
  // Verify validations is empty
  if (empty($validations)) {

    // Prepare data base query
    $statement = $connection->prepare("SELECT * FROM admins WHERE email = ? AND password = ?");

    // Execute data base query with parameters
    $statement->execute([$email, $pswd]);

    // Get admin register
    $admin = $statement->fetch();
    
    // Verify if administration register there is
    if ($admin) {
      
      // Put admin found to Session memory
      $_SESSION['admin'] = $admin;

      // Redirect to Admin Home Page
      header('Location: /admin/admin.php');
    } else { // Admin not found
      
      // Put error on validations array variable
      $validations['error'] = "E-mail and / or password not found.";
    }

  }

}

?>
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
    
    <title>Admin</title>
  </head>
 
  <body>

    <?php if (!empty($validations)) { ?>
      <div class="opsMessage alert alert-danger container-fluid text-center col-xs-12 col-sm-6 col-md-6 col-lg-4">
        <strong>Ops!</strong> 
        <?php 
        if (isset($validations['error'])) {
          echo $validations['error'];
        } else {
          echo 'Something wrong.';
        }
        ?>
      </div>
    <?php } ?>

  <div class="container-fluid loginBox col-xs-12 col-sm-6 col-md-6 col-lg-4">
    <div id="logoLogin"  class="mx-auto d-block">
      
        <img src="/admin/imagem/logo.jpg"  id="logoImage"class="mx-auto d-block">
       
    </div>
    <div class="admin ">
      <p class="text-center">Administrator</p>
    </div>
   
    <form action="/admin/index.php" method="POST">
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control<?php if (isset($validations['email'])) { echo ' is-invalid'; } ?>" id="email" value="<?php if (isset($_POST['email'])) { echo $_POST['email']; }?>" placeholder="Enter email" name="email">
        <?php 
        if (isset($validations['email'])) {
          echo '<div class="invalid-feedback">' . $validations['email'] . '</div>';
        } 
        ?>
      </div>
      <div class="form-group">
        <label for="pwd">Password:</label>
        <input type="password" class="form-control<?php if (isset($validations['pswd'])) { echo ' is-invalid'; } ?>" id="pwd" value="" placeholder="Enter password" name="pswd">
        <?php 
        if (isset($validations['pswd'])) {
          echo '<div class="invalid-feedback">' . $validations['pswd'] . '</div>';
        } 
        ?>
      </div>
     
      <button id="btnLogin" type="submit" class="btn btn-secondary btn-block">Login</button>
    </form>
  </div>
  

  
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="/assets/js/jquery-3.4.1.slim.js"></script>
    <script src="/assets/js/popper.js"></script>
    <script src="/assets/js/bootstrap.js"></script>
   
  </body>
</html>