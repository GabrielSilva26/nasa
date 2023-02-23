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
        private $diretorio;

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
        $tiposPermitidos = array("jpg", "jpeg", "gif", "png");

        // a função explode no PHP quebra uma string usando o caractere informado gerando um array onde o 0 é a esquerda do caractere e 1 à direita
        $tipo = explode("/", $tipo);

        $this -> MostraTexto( $tipo, 0 );

        // comparar SE é permitido
        if( in_array( $tipo[1], $tiposPermitidos ) )
        {
            // se o tipo é permitido mandamos para a próxima checagem
            $this -> ChecaTamanho();
        }
        else
        {
            $this -> MostraTexto( "Não está no Array", 1 );
        }
        }

        private function ChecaTamanho():void
        {
            
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