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
}