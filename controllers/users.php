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
        if ($_POST) {
            $users_model = new User();
            $user = $users_model->getByName($_POST['data']['user']['name']);
            if ($user) {
                if ($user['password'] == $_POST['data']['user']['password']) {
                    Auth::setAuth($user);
                    Message::setMessage('Successfully!');
                } else {
                    Message::setMessage('Wrong data, try again!', 1);
                }
                header('Location: /users/view/' . $user['id']);
            }
        }
        $view = new View();
        $view->render('users/login');
    }

    public function logout()
    {
        session_destroy();
        session_start();
        header('Location: /users/login');
    }

    public function view($id)
    {
        $users_model = new User();
        $user = $users_model->getById($id);
//        pr($user);
        $view = new View();
        $view->render('users/view', $user);
    }

    public function edit($id)
    {
        $users_model = new User();
        if ($_POST) {
        $avatar_url = $_POST['data']['user']['avatar_url'];
            pr($_POST);
            if ($_FILES['uploadFile']['name']) {
                $avatar_url = $this->fileUpload($avatar_url);
                pr($avatar_url);
            }
            $_POST['data']['user']['avatar_url'] = $avatar_url;
            pr($_POST);
            $user = $users_model->update($_POST['data']['user']);

        }
        $user = $users_model->getById($id);

        pr($user);
        $view = new View();
        $view->render('users/edit', $user);
    }

    protected function fileUpload($old_file = '')
    {
        $uploadOk = 1;

        if($old_file){
            unlink($old_file);
        }
        $check = getimagesize($_FILES["uploadFile"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            Message::setMessage('File is not an image.', 1);
            $uploadOk = 0;
        }
        $target_file = USERS_PICS_DIR . basename($_FILES["uploadFile"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Check if file already exists
     if (file_exists($target_file)) {
            Message::setMessage('Sorry, file already exists.', 1);
            $uploadOk = 0;
        }
// Check file size
        if ($_FILES["uploadFile"]["size"] > 500000) {
            Message::setMessage('Sorry, your file is too large.', 1);
            $uploadOk = 0;
        }
        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            Message::setMessage('Sorry, only JPG, JPEG, PNG & GIF files are allowed.', 1);
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            Message::setMessage('Sorry, your file was not uploaded.', 1);
// if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["uploadFile"]["tmp_name"], $target_file)) {
                return $target_file;
            } else {
                Message::setMessage('Sorry, there was an error uploading your file.', 1);

            }
        }


    }

    #Private

    public function show($id)
    {
        $users_model = new User();
        $user = $users_model->get($id);
        $view = new View();
        $data['user'] = array_pop($user);
        $view->render('users/show', $data);
    }
}