<?php
    session_start();
    // bloqueia o acesso caso a pessoa não esteja logada
    if(!isset($_SESSION['logado']) || $_SESSION['logado'] == false )
    {
        echo '<script> location.href = "./painel.php?op=0";</script>';
    }


?>