<?php

namespace App\Services;

use App\Models\User;
use App\Models\Usuario;

class AdminServices
{


    //A classe possui dois atributos públicos: $email e $password, passados via construtor.
    public $email;
    public $password;

    //Isso permite que a classe seja inicializada com credenciais fornecidas.
    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function createAdminUser()
    {
        //Verifica se o e-mail e senha recebidos coincidem com as credenciais definidas no .env (USER_EMAIL e USER_PASSWORD).
        //Só continua se a verificação for verdadeira.
        if ($this->email === env('USER_EMAIL') && $this->password === env('USER_PASSWORD')) {

            // Cria ou atualiza o usuário no banco
            $dados = User::updateOrCreate( // User::updateOrCreate(): procura um usuário com o e-mail fornecido.
                ['email' => env('USER_EMAIL')],
                [                           //Se existe, atualiza nome, senha (criptografada) e tipo (tipo_user = 1 = administrador).
                    'name' => env('USER_USERNAME'),
                    'password' => bcrypt(env('USER_PASSWORD')),
                    'tipo_user' => 1 // Define como administrador
                ])->id; //Se não existe, cria com esses dados. Salva o id do usuário em $dados

            // Na tabela usuarios, cria ou atualiza um registro com: id_user: igual ao ID do usuário criado/acima.
            Usuario::updateOrCreate(
            [ 'id_user' => $dados ], //valida se já existir ele atualiza, senão ele cria um novo.
            [
                'id_user' => $dados,
                'setor_id' => '2',
            ]);
        }
    }
}
