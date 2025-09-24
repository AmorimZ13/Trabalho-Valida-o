<?php

require_once 'UserManager.php';
require_once 'User.php';

class Validator
{
    private UserManager $userManager;

    public function __construct(UserManager $userManager)
    {
        $this->userManager = $userManager;
    }

    private function isEmailValid(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    private function isPasswordSecure(string $password): bool
    {
        return strlen($password) >= 8 &&
               preg_match('/[a-z]/', $password) &&
               preg_match('/[A-Z]/', $password);
    }

    public function login(string $email, string $password): array
    {
        $user = $this->userManager->findByEmail($email);

        if (!$user || !password_verify($password, $user->getSenha())) {
            return ['status' => 'error', 'message' => 'Credenciais inválidas'];
        }

        return ['status' => 'success', 'message' => 'Login efetuado com sucesso.', 'user' => $user];
    }

    public function register(string $name, string $email, string $password): array
    {
        if (!$this->isEmailValid($email)) {
            return ['status' => 'error', 'message' => 'E-mail inválido'];
        }

        if ($this->userManager->findByEmail($email)) {
            return ['status' => 'error', 'message' => 'E-mail já está em uso'];
        }

        if (!$this->isPasswordSecure($password)) {
            return ['status' => 'error', 'message' => 'A senha deve ter no mínimo 8 caracteres, uma letra maiúscula e uma minúscula.'];
        }

        $newId = $this->userManager->getNextId();
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        $newUser = new User($newId, $name, $email, $hashedPassword);
        $this->userManager->addUser($newUser);

        return ['status' => 'success', 'message' => 'Usuário cadastrado com sucesso.'];
    }

    public function resetPassword(int $id, string $newPassword): array
    {
        $user = $this->userManager->findById($id);

        if (!$user) {
            return ['status' => 'error', 'message' => 'Usuário não encontrado.'];
        }

        if (!$this->isPasswordSecure($newPassword)) {
            return ['status' => 'error', 'message' => 'A nova senha deve ter no mínimo 8 caracteres, uma letra maiúscula e uma minúscula.'];
        }

        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $user->setSenha($hashedPassword);
        $this->userManager->updateUser($user);

        return ['status' => 'success', 'message' => 'Senha alterada com sucesso.'];
    }
}
?>