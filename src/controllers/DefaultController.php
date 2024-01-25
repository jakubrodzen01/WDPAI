<?php

require_once 'AppController.php';

class DefaultController extends AppController
{

    public function index()
    {
        $this->render('login');
    }

    public function main()
    {
        $this->render('main');
    }

    public function profile()
    {
        $this->render('profile');
    }

    public function register()
    {
        $this->render('register');
    }

    public function adminPanel()
    {
        $this->render('adminPanel');
    }
}