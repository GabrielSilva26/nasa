<?php
  //session_start(); //permite acessar as variáveis $_SESSION no servidor

  // buscar no BD se o usuário ou e-mail estão na tabela e a senha informada é igual a cadastrada
  require_once("./config.php");
  require_once("./app/models/DB.class.php");

  $logado = false;

  if (isset($_GET['loga'] ) )
  {
  $buscaUsuario = new DB($host, $banco, $usuario, $senha);

  $SQL = "SELECT * FROM usuarios WHERE email = ? AND senha = ?";

 $senhaCripto = $buscaUsuario -> criptografaDados($_POST['senha']);

  $array = array(
    $_POST['usuario'],
    $_POST['senha']
  );

  $resultado = $buscaUsuario -> buscaDados( $SQL, $array );

  if(count( $resultado ) > 0 )
  {
    // variavel na memória do serviodr, ela existem em todas as páginas enqaunt oo navegador está aberto
    $_SESSION['logado'] = true;
    $logado = true;
    echo '<script>location.href = "./painel.php?op=1";</script>';
  }
    else
    {
    $_SESSION['logado'] = false;
    $logado = false;
    }
  }
?>

<h1 class="col-md-6 m-md-auto mt-md-5" >Login Painel Administrativo</h1>
<form class="col-md-6 m-md-auto mt-md-5" action="?op=0&loga" method="POST">

  <!-- Email input -->
  <div class="form-outline mb-4">
    <input type="text" id="form2Example1" class="form-control" name="usuario" />
    <label class="form-label" for="form2Example1">Usuário ou E-mail</label>
  </div>

  <!-- Password input -->
  <div class="form-outline mb-4">
    <input type="password" id="form2Example2" class="form-control" name="senha" />
    <label class="form-label" for="form2Example2">Senha</label>
  </div>

  <!-- 2 column grid layout for inline styling -->
  <div class="row mb-4">
    <div class="col d-flex justify-content-center">
      <!-- Checkbox -->
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
        <label class="form-check-label" for="form2Example31"> Lembrar </label>
      </div>
    </div>

    <div class="col">
      <!-- Simple link -->
      <a href="#!">Esqueceu a senha?</a>
    </div>
  </div>

  <!-- Submit button -->
  <button type="submit" class="btn btn-primary btn-block mb-4">Entrar</button>

  <!-- Register buttons -->
  <div class="text-center">
    <p>Não tem conta? <a href="#!">Registre-se</a></p>
    <p>Ou entre com:</p>

    <button type="button" class="btn btn-link btn-floating mx-1">
      <i class="fab fa-facebook-f"></i>
    </button>

    <button type="button" class="btn btn-link btn-floating mx-1">
      <i class="fab fa-google"></i>
    </button>

    <button type="button" class="btn btn-link btn-floating mx-1">
      <i class="fab fa-twitter"></i>
    </button>

    <button type="button" class="btn btn-link btn-floating mx-1">
      <i class="fab fa-github"></i>
    </button>
  </div>
</form>