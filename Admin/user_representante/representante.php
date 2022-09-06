<?php
ob_start();
require_once '../../Developers/Config.php';

//Verifica Existência das Sessões

if (
    !$_SESSION['user_turma_id'] ||
    !$_SESSION['user_level'] ||
    !$_SESSION['user_email'] ||
    !$_SESSION['logged'] ||
    !$_SESSION['user_token'] ||
    (!$_SESSION['user_id'] && $_SESSION['blocked'] == 1)
) {
    session_destroy();
    unset($_SESSION['user_turma_id']);
    unset($_SESSION['user_level']);
    unset($_SESSION['user_email']);
    unset($_SESSION['user_id']);
    unset($_SESSION['user_token']);
    unset($_SESSION['logged']);
    header('Location: ../../index.php');
}
if ($_SESSION['user_level'] < LEVEL_USER) {
    header('Location: ../../index.php');
}
$representanteDados = retornoDados::representanteDados();
$controle = retornoDados::listCardapio();

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

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="../../assets/css/datatables.min.css">
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <link rel="stylesheet" href="../../assets/css/representante.css">
  </head>
  <body>
    <div class="grid-container">
    <?php

        $action = strip_tags(filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRIPPED));
        if ($action == 'logout') {
            session_destroy();
            unset($_SESSION['user_turma_id']);
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
            <span class="material-icons-outlined">inventory</span> Painel representante
          </div>
          <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
        </div>

        <ul class="sidebar-list">
          <li class="sidebar-list-item">
            <span class="material-icons-outlined" >dashboard</span> Dashboard
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

          <div class="card">

            <div class="card-inner">
              <p class="text-primary"><?php echo $representanteDados->user_email?></p>
              <span class="material-icons-outlined text-blue">inventory_2</span>
            </div>
            <span class="text-primary font-weight-bold"><?php echo $representanteDados->nome_serie?></span>
           
     

          </div>

          
        </div>
        <div class="row">
            <div class="col-12">

                <div class="data_table">
                    <table id="example" class="table table-striped table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>Data</th>
                                <th>Lanche da manhã</th>
                                <th>Almoço</th>
                                <th>Lanche da tarde</th>
                               
                              
                            </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($controle as $cardapio) {?>
                            <tr>
                                <td><?php
                                $date = new DateTime($cardapio->data);
                                echo $date->format('d/m/Y');
                                ?>
                                </td>
                                <td><?php echo $cardapio->lanche_manha; ?></td>
                                <td><?php echo $cardapio->almoco; ?></td>
                                <td><?php echo $cardapio->lanche_tarde; ?></td>

                             
                            </tr>
                         <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
         
          </div>
        <div class="main-content ">
              <h1 class="big-title">Organize as distribuições de comida na escola</h1>

              <form action="../addRepresentante.php" method="POST">
                  <div class="form-data">
                      <div class="horario">
                          <label class="horario-label">Horario</label>
                          <p>Café da manhã</p>
                      </div>

                      <div class="numero">
                          <label for="numbers">Numero de pessoas</label>
                          <input id="numbers" name="lanche_manha" type="number" min="1" max="70" value="0" required>
                      </div>
                      <div class="horario">
                          <label class="horario-label">Horario</label>
                          <p>Almoço</p>
                      </div>

                      <div class="numero">
                          <label for="numbers">Numero de pessoas</label>
                          <input id="numbers" name="almoco" type="number" min="1" max="70" value="0"required>
                      </div>
                      <div class="horario">
                          <label class="horario-label">Horario</label>
                          <p>Lanche da tarde</p>
                      </div>

                      <div class="numero">
                          <label for="numbers">Numero de pessoas</label>
                          <input id="numbers" name="lanche_tarde" type="number" min="1" max="70" value="0"required>
                      </div>
                      <div class="numero">
                          <label for="numbers data">Data</label>
                          <input id="data" class="data" name="data" type="date" required>
                      </div>
                      <div class="numero">
                          <label for="numbers">Numero da sala</label>
                          <input id="numbers" name="sala" type="number" min="1" max="70" value="0"required>
                      </div>


                  </div>
                  <button type="submit" class="btn-primary btn-primary--pressed">Enviar</button>
              </form>
              </div>
      </main>
      </div>
      <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
              <img src="..." class="rounded mr-2" alt="...">
              <strong class="mr-auto">Bootstrap</strong>
              <small>11 mins ago</small>
              <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="toast-body">
              Hello, world! This is a toast message.
            </div>
          </div>

    </div>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../../assets/js/datatables.min.js"></script>
    <script src="../../assets/js/pdfmake.min.js"></script>
    <script src="../../assets/js/vfs_fonts.js"></script>
    <script src="../../assets/js/custom.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active');
                $('#content').toggleClass('active');
            });
            $('.more-button,.body-overlay').on('click', function() {
                $('#sidebar,.body-overlay').toggleClass('show-nav');
            });
        });
    </script>
    <!-- Scripts -->
    <!-- ApexCharts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.3/apexcharts.min.js"></script>
    <!-- Custom JS -->

    <script src="../../assets/js/scripts.js"></script>
    <?php ob_end_flush(); ?>
  </body>
</html>