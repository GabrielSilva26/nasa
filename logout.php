<?php
session_start();

// remove a session do serviodr como se o navegador tivesse sido fechado
session_destroy();

header("Location: ./painel.php");

?>