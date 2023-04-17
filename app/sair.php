<?php



if((isset($_SESSION['email']) == true) and (isset($_SESSION['senha']) == true)){

    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header('Location: login.php');
    echo ("<SCRIPT LANGUAGE='JavaScript'>
window.location.href='./index.php';
</SCRIPT>");

}





?>