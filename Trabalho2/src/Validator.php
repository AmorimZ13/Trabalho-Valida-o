<?php

class Validator
{
    private array $users = [
        ['id' => 1, 'nome' => 'João Silva', 'email' => 'joao@email.com', 'senha' => '$2y$10$TqUv1VqL1Q5zQxM5xQ6R8.hE8oE2J9N.iH6.iM.iY2I.t.yVlG2Y.']
    ];

    private function findUserByEmail(string $email): ?array
    {
        foreach ($this->users as $user) {
            if ($user['email'] === $email) {
                return $user;
            }
        }
        return null;
    }

    private function findUserById(int $id): ?array
    {
        foreach ($this->users as $user) {
            if ($user['id'] === $id) {
                return $user;
            }
        }
        return null;
    }

    private function isEmailValid(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    public function login(string $email, string $password): array
    {
        $user = $this->findUserByEmail($email);
        
        if (!$user || !password_verify($password, $user['senha'])) {
            return ['status' => 'error', 'message' => 'Credenciais inválidas'];
        }
        
        return ['status' => 'success', 'message' => 'Login efetuado com sucesso.', 'user' => $user];
    }

    public function register(string $name, string $email, string $password): array
    {
        if (!$this->isEmailValid($email)) {
            return ['status' => 'error', 'message' => 'E-mail inválido'];
        }

        if ($this->findUserByEmail($email)) {
            return ['status' => 'error', 'message' => 'E-mail já está em uso'];
        }

        if (strlen($password) < 8) {
            return ['status' => 'error', 'message' => 'A senha deve ter no mínimo 8 caracteres.'];
        }

        if (!preg_match('/[a-z]/', $password)) {
            return ['status' => 'error', 'message' => 'A senha deve conter pelo menos uma letra minúscula.'];
        }

        if (!preg_match('/[A-Z]/', $password)) {
            return ['status' => 'error', 'message' => 'A senha deve conter pelo menos uma letra maiúscula.'];
        }

        $newId = count($this->users) + 1;
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $this->users[] = [
            'id' => $newId,
            'nome' => $name,
            'email' => $email,
            'senha' => $hashedPassword
        ];

        return ['status' => 'success', 'message' => 'Usuário cadastrado com sucesso.'];
    }

    public function resetPassword(int $id, string $newPassword): array
    {
        $user = $this->findUserById($id);

        if (!$user) {
            return ['status' => 'error', 'message' => 'Usuário não encontrado.'];
        }

        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        foreach ($this->users as &$u) {
            if ($u['id'] === $id) {
                $u['senha'] = $hashedPassword;
                break;
            }
        }

        return ['status' => 'success', 'message' => 'Senha alterada com sucesso.'];
    }
}
