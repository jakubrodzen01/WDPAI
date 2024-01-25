<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';

class UserRepository extends Repository
{
    public function getUser(string $email): ?User {
        $stmt = $this->database->connect()->prepare('
            SELECT *
            FROM public.users u
            WHERE u.email = :email
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user == false) {
            return null;
        }

        return new User($user['email'], $user['password'], $user['name'], $user['surname'], $user['gender'], $user['id']);
    }

    public function getAllUsers(): array
    {
        $stmt = $this->database->connect()->prepare('
        SELECT *
        FROM public.users
    ');
        $stmt->execute();

        $usersData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $users = [];

        foreach ($usersData as $userData) {
            $users[] = new User(
                $userData['email'],
                $userData['password'],
                $userData['name'],
                $userData['surname'],
                $userData['gender'],
                $userData['id']
            );
        }

        return $users;
    }

    public function addUser(User $user): void
    {
        // Wstawianie danych do tabeli users
        $stmt = $this->database->connect()->prepare('
        INSERT INTO public.users (email, password, name, surname, gender)
        VALUES (?, ?, ?, ?, ?)
    ');
        $stmt->execute([
            $user->getEmail(),
            $user->getPassword(),
            $user->getName(),
            $user->getSurname(),
            $user->getGender()
        ]);
    }

    public function getHashedPassword(String $email){
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.users WHERE email = :email
        ');
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->execute();
        $hashedPassword=$stmt->fetch(PDO::FETCH_ASSOC);
        return $hashedPassword;
    }

    public function deleteUser(int $id) {
        $stmt = $this->database->connect()->prepare('
        DELETE FROM public.users
        WHERE id = :id
    ');

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function updateUserAndDeleteUser(User $updatedUser, int $userIdToDelete) {
        $this->database->connect()->beginTransaction();

        try {
            $this->updateUser($updatedUser);

            $this->deleteUser($userIdToDelete);

            $this->database->connect()->commit();
        } catch (Exception $e) {
            $this->database->connect()->rollBack();
            throw $e; // ponowne podniesienie wyjątku
        }
    }
    public function updateUser(User $user) {
        $stmt = $this->database->connect()->prepare('
        UPDATE public.users
        SET name = :name, surname = :surname
        WHERE id = :id
    ');

        $userId = $user->getId();
        $userName = $user->getName();
        $userSurname = $user->getSurname();

        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':name', $userName, PDO::PARAM_STR);
        $stmt->bindParam(':surname', $userSurname, PDO::PARAM_STR);

        $stmt->execute();
    }
}