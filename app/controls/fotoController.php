<?php

require_once("../../config.php");

if( $_POST == null )
    {
        header("Location: " . CAMINHO . "painel.php?op=5"); // cabeçalho do arquivo / redirecionando
    }


if ( !empty($_FILES['arquivo01'] ) && $_FILES ['arquivo01'] ['tmp_name'] != "" )
    {
        // chamar o Model
        // 1° Upload de Imagem

        // importamos a classe
        require_once("../models/upload.class.php");

        // instanciamos ou criamos um objeto
        $sobeArquivo = new upload( $_FILES['arquivo01'] );

        $sobeArquivo -> diretorio = "../../public_html/imagens/fotos_videos/";

        $sobeArquivo -> ChecaTipo();
        // 2° CRUD no BD
        if( $sobeArquivo )
    {
        require_once("../models/DB.class.php");
        // objeto do banco de dados
        $db = new DB($host, $banco, $usuario, $senha);

        $SQL = "INSERT INTO arquivos (arquivo) VALUES ( ? )";

        $array = array(
            $sobeArquivo->nome
        );
        // insere o banner no banco de dados
        $cadastro = $db->rodaSQL( $SQL, $array );

        if($cadastro == false)
        {
            header("Location: ../../painel.php?op=5&erro");
        }
        else
        {
            header("Location: ../../painel.php?op=5&ok");
        }
    }
}

?>
