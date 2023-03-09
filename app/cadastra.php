<h1> Administração dos Usuários </h1>

<form class= "container-fluid" action="./app/controls/usuariosController.php" method="POST" novalidate>

    <div class= "row">
    
    <div class="form-floating col-md-5 m-md-3">
        <input type="text" class="form-control" id="nome"
        name="nome" placeholder="nome"
        minlength="2" required>
        <label for="nome" class="ps-md-4">Nome</label>
    </div>

        <div class="form-floating col-md-6 m-md-3">
        <input type="text" class="form-control" id="sobrenome"
        name="sobrenome" placeholder="sobrenome"
        minlength="2" required>
        <label for="sobrenome" class="ps-md-4">Sobrenome</label>
    </div>

        <div class="form-floating  col-md-3 m-md-3 mt-md-4">
        <input type="text" class="form-control" id="usuario"
        name="usuario" placeholder="email"
        minlength="2" required>
        <label for="e-mail" class="ps-md-4">E-mail</label>
    </div>

    <div class="form-floating col-md-3 m-md-3 mt-md-4">
        <input type="text" class="form-control" id="usuario"
        name="usuario" placeholder="email"
        minlength="2" required>
        <label for="usuario" class="ps-md-4">Usuario</label>
    </div>

    <div class="form-floating col-md-2 m-md-3 mt-md-4">
        <input type="password" class="form-control" id="senha"
        name="senha" placeholder="senha"
        minlength="8" required>
        <label for="senha" class="ps-md-4">Senha</label>
    </div>

    <div class="form-floating col-md-2 m-md-3 mt-md-4">
        <input type="text" class="form-control" id="CPF"
        name="CPF" placeholder="CPF"
        maxlength="11" required>
        <label for="senha" class="ps-md-4">CPF</label>
    </div>

    <div class="form-floating col-md-3 m-md-3 mt-md-4">
        <input type="text" class="form-control" id="usuario"
        name="usuario" placeholder="rua"
        minlength="4" required>
        <label for="endereco" class="ps-md-4">Endereço</label>
    </div>

    <div class="form-floating col-md-1 m-md-3 mt-md-4">
        <input type="text" class="form-control" id="usuario"
        name="usuario" placeholder="número" required>
        <label for="numero" class="ps-md-4">Número</label>
    </div>

    <div class="form-floating col-md-2 m-md-3 mt-md-4">
        <input type="text" class="form-control" id="cep"
        name="cep" placeholder="número"
        maxlength="9" required>
        <label for="numero" class="ps-md-4">CEP</label>
    </div>

    <div class="form-floating col-md-2 m-md-3 mt-md-4">
        <input type="text" class="form-control" id="complemento"
        name="complemento" placeholder="complemento" required>
        <label for="numero" class="ps-md-4">Complemento</label>
    </div>

    <div class="form-floating col-md-2 m-md-3 mt-md-4">
        <input type="text" class="form-control" id="bairro"
        name="bairro" placeholder="complemento" required>
        <label for="numero" class="ps-md-4">Bairro</label>
    </div>


        <div class="m-md-3">
            <label class="d-none" for="enviar"> Cadastrar Usuário </label>
            <input type="submit" name="enviar" class="btn btn-primary" value="Cadastrar Usuario" id="enviar">
        </div>
</form>

<table class="table table-secondary col-md-10 table-striped table-hover table-sm align-middle mt-md-5"
style="width: 95%; margin-left: 2.5%;">

    <tr>
      <th scope="col">#</th>
      <th scope="col">Nome Completo</th> 
      <th scope="col">Usuário</th> 
      <th scope="col">E-mail</th>
      <th scope="col">Endereço</th>
      <th scope="col"></th>
    </tr>

    <!-- Inicio da repetição do PHP -->
  <tr> 
    <td class="text-center">1</td>
    <td>  </td>
    <td>  </td>
    <td>  </td>
    <td>  </td>
    <td>
    <a href=""><i class="bi bi-pencil-square h4 p-md-3"></i></a>

    <a href=""><i class="bi bi-trash3 h4"></i></a>
  </td>
</tr>
    <!-- Fim da repetição do PHP -->
</table>