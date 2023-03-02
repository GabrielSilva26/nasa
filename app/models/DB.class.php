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
        }
        catch(PDOException $erro)
        {
            echo "Erro ao conectar ao banco. Erro: ". $erro->getMessage();
        }

        // Disponibilizando a conexão como propriedade da classe.
        $this->conn = $conexao;
    }

    public function insereDados($tabela):bool
    {
        $SQL = "INSERT INTO ".$tabela." ( banner ) VALUES ('banner01')";
        
        // rodamos o comando sql através da conexão
        $this->conn->execute( $SQL );
    }

// procura no banco

// atualiza no banco

// apaga no banco

}
?>