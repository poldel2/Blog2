<?php

namespace Laravel\Blog\application\models\Repositories;

use Laravel\Blog\application\DB;
use Laravel\Blog\application\models\User;
use Laravel\Blog\application\models\UserDTO;
use PDO;

class UserRepository extends Repository
{
    public function save($entity): void
    {
        if ($entity instanceof UserDTO) {
            $name = $entity->name;
            $email = $entity->email;
            $password = $entity->password;

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $this->db->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
            $stmt->execute([
                'name' => $name,
                'email' => $email,
                'password' => $hashedPassword
            ]);
        }
    }

    public function getByKey($key): ?User
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$key]);

        $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($userRow) {
            return new User($userRow['id'], $userRow['name'], $userRow['email'], $userRow['password']);
        } else {
            return null;
        }
    }

    public function delete($key): void
    {
        $stmt = $this->db->prepare("Delete FROM users WHERE name = ?");
        $stmt->execute([$key]);
    }

    public function update($entity): void
    {
        if ($entity instanceof User) {
            $id = $entity->getId();
            $name = $entity->getUsername();
            $email = $entity->getEmail();

            $stmt = $this->db->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
            $stmt->execute([$name, $email, $id]);
        }
    }
}