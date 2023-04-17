

<?php

session_start();

    if (isset($_GET['pagina']))
    {
        switch($_GET['pagina'])
        {

            case "briefing":
                $endereco = "./app/briefing.php";
                break;

        }

        require_once($endereco);
    }

        /* Chamadas do banner */
    $imagens = array
    (
        "https://picsum.photos/1920/1080",
        "https://via.placeholder.com/1920x1080.png?text=banner+02",
        "https://via.placeholder.com/1920x1080.png?text=banner+03"
    );

    $alt = array
    (
        "Banner 01",
        "Banner 02",
        "Banner 03" 
    );

    $tituloImg = array 
    (
        "Título da imagem 01",
        "Titulo da imagem 02",
        "Titulo da imagem 03"
    );

    $subTituloImg = array
    (
        "Subtítulo da imagem 01",
        "Subtítulo da imagem 02",
        "Subtítulo da imagem 03"
    );

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>NASA - Página principal</title>
    <meta name="autor" content="João Vitor, Nicolas Cunha, Adriano Angioletto e Gabriel Almeida">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Site com ferramentas úteis para o trabalho designado">
    <meta name="keyboards" content="Projeto final NASA, T92, web design, UC16">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Impedir o cache do navegador-->
    <meta http-equiv="cache-control" content="no-cache, no-store">
    <meta http-equiv="Pragma" content="no-cache, no-store">

    <link rel="stylesheet" href="./vendor/bootstrap-5.0.2-dist/css/bootstrap.min.css"></link>

    <link rel="stylesheet" href="./public_html/css/nasaSite.css">

    <script src="./vendor/bootstrap-5.0.2-dist/js/bootstrap.min.js" defer></script>
</head>
<body>

    <main class="container-fluid">

        <nav id="menu">

            <a href="./">
            <img src = "https://via.placeholder.com/120x60.png?text=Logo" alt="logotipo" title="clique para voltar à home">           
            </a>
            <a href="#"><i class= "las la-bars"></i></a>
            <a href="?pagina=briefing"> Briefing ONG</a>
            <a href="./login.php"><i class="las la-lock"></i> Painel</a>

        </nav>

        <section id = "banner">

            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
        
            <?php
                $indice = 0;

                foreach($imagens as $item)
                {          
            ?>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?php echo $indice; ?>" class="<?php echo $indice == 0 ? "active" : ""; ?>" aria-current="true" aria-label="Slide <?php echo $indice; $indice++; ?>"></button>
        <?php } ?>

            </div>

            <div class="carousel-inner"></div>
            
            <?php
            //conta os itens dentro do array
            $qtdadeImg = count($imagens);

            //variável de índice
            $i = 0;
        
            while($qtdadeImg > $i)
            {
            ?>
                <div class="carousel-item <?php echo $i == 0  ? "active" : ""; ?> ">
                    <img src="<?php echo $imagens [$i]; ?>" class="d-block w-100" alt="<?php $alt[$i] ;?>">
                        <div class="carousel-caption d-none d-md-block">
                        <h5><?php echo $tituloImg [$i]; ?></h5>
                        <p><?php echo $subTituloImg[$i]; ?></p>
                        </div>
                </div>
        <?php
            $i++; // Incrementa 01 ao valor de $i
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