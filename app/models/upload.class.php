<?php
/**
 * @version 1.0
 * @author João Vitor, Adriano Angiolleto, Nicolas Cunha, Gabriel Almeida
 * @abstract Classe que implementa o envio de arquivos para a pasta do servidor
 * @license MIT
 * 
 * 
 */

class upload
{
    // propriedades/variáveis da classe
    private $arquivo;
    public $diretorio = "../../public_html/imagens/banners/";
    // permite alterar no objeto esse limite
    public $limite = 1024*1024*2;// (bytes)

    // listar os tipos permitidos
    public $tiposPermitidos = array("jpg", "jpeg", "gif", "png", "mp4", "mov", "wmv", "avi", "webm");

    public $nome;

    /**
     * Abstract Método construtor do PHP executado automaticamente. Usado para passar dados à classe.
     *
     * @param $_FILES $enviado - recebe o arquivo enviado
     */
    function __construct($enviado)
    {
        $this -> arquivo = $enviado;

        // $this -> ChecaTipo();
    }
    
    /**
     * Checa o tipo de arquivo enviado
     * @return void
     */
    public function ChecaTipo():void
    {
       // variável local com o tipo do arquivo
       $tipo =  $this -> arquivo['type'];

       $tipo = explode( "/", $tipo );

       // comparar SE é permitido
       if( in_array( $tipo[1], $this->tiposPermitidos )  )
       {
            // se o tipo é permitido mandamos para a próxima checagem
            $this -> ChecaTamanho();
       }
       else
       {
            $this -> MostraTexto( " Tipo de arquivo não permitido. ", 1 );
       }
       
       
    /**
     * Checa o tamanho do arquivo enviado
     * @return void
     */
    }

    private function ChecaTamanho( ):void
        {

            if( $this->arquivo['size'] <= $this->limite )
            {
               $this -> GeraNomes();
            }
            else
            {
           
                $this -> MostraTexto( " Arquivo maior que o permitido. ", 1 );
            }
        }

    /**
     * Altera o nome do arquivo enviado
     * @return void
     */
    private function GeraNomes():void
    {
        // 20230228092633_100000_nome.jpg
        $nome = date("YmdHis_");

        // operador de atribuição que concatena, junta os valores armazenados com o novo valor
        $nome .= rand( 1,100000 );
            
        $nomeOriginal = pathinfo( $this->arquivo['name'], PATHINFO_FILENAME );
            
        $extensao = pathinfo( $this->arquivo['name'], PATHINFO_EXTENSION ); //explode(".", $nomeOriginal);

        $nome .= $nomeOriginal . "." . $extensao;

        $this->nome = $nome;

        $this -> ChecaPasta();

        }
        /**
         * Checa se a pasta foi criada, se não, cria um diretório novo 
         *
         * @return void
         */  
        private function ChecaPasta():void
        {
            if( !is_dir( $this->diretorio ) )
            {
                mkdir( $this->diretorio, "0777" );
            }

            $this -> SalvaArquivo();
        }

        /**
         * Salva o arquivo no diretório
         *
         * @return boolean
         */
        private function SalvaArquivo():bool
        {

            if( move_uploaded_file( $this->arquivo['tmp_name'], $this->diretorio . $this->nome ) )
            {
               
                echo ("<SCRIPT LANGUAGE='JavaScript'>
                window.alert('Arquivo enviado com sucesso')
                window.location.href='../../painel.php?op=1';
                </SCRIPT>");

                return true;
            }
            else
            {
                $this->MostraTexto("Problema ao enviar o arquivo", 1 );

                return false;
            }

        }
        /**
         * @abstract Método que exibe os textos na tela para debug.
         *
         * @param [string] $texto/object - texto a ser mostrado
         * @param [int] $escolha - 1 para usar o echo / 0 para usar o var_dump()
         * @return void
         * 
         */

        public function MostraTexto( $texto, $escolha ):void
            {
                switch( $escolha )
                {
                    case 0 :
                        var_dump( $texto );
                        break;
                    case 1:
                        echo $texto;
                    break;
                }
            }
}


?>

