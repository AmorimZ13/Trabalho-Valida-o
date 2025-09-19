<?php

require_once 'validator.php';

$validator = new Validator();

echo "<h1>Testes rápidos</h1>";

echo "<h2>Cadastro válido</h2>";
$result = $validator->register('Maria Oliveira', 'maria@email.com', 'Senha123');
echo "Resultado: " . $result['message'] . "<br><br>";

echo "<h2>E-mail inválido</h2>";
$result = $validator->register('Pedro', 'pedro@@email', 'Senha123');
echo "Resultado: " . $result['message'] . "<br><br>";

echo "<h2>Login com senha errada</h2>";
$result = $validator->login('joao@email.com', 'Errada123');
echo "Resultado: " . $result['message'] . "<br><br>";

echo "<h2>Reset de senha</h2>";
$result = $validator->resetPassword(1, 'NovaSenha1');
echo "Resultado: " . $result['message'] . "<br><br>";

echo "<h2>E-mail duplicado</h2>";
$result = $validator->register('Ana', 'joao@email.com', 'SenhaDuplicada');
echo "Resultado: " . $result['message'] . "<br><br>";
