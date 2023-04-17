<?php

require_once("./config.php");
require_once("./app/models/DB.class.php");


    if(isset($_GET['editar']))
    {
        $SQL = "UPDATE publicacoes SET imgpublicacao = ?, bannerpublicacao = : ?, titulo = : ?, subtitulo = : ?, descricao = : ? WHERE idpublicacao = ?";

        $array = array(
            $_POST['imgpublicacao'],
            $_POST['bannerpublicacao'],
            $_POST['titulo'], 
            $_POST['subtitulo'], 
            $_POST['descricao'], 
            $_POST['pubEdita']);

        $edita = new DB ($host, $banco, $usuario, $senha);

        if ($edita -> rodaSQL($SQL, $array) == true)
        {
            echo '<script>location.href="?op=3&ok"</script>';
        }

        else
        {
            echo '<script>location.href="?op=3&erro"</script>';
        }
    }

    if(isset($_GET['edita']))
    {

        $pegaDados = new DB ($host, $banco, $usuario, $senha);

        $SQL =" SELECT FROM publicacoes WHERE idpublicacao = ?";
        
        $array = array($_GET['id']);
        
        $dado = $pegaDados -> buscaDados ($SQL, $array);
    }

    if(isset($_GET['apaga']))
    {
        $deleta = new DB ($host, $banco, $usuario, $senha);

        $SQL =" DELETE FROM publicacoes WHERE idpublicacao = ?";

        $array =array(
            $_GET["id"]
        );

            if ($deleta->apaga($SQL, $array) == true)
            {
                echo '
                <script>
                    location.href="op=3&ok;
                </script>
                ';
            }
            else
            {
                echo '
                <script>
                    location.href="op=3&erro";
                </script>
                ';
            }
    }

?>


<h1>Publicação de Noticias</h1>

<form class="container-fluid" action="<?php echo (!isset($_GET['edita'])) ? './app/controls/publicacoesController.php' : '? op=3&editar'; ?>" method="POST" enctype="multipart/form-data" novalidate > 


    <?php if(isset($_GET['edita'])) { ?>

        <!-- Input oculto que armazena o id para a edição-->
        <input type="hidden" name="pubEdita" value="<?php echo @$dado[0]->idpublicacao; ?>">
    <?php }?>

    <div class="row" >
        <!-- input oculto que armazena o id para a edição -->

        <div class="form-floating col-md-6 m-md-0 mt-md-3 ">
            <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título da publicação" maxlength="77" minlength="20" required value="<?php echo @$dado[0]->titulo; ?>">
            <label for="titulo" class="ps-md-4" >Título da Publicação</label>
        </div>

        <div class="form-floating col-md-6 m-md-0 mt-md-3 ">
            <input type="text" class="form-control " id="subtitulo" name="subtitulo" placeholder="Título do texto" maxlength="77" minlength="20" required value="<?php echo @$dado[0]->subtitulo; ?>">
            <label for="subtitulo" class="ps-md-4" >Subtítulo do Texto</label>
        </div>
        
        <div style ='height:45%;' class="col-md-12 m-md-0 mt-md-0" >
            <label for="text" class="form-label"></label>
            <textarea style ='height:80%' id="descricao" name="descricao" placeholder="Descrição da Publicação" class="form-control" rows="3" value="<?php echo @$dado[0]->descricao; ?>"></textarea>
        </div>

        <div class="col-md-5 m-md-0 mt-md-4">
            <label class="d-none" for="imgpublicacao" class="form-label"> Imagem </label>
            <input class="form-control form-control-lg " id="imgpublicacao" name="imgpublicacao" type="file" accept="image/png, image/jpg, image/gif, image/jpeg" value="<?php @$dado[0]->$imagem ?>" >
        </div>

        <div class="col-md-5 m-md-0 mt-md-4">
            <label class="d-none" for="bannerpublicacao" class="form-label"> Imagem </label>
            <input class="form-control form-control-lg " id="bannerpublicacao" name="bannerpublicacao" type="file" accept="image/png, image/jpg, image/gif, image/jpeg" value="<?php @$dado[0]->$banner ?>" >
        </div>
    </div>

    <?php if(!isset($_GET['edita'])) { ?>
        <div class="col-md-2 mt-md-4">
            <label class="d-none" for="enviar">Cadastrar a Publicação</label>
            <input style = "height: 6.1vh; width: 11.8vw" type="submit" name="enviar" class="btn btn-primary" value="Cadastrar a Publicação" id="enviar"  >
        </div>
        <?php } else { ?>
            <div class="col-md-2 mt-md-4">
            <label class="d-none" for="enviar">Alterar a Publicação</label>
            <input style = "height: 6.1vh; width: 11.8vw" type="submit" name="alterar" class="btn btn-primary" value="Alterar a Publicação" id="alterar"  >
        </div>
        <?php } ?>
</form>

<table class="table table-secondary col-md-10 table-striped table-hover align-middle mt-md-3" style="width: 95%; margin-left: 2,5%;">
    <tr>
        <th scope="col">#</th>
        <th scope="col">Publicação</th>
        <th scope="col">Banner</th>
        <th scope="col">Titulo da Publicação</th>
        <th scope="col">Subtítulo</th>
        <th scope="col">Descrição</th>
        <th scope="col">Editar</th>
    </tr>    

    <?php 
        // rodamos a busca da tabela de usuários
        require_once("./app/models/DB.class.php");
        require_once("./config.php");

        //cria o objeto e abre automaticamente a conexão com o bd
        $busca = new DB($host, $banco, $usuario, $senha);

        $SQL = "SELECT * FROM publicacoes ORDER BY idpublicacao DESC";

        $array = array();
        
        $i = 1;

        foreach( $resultados = $busca -> buscaDados($SQL, $array) as $res)
        {
    ?>

   

    <tr >
        <td class="text-center"><?php echo $i; $i++;?></td>
        <td ><img style= "width: 150px; " src="./public_html/imagens/publicacoes/<?php echo @$res->imgpublicacao; ?>" alt="Miniatura publicação 01"></td>
        <td><img style= "width: 150px;" src="./public_html/imagens/publicacoes/banners/<?php echo @$res->bannerpublicacao; ?>" alt="Miniatura banner 01"></td>
        <td>
           <a><?php echo $res-> titulo?></a>
        </td>
        <td>
            <a><?php echo $res-> subtitulo?></a>     
        </td>
        <td>
            <a><?php echo $res-> descricao?></a>
        </td>
        <td>
            <a href="?op=3&edita&id=<?php echo $res->idpublicacao; ?>">
            <i class="bi bi-pencil-square h4 p-md-3"></i></a>
            <a href="?op=3&apaga&id=<?php echo $res->idpublicacao; ?>"> 
            <i class="bi bi-trash3 h4 p-md-3"></i></a>
        </td>
    </tr>
    <?php } ?>
</table>
