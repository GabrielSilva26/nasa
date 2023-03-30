<?php

    require_once("./config.php");
    require_once("./app/models/DB.class.php");

    $testeCrypto = new DB ($host, $banco, $usuario, $senha);

    $texto = "1234";

    echo $testeCrypto -> criptografaDados($texto);
?>