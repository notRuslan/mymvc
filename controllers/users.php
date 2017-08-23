<?php

namespace App;
require_once __DIR__ . "/../models/user.php";

class Users
{

    public function index()
    {
        $users_model = new User();
        $users = $users_model->all();
        $view = new View();
        $data['users'] = $users;
        $view->render('users/index', $data);
    }

    public function registration()
    {
        if ($_POST) {
//        header('Location: /users/registration');
            $users_model = new User();
            if ($users_model->add($_POST['data']['user'])) {
                Message::setMessage('Successfully registered!');
                header('Location: /users/login');
            } else {
                Message::setMessage('You are not registered, try again!', 1);
            }
        }
        $view = new View();
        $view->render('users/registration');
    }

    public function login()
    {
        if($_POST){
            $users_model = new User();
            $user = $users_model->getByName($_POST['data']['user']['name']);
            if($user) {
                if($user['password'] == $_POST['data']['user']['password']){
                    Auth::setAuth($user);
                    Message::setMessage('Successfully!');
                }else{
                    Message::setMessage('Wrong data, try again!', 1);
                }
                header('Location: /users/view/'. $user['id']);
            }
        }
        $view = new View();
        $view->render('users/login');
    }

    public function logout(){
        session_destroy();
        session_start();
        header('Location: /users/login');
    }

    public function view($id)
    {
        $users_model = new User();
        $user = $users_model->getById($id);
        pr($user);
        $view = new View();
        $view->render('users/view', $user);
    }

    public function show($id)
    {
        $users_model = new User();
        $user = $users_model->get($id);
        $view = new View();
        $data['user'] = array_pop($user);
        $view->render('users/show', $data);
    }
}