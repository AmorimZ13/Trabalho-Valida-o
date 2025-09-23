<?php

require_once 'validator.php';

$validator = new Validator();

echo "<h1>Testes rápidos</h1>";

echo "<h2>1. Cadastro válido</h2>";
$result = $validator->register('Maria Oliveira', 'maria@email.com', 'Senha123');
echo "Resultado: " . $result['message'] . "<br><br>";

echo "<h2>2. E-mail inválido</h2>";
$result = $validator->register('Pedro', 'pedro@@email', 'Senha123');
echo "Resultado: " . $result['message'] . "<br><br>";

echo "<h2>3. Login com senha errada</h2>";
$result = $validator->login('joao@email.com', 'Errada123');
echo "Resultado: " . $result['message'] . "<br><br>";

echo "<h2>4. Reset de senha</h2>";
$result = $validator->resetPassword(1, 'NovaSenha1');
echo "Resultado: " . $result['message'] . "<br><br>";

echo "<h2>5. E-mail duplicado</h2>";
$result = $validator->register('Ana', 'joao@email.com', 'SenhaDuplicada');
echo "Resultado: " . $result['message'] . "<br><br>";

echo "<h2>6. Senha muito curta (menos de 8 caracteres)</h2>";
$result = $validator->register('Usuario Curto', 'curto@email.com', 'curta');
echo "Resultado: " . $result['message'] . "<br><br>";

echo "<h2>7. Senha sem letra maiúscula</h2>";
$result = $validator->register('Usuario Minuscula', 'minuscula@email.com', 'apenasminuscula');
echo "Resultado: " . $result['message'] . "<br><br>";

echo "<h2>8. Senha sem letra minúscula</h2>";
$result = $validator->register('Usuario Maiuscula', 'maiuscula@email.com', 'APENASMAIUSCULA');
echo "Resultado: " . $result['message'] . "<br><br>";

?>
