<?php

namespace App\Auth;

use App\Models\User;

class Auth
{

    public function user()
    {
        return isset($_SESSION['user']) ? User::find($_SESSION['user']) : [];
    }

    public function check()
    {
        return isset($_SESSION['user']);
    }

    public function attempt($email, $password)
    {
        $user = User::where('email', $email)->first();
        if ( ! $user)
        {
            return false;
        }

        if (password_verify($password, $user->password))
        {
            $_SESSION['user'] = $user->id;
            return true;
        }

        return false;
    }

    public function logout()
    {
        if (isset($_SESSION['user']))
        {
            unset($_SESSION['user']);
        }
    }

}
