<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Router::get('', 'DefaultController');
Router::get('index','DefaultController');
Router::get('main', 'DefaultController');
Router::post('login', 'SecurityController');
Router::get('logout', 'SecurityController');
Router::get('profile', 'DefaultController');
Router::get('register', 'SecurityController');
Router::post('postPlan', 'PlanController');
Router::post('addExercise', 'PlanController');
Router::get('adminPanel', 'UsersController');
Router::get('deleteUser', 'UsersController');

Router::run($path);