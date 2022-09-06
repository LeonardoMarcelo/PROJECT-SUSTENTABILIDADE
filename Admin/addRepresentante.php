<?php

require_once './../Developers/Config.php';
$pdo = Conn::conectar();
$representanteDados = retornoDados::representanteDados();

if($_SERVER["REQUEST_METHOD"] == "POST")
{
   $data = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRIPPED);


 
    // var_dump($data);
        //CRIAR AS VALIDAÇÕES DE CAMPOS VAZIOS E TUDO MAIS
        $sql = "INSERT INTO turmas VALUES(DEFAULT, :nome_serie,  :sala,  :lanche_manha, :almoco, :lanche_tarde,:data)";
        $res = $pdo->prepare($sql);
        $res->bindValue("data", $data["data"]);
        $res->bindValue("nome_serie", $representanteDados->nome_serie );
        $res->bindValue("lanche_manha",$data["lanche_manha"]);
        $res->bindValue("almoco", $data["almoco"]);
        $res->bindValue("lanche_tarde",$data["lanche_tarde"]);
        $res->bindValue("sala",$data["sala"]);
  
        $res->execute();
    
        //DEBUG
        #$res->debugDumpParams();
    
        if($res->rowCount()>0)
        {
    //        
            $_SESSION['msg'] = '<div class="alert alert-success" role="alert">
            This is a success alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
          </div>';

            header("Location: ./user_representante/representante.php");
        }
    }


