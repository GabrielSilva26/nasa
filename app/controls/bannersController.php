<?php

    /*
        Algoritmo que fará o cadastro dos banners

        1 - Os dados são enviados da View para o Controller ( action / method )

        2 - A controller solicita os processamentos e devolve os resultados
            a. Subir a imagem para a pasta do servidor 
            b. Salvar o caminho da imagem no BD
            c. Encaminhar de volta para o painel
        
        3 - A tabela do painel é atualizada

    $_GET[''] / $_POST[''] - super variáveis que trazem os dados de acordo com o method enviado

    $_FILES[''] - super variável para campo do tipo file

    var_dump() / print_r() - exibe os dados mesmo de um array em formato
    */

    require_once("../../config.php");

    // checa se a página etá recebendo dados POST (só não recebe se for acesso direto)
    if( $_POST == null )
    {
        header("Location: " . CAMINHO . "painel.php?op=1");// cabeçalho do arquivo / redirecionando
    }

    var_dump( $_POST ); // BD

    var_dump( $_FILES ); // Colocar na pasta

    // A controller faz a chamada para o Model
    move_uploaded_file(
        $_FILES['banner01']['tmp_name'],
        CAMINHO . 'public_html/imagens/imagem.jpg'
    );

?>