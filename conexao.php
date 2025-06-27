<?php
class BancoDeDados {
    private $host = "localhost";
    private $nome_banco = "aula_php";
    private $usuario = "root";
    private $senha = "";
    private $conexao;

    public function obterConexao() {
        $this->conexao = null;
        try {
            $this->conexao = new PDO("mysql:host={$this->host};dbname={$this->nome_banco}", $this->usuario, $this->senha);
            $this->conexao->exec("set names utf8");
            $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $excecao) {
            echo "Erro de conexão:" . $excecao->getMessage();
            return null;
        }
        return $this->conexao;
    }
}
?>