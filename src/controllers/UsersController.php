<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Plan.php';
require_once __DIR__.'/../repository/PlanRepository.php';
require_once __DIR__.'/../repository/ExerciseRepository.php';

class UsersController extends AppController
{
    private $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function adminPanel()
    {
        $this->render('adminPanel');
        $this->getUsers();
    }

    public function getUsers()
    {
        session_start();

        $users = $this->userRepository->getAllUsers();
        $_SESSION['users'] = $users;
    }

    public function deleteUser()
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        if ($requestMethod === 'DELETE') {
            $data = json_decode(file_get_contents('php://input'), true);
            $userId = $data['userId'];
            session_start();

            $this->userRepository->deleteUser($userId);
            $this->getUsers();
            $this->render('adminPanel');
            $this->userRepository->deleteUser($userId);

            header('Content-Type: application/json');
            echo json_encode(['message' => 'User deleted successfully.']);
            exit;
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Bad request.']);
            exit;
        }
    }
}