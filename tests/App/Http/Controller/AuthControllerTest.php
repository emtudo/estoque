<?php

namespace App\Http\Controller;

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthControllerTest extends \TestCase
{
    use DatabaseTransactions;

    public function testLogin()
    {
        //Sets
        $data = [
            'username' => 'emtudo',
            'password' => 'emtudo123',
        ];

        $user             = $data;
        $user['password'] = bcrypt($user['password']);
        $user['email']    = 'teste@teste.com';
        factory(User::class)->create($user);

        $this->post('auth/login', $data);

        //Asserts
        $this->seeStatusCode(200);
        $this->seeJson([
            'username' => 'emtudo',
        ]);
    }
}
