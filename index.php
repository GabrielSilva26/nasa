<?php

    /*
        HTTPS temos várias formas de envio de dados:
            - GET - url - www.nome.com.br/?variaveis=valor
                $_GET['variaveis']
                - usado para navegação
            - POST - 

        O PHP tem funções de importação de códigos:
            - require_once("nomedoarquivo")
                - inclui uma única vez
            - include("nomedoarquivo")
    */

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Home do Site</title>

    <link rel="stylesheet" href="./vendor/bootstrap-5.0.2-dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="./public_html/css/devappSite.css">
    
    <script src="./vendor/bootstrap-5.0.2-dist/js/bootstrap.min.js" defer ></script>

</head>
<body>
    <main class= "container-fluid"></main>

    <div class="collapse" id="navbarToggleExternalContent">
  <div class="bg-dark p-4">
    <h5 class="text-white h4">Collapsed content</h5>
    <span class="text-muted">Toggleable via the navbar brand.</span>
  </div>
</div>
<nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
</nav>


    <nav>
    <a href="./">Home</a>
    <a href="?pagina=briefing">Briefing ONG</a>
    </nav>

    <?php

    if (isset($_GET['pagina'])) {

        switch ($_GET['pagina']) {
            case "briefing":
                $endereco = "./app/briefing.php";
                break;
        }
        require_once($endereco);
    }
    ?>
    </main>

</body>
</html>