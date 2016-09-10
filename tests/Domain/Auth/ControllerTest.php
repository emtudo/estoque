<?php

namespace Domain\Auth;

use Domain\User\User;

class ControllerTest extends \TestCase
{
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
