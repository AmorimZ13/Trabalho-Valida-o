# Sistema de validação de Usuário.

Integrantes:

Marcelo Henrique de Amorim RA: 1997218  
Giovanna Batista RA: 1991571

Passos a passo para iniciar e executar o XAMPP:
1. No Painel de Controle do XAMPP, inicie os módulos "Apache" e "MySQL" clicando em "Start" nos respetivos botões.
2. Navegue até a pasta de instalação do XAMPP (normalmente C:\xampp no Windows). 
3. Baixe e adicione os seus arquivos PHP dentro da pasta htdocs para que possam ser executados no servidor local.
4. Abra um navegador da web e digite http://localhost seguido do nome do seu arquivo PHP (por exemplo, http://localhost/index.php) na barra de endereços. 
5. O navegador exibirá o resultado da execução do script, permitindo que você veja os teste do código.

6. ### `validator.php`
Contém a classe **Validator**, que possui os seguintes métodos:

- `register(nome, email, senha)` → cadastra um novo usuário, validando o e-mail e verificando duplicidade.  
- `login(email, senha)` → realiza a autenticação verificando o hash da senha.  
- `resetPassword(id, novaSenha)` → redefine a senha de um usuário já existente.  
- `findUserByEmail(email)` → busca usuário pelo e-mail.  
- `findUserById(id)` → busca usuário pelo ID.  
- `isEmailValid(email)` → verifica se o formato do e-mail é válido.  

---

### `Testes.php`
Executa alguns casos de uso da classe e mostra os resultados em HTML:

1. Cadastro válido
   echo "<h2>Cadastro válido</h2>";
$result = $validator->register('Maria Oliveira', 'maria@email.com', 'Senha123');
echo "Resultado: " . $result['message'] . "<br><br>";

  
2. Cadastro com e-mail inválido
echo "<h2>E-mail inválido</h2>";
$result = $validator->register('Pedro', 'pedro@@email', 'Senha123');
echo "Resultado: " . $result['message'] . "<br><br>";
 
3. Login com senha incorreta
 echo "<h2>Login com senha errada</h2>";
$result = $validator->login('joao@email.com', 'Errada123');
echo "Resultado: " . $result['message'] . "<br><br>";

 
4. Reset de senha
 echo "<h2>Reset de senha</h2>";
$result = $validator->resetPassword(1, 'NovaSenha1');
echo "Resultado: " . $result['message'] . "<br><br>";

5. Cadastro com e-mail duplicado
echo "<h2>E-mail duplicado</h2>";
$result = $validator->register('Ana', 'joao@email.com', 'SenhaDuplicada');
echo "Resultado: " . $result['message'] . "<br><br>";
