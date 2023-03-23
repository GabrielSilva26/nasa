<?php

    require_once("../../config.php");

    if( $_POST == null )
    {
        header("Location: " . CAMINHO . "painel.php?op=2"); // cabeçalho do arquivo / redirecionando
    }
    

    // receber os dados
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $email = $_POST['email'];
    $user = $_POST['usuario'];
    $pass = $_POST['senha'];
    $endereco = $_POST['endereco'];
    $numero = $_POST['numero'];
    $cep = $_POST['cep'];
    $complemento = $_POST['complemento'];
    $bairro = $_POST['bairro'];
    $cpf = $_POST['CPF'];

    // cadastrar no BD
    require_once("../models/DB.class.php");
    $insereUsuario = new DB( $host, $banco, $usuario, $senha );

    $SQL = "INSERT INTO usuarios ( nome, sobrenome, email, senha, cpf, usuario ) VALUES ( ?, ?, ?, ?, ?, ? )";

    $valores = array( 
        $nome, 
        $sobrenome, 
        $email, 
        $pass, 
        $cpf, 
        $user
    );

    $executa = $insereUsuario -> rodaSQL( $SQL, $valores );

    if( $executa == false )
    {
        //echo '<script> location.href="painel.php?op=2"&erro; </script> ';
        
        // redirecionando com PHP
        header("Location: ../../painel.php?op=2&erro");
    }
    else
    {
        header("Location: ../../painel.php?op=2&ok");
    }

    // dar uma mensagem do usuário

?>