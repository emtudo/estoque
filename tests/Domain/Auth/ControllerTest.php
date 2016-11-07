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

        $this->post('auth/login', $data);

        //Asserts
        $this->seeStatusCode(200);
        $this->seeJson([
            'username' => 'emtudo',
        ]);

        $this->post('auth/logout', [], $this->getHeaders());
        $this->seeStatusCode(200);
    }

    public function testLoginClient()
    {
        //Sets
        $data = [
            'username' => 'emtudo',
            'password' => 'emtudo123',
        ];

        $user             = $data;
        $user['password'] = bcrypt($user['password']);
        $user['email']    = 'teste@teste.com';
        factory(Client::class)->create($user);

        $this->post('clients/auth/login', $data);

        //Asserts
        $this->seeStatusCode(200);
        $this->seeJson([
            'username' => 'emtudo',
        ]);
    }

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

    public function testLoginWithEmail()
    {
        //Sets
        $data = [
            'username' => 'teste@teste.com',
            'password' => 'emtudo123',
        ];

        $user = [
            'username' => 'emtudo',
            'password' => bcrypt($data['password']),
            'email'    => 'teste@teste.com',
        ];

        factory(User::class)->create($user);

        $this->post('auth/login', $data);

        //Asserts
        $this->seeStatusCode(200);
        $this->seeJson([
            'username' => 'emtudo',
        ]);
    }

    public function testCantLogin()
    {
        $data = [
            'username' => uniqid(),
            'password' => 'teste',
        ];
        $this->post('auth/login', $data);

        //Asserts
        $this->seeStatusCode(401);
    }
}
