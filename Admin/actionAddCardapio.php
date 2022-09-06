<?php

require_once './../Developers/Config.php';
$pdo = Conn::conectar();
if($_SERVER["REQUEST_METHOD"] == "POST")
{
   $data = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRIPPED);


 
    // var_dump($data);
        //CRIAR AS VALIDAÇÕES DE CAMPOS VAZIOS E TUDO MAIS
        $sql = "INSERT INTO calendario_comida VALUES(DEFAULT, :data, :lanche_manha, :almoco, :lanche_tarde)";
        $res = $pdo->prepare($sql);
        $res->bindValue("data", !empty($data["data"])? $data["data"]: null, PDO::PARAM_STR);
        $res->bindValue("lanche_manha", !empty($data["lanche_manha"])?$data["lanche_manha"]: null, PDO::PARAM_STR);
        $res->bindValue("almoco", !empty($data["almoco"])?$data["almoco"]: null, PDO::PARAM_STR);
        $res->bindValue("lanche_tarde", !empty($data["lanche_tarde"])?$data["lanche_tarde"]: null, PDO::PARAM_STR);
  
        $res->execute();
    
        //DEBUG
        #$res->debugDumpParams();
    
        if($res->rowCount()>0)
        {
            $_SESSION['msg'] = '<div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
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
          </div>';
    //         $_SESSION["msg"] = "<div class='alert alert-success alert-dismissible fade show text-center' role='alert'>
    //   <strong>Cliente cadastrado com sucesso</strong>
    //   <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    // </div>";
            header("Location: ./user_adm/admin.php");
        }
    }






