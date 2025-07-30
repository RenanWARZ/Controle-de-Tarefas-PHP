<?php

namespace App\Services;

use App\Models\User;

class AdminServices
{

    public $email;
    public $password;

    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function createAdminUser()
    {
        if ($this->email === env('USER_EMAIL') && $this->password === env('USER_PASSWORD')) {

            // Cria ou atualiza o usuário no banco

            User::updateOrCreate(
                ['email' => env('USER_EMAIL')],
                [
                    'name' => env('USER_USERNAME'),
                    'password' => bcrypt(env('USER_PASSWORD')),
                    'tipo_user' => 1 ] // Define como administrador
            );
        }   }
}
