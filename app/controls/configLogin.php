<?php

session_start();

if (isset($_POST['email']) && isset($_POST['senha'])) {
    require_once('../../config.php');
    require_once('../models/DB.class.php');

    $db = new DB($host, $banco, $usuario, $senha);


    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE email = :email and senha = :senha";

    $senhaCriptografada = $db -> criptografaDados($senha);
    
    $prepara_anitta = $db->pegaConexao()->prepare($sql);
    $prepara_anitta->bindValue(':email', $email );
    $prepara_anitta->bindValue(':senha', $senhaCriptografada);
    $prepara_anitta->execute();

    if ($prepara_anitta->rowCount() <1) {

        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Email ou senha estão incorretos!')
        window.location.href='../../../login.php';
        </SCRIPT>");
    } else {
        $_SESSION['email'] = $email;
        $_SESSION['senha'] = $senha;
        header('Location: ../../../painel.php');
        exit;
    }
} else {
    header('Location: ../.././public/login.php');
    exit;
}
?>