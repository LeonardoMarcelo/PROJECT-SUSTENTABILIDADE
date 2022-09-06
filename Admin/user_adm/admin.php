<?php
ob_start();
require_once '../../Developers/Config.php';

//Verifica Existência das Sessões

if (
    !$_SESSION['user_level'] ||
    !$_SESSION['user_email'] ||
    !$_SESSION['logged'] ||
    !$_SESSION['user_token'] ||
    (!$_SESSION['user_id'] && $_SESSION['blocked'] == 1)
) {
    session_destroy();
    unset($_SESSION['user_level']);
    unset($_SESSION['user_email']);
    unset($_SESSION['user_id']);
    unset($_SESSION['user_token']);
    unset($_SESSION['logged']);
    header('Location: ../../index.php');
}

if ($_SESSION['user_level'] < LEVEL_SUPER) {
    header('Location: ../../index.php');
}
$all = retornoDados::ListTurmas();
$table_registers  = retornoDados::listAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/datatables.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../../assets/css/styles.css">

    <!--CSS Table-->

  </head>
  <body>
    <div class="grid-container">
    <?php
    $action = strip_tags(
        filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRIPPED)
    );
    if ($action == 'logout') {
        session_destroy();
        unset($_SESSION['user_level']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_id']);
        unset($_SESSION['user_token']);
        unset($_SESSION['logged']);
        header('Location: ../../index.php');
    }
    ?>
      <!-- Header -->
      <header class="header">
        <div class="menu-icon" onclick="openSidebar()">
          <span class="material-icons-outlined">menu</span>
        </div>
      
        <div class="header-right">
          <span class="material-icons-outlined">account_circle</span>
        </div>
      </header>
      <!-- End Header -->

      <!-- Sidebar -->
      <aside id="sidebar">
        <div class="sidebar-title">
          <div class="sidebar-brand">
            <span class="material-icons-outlined">inventory</span> Painel Admin
          </div>
          <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
        </div>

        <ul class="sidebar-list">
          <li class="sidebar-list-item">
          <a   href="./cardapio.php" class="nav__link_featured">
            <span class="material-icons-outlined">dashboard</span> Cardápio
            </a>
          </li>
      

          <li class="sidebar-list-item">
          <a   href="?action=logout" class="nav__link"> 
               <span class="material-icons-outlined">user_logout</span> Sair
            </a>
         
          </li>
          
        </ul>
      </aside>
      <!-- End Sidebar -->

      <!-- Main -->
      <main class="main-container">
        <div class="main-title">
          <p class="font-weight-bold">DASHBOARD</p>
        </div>

        <div class="main-cards">
     <?php 
   
     
     foreach ($all as $todos) {
    
        
    
      ?>
          <div class="card">
            <div class="card-inner">
        
               <p class="text-primary"><?php  echo $todos->nome_serie; ?></p>
              <span class="material-icons-outlined text-blue">inventory_2</span>
            </div>
            <span class="text-primary font-weight-bold"><?php echo 'Sala: ' .
                $todos->sala; ?></span>
          </div>
      <?php }   ?>
     

        </div>

        <div class="charts">

          <div class="charts-card">
            <p class="chart-title">Top 5 Products</p>
            <div id="bar-chart"></div>
          </div>

          <div class="charts-card">
            <p class="chart-title">Purchase and Sales Orders</p>
            <div id="area-chart"></div>
          </div>

        </div>

        <div class="row ">
            <div class="col-12 ">
                <div class="data_table">
                    <table id="example" class="table table-striped table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>Data</th>
                                <th>Nome da turma</th>
                                <th>Quantidade total de alunos</th>
                                <th>Quantidade de alunos lanche da manhã</th>
                                <th>Quantidade de alunos Almoço</th>
                                <th>Quantidade de alunos lanche da tarde</th>
                              
                            </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($table_registers as $controleDiarioComida) { ;
                       
                          ?>
                            <tr>
                                <td><?php
                                $date = new DateTime(
                                    $controleDiarioComida->data
                                );
                                echo $date->format('d/m/Y');
                                ?>
                                </td>
                                <td><?php echo $controleDiarioComida->nome_serie; ?></td>
                                <td><?php echo $controleDiarioComida->qtd_total =
                                    $controleDiarioComida->lanche_manha +
                                    $controleDiarioComida->almoco +
                                    $controleDiarioComida->lanche_tarde; ?></td>
                                <td><?php echo $controleDiarioComida->lanche_manha; ?></td>
                                <td><?php echo $controleDiarioComida->almoco; ?></td>
                                <td><?php echo $controleDiarioComida->lanche_tarde; ?></td>
                                <?php } ?>
                            </tr>
                         
                        </tbody>
                    </table>
                </div>
            </div>
            </div>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../../assets/js/datatables.min.js"></script>
    <script src="../../assets/js/pdfmake.min.js"></script>
    <script src="../../assets/js/vfs_fonts.js"></script>
    <script src="../../assets/js/custom.js"></script>
   
    <!-- Scripts -->
    <!-- ApexCharts -->
    <!-- Custom JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.3/apexcharts.min.js"></script>
    <script src="../../assets/js/scripts.js"></script>
    <?php ob_end_flush(); ?>
  </body>
</html>