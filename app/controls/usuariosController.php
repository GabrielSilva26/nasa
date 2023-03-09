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
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
    $endereco = $_POST['endereco'];
    $numero = $_POST['numero'];
    $cep = $_POST['cep'];
    $complemento = $_POST['complemento'];
    $bairro = $_POST['bairro'];

    // cadastrar no BD
    require_once("../models/DB.class.php");
    $insereUsuario = new DB( $host, $banco, $usuario, $senha );

    $SQL = "INSERT INTO usuarios ( nome, sobrenome, email, senha, cpf, usuario ) VALUES ( ?, ?, ?, ?, ?, ? )";

    $valores = array( 
        $nome, 
        $sobrenome, 
        $email, 
        $senha, 
        $cpf, 
        $usuario
    );

    if(!$insereUsuario -> rodaSQL( $SQL, $valores ));
    {
        echo "Problema ao realizar o cadastro.";
    }

    // dar uma mensagem do usuário

?>