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

            Estruturas de repetição (loop)

                for
                foreach
                while
                do while
    */


    if (isset($_GET['pagina'])) {

        switch ($_GET['pagina']) {
            case "briefing":
                $endereco = "./app/briefing.php";
                break;
        }
        require_once($endereco);
    }

    /* Chamadas do Banner */
    $imagens = array (
      "https://via.placeholder.com/1920x1080.png?text=Banner+01",
      "https://via.placeholder.com/1920x1080.png?text=Banner+02",
      "https://via.placeholder.com/1920x1080.png?text=Banner+03"
    );

    $alt = array (
      "Banner 01",
      "Banner 02",
      "Banner 03"
    );

    $tituloImg = array(
      "Titulo da Imagem 01",
      "Titulo da Imagem 02",
      "Titulo da Imagem 03"
      );

    $subtituloImg = array(
      "Subtítulo da Imagem 01",
      "Subtítulo da Imagem 02",
      "Subtítulo da Imagem 03"
    );

    ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Impedir o cache do navegador -->
    <meta http-equiv="Cache-Control" content="no-cache, no-store">
    <meta http-equiv="Pragma" content="no-cache, no-store">
    
    <title>Home do Site</title>

    <link rel="stylesheet" href="./vendor/bootstrap-5.0.2-dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="./vendor/line_awesome/css/line-awesome.min.css">

    <link rel="stylesheet" href="./public_html/css/devappSite.css">
    
    <script src="./vendor/bootstrap-5.0.2-dist/js/bootstrap.min.js" defer ></script>

</head>
<body>
    <main class= "container-fluid">

    <nav id="menu">
    <a href="./">
          <img src="https://via.placeholder.com/120x60.png?text=Logo" alt="logotipo" title="Clique para voltar à Home">
    </a>
          
    <a href="#"><i class="las la-bars"></i></a>

    <a href="?pagina=briefing">Briefing ONG</a>

    <a href="#">  <i class="las la-lock"></i> Painel</a>
    </nav>

    <section id="banner">

    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">

      <?php 
          foreach($imagens as $item)
          {
            ?>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      

      <?php } ?>

        </div>

      <div class="carousel-inner">

      <?php
          // Para cada imagem cadastrada será criado o HTML abaixo
          
      // conta os itens dentro do array
      $qtadeImg = count($imagens);
      foreach ($imagens as $item) {

        // variável de índice
        $i = 0;

        // 3 > 0
        while($qtadeImg > $i)
        ?>

        <div class="carousel-item active">
          <img src="<?php echo $imagens[ $i ]; ?>" class="d-block w-100" alt="<?php echo $alt [$i]; ?>">
          <div class="carousel-caption d-none d-md-block">
            <h5><?php echo $tituloImg [$i]; ?></h5>
            <p><?php echo $subtituloImg [$i]; ?></p>
          </div>
        </div>

        <?php 
          $i++;// incrementa 01 ao valor de $i 
        } ?>

      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
      
    </section>

</main>
</body>
</html>