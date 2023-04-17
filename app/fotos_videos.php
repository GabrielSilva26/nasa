<?php

        require_once("./config.php");
        require_once("./app/models/DB.class.php");

if( isset( $_GET['apaga'] ) )
    {


        // faz o delete

        $deleta = new DB( $host, $banco, $usuario, $senha );

        $SQL = " DELETE FROM arquivos WHERE idarquivos = ? ";


        $array = array(
            $_GET['id']
        );

        if( $deleta->apaga( $SQL, $array ) == true )
        {

            if( $deleta->apaga( $SQL, $array ) == true )
            {
                echo '
                <script> 
                    location.href="?op=5&ok";
                </script>
                ';
            }
            else
            {
                echo '
                <script> 
                    location.href="?op=5&erro";
                </script>
                ';
            }

        }
    }


?>


<h1>Fotos e Videos</h1>

<form class="container-fluid" action="./app/controls/fotoController.php" method="POST" enctype="multipart/form-data" >
    <div class="row" >

    <div class="col-md-11 m-md-0 mt-md-3">
        <label class="d-none" for="arquivo01" class="form-label">Foto/Video</label>
        <input class="form-control form-control-lg " id="arquivo01" name="arquivo01" type="file" accept="image/png, image/jpg, image/gif, image/jpeg, video/mp4, video/mov, wmv, avi, webm">
    </div>

    <div class="col-md-4 mt-lg-4">
        <label class="d-none" for="enviar">Cadastrar Fotos/Videos</label>
        <input style = "height: 6.6vh; width: 11.8vw" type="submit" name="enviar" class="btn btn-primary" value="Cadastrar Fotos/Videos" id="enviar" >
    </div>

</form>

<!-- Tabela de exibição do que está cadastrado -->

<table class="table table-secondary col-md-2 table-striped table-hover align-middle mt-md-5 " style=" width: 98%; margin-left: 1.0%;"  >

    <tr>
        <th scope="col" >#</th>
        <th scope="col" >Foto/Video</th>
        <th scope="col" ></th>
    </tr>


    <?php
    require_once("./config.php");
    require_once("./app/models/DB.class.php");

$busca = new DB($host, $banco, $usuario, $senha);
$SQL = "SELECT * FROM arquivos ORDER BY idarquivos DESC";
$array = array();
$i = 1;

foreach ($resultados = $busca->buscaDados($SQL, $array) as $res) {
    $imagem = $res->arquivo;
    $urlImagem = "./public_html/imagens/fotos_videos/";
?>

    <!-- Início da repetição do PHP -->
    <tr>
    <td class="text-center"><?= $i ?></td>
    <td><img src="<?php echo $urlImagem.$res->arquivo ?>" alt="miniatura arquivo" width="100" height="100"></td>
    <td>         
        <a href="?op=5&apaga&id=<?php echo $res->idarquivos; ?>"><i class="bi bi-trash3 h4 p-md-3"></i></a>
    </td>
</tr>
<?php
    $i++;
}
?>
    <!-- Final da repetição do PHP -->

</table>