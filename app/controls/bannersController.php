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

    $_FILES['nomeCampo']['índice'] - super variável para campo do tipo file, ele gera um vetor com os índices abaixo:

        - name - nomeDoArquivoOriginal.ext

        - tmp_name - nomeTemp.ext na pasta temp no seridor, imediatamente descartado após a execução do arquivo

        - type - traz o tipo do arquivo enviado

        - size - tamanho do arquivo em bytes

        - error - traz o valor 0 se não houver erro no envio

    var_dump() / print_r() - exibe os dados mesmo de um array em formato

    empty() - função do PHP que cehca se o item (variável) está vazio true/1 se estiver vazio
    */

    // importação das configurações da aplicação
    require_once("../../config.php");

    // checa se a página etá recebendo dados POST (só não recebe se for acesso direto)
    if( $_POST == null )
    {
        header("Location: " . CAMINHO . "painel.php?op=1"); // cabeçalho do arquivo / redirecionando
    }

    // var_dump( $_POST ); // BD

    // A controller faz a chamada para o Model
    if ( !empty($_FILES['banner01'] ) && $_FILES ['banner01'] ['tmp_name'] != "" )
    {
        // chamar o Model
        // 1° Upload de Imagem

        // importamos a classe
        require_once("../models/upload.class.php");

        // instanciamos ou criamos um objeto
        $sobeArquivo = new upload( $_FILES['banner01'] );

        var_dump($sobeArquivo);

        // 2° CRUD no BD
        require_once("../models/DB.class.php");

        $db = new DB();
    }

?>