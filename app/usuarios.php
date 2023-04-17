<?php
    require_once("./config.php");
    require_once("./app/models/DB.class.php");

    // altera o usuário editado
    if ( isset( $_GET['editar'] ) )
    {
        $db = new DB ($host, $banco, $usuario, $senha);
        $senhaCriptografada = $db -> criptografaDados($senha);

        if(isset($_POST['senha']) && $_POST['senha']!= ""){

        $SQL = "UPDATE usuarios SET nome = ?, sobrenome = ?, cpf = ?, senha = ?, email = ?, usuario = ? WHERE idusuario = ?";
        $SQL2 = "UPDATE enderecos SET endereco = ?, numero = ?, cep = ?, complemento = ?, bairro= ? WHERE usuarios_idusuario = ? ";

        $array = array(
            $_POST['nome'],
            $_POST['sobrenome'],
            $_POST['cpf'],
            $_POST['senha'] = $db -> criptografaDados($_POST['senha']),
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

        }else{

            $SQL = "UPDATE usuarios SET nome = ?, sobrenome = ?, cpf = ?,  email = ?, usuario = ? WHERE idusuario = ?";
            $SQL2 = "UPDATE enderecos SET endereco = ?, numero = ?, cep = ?, complemento = ?, bairro= ? WHERE usuarios_idusuario = ? ";
    
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


        }
        $edita = new DB( $host, $banco, $usuario, $senha );

        if ( $edita->rodaSQL( $SQL, $array ) == true && $edita->rodaSQL( $SQL2, $array2 ) )
        {
            echo '<script>location.href="?op=2&ok";</script>';
        }
        else
        {
            echo '<script>location.href="?op=2&erro";</script>';
        }

    }

    if( isset( $_GET['edita'] ) )
    {
        // buscar os dados do registro a ser editado
        $pegaDados = new DB( $host, $banco, $usuario, $senha );

        $SQL = " SELECT * FROM usuarios WHERE idusuario = ? ";

        $array = array(
            $_GET['id']
        );

        $dado = $pegaDados -> buscaDados( $SQL, $array );
    }

    if( isset( $_GET['apaga'] ) )
    {
        // faz o delete

        $deleta = new DB( $host, $banco, $usuario, $senha );

        $SQL = " DELETE FROM usuarios WHERE idusuario = ? ";
        $SQL2 = " DELETE FROM enderecos WHERE usuarios_idusuario = ? ";

        $array = array(
            $_GET['id']


        );

        if( $deleta->apaga( $SQL, $array ) == true )
        {

            if( $deleta->apaga( $SQL, $array ) == true )
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
<script defer >

    // Document Object Model - HTML todo
    document.addEventListener( "DOMContentLoaded", function(){

        /*
        <input onblur="alert('abre')" >
        onblur - usa no elemento HTML
        blur - usa no código 

            click - todos - clica
            onmouseOver - todos - mouse sobre
            onmouseOut - todos - sai do elemento
            onmousemove - move o cursor
            onfocus - form - clica no campo
            onblur - form - sai do campo
            onload - qdo carregado
            keypress - qdo uma tecla é pressionada
        */

        document.querySelector("#cep").addEventListener("keypress", function(event){
            VMasker( document.querySelector("#cep") ).maskPattern("99999-999");
        });

        document.querySelector("#cpf").addEventListener("keypress", function(event){
            VMasker( document.querySelector("#cpf") ).maskPattern("999.999.999-99");
        });

        // Consultando o ViaCEP
        document.querySelector("#cep").addEventListener("blur", function(event){

            let cep = document.querySelector("#cep").value; // lê o campo

            if( cep.length > 8 )
            {
            
            // envia automaticamente GET
            fetch( "https://viacep.com.br/ws/" + cep + "/json" )
            .then(
                // Promessa
                // converte para objeto json
                (resposta) => resposta.json()
            )
            .then(
                (resposta) => { 
                    document.querySelector("#bairro").value = resposta.bairro;

                    document.querySelector("#endereco").value = resposta.logradouro + " - " + resposta.localidade + " - " + resposta.uf;

                }
            )
        }// fechamento do if

        });

    });

</script>

<form class="container-fluid" action="<?php echo ( !isset($_GET['edita'])) ? './app/controls/usuariosController.php': '?op=2&editar'; ?>" method="POST" >

    <?php if(isset($_GET['edita'])){ ?>
        <!-- input oculto que armazena o id para a edição -->
        <input type="hidden" name="usuEdita" value="<?php echo @$dado[0]->idusuario; ?>" > 
    <?php } ?>

    <div class="row" >
    <p> <?=$logado?> </p>
        <div class="form-floating col-md-4 m-md-0 mt-md-3 ">
            <input type="text" class="form-control " id="nome" name="nome" placeholder="Seu nome" minlength="2" required value="<?php echo @$dado[0]->nome; ?>" >
            <label for="nome" class="ps-md-4" >Seu nome</label>
        </div>

        <div class="form-floating col-md-4 m-md-0 mt-md-3 ">
            <input type="text" class="form-control " id="sobrenome" name="sobrenome" placeholder="Seu sobrenome" minlength="2" required value="<?php echo @$dado[0]->sobrenome; ?>" >
            <label for="sobrenome" class="ps-md-4" >Seu sobrenome</label>
        </div>
        
        <div class="form-floating col-md-4 m-md-0 mt-md-3 ">
            <input type="text" class="form-control " id="cpf" name="cpf" placeholder="Seu CPF" maxlength="14" required value="<?php echo @$dado[0]->cpf; ?>" >
            <label for="cpf" class="ps-md-4" >Seu CPF</label>
        </div> 

        <div class="form-floating col-md-3 m-md-0 mt-md-3 ">
            <input type="email" class="form-control " id="email" name="email" placeholder="Seu e-mail" minlength="2" required value="<?php echo @$dado[0]->email; ?>"  >
            <label for="e-mail" class="ps-md-4" >Seu e-mail</label>
        </div> 

        <div class="form-floating col-md-3 m-md-0 mt-md-3 ">
            <input type="text" class="form-control " id="usuario" name="usuario" placeholder="Seu usuário" minlength="2" required value="<?php echo @$dado[0]->usuario; ?>" >
            <label for="usuario" class="ps-md-4" >Seu usuário</label>
        </div> 

        
        <div class="form-floating col-md-3 m-md-0 mt-md-3 ">
            <input type="password" class="form-control " id="senha" name="senha" placeholder="Seu usuário" minlength="8" required >
            <label for="senha" class="ps-md-4" >Sua senha</label>
        </div> 

        <div class="form-floating col-md-3 m-md-0 mt-md-3 ">
            <input type="password" class="form-control " id="repSenha" name="repSenha" placeholder="Seu usuário" minlength="8" required >
            <label for="repSenha" class="ps-md-4" >Repita a senha</label>
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

    </div>

    <?php if( !isset( $_GET['edita'] ) ) { ?>
    <div class="col-md-2 mt-lg-3">
        <label class="d-none" for="enviar">Cadastrar o Usuário </label>
        <input style = "height: 7.9vh; width: 11.8vw" type="submit" name="enviar" class="btn btn-primary" value="Cadastrar Usuário" id="enviar" >
    </div>
    <?php } else { ?>
    <div class="col-md-2 mt-lg-3">
        <label class="d-none" for="alterar">Alterar o Usuário </label>
        <input style = "height: 7.9vh; width: 11.8vw" type="submit" name="alterar" class="btn btn-success" value="Alterar Usuário" id="alterar" >
    </div>
    <?php } ?>
</form>

<!-- Tabela de exibição do que está cadastrado -->

<table class="table table-secondary col-md-2 table-striped table-hover align-middle mt-md-5 " style=" width: 98%; margin-left: 1.0%;"  >

    <tr>
        <th scope="col" >#</th>
        <th scope="col" >Nome Completo</th>
        <th scope="col" >Usuário</th>
        <th scope="col" >E-mail</th>
        <th scope="col" >Endereço</th>
        <th scope="col" ></th>
    </tr>

    <!-- Início da repetição do PHP -->
    <?php 
        // rodamos a busca na tabela de usuários

        // cria o objeto e abre a conexão com o BD
        $busca = new DB( $host, $banco, $usuario, $senha );

        $SQL = " SELECT * FROM usuarios ORDER BY idusuario DESC";

        $array = array();
        
        $i = 1;

        foreach( $resultados = $busca->buscaDados( $SQL, $array ) as $res )
        {
    ?>
    <tr>
        <td class="text-center" > 
            <?php echo $i; $i++; ?>
        </td>
        <td>
            <?php echo $res->nome . " " . "$res->sobrenome"; ?>
        </td>
        <td>
            <?php echo $res -> usuario; ?>
        </td>
        <td>
        <?php echo $res -> email; ?>
        </td>
        <td>

        </td>
        <td>
           <a href="?op=2&edita&id=<?php echo $res->idusuario; ?>"><i class="bi bi-pencil-square h4 p-md-3 "></i></a>           
           <a href="?op=2&apaga&id=<?php echo $res->idusuario; ?>"><i class="bi bi-trash3 h4 p-md-3"></i></a>
        </td>
    </tr>
    
    <?php } ?>

    <!-- Final da repetição do PHP -->

</table>