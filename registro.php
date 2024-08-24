<?php

require 'config/config.php';
require 'config/database.php';
require 'clases/clienteFunciones.php';


$db = new Database();
$con =$db->conectar();

$errors = [];

if(!empty($_POST)){

    $nombres = trim($_POST['nombres']);
    $apellidos = trim($_POST['apellidos']);
    $email = trim($_POST['email']);
    $telefono = trim($_POST['telefono']);
    $matricula = trim($_POST['matricula']);
    $usuario = trim($_POST['usuario']);
    $password = trim($_POST['password']);
    $repassword = trim($_POST['repassword']);

   $id = registraCliente([$nombres, $apellidos, $email, $telefono, $matricula], $con);

   if($id > 0){
    $pass_hash = password_hash($password, PASSWORD_DEFAULT);
    $token = generarToken();
    if (!registraUsuario([$usuario, $pass_hash, $token, $id], $con)) {
        $errors[] = "Error al registrar cliente";
      }
   } else{
    
    
    $errors[] = "Error al registrar cliente";
   }

   if(count($errors) == 0){

   } else {
    print_r($errors);
   }
}





?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=  , initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="css/estilos.css" rel="stylesheet" >

</head>

<body>



<header>
  <div class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a href="#" class="navbar-brand "> 
          <strong>Tienda online</strong>
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarHeader">
        <ul class="navbar-nav me-auto mb-2 mb-ig-0">
          <li class="nav-item">
            <a href="#" class="nav-link active">Catalogo</a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link ">Contacto</a>
          
          </li>

        </ul>
        <a href="checkout.php" class="btn btn-primary">
            Carrito <span id="num_cart" class="badge bg-secondary"><?php echo $num_cart; ?></span>
        </a>

      </div>


    </div>
  </div>
</header>

<main>
  <div class="container">

    <h2>Datos del cliente</h2>

    <form class="row g-3" action="registro.php" method="post" autocomplete="off">
        <div class="col-md-6">
            <label for="nombres"><span class="text-danger">*</span> Nombres </label>
            <input type="text" name="nombres" id="nombres" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label for="apellidos"><span class="text-danger">*</span> Apellidos </label>
            <input type="text" name="apellidos" id="apellidos" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label for="email"><span class="text-danger">*</span> Correo electronico </label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label for="telefono"><span class="text-danger">*</span> Telefono </label>
            <input type="tel" name="telefono" id="telefono" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label for="matricula"><span class="text-danger">*</span> Matricula </label>
            <input type="text" name="matricula" id="matricula" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label for="usuario"><span class="text-danger">*</span> Usuario </label>
            <input type="text" name="usuario" id="usuario" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label for="password"><span class="text-danger">*</span> Contraseña </label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label for="repassword"><span class="text-danger">*</span> Repetir Contraseña </label>
            <input type="password" name="repassword" id="repassword" class="form-control" required>
        </div>

        <i><b>Nota:</b>Los campos con asteristico son obligatorios </i>

        <div class="col-12">
            <button type="submit" class="btn btn-primary">Registrar</button>

        </div>

       </form>
    </div>
</main>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    
</body>

</html>