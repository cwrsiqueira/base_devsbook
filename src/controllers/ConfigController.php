<?php
namespace src\controllers;

use \core\Controller;
use \src\Handlers\UserHandler;

class ConfigController extends Controller {

    private $loggedUser;

    public function __construct() {
        $this->loggedUser = UserHandler::checkLogin();
        if($this->loggedUser === false) {
            $this->redirect('/login');
        }
    }

    public function index() {
        
        $flash = [];
        if(!empty($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }

        $this->render('config', 
            [
                'loggedUser' => $this->loggedUser,
                'flash' => $flash,
            ]
        );
    }

    public function edit($atts = []) {
        $id = $atts['id'];
        $avatar = filter_input(INPUT_POST, 'avatar');
        $cover = filter_input(INPUT_POST, 'cover');
        $name = filter_input(INPUT_POST, 'name');
        $birthdate = filter_input(INPUT_POST, 'birthdate');
        $city = filter_input(INPUT_POST, 'city');
        $work = filter_input(INPUT_POST, 'work');
        $new_password = filter_input(INPUT_POST, 'new_password');
        $confirm_new_password = filter_input(INPUT_POST, 'confirm_new_password');

        $qtData = explode('-', $birthdate);
        if(count($qtData) != 3 || !strtotime($birthdate)) {
            $_SESSION['flash'] = ['error' => 'Data de Nascimento inválida!'];
            $this->redirect('/config');
        }

        if($new_password !== $confirm_new_password) {
            $_SESSION['flash'] = ['error' => 'Confirmação de senha diferente da senha!'];
            $this->redirect('/config');
        }

        if(isset($_FILES['avatar']) && !empty($_FILES['avatar']['tmp_name'])) {
            $newAvatar = $_FILES['avatar'];

            if(in_array($newAvatar['type'], ['image/jpeg', 'image/jpg', 'image/png'])) {
                $avatarName = $this->cutImage($newAvatar, 200, 200, 'media/avatars');
                $avatar = $avatarName;
            }
        }

        if(isset($_FILES['cover']) && !empty($_FILES['cover']['tmp_name'])) {
            $newCover = $_FILES['cover'];

            if(in_array($newCover['type'], ['image/jpeg', 'image/jpg', 'image/png'])) {
                $coverName = $this->cutImage($newCover, 850, 310, 'media/covers');
                $cover = $coverName;
            }
        }

        if(UserHandler::editUser($id, $avatar, $cover, $name, $birthdate, $city, $work, $new_password)) {
            $_SESSION['flash'] = ['success' => 'Dados alterados com sucesso!'];
        }

        $this->redirect('/config');
    }

    private function cutImage($file, $w, $h, $folder) {
        list($widthOrig, $heightOrig) = getImageSize($file['tmp_name']);
        $ratio = $widthOrig / $heightOrig;

        $newWidth = $w;
        $newHeight = $newWidth / $ratio;

        if($newHeight < $h) {
            $newHeight = $h;
            $newWidth = $newHeight * $ratio;
        }

        $x = $w - $newWidth;
        $y = $h - $newHeight;
        $x = $x < 0 ? $x / 2 : $x;
        $y = $y < 0 ? $y / 2 : $y;

        $finalImage = imagecreatetruecolor($w, $h);
        switch ($file['type']) {
            case 'image/jpeg':
            case 'image/jpg':
                $image = imagecreatefromjpeg($file['tmp_name']);
                break;
            case 'image/png':
                $image = imagecreatefrompng($file['tmp_name']);
                break;
        }

        imagecopyresampled(
            $finalImage, $image,
            $x, $y, 0, 0,
            $newWidth, $newHeight, $widthOrig, $heightOrig
        );

        $fileName = md5(time().rand(0,9999)).'.jpg';

        imagejpeg($finalImage, $folder.'/'.$fileName);

        return $fileName;
    }

}
