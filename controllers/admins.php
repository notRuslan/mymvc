<?php
/**
 * Controller for users administrations
 */

namespace App;

require_once __DIR__ . "/../models/user.php";

use Intervention\Image\ImageManagerStatic as Image;

class Admins
{
    public function index()
    {
        $users_model = new User();
        $users = $users_model->all();
        $view = new View();
        $data['users'] = $users;
        $view->render('admins/index', $data);
    }

    public function delete()
    {
//            pr($_POST);
        $users_model = new User();

        if ($users_model->delete($_POST['data']['user']['id'])) {
            Message::setMessage('Deleted Successfuly');
        } else {
            Message::setMessage('Could not delete', 1);
        }

        $users = $users_model->all();
        $view = new View();
        $data['users'] = $users;
//        $view->render('admins/index', $data);
        header('Location: /admins/index');
    }

    public function edit($id)
    {
        $users_model = new User();
        if ($_POST) {
            $avatar_url = $_POST['data']['user']['avatar_url'];
//            pr($_POST);
            if ($_FILES['uploadFile']['name']) {
//                pr($_FILES['uploadFile']);
                $avatar_url = $this->fileUpload($avatar_url);
            }
            $_POST['data']['user']['avatar_url'] = $avatar_url;
//            pr($_POST);
            $user = $users_model->update($_POST['data']['user']);
            if($user){
                Message::setMessage('Stored successfully');
            }

        }
        $user = $users_model->getById($id);

//        pr($user);
        $view = new View();
        $view->render('users/edit', $user);
    }

    protected function fileUpload($old_file = '')
    {
        $uploadOk = 1;
        if (file_exists($old_file)) {
            unlink($old_file);
        }
        $check = getimagesize($_FILES["uploadFile"]["tmp_name"]);
        if ($check !== false) {
//            echo "File is an image - " . $check["mime"] . ".";
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
            //Allow t oshare files
            $uploadOk = 1;
        }
// Check file size
        if ($_FILES["uploadFile"]["size"] > 500000) {
            Message::setMessage('Sorry, your file is too large.', 1);
            $uploadOk = 0;
        }
        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            Message::setMessage('Sorry, only JPG, JPEG, PNG & GIF files are allowed.', 1);
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
//            echo "Sorry, your file was not uploaded.";
//            Message::setMessage('Sorry, your file was not uploaded.', 1);
// if everything is ok, try to upload file
        } else {
//            if (move_uploaded_file($_FILES["uploadFile"]["tmp_name"], $target_file)) {
            $img = Image::make($_FILES["uploadFile"]["tmp_name"]); //Открываем
            //Изменяем размер resize the image to a width of 100 and constrain aspect ratio (auto height)
            $img->resize(100, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            if($img->save($target_file)){
//        $img->save('uploads/NEW' . $file['name']); //Сохраняем с новым именем
                return $target_file;
            } else {
                Message::setMessage('Sorry, there was an error uploading your file.', 1);

            }
        }


    }

}