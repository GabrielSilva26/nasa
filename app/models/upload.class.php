<?php
    /**
     * @version 1.0
     * @author gabriel.silva <gabriel.silva2016@gmail.com>
     * @abstract Classe que implement o envio de arquivos para a pasta do servidor.
     * @license MIT
     */

    class upload
    {
        // propriedades/variáveis da classe
        private $arquivo;
        private $diretorio = "../../public_html/imagens/banners/";
        // permite alterar no objeto esse limite
        public $limite = 2000000; // (Kbytes)
        public $tiposPermitidos = array("jpg", "jpeg", "gif", "png");
        public $nome;


        /**
         * @abstract Método construtor do PHP executado automáticamente. Usado para passar dados à classe.
         * @param $_FILES $enviado - recebe o arquivo enviado
         */
        function __construct( $enviado )
        {
            $this -> arquivo = $enviado;

            $this -> ChecaTipo();


        }

        // checar se a pasta existe / se não, cria-la

        // checar o tipo de arquivo enviado
        private function ChecaTipo():void
        {
            // variavel local com o tipo do arquivo
          $tipo = $this -> arquivo['type'];

            // listar os tipos permitidos
        // a função explode no PHP quebra uma string usando o caractere informado gerando um array onde o 0 é a esquerda do caractere e 1 à direita
        $tipo = explode("/", $tipo);

        // comparar SE é permitido
        if( in_array( $tipo[1], $this->tiposPermitidos ) )
        {
            // se o tipo é permitido mandamos para a próxima checagem
            $this -> ChecaTamanho();
        }
        else
        {
            $this -> MostraTexto( "Tipo de arquivo não permitido.", 1 );
        }
        }

        private function ChecaTamanho(  ):void
        {
           
            if( $this -> arquivo['size'] <= $this -> limite)
            {
                $this -> GeraNomes();
            }
            else
            {
                $this -> MostraTexto("Arquivo maior que o permitido. ", 1);
            }
        }

        private function GeraNomes()
        {
            // 20230228092633_100000_nome.jpg
            /*
                date() função do PHP para manipular datas Y - ano em 2023
                Y - ano em 2023
                y - ano 23
                m - mês 02
                d - dia 28
                H - hora 24
                i - minutos
                s - segundos
            */
            $nome = date("YmdHis_");
            // operador de atribuição que concatena, junta os valores armazenados com o novo valor
            $nome .= rand(1,100000);
            
            
            $nomeOriginal = pathinfo( $this->arquivo['name'], PATHINFO_FILENAME );
            $extensao =  pathinfo( $this->arquivo['name'], PATHINFO_EXTENSION ); // explode('.', $nomeOriginal);

            $nome .= $nomeOriginal . ".". $extensao;
            
            $this->nome = $nome;

            $this -> ChecaPasta();
        }
            private function ChecaPasta()
            {
                if ( !is_dir($this->diretorio) )
                {
                    mkdir( $this->diretorio, "0777");
                }
                
                $this -> SalvaArquivo();
            }

            private function SalvaArquivo():bool
            {
              if ( move_uploaded_file($this->arquivo['tmp_name'], $this->diretorio . $this->nome) )
              {
                $this->MostraTexto("Arquivo enviado com sucesso!", 1);

                return true;
              }
              else
              {
                $this->MostraTexto("Problema ao enviar o arquivo.", 1);

                return false;
              }
            }

        // padronizar o nome dos arquivos enviados

        // salvar o arquivo na pasta de destino

        /**
         * @abstract Método que exibe os textos na tela para debug.
         * @param [string] $texto/object - texto a ser mostrado
         * @param [int] $escolha - 1 para usar o echo e 0 para usar o var_dump
         * @return void
         */
        public function MostraTexto( $texto, $escolha ):void
        {
            switch($escolha)
            {
                case 0 : 
                 var_dump( $texto );
                    break;
                case 1;
                    echo $texto;
                break; 
            }
        }
    }

?>