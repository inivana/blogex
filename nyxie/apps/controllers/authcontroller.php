<?php

class AuthController extends Nyxie
{
    public function index()
    {
        $view = new View();
        $view->display("auth/form.php");

        if (Session::exists()) {
            header("Location: /");
        }
    }

    public function login_post()
    {
        $auth = new Auth();
        if ($user_id = $auth->login($_POST["email"], $_POST["password"])) {
            Session::create($user_id);
            header("Location: /");
        } else {
            header("Location: /auth");
        }
    }

    function logout()
    {
        Session::destroy();
        header("Location: /auth");
    }
}