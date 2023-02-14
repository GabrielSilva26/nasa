<h1>Administração dos Banners</h1>

<form class="d-flex"> 

<div class="container-fluid">

  <div class="form-floating mb-3 col-md-4 m-md-2">
    <input type="text" class="form-control" id="titulo" placeholder="Título da Imagem" maxlength="77" minlength="20" required>
    <label for="titulo">Título Banner 01</label>
  </div>

  <div class="form-floating mb-3 col-md-4 m-md-2">
    <input type="text" class="form-control" id="subtitulo" placeholder="Subtítulo da Imagem" maxlength="77" minlength="20" required>
    <label for="subtitulo">Subtítulo Banner 01</label>
  </div>

  <div class="col-md-4">
    <label class="d-none" for="banner01" class="form-label">Banner 01</label>
    <input class="form-control form-control-lg" id="banner01" name="banner01" type="file">
  </div>
</div>

  <div class="flex-md-nowrap">
    <label class="d-none" for="enviar"> Cadastrar os Banners </label>
    <input type="submit" name="enviar" class="btn btn-primary" value="Cadastrar os Banners" id="enviar">
  </div>

</form>