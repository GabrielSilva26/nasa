<!-- View de administração dos Banners da Home -->


<h1>Administração dos Banners</h1>

<form class="container-fluid" action="./app/controls/bannersController.php" method="POST" enctype="multipart/form-data">
    <div class="row" >

    <div class="form-floating col-md-6 m-md-0 mt-md-3 ">
        <input type="text" class="form-control " id="titulo" name="titulo" placeholder="Título da Imagem" maxlength="77" minlength="10" required >
        <label for="titulo" class="ps-md-4" required" >Título Banner</label>
    </div>

    <div class="form-floating col-md-6 m-md-0 mt-md-3 ">
        <input type="text" class="form-control " id="subtitulo" name="subtitulo" placeholder="Subtítulo da Imagem" maxlength="77" minlength="10" required >
        <label for="subtitulo" class="ps-md-4" required >Subtítulo do Banner</label>
    </div>



    <div class="col-md-10 m-md-0 mt-md-3">
        <label class="d-none" for="banner01" class="form-label">Banner 01</label>
        <input class="form-control form-control-lg " id="banner01" name="banner01" type="file" accept="image/png, image/jpg, image/gif, image/jpeg" required >
    </div>

    <div class="col-md-2 mt-lg-3">
        <label class="d-none" for="enviar">Cadastrar os Banners</label>
        <input style = "height: 6.6vh; width: 11.8vw" type="submit" name="enviar" class="btn btn-primary" value="Cadastrar os Banners" id="enviar" >
    </div>

</form>


<table class="table table-secondary col-md-10 table-striped table-hover table-sm align-middle mt-md-5"
style="width: 95%; margin-left: 2.5%;">

    <tr>
      <th scope="col">#</th> 
      <th scope="col">Banner</th>
      <th scope="col">Título</th>
      <th scope="col">Subtítulo</th>
      <th scope="col"></th>
    </tr>





<?php
require_once("./config.php");
require_once("./app/models/DB.class.php");

$busca = new DB($host, $banco, $usuario, $senha);
$SQL = "SELECT * FROM banners ORDER BY idbanner DESC";
$array = array();
$i = 1;

foreach ($resultados = $busca->buscaDados($SQL, $array) as $res) {
    $titulo = $res->titulo;
    $subtitulo = $res->subtitulo;

    $imagem = $res->banner;

    $urlImagem = "./public_html/imagens/banners/";
    

    
?>


<tr>
    <td class="text-center"><?= $i ?></td>
    <td><img  src="<?php echo $urlImagem.$res->banner ?>" alt="miniatura banner" ></td>
    <td><?= $titulo ?></td>
    <td><?= $subtitulo ?></td>
    <td>       
        <a href="?op=1&apaga&id=<?php echo $res->idbanner; ?>"><i class="bi bi-trash3 h4 p-md-3"></i></a>
    </td>
</tr>

<?php
    $i++;
}

if( isset( $_GET['apaga'] ) )
{
    // faz o delete

    $deleta = new DB( $host, $banco, $usuario, $senha );

    $SQL = " DELETE FROM banners WHERE idbanner = ? ";

    $array = array(
        $_GET['id']


    );

    if( $deleta->apaga( $SQL, $array ) == true )
    {

        if( $deleta->apaga( $SQL, $array ) == true )
        {
            echo '
            <script> 
                location.href="?op=1&ok";
            </script>
            ';
        }
        else
        {
            echo '
            <script> 
                location.href="?op=1&erro";
            </script>
            ';
        }

    }
}




?>

</table>