# Sistema de Validação de Usuário

**Integrantes:**

- Marcelo Henrique de Amorim RA: 1997218
- Giovanna Batista RA: 1991571

---

### **Como Iniciar e Executar com XAMPP**

1.  No Painel de Controle do XAMPP, inicie os módulos **"Apache"** e **"MySQL"** clicando em **"Start"** nos botões correspondentes.
2.  Navegue até a pasta de instalação do XAMPP (geralmente `C:\xampp` no Windows).
3.  Baixe e adicione todos os arquivos PHP do projeto (`User.php`, `UserManager.php`, `Validator.php` e `index.php`) dentro da pasta `htdocs`.
4.  Abra um navegador e digite `http://localhost/index.php` na barra de endereços.
5.  O navegador irá exibir o resultado da execução dos testes em HTML.

---

### **Estrutura dos Arquivos**

A nova arquitetura do projeto divide as responsabilidades em três classes, seguindo o princípio da separação de responsabilidades para maior organização e escalabilidade.

#### **`User.php`**

Esta classe atua como um **modelo** de dados, representando um único usuário. Ela contém apenas as propriedades (`id`, `nome`, `email`, `senha`) e métodos para acessá-las (`getters`) e alterá-las (`setters`), sem qualquer lógica de validação.

#### **`UserManager.php`**

Esta classe é o **gerenciador** de usuários. Ela cuida das operações de persistência de dados, como:
-   `addUser()`: Adiciona um novo usuário à coleção.
-   `findByEmail()`: Encontra um usuário pelo e-mail.
-   `findById()`: Encontra um usuário pelo ID.
-   `updateUser()`: Atualiza os dados de um usuário existente.

#### **`Validator.php`**

Esta classe é a **camada de validação** e lógica de negócio. Ela utiliza o `UserManager` para interagir com os dados, mas sua principal função é garantir que as operações sigam as regras de segurança e negócio. Seus principais métodos são:
-   `register(nome, email, senha)`: Cadastra um novo usuário, aplicando validações rigorosas como formato de e-mail e regras de segurança para a senha (mínimo de 8 caracteres, uma letra maiúscula e uma minúscula).
-   `login(email, senha)`: Autentica o usuário verificando as credenciais.
-   `resetPassword(id, novaSenha)`: Redefine a senha de um usuário, aplicando as regras de segurança para a nova senha.

---

### **`index.php`**

Este arquivo é o ponto de entrada da aplicação, onde todas as classes são instanciadas e testadas. Ele demonstra como a nova arquitetura funciona, executando uma série de testes que cobrem as principais funcionalidades e as validações implementadas. Os testes incluem:
-   Cadastro válido.
-   E-mail inválido.
-   Login com senha incorreta.
-   Redefinição de senha.
-   E-mail duplicado.
-   Casos de falha nas regras de senha (muito curta, sem maiúscula, sem minúscula).
