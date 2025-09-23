# Sistema de Validação de Usuário

**Integrantes:**

- Marcelo Henrique de Amorim RA: 1997218
- Giovanna Batista RA: 1991571

---

### **Como Iniciar e Executar com XAMPP**

1.  No Painel de Controle do XAMPP, inicie os módulos **"Apache"** e **"MySQL"** clicando em **"Start"** nos botões correspondentes.
2.  Navegue até a pasta de instalação do XAMPP (normalmente `C:\xampp` no Windows).
3.  Baixe e adicione os seus arquivos PHP (`validator.php` e `index.php`) dentro da pasta `htdocs` para que possam ser executados no servidor local.
4.  Abra um navegador e digite `http://localhost/index.php` na barra de endereços.
5.  O navegador exibirá o resultado da execução do script, mostrando os resultados dos testes do código.

---

### **Estrutura dos Arquivos**

#### **`validator.php`**

Contém a classe **`Validator`**, que gerencia as operações de autenticação de usuários. Ela inclui os seguintes métodos:

-   `register(nome, email, senha)`: Cadastra um novo usuário, validando o e-mail e garantindo que a **senha tenha pelo menos 8 caracteres, uma letra maiúscula e uma minúscula**. Também verifica se o e-mail já está em uso.
-   `login(email, senha)`: Realiza a autenticação do usuário verificando o e-mail e o **hash da senha**.
-   `resetPassword(id, novaSenha)`: Redefine a senha de um usuário existente.
-   `findUserByEmail(email)`: Método privado que busca um usuário pelo e-mail.
-   `findUserById(id)`: Método privado que busca um usuário pelo ID.
-   `isEmailValid(email)`: Método privado que verifica se o formato do e-mail é válido.

---

#### **`index.php`**

Executa a classe `Validator` com vários casos de uso para testar as funcionalidades e mostra os resultados em HTML. Os testes incluem:

1.  Cadastro válido.
2.  E-mail inválido.
3.  Login com senha incorreta.
4.  Reset de senha.
5.  E-mail duplicado.
6.  **Senha muito curta.**
7.  **Senha sem letra maiúscula.**
8.  **Senha sem letra minúscula.**
