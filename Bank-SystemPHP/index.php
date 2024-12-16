<?php
// Incluir o arquivo de lógica do sistema bancário
include 'banco.php';

// Obter saldo atual
$saldo = getSaldo();

// Mensagens de erro ou sucesso
$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['acao'])) {
        $acao = $_POST['acao'];

        // Depósito
        if ($acao == 'depositar' && isset($_POST['deposito'])) {
            $valorDeposito = (float) $_POST['deposito'];
            depositar($valorDeposito);
        }

        // Saque
        if ($acao == 'sacar' && isset($_POST['saque'])) {
            $valorSaque = (float) $_POST['saque'];
            sacar($valorSaque);
        }

        // Sair
        if ($acao == 'sair') {
            echo "<p>Você saiu do sistema.</p>";
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank System</title>
</head>
<body>
    <h1>Bank System</h1>
    <p>Seu saldo atual: R$ <?php echo number_format($saldo, 2, ',', '.'); ?></p>

    <!-- Mensagem de erro ou sucesso -->
    <?php if (!empty($mensagem)) : ?>
        <p><?php echo $mensagem; ?></p>
    <?php endif; ?>

    <!-- Formulário de Depósito -->
    <form action="index.php" method="POST">
        <h2>Depósito</h2>
        <input type="number" name="deposito" placeholder="Valor para depósito" required>
        <button type="submit" name="acao" value="depositar">Depositar</button>
    </form>

    <!-- Formulário de Saque -->
    <form action="index.php" method="POST">
        <h2>Saque</h2>
        <input type="number" name="saque" placeholder="Valor para saque" required>
        <button type="submit" name="acao" value="sacar">Sacar</button>
    </form>

    <!-- Formulário de Sair -->
    <form action="index.php" method="POST">
        <h2>Sair</h2>
        <button type="submit" name="acao" value="sair">Sair</button>
    </form>
</body>
</html>
