<?php
namespace src\controllers;

use \core\Controller;
use \src\Handlers\UserHandler;

class LoginController extends Controller {

    public function signin() {
        $flash = '';
        if(!empty($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }
        $this->render('signin', [
            'flash' => $flash
        ]);
    }

    public function signinAction() {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');

        if($email && $password) {
            $token = UserHandler::verifyLogin($email, $password);
            if($token) {
                $_SESSION['token'] = $token;
                $this->redirect('/');
            } else {
                $_SESSION['flash'] = 'Dados não conferem!';
                $this->redirect('/login');
            }

        } else {
            $_SESSION['flash'] = 'Todos os campos devem ser preenchidos!';
            $this->redirect('/login');
        }
    }

    public function signup() {
        $flash = '';
        if(!empty($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }
        $this->render('signup', [
            'flash' => $flash
        ]);
    }

    public function signupAction() {
        $name = filter_input(INPUT_POST, 'name');
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');
        $dtNasc = filter_input(INPUT_POST, 'birthdate');

        if($name && $email && $password && $dtNasc) {
            $qtData = explode('/', $dtNasc);
            $birthdate = $qtData[2].'-'.$qtData[1].'-'.$qtData[0];
            
            if(count($qtData) != 3 || !strtotime($birthdate)) {
                $_SESSION['flash'] = 'Data de Nascimento inválida!';
                $this->redirect('/cadastro');
            }

            if(!UserHandler::emailExists($email)) {
                $token = UserHandler::addUser($name, $email, $password, $birthdate);
                $_SESSION['token'] = $token;
                $this->redirect('/');
            } else {
                $_SESSION['flash'] = 'E-mail já cadastrado!';
                $this->redirect('/cadastro');
            }

        } else {
            $_SESSION['flash'] = 'Todos os campos devem ser preenchidos!';
            $this->redirect('/cadastro');
        }
    }

    public function logout() {
        $_SESSION['token'] = '';
        $this->redirect('/login');
    }

}