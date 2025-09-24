<?php

require_once 'User.php';

class UserManager
{
    private array $users = [];

    public function __construct()
    {
        $this->users[] = new User(
            1,
            'João Silva',
            'joao@email.com',
            '$2y$10$TqUv1VqL1Q5zQxM5xQ6R8.hE8oE2J9N.iH6.iM.iY2I.t.yVlG2Y.'
        );
    }

    public function findByEmail(string $email): ?User
    {
        foreach ($this->users as $user) {
            if ($user->getEmail() === $email) {
                return $user;
            }
        }
        return null;
    }

    public function findById(int $id)
    {
        foreach ($this->users as $user) {
            if ($user->getId() === $id) {
                return $user;
            }
        }
        return null;
    }

    public function addUser(User $user): void
    {
        $this->users[] = $user;
    }

    public function getNextId(): int
    {
        return count($this->users) + 1;
    }

    public function updateUser(User $updatedUser): bool
    {
        foreach ($this->users as $index => $user) {
            if ($user->getId() === $updatedUser->getId()) {
                $this->users[$index] = $updatedUser;
                return true;
            }
        }
        return false;
    }
}

?>
