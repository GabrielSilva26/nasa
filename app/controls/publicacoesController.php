<?php

require_once("../../config.php");

if( $_POST == null )
    {
        header("Location: " . CAMINHO . "painel.php?op=3"); // cabeçalho do arquivo / redirecionando
    }

  
    require_once("../models/upload.class.php");

    $sobeArquivo = new upload($_FILES ['imgpublicacao']);

    $sobeArquivo2 = new upload($_FILES ['bannerpublicacao']);

    var_dump($sobeArquivo2);

    $sobeArquivo -> diretorio ="../../public_html/imagens/publicacoes/banners/";

    $sobeArquivo2 -> diretorio ="../../public_html/imagens/publicacoes/";
    
    $sobeArquivo2 -> ChecaTipo();

    var_dump($sobeArquivo -> ChecaTipo());




    if( $sobeArquivo2==true && $sobeArquivo == true)
        {           
        require_once("../models/DB.class.php");
    // objeto do banco de dados
        $titulo = $_POST['titulo'];
        $subtitulo = $_POST['subtitulo'];
        $descricao = $_POST['descricao'];
        $banner = $sobeArquivo2 ->nome;
        $imagem = $sobeArquivo ->nome;

        $db = new DB($host, $banco, $usuario, $senha);

        $SQL = "INSERT INTO publicacoes (imgpublicacao, bannerpublicacao, titulo, subtitulo, descricao) VALUES ( ?, ?, ?, ?, ? )";

        $array = array(
        $banner,
        $imagem,
        $titulo,
        $subtitulo,
        $descricao
        );
        // insere o banner no banco de dados
            $cadastro = $db->rodaSQL( $SQL, $array );

            if($cadastro == false)
            {
            header("Location: ../../painel.php?op=3&erro");
            }

            else
            {
            header("Location: ../../painel.php?op=3&ok");
            }
        }
    
        
?>