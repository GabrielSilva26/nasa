<?php
    // Processa o update e delete de usuários
    require_once("./config.php");
    require_once("./app/models/DB.class.php");

    // altera o usuário editado
    if (isset($_GET['editar'] ) )
    {
        $SQL = "UPDATE usuarios SET nome = ?, sobrenome = ?, cpf = ?, email = ?, usuario = ? = ? WHERE id_usuario = ?";
        $SQL2 = "UPDATE enderecos SET endereco = ?, numero = ?, cep = ?, complemento = ?, bairro = ? WHERE usuarios_id_usuario = ?";

        $array = array(
            $_POST['nome'],
            $_POST['sobrenome'],
            $_POST['cpf'],
            $_POST['email'],
            $_POST['usuario'],
            $_POST['usuEdita']
        );
        $array2 = array(
            $_POST['endereco'],
            $_POST['numero'],
            $_POST['cep'],
            $_POST['complemento'],
            $_POST['bairro'],
            $_POST['usuEdita']
        );

        $edita = new DB($host, $banco, $usuario, $senha);

        if ($edita -> rodaSQL($SQL,$array) == true  && $edita->rodaSQL ($SQL2, $array2))
        {
            echo '<script> location.href="?op=2&ok"; </script>';
        }
        else
        {
            echo '<script> location.href="?op=2&erro"; </script>';
        }
    }

    // faz a edição
    if(isset($_GET['edita']))
    {
        // buscar os dados do registro a ser editado
        $pegaDados = new DB($host, $banco, $usuario, $senha);

        $SQL = "SELECT * FROM usuarios WHERE id_usuario = ?";
        $array = array(
            $_GET['id']
        );

        $dado = $pegaDados -> buscaDados($SQL, $array);
    }

    if(isset($_GET['apaga']))
    {
        // faz o delete
        require_once("./config.php");
        require_once("./app/models/DB.class.php");

        $deleta = new DB($host, $banco, $usuario, $senha);

        $SQL = "DELETE FROM usuarios WHERE id_usuario = ?";

        $SQL2 = "DELETE FROM enderecos WHERE usuarios_id_usuario = ?";

        $array = array(
            $_GET['id']
        );

        if ($deleta->apaga( $SQL2, $array ) == true )
        {

        if ($deleta->apaga( $SQL, $array ) == true )
        {
            echo ' 
            <script>
                location.href="?op=2&ok";
            </script>
            ';
        }
        else
        {
            echo ' 
            <script>
                location.href="?op=2&erro";
            </script>
            ';
        }
    }
}
?>

<h1>Administração dos Usuários</h1>

<script defer>

    // Document Object Model - HTML todo
    document.addEventListener("DOMContentLoaded", function(){



/*
    onblur - usa no elemento HTML
    blur - usa no código JS
    click - todos - quando clica
    onmouseOver - todos - mouse sobre
    onmouseOut - todos - sai do elemento
    onmousemove - move o cursor
    focus - form - clica no campo
    blur - form - quando sai do campo
    keypress - quando uma tecla é pressionada
*/

    document.querySelector("#cep").addEventListener("keypress", function(){
        VMasker(document.querySelector("#cep")).maskPattern("99999-999");
        
    });


    document.querySelector("#cpf").addEventListener("keypress", function(){
        VMasker(document.querySelector("#cpf")).maskPattern("999.999.999-99");
    });

    // Consultando o ViaCEP
    document.querySelector("#cep").addEventListener("blur", function(){

        let cep = document.querySelector("#cep").value; // lê o campo

        if(cep.length > 8 ){
        
        // Envia automaticamente em GET
        fetch( "https://viacep.com.br/ws/"+ cep +"/json")
        .then(
            // Promessa
            // converte para objeto json
            (resposta) => resposta.json()
        )
        .then(
            (resposta)  => { document.querySelector("#bairro"). value = resposta.bairro;
                document.querySelector("#endereco"). value = resposta.logradouro + " - " + resposta.localidade + " - " + resposta.uf;
            }
        )
    } // fechamento do if
        });
    
    });

</script>

<form class="container-fluid" action="<?php echo ( !isset($_GET['edita'])) ? './app/controls/usuariosController.php': '?op=2&editar'; ?>" method="POST" >

    <?php if(isset($_GET['edita'])){ ?>
        <!-- input oculto que armazena o id para a edição -->
        <input type="hidden" name="usuEdita" value="<?php echo @$dado[0]->id_usuario; ?> ">
        <?php } ?>

    <div class="row" >

        <div class="form-floating col-md-4 m-md-0 mt-md-3 ">
            <input type="text" class="form-control " id="nome" name="nome" placeholder="Seu nome" minlength="2" required value="<?php echo @$dado[0]->nome ?> " >
            <label for="nome" class="ps-md-4" >Seu nome</label>
        </div>

        <div class="form-floating col-md-4 m-md-0 mt-md-3 ">
            <input type="text" class="form-control " id="sobrenome" name="sobrenome" placeholder="Seu sobrenome" minlength="2" required value="<?php echo @$dado[0]->sobrenome ?> " >
            <label for="sobrenome" class="ps-md-4" >Seu sobrenome</label>
        </div> 

        <div class="form-floating col-md-4 m-md-0 mt-md-3 ">
            <input type="text" class="form-control " id="cpf" name="cpf" placeholder="Seu cpf" maxlength="14" required value="<?php echo @$dado[0]->cpf ?> " >
            <label for="cpf" class="ps-md-4" >Seu CPF</label>
        </div> 

        <div class="form-floating col-md-3 m-md-0 mt-md-3 ">
            <input type="email" class="form-control " id="email" name="email" placeholder="Seu e-mail" minlength="2" required value="<?php echo @$dado[0]->email ?> " >
            <label for="email" class="ps-md-4" >Seu e-mail</label>
        </div> 

        <div class="form-floating col-md-3 m-md-0 mt-md-3 ">
            <input type="text" class="form-control " id="usuario" name="usuario" placeholder="Seu usuário" minlength="2" required value="<?php echo @$dado[0]->usuario ?> " >
            <label for="usuario" class="ps-md-4" >Seu usuário</label>
        </div> 

        <div class="form-floating col-md-3 m-md-0 mt-md-3 ">
            <input type="password" class="form-control " id="senha" name="senha" placeholder="Seu usuário" minlength="8" required >
            <label for="senha" class="ps-md-4" >Sua senha</label>
        </div> 

    <div class="form-floating col-md-3 m-md-0 mt-md-3">
        <input type="password" class="form-control" id="repSenha"
        name="senha" placeholder="senha"
        minlength="8" required>
        <label for="repSenha" class="ps-md-4">Repita a Senha</label>
    </div>

    <div class="form-floating col-md-2 m-md-0 mt-md-3 ">
            <input type="text" class="form-control " id="cep" name="cep" placeholder="Seu CEP" maxlength="9" required >
            <label for="cep" class="ps-md-4" >Seu CEP</label>
        </div> 

        <div class="form-floating col-md-4 m-md-0 mt-md-3 ">
            <input type="text" class="form-control " id="endereco" name="endereco" placeholder="Seu endereco" minlength="4" required >
            <label for="endereco" class="ps-md-4" >Seu endereço</label>
        </div>
        
        <div class="form-floating col-md-2 m-md-0 mt-md-3 ">
            <input type="text" class="form-control " id="numero" name="numero" placeholder="Número" required >
            <label for="endereco" class="ps-md-4" >Número</label>
        </div>
        
        <div class="form-floating col-md-2 m-md-0 mt-md-3 ">
            <input type="text" class="form-control " id="complemento" name="complemento" placeholder="Complemento"  >
            <label for="endereco" class="ps-md-4" >Complemento</label>
        </div>
        
        <div class="form-floating col-md-2 m-md-0 mt-md-3 ">
            <input type="text" class="form-control " id="bairro" name="bairro" placeholder="Bairro" required  >
            <label for="bairro" class="ps-md-4" >Bairro</label>
            </div>

        <?php if (!isset ($_GET['edita'])){  ?>

        <div class="m-md-3 mt-md-5">
        <label class="d-none" for="enviar"> Cadastrar o Usuário </label>
        <input type="submit" name="enviar" class="btn btn-primary" value="Cadastrar Usuário" id="enviar" >
         </div>
         <?php } else { ?>
            <div class="m-md-3 mt-md-5">
        <label class="d-none" for="alterar"> Alterar o Usuário </label>
        <input type="submit" name="alterar" class="btn btn-primary" value="Alterar Usuário" id="alterar" >
         </div>
         <?php } ?>
      


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

    <?php
        // rodamos a busca na tabela de usuários
        require_once( "./app/models/DB.class.php" );
        require_once( "./config.php");

        $busca = new DB( $host, $banco, $usuario, $senha );

        $SQL = "SELECT * FROM usuarios ORDER BY id_usuario DESC";

        $array = array();

        $i = 1;

        foreach($resultados = $busca->buscaDados($SQL, $array ) as $res )
        { 
    ?>
  <tr> 
    <td class="text-center">
        <?php echo $i; $i++;?>
    </td>
    <td> <?php echo $res->nome . " " . $res->sobrenome; ?> </td>
    <td> <?php echo $res->usuario ?> </td>
    <td> <?php echo $res->email ?></td>
    <td>  </td>
    <td>
    <a href="?op=2&edita&id=<?php echo $res->id_usuario ?>"><i class="bi bi-pencil-square h4 p-md-3"></i></a>

    <a href="?op=2&apaga&id=<?php echo $res->id_usuario ?>"><i class="bi bi-trash3 h4"></i></a>
  </td>
</tr>

<?php
        }
?>
    <!-- Fim da repetição do PHP -->
</table>