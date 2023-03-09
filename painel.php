<?php
    // Montar um switch/case que pegue a variável op que está na url e quando seu valor for 1 carregue a página banners. php dentro da section


    // checamos se a variável GET(url) existe
    if (isset($_GET['op'])) 
    {
    switch ($_GET['op']) 
     {
        case "1":
        $arquivo = "./app/banners.php";
        break;

        case "2":
        $arquivo = "./app/cadastra.php";
        break;

     }
    }
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Painel Administrativo </title>

    <link rel="stylesheet" href="./vendor/bootstrap-5.0.2-dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">

    <script src="./vendor/bootstrap-5.0.2-dist/js/bootstrap.min.js" defer> </script>

    <style type="text/css">

    main
    {
        width: 100vw;
        height: 100vh;
    }

    </style>
</head>
<body>

 <main class="d-flex bg-light">
    
    <nav class="bg-dark col-12 col-md-2 p-4 p-md-2">
        
        <a class="text-light text-decoration-none col-md-12 d-block p-md-3 mt-md-2" href="?op=1"> <i class="bi bi-images"> </i> Banners </a>

        <a class="text-light text-decoration-none col-md-12 d-block p-md-3 mt-md-2" href="?op=2"> <i class="bi bi-people-fill"></i> </i> Registro </a>
    </nav>

    <section class=" col-12 col-md-10 p-md-5">

    <?php
    if( isset($_GET['op']))
    {
      require_once($arquivo);
    }

    ?>
    </section>
 </main>
    
</body>
</html>