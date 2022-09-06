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
          <a   href="admin.php" class="nav__link_featured">
            <span class="material-icons-outlined">dashboard</span> Dashboard
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
          <p class="font-weight-bold">CARDÁPIO</p>
          <div class="container">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
             Adicionar cardápio do dia
            </button>
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
      

          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Adicionar ao Cardápio</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                <form action="../actionAddCardapio.php" method="POST">
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Data do Cardápio</label>
                    <input type="date" class="form-control" id="data" name="data" required>
                  </div>
                  <div class="mb-3">
                    <label for="lanche_manha" class="form-label">Lanche da Manhã</label>
                    <input type="text" class="form-control" id="lanche_manha" required name="lanche_manha" placeholder="Digite o lanche da manhã">
                  </div>
             
                  <div class="mb-3">
                    <label for="almoco" class="form-label">Almoço</label>
                    <input type="text" class="form-control" id="almoco" name="almoco" required placeholder="Digite o almoço">
                  </div>
             
                  <div class="mb-3">
                    <label for="lanche_tarde" class="form-label">Lanche da Tarde</label>
                    <input type="text" class="form-control" id="lanche_tarde"required name="lanche_tarde"placeholder="Digite o lanche da tarde">
                  </div>
             
                
               
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">fechar</button>
                  <button type="submit" class="btn btn-primary">Adicionar Cardápio</button>
                </div>
                </form>
              </div>
            </div>
          </div>
  </main>
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
    <!-- Custom JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.3/apexcharts.min.js"></script>
    <script src="../../assets/js/scripts.js"></script>
    <?php ob_end_flush(); ?>
  </body>
</html>