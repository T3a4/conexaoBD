<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Pessoas</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <header>
            <h1>Cadastro de Pessoas</h1>
        </header>
        <section>
            <?php
                require_once __DIR__ . '/conexao.php';
                require_once __DIR__ . '/pessoa.php';

                $mensagem = '';
                $cadastroSucesso = false;

                $database = new BancoDeDados();
                $db = $database->obterConexao();

                if ($db == null) {
                    $mensagem = "Erro: Não foi possível conectar ao banco de dados.";
                } else {
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $pessoa = new Pessoa($db);
                        $pessoa->nome = $_POST['nome'];
                        $pessoa->idade = $_POST['idade'];

                        if ($pessoa->criar()) {
                            $mensagem = "Pessoa '{$pessoa->nome}' cadastrada com sucesso!";
                            $cadastroSucesso = true;
                        } else {
                            $mensagem = "Falha ao cadastrar a pessoa.";
                        }
                    }
                }
            ?>

            <form action="" method="post" id="formCadastroPessoa">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required>
                <label for="idade">Idade:</label>
                <input type="number" id="idade" name="idade" required>
                <input type="submit" value="Cadastrar">
            </form>
        </section>

        <script>
            const mensagemDoPHP = "<?php echo $mensagem; ?>";
            const cadastroFoiSucesso = <?php echo json_encode($cadastroSucesso); ?>;

            if (mensagemDoPHP) {
                alert(mensagemDoPHP);

                if (cadastroFoiSucesso) {
                    document.getElementById('nome').value = '';
                    document.getElementById('idade').value = '';

                    document.getElementById('nome').focus();
                }
            }
        </script>
    </div>
</body>

</html>