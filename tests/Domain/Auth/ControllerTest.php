<?php

namespace Domain\Auth;

use Domain\Client\Client;
use Domain\User\User;

class ControllerTest extends \TestCase
{
    public function testLogout()
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

        $this->postJson('auth/login', $data);

        //Asserts
        $this->seeStatusCode(200);
        $this->seeJson([
            'username' => 'emtudo',
        ]);

        $this->postJson('auth/logout', [], $this->getHeaders());
        $this->seeStatusCode(200);
    }

    public function testLoginClient()
    {
        //Sets
        $data = [
            'username' => 'emtudo2',
            'password' => 'emtudo123',
        ];

        $user             = $data;
        $user['password'] = bcrypt($user['password']);
        $user['email']    = 'teste2@teste.com';
        factory(Client::class)->create($user);

        $this->postJson('clients/auth/login', $data);

        //Asserts
        $this->seeStatusCode(200);
        $this->seeJson([
            'username' => 'emtudo2',
        ]);
    }

    public function testLogin()
    {
        //Sets
        $data = [
            'username' => 'emtudo3',
            'password' => 'emtudo123',
        ];

        $user             = $data;
        $user['password'] = bcrypt($user['password']);
        $user['email']    = 'teste3@teste.com';
        factory(User::class)->create($user);

        $this->postJson('auth/login', $data);

        //Asserts
        $this->seeStatusCode(200);
        $this->seeJson([
            'username' => 'emtudo3',
        ]);
    }

    public function testLoginWithEmail()
    {
        //Sets
        $data = [
            'username' => 'teste4@teste.com',
            'password' => 'emtudo123',
        ];

        $user = [
            'username' => 'emtudo4',
            'password' => bcrypt($data['password']),
            'email'    => 'teste4@teste.com',
        ];

        factory(User::class)->create($user);

        $this->postJson('auth/login', $data);

        //Asserts
        $this->seeStatusCode(200);
        $this->seeJson([
            'username' => 'emtudo4',
        ]);
    }

    public function testCantLogin()
    {
        $data = [
            'username' => uniqid(),
            'password' => 'teste',
        ];
        $this->postJson('auth/login', $data);

        //Asserts
        $this->seeStatusCode(401);
    }
}
