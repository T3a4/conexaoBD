<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Pessoas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Lista de Pessoas Cadastradas</h1>
    </header>
    <section>
        <?php
        require_once 'conexao.php';
        require_once 'pessoa.php';

        $database = new BancoDeDados();
        $db = $database->obterConexao();

        if ($db === null) {
            die("<p class='error'>Erro: Não foi possível conectar ao banco de dados.</p>");
        }

        $pessoa = new Pessoa($db);
        $stmt = $pessoa->ler();
        $num_linhas = $stmt->rowCount();

        if ($num_linhas > 0) {
            while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='person'>";
                echo "<p>ID: " . $linha['id'] . "</p>";
                echo "<p>Nome: " . $linha['nome'] . "</p>";
                echo "<p>Idade: " . $linha['idade'] . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p class='error'>Nenhuma pessoa encontrada no banco de dados.</p>";
        }
        ?>
    </section>
</body>
</html>