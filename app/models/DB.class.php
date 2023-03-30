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
        return $dados == true ? true : false;    
    }

    // procura no banco
    public function buscaDados( $SQL, $array )
    {
       $roda = $this->conn->prepare( $SQL );

       $roda->execute( $array );

        // virão muitos dados 
        // o comando fetchAll() converte os dados para um objeto
        $resultado = $roda->fetchAll(PDO::FETCH_OBJ);

        return $resultado;
    }

    public function apaga($SQL, $array):bool
    {
        $roda = $this->conn->prepare($SQL);

        if($roda -> execute($array) == true)
        {
            return true;
        }
        else 
        {
            return false;
        }
    } 

    public function pegaUltimo():array
    {
        
        $SQL = "SELECT LAST_INSERT_ID()";
        // chamar o método de busca
        $roda = $this->conn->prepare( $SQL );

        $roda->execute( array() );

        // retirando os dados em uma array
        $res = $roda->fetchAll(PDO::FETCH_ASSOC);

        return $res;
        
    }
    public function criptografaDados( $texto ):string
    {
        // md5( $texto ) - criptografa em md5 hash (não descriptografa)
        // base64_encode( $texto ) - criptografa em base64 e pode ser descriptografado facilmente (base64_decode ($texto))
        // crypt ($texto, $chave) - criptografa usando uma chave personalizada / compara usando crypt ($texto, $chave) == textoNoBancoDeDados 

        // openssl é o modo mais novo e mais seguro

        //return md5($texto); //existem muitos dicionários de senhas / valorDoBD == md5("$_POST['senha'])
        //return base64_encode($texto); / base64_decode(valorDoBD) == ("$_POST['senha'])

        //return crypt($texto, '$en@c'); // não permite descriptografar a senha / crypt ("$_POST['senha']), '$en@c == valorDoBD

        $cipher = "aes-128-gcm"; // tamanho do hash
        $iv = openssl_cipher_iv_length($cipher); // string aleatória para a chave pública
        $ivRandom = openssl_random_pseudo_bytes($iv);

        $chave = '$en@c';

        $textoCriptografado = openssl_encrypt($texto, $cipher, $chave, $options=0 , $iv, $ivRandom);

        return $textoCriptografado;
    }
}
?>