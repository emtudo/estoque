<?php

use Domain\User\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TestCase extends Laravel\BrowserKitTesting\TestCase
{
    use DatabaseTransactions;

    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__ . '/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    public function dd()
    {
        dd($this->response->getContent());
    }

    public function getHeaders(string $password = 'password123', User $user = null)
    {
        if (is_null($user)) {
            $user = factory(User::class)->create([
                'password' => bcrypt($password),
            ]);
        }
        $data = [
            'username' => $user->username,
            'password' => $password,
        ];
        $this->post('auth/login', $data);

        $data  = $this->response->getContent();
        $token = json_decode($data)->token;

        return [
            'Authorization' => 'Bearer ' . $token,
        ];
    }
}
