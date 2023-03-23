<?php

class DB
{
    // conexão com o banco armazenada
    private $conn;
    function __construct($host, $banco, $usuario, $senha)
    {
        $this->conectaBanco($host, $banco, $usuario, $senha);
    }


    /**
     * Undocumented function
     *
     * @param [string] $host
     * @param [string] $banco
     * @param [string] $usuario
     * @param [string] $senha
     * @return void
     */
    private function conectaBanco($host, $banco, $usuario, $senha):void
    {  
        try
        {

        
        // módulo PDO()
        $conexao = new PDO( "mysql:host=".$host.";dbname=". $banco, $usuario , $senha );
        // Disponibilizando a conexão como propriedade da classe.
        $this->conn = $conexao;

        }
        catch(PDOException $erro)
        {
            echo "Erro ao conectar ao banco. Erro: ". $erro->getMessage();
        }


    }

    /**
     * Roda o SQL nas tabelas protegendo com SQL Injection
     *
     * @param [string] $SQL - SQL a ser executado
     * @param [array] $array - um item para cada ? enviada
     * @return boolean
     */
    public function rodaSQL($SQL, $array):bool
    {
        // rodamos o comando sql através da conexão
        // query () executa sem nenhuma proteção
        // execute() - protege de injeção de SQL usando os prepared statements (parâmetros preparados) -> prepare()
        $insere = $this->conn->prepare( $SQL );

        $dados=$insere->execute($array);

        // Operador Ternário
        return $dados == true ? true: false;    
    }

    // procura no banco
    public function buscaDados( $SQL, $array )
    {
       $roda = $this->conn->prepare( $SQL );

       $roda->execute( $array );

        // virão muitos dados 
        // o comando fetchAll() converte os dados para um objeto
        $roda->fetchAll(PDO::FETCH_OBJ);

        return $roda;
    }



// atualiza no banco

// apaga no banco

}
?>