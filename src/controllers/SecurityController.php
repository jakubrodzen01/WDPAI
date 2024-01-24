<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';

class SecurityController extends AppController
{
    public function login(){
        session_start();

        if (!$this->isPost()) {
            return $this->render('login');
        }

        $email = $_POST["email"];
        $password = $_POST["password"];

        $userRepository = new UserRepository();
        $user = $userRepository->getUser($email);

        if (!$user) {
            return $this->render('login', ['messages' => ['User not exist!']]);
        }

        if ($user->getEmail() !== $email) {
            return $this->render('login', ['messages' => ['User with this email not exist!']]);
        }

        if ($user->getPassword() !== $password) {
            return $this->render('login', ['messages' => ['Wrong password!']]);
        }

        $user_id = $userRepository->getUser($email)->getId();
        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_email'] = $user->getEmail();
        $_SESSION['user_name'] = $user->getName();
        $_SESSION['user_surname'] = $user->getSurname();

        //return $this->render('main');
        //alternatywne wykonanie

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/main");
    }

    public function logout(){
        session_start();
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_surname']);
        unset($_SESSION['plan_id']);
        unset($_SESSION['selected_date']);
        unset($_SESSION['plan_name']);
        unset($_SESSION['exercises']);
        session_destroy();
        return $this->render('login', ['messages' => ['Logout successful!']]);
    }

    public function register(){
        if (!$this->isPost()) {
            return $this->render('register');
        }

        // Pobranie danych z formularza
        $name = $_POST["name"];
        $surname = $_POST["surname"];
        $gender = $_POST["gender"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $userRepository = new UserRepository();

        // Tworzenie obiektu User
        $user = new User($email, $hashedPassword, $name, $surname, $gender);
        try {
            $userRepository->addUser($user);

        } catch (Exception $e) {
            $this->render('register', ['error' => 'Registration failed: ' . $e->getMessage()]);
        }

        header("Location: login");
    }
}