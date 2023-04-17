<?php

session_start();


if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)){

    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header('Location: login.php');
}


 $logado = $_SESSION['email'];




?>


<?php
//checamos se a várivel GET(url) existe
    if( isset( $_GET['op']) )
    {
        //if( $_GET['op'] == 1 ) {}
        switch( $_GET['op'] )
        {
            case "1" :
                $arquivo = "./app/banners.php";
            break;

            case "2" :
                $arquivo = "./app/usuarios.php";
            break;

            case "3" :
                $arquivo = "./app/publicacoes.php";
            break;

            case "4" :
                $arquivo = "./app/sair.php";
            break;
    
            case "5":
                $arquivo = "./app/fotos_videos.php";
            break;
        }
    }


    if( isset( $_GET['erro'] ) )
    {
        $textoMensagem = [ "Erro:", "Problema ao realizar a operação."];
        
        // Mostramos a mensagem usando Js
        echo '<script defer >
            // só disparar ao carregar todo o HTML
            document.addEventListener("DOMContentLoaded", function(e) 
            {
                document.querySelector(".alert").setAttribute( "class","alert alert-danger alert-dismissible fade show" );

                // permanece aberto por 3s
                setTimeout(function(){

                    document.querySelector(".alert").setAttribute( "class","alert alert-danger alert-dismissible fade hide" );

                },3000);
            });
        </script>';
    }
    
    if( isset( $_GET['ok'] ) )
    {
        $textoMensagem = [ "OK!:", "Operação realizada com sucesso."];
        
        // Mostramos a mensagem usando Js
        echo '<script defer >
            // só disparar ao carregar todo o HTML
            document.addEventListener("DOMContentLoaded", function(e) 
            {
                document.querySelector(".alert").setAttribute( "class","alert alert-success alert-dismissible fade show" );

                // permanece aberto por 3s
                setTimeout(function(){
                    document.querySelector(".alert").setAttribute( "class","alert alert-success alert-dismissible fade hide" );
                }, 3000);
            });
        </script>';
    }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>NASA - Painel de administração</title>
    <meta name="autor" content="João Vitor, Nicolas Cunha, Adriano Angioletto e Gabriel Almeida">
    <meta name="description" content="Site com ferramentas úteis para o trabalho designado">
    <meta name="keyboards" content="Projeto final NASA, T92, web design, UC16">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./vendor/bootstrap-5.0.2-dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">

    <script src="./vendor/bootstrap-5.0.2-dist/js/bootstrap.min.js" defer ></script>

    <script src="./vendor/vanilla-masker.js" defer ></script>

    <style type="text/css" >
       
    main
    {
        width: 100vw;
        height: 100vh;
    }

    </style>

</head>
<body>

    <div class="alert alert-warning alert-dismissible fade hide" role="alert" style="position:fixed; top: 0; left:0; width: 100vw; text-align: center; " >
        <strong><?php echo @$textoMensagem[0]; ?></strong> <?php echo @$textoMensagem[1]; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <main class="d-flex bg-light">
        <nav class=" bg-dark col-12 col-md-2 p-4 p-md-2">
            <a class=" text-light text-decoration-none col-md-12 d-block p-md-3 bg-danger mt-md-2 " href="?op=1"><i class="bi bi-images"></i> Banners</a>
            <a class=" text-light text-decoration-none col-md-12 d-block p-md-3 bg-danger mt-md-2 " href="?op=2"><i class="bi bi-people-fill"></i> Usuários</a>
            <a class=" text-light text-decoration-none col-md-12 d-block p-md-3 bg-danger mt-md-2 " href="?op=3"><i class="bi bi-file-earmark-plus"></i> Publicar Notícia</a>
            <a class=" text-light text-decoration-none col-md-12 d-block p-md-3 bg-danger mt-md-2 " href="?op=5"><i class="bi bi-images"></i> Fotos e Vídeos</a>
            <a class=" text-light text-decoration-none col-md-12 d-block p-md-3 bg-danger mt-md-2 " href="?op=4"><i class=""></i> Sair </a>
        </nav>

        <section class="col-12 col-md-10 p-md-4">
            
            <?php 
                if(isset($_GET['op']))
                {
                require_once($arquivo);
                }

            ?>

        </section>

    </main>

</body>
</html>