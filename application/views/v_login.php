<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistema Gatão - Login</title>

    <!-- Bootstrap core CSS-->
  <link href="<?= base_url('include');?>/css/login.css" rel="stylesheet">
	<link href="<?= base_url('include/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">

    <!-- Custom fonts for this template-->
	<link href="<?= base_url('include/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
	<link href="<?= base_url('include/css/sb-admin.css') ?>" rel="stylesheet">

  </head>

  <body class="bg-dark">

<div class="container">
  <div class="login-container">
            <div id="output"></div>
            <div class="avatar">
              <img class="profile-img" src="<?= base_url('include');?>/img/logo.jpg"
                    alt="">
            </div>
            <div class="form-box">
          <form class="form-signin" role="form" method="post" action="<?= base_url('index.php/login/logar') ?>">
                <input type="text" id="usuario" class="form-control" placeholder="Usuario" required="required" autofocus="autofocus" name="usuario">
                <input type="password" id="senha" class="form-control" placeholder="senha" required="required" name="senha">
             <button class="btn btn-info btn-block login" type="submit">Fazer login</button>
          </form>
            </div>
        </div>
        
</div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('include');?>/js/login.js"></script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  </body>

</html>
