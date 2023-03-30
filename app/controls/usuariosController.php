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
    $cpf = $_POST['cpf'];

    // cadastrar no BD
    require_once("../models/DB.class.php");
    $insereUsuario = new DB( $host, $banco, $usuario, $senha );

    $SQL = "INSERT INTO usuarios ( nome, sobrenome, email, senha, cpf, usuario ) VALUES ( ?, ?, ?, ?, ?, ? )";

    $pass2 = $insereUsuario -> criptografaDados($pass); // senha criptografada

    $valores = array( 
        $nome, 
        $sobrenome, 
        $email, 
        $pass2, 
        $cpf, 
        $user
    );

    if( $insereUsuario -> rodaSQL( $SQL, $valores ) == false )
    {
        //echo '<script> location.href="painel.php?op=2"&erro; </script> ';
        
        // redirecionando com PHP
       // header("Location: ../../painel.php?op=2&erro");
    }
    else
    {

    $ultimo = $insereUsuario->pegaUltimo();

    $SQL2 = "INSERT INTO enderecos (endereco, numero, cep, complemento, bairro, usuarios_id_usuario ) VALUES (?, ?, ?, ?, ?, ?)";

    $array2 = array(
        $_POST['endereco'],
        $_POST['numero'],
        $_POST['cep'],
        $_POST['complemento'],
        $_POST['bairro'],
        $ultimo[0]['LAST_INSERT_ID()']
    );

    var_dump($array2);

    if($insereUsuario->rodaSQL($SQL2, $array2) == true )
    {
        header("Location: ../../painel.php?op=2&ok");
    }
    else
    {
        header("Location: ../../painel.php?op=2&erro");
    }
}
    // dar uma mensagem do usuário

?>