<?php

// Função para ler o saldo do arquivo
function getSaldo() {
    $saldo = 0;
    if (file_exists('saldo.txt')) {
        $saldo = (float) file_get_contents('saldo.txt');
    }
    return $saldo;
}

// Função para atualizar o saldo no arquivo
function atualizarSaldo($novoSaldo) {
    file_put_contents('saldo.txt', number_format($novoSaldo, 2, '.', ''));
}

// Função para processar o depósito
function depositar($valor) {
    if ($valor > 0) {
        $saldoAtual = getSaldo();
        $novoSaldo = $saldoAtual + $valor;
        atualizarSaldo($novoSaldo);
        echo "<p style='color: green;'>Depósito de R$ " . number_format($valor, 2, ',', '.') . " realizado com sucesso!</p>";
    } else {
        echo "<p style='color: red;'>Valor de depósito inválido!</p>";
    }
}

// Função para processar o saque
function sacar($valor) {
    $saldoAtual = getSaldo();
    if ($valor > 0 && $valor <= $saldoAtual) {
        $novoSaldo = $saldoAtual - $valor;
        atualizarSaldo($novoSaldo);
        echo "<p style='color: green;'>Saque de R$ " . number_format($valor, 2, ',', '.') . " realizado com sucesso!</p>";
    } else {
        echo "<p style='color: red;'>Saldo insuficiente ou valor inválido para saque!</p>";
    }
}
