<!DOCTYPE html>
<html lang="en">
  
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>Finanças</title>

      <!-- Bootstrap core CSS-->
      <link href="<?= base_url('include');?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

      <!-- Custom fonts for this template-->
      <link href="<?= base_url('include');?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

      <!-- Page level plugin CSS-->
      <link href="<?= base_url('include');?>/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

      <!-- Custom styles for this template-->
      <link href="<?= base_url('include');?>/css/sb-admin.css" rel="stylesheet">
      <link href="<?= base_url('include');?>/css/sistema.css" rel="stylesheet">

      <!-- Morris Charts CSS -->
      <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/prettify/r224/prettify.min.css">
      <link rel="stylesheet" href="<?= base_url('include');?>/morris/morris.css">

    </head>

  <body id="page-top">
    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
          <a class="navbar-brand mr-1" href="<?= base_url('inicio');?>">Finanças</a>
      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
            <i class="fas fa-bars"></i>
          </button>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
              <a class="dropdown-item" href="#">Settings</a>
              <a class="dropdown-item" href="#">Activity Log</a>

              <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
              </div>
      </nav>

      <div id="wrapper">

          <!-- Sidebar -->
          <ul class="sidebar navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="<?= base_url('Inicio');?>">
                  <i class="fas fa-fw fa-tachometer-alt"></i>
                  <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('cartao');?>">
                  <i class="far fa-credit-card"></i>
                  <span>Cartões de Créditos</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-money-check-alt"></i>
                  <span>Transações</span>
                </a>
          
                <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                  <a class="dropdown-item" href="<?= base_url('transacao/index/1');?>">Receitas</a>
                  <a class="dropdown-item" href="<?= base_url('transacao/index/2');?>">Despesas</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link"  href="<?= base_url('conta');?>">
                  <i class="fas fa-university"></i>
                  <span>Contas</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('relatorio');?>">
                  <i class="fas fa-chart-bar"></i>
                  <span>Relatórios</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('categoria');?>">
                  <i class="fas fa-tags"></i>
                  <span>Categorias</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('login/logout');?>">
                  <i class="fas fa-sign-out-alt"></i>
                  <span>Sair do sistema</span>
                </a>
            </li>
          </ul>

          <div id="content-wrapper">
            <div class="container-fluid">