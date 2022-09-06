<?php
/*
    ***********************************************
    CONFIG.PHP - PARAMETRIZAÇÃO DE NOSSA APLICAÇÃO.
    ***********************************************
    Copyright (c) 2020, Jeferson Souza MESTRES DO PHP
*/

//Iniciando a Sessão em Toda Nossa Aplicação
session_start();

//Configurando o Timezone e a Data Hora do Nosso Servidor
date_default_timezone_set('America/Sao_paulo');

//Configurações da Base de Dados
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DB', 'backend');

//Chamada da Conexão
require 'Connection.php';



/* Configurações de Níveis de Acesso */
define('LEVEL_USER', 8); //Nível de Acesso Para Usuários [Operacionais]
define('LEVEL_SUPER', 10); //Nível de Acesso Para Profissional Web [Você]

/* Configurações de Servidor de E-mail */
define('MAIL_HOST', 'smtp.gmail.com'); //Definição Configuração de Host do Servidor
define('MAIL_SMTP', 'smtp.gmail.com'); //Definição Configuração de SMTP do Servidor
define('MAIL_USER', 'teamlag434@gmail.com'); //Definição Configuração de Login de Usuário
define('MAIL_PASS', 'senha123321an'); //Definição Configuração de Senha de Acesso
define('MAIL_RESPONSE', 'teamlag434@gmail.com'); //Definição Configuração de E-mail Para Resposta
define('MAIL_PORT', 587); //Definição Configuração de Porta do Servidor [587 ou 465]
define('MAIL_SECURE', 'SSL'); //Definição Configuração de Segurança [TLS/SSL]

/*Configurações de Módulos*/
define('MINUTOS_BLOQUEIO', 10); // Constante com a quantidade minutos para bloqueio
define('TENTATIVAS_ACEITAS', 5); //Quantas Tentativas Usuário Pode Fazer Antes de Bloquear
define('REMEMBER', 1); //Lembrar Senha
define('TITLE_LOGIN', 'Login Auth 2.0'); //Nome da Aplicação
define('LOGINACTIVE', 1); //Login Ativo - Módulo Possibilita Acesso Direto, Se Houver Cookies. Para Funcionar Precisa do Remember Ativo.
define('LOGCREATE', 1); //Cria Log com .txt de Login (NOT APPLICATED)
define('LOGINHISTORY', 1); //Cria Histórico de Login - Salve no Banco de Dados. (NOT APPLICATED)

// funcoes do painel adm

abstract class retornoDados
{
    static function ListTurmas()
    {
        try {
            $pdo = Conn::conectar();
            $listTurmas = $pdo->prepare(
                'SELECT nome_serie,sala FROM turmas GROUP BY nome_serie '
            );
            $listTurmas->execute();
            $listTurmas = $listTurmas->fetchAll(PDO::FETCH_OBJ);
            return $listTurmas;
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
    static function listAll()
    {
        try {
            $pdo = Conn::conectar();
            $all = $pdo->prepare(
                'SELECT * FROM turmas '
            );
            $all->execute();
            $all = $all->fetchAll(PDO::FETCH_OBJ);
            return $all;
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
  
    static function listCardapio()
    {
        try {
            $pdo = Conn::conectar();
            $calendarioComida = $pdo->prepare(
                'SELECT * FROM calendario_comida  '
            );
            $calendarioComida->execute();
            $calendarioComida = $calendarioComida->fetchAll(PDO::FETCH_OBJ);

            return $calendarioComida;
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
    static function representanteDados()
    {
        try {
            $pdo = Conn::conectar();

            $representanteDados = 'SELECT *, turmas.id AS user_turma_id FROM users INNER JOIN turmas ON users.user_turma_id = turmas.id    WHERE user_turma_id = ?  LIMIT 1';
            $stm = $pdo->prepare($representanteDados);
            $stm->bindValue(1, $_SESSION['user_turma_id']);
            $stm->execute();
            $retorno = $stm->fetch(PDO::FETCH_OBJ);

            return $retorno;
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
}
