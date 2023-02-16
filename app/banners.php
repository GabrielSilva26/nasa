<!-- View de administração dos Banner da Home -->
<h1>Administração dos Banners</h1>

<form class="container-fluid" action="./app/controls/bannersController.php" method="POST" enctype="multipart/form-data" novalidate> 

<div class="row">

  <div class="form-floating mb-3 col-md-6 m-md-3">
    <input type="text" class="form-control" id="titulo" name="Título" placeholder="Título da Imagem" maxlength="77" minlength="20" required>
    <label for="titulo">Título Banner 01</label>
  </div>

  <div class="form-floating col-md-4 m-md-3">
    <input type="text" class="form-control" id="subtitulo" name="Subtítulo" placeholder="Subtítulo da Imagem" maxlength="77" minlength="20" required>
    <label for="subtitulo" class="ps-md-4">Subtítulo Banner 01</label>
  </div>

  <div class="col-md-6 m-md-3">
    <label class="d-none" for="banner01" class="form-label">Banner 01</label>
    <input class="form-control form-control-lg" id="banner01" name="banner01" type="file">
  </div>
</div>

  <div class="m-md-3">
    <label class="d-none" for="enviar"> Cadastrar os Banners </label>
    <input type="submit" name="enviar" class="btn btn-primary" value="Cadastrar os Banners" id="enviar">
  </div>

</form>

<!-- Tabela de exibição do que está cadastrado -->

<table class="table table-secondary col-md-10 table-striped table-hover table-sm align-middle mt-md-5"
style="width: 95%; margin-left: 2.5%;">

    <tr>
      <th scope="col">#</th> 
      <th scope="col">Banner</th>
      <th scope="col">Título</th>
      <th scope="col">Subtítulo</th>
      <th scope="col"></th>
    </tr>

    

<!-- Inicio da repetição do PHP -->
  <tr> 
    <td>1</td>
    <td> <img src="https://via.placeholder.com//100x80" alt="miniatura banner01"> </td>
    <td> Título </td>
    <td> Subtítulo </td>

    <td>
    <a href=""><i class="bi bi-pencil-square h4 p-md-3"></i></a>

    <a href=""><i class="bi bi-trash3 h4"></i></a>
  </td>
</tr>
    <!-- Fim da repetição do PHP -->
</table>