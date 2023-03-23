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


    document.querySelector("#CPF").addEventListener("keypress", function(){
        VMasker(document.querySelector("#CPF")).maskPattern("999.999.999-99");
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

<form class="container-fluid" action="./app/controls/usuariosController.php" method="POST" novalidate >

    <div class="row" >

        <div class="form-floating col-md-4 m-md-0 mt-md-3 ">
            <input type="text" class="form-control " id="nome" name="nome" placeholder="Seu nome" minlength="2" required >
            <label for="nome" class="ps-md-4" >Seu nome</label>
        </div>

        <div class="form-floating col-md-4 m-md-0 mt-md-3 ">
            <input type="text" class="form-control " id="sobrenome" name="sobrenome" placeholder="Seu sobrenome" minlength="2" required >
            <label for="sobrenome" class="ps-md-4" >Seu sobrenome</label>
        </div> 

        <div class="form-floating col-md-4 m-md-0 mt-md-3 ">
            <input type="text" class="form-control " id="CPF" name="CPF" placeholder="Seu CPF" maxlength="14" required >
            <label for="CPF" class="ps-md-4" >Seu CPF</label>
        </div> 

        <div class="form-floating col-md-3 m-md-0 mt-md-3 ">
            <input type="email" class="form-control " id="email" name="email" placeholder="Seu e-mail" minlength="2" required >
            <label for="email" class="ps-md-4" >Seu e-mail</label>
        </div> 

        <div class="form-floating col-md-3 m-md-0 mt-md-3 ">
            <input type="text" class="form-control " id="usuario" name="usuario" placeholder="Seu usuário" minlength="2" required >
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

        <div class="m-md-3 mt-md-5">
        <label class="d-none" for="enviar">Cadastrar o Usuário </label>
        <input type="submit" name="enviar" class="btn btn-primary" value="Cadastrar Usuário" id="enviar" >
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

    <!-- Inicio da repetição do PHP -->]

    <?php
        // rodamos a busca na tabela de usuários
        require_once( "./app/models/DB.class.php" );
        require_once( "./config.php");

        $busca = new DB( $host, $banco, $usuario, $senha );

        $SQL = "SELECT * FROM usuarios";

        $array = array();

        var_dump($busca->buscaDados($SQL, $array ) );
    ?>
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