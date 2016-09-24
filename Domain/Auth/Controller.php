<?php

namespace Domain\Auth;

use Auth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class Controller extends \Domain\Core\Http\Controller
{
    public function login(Request $request)
    {
        // grab credentials from the request
        $credentials = $request->only('username', 'password');
        $email       = $request->username;

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $credentials['email'] = $email;
            unset($credentials['username']);
        }

        try {
            // attempt to verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // all good so return the token
        return $this->getUser($token);
    }

    public function getUser(string $token)
    {
        $user = Auth::user();

        return compact('token', 'user');
    }

    public function logout()
    {
        $result = JWTAuth::invalidate(JWTAuth::getToken());
        if (!$result) {
            return response()->json(['error' => 'falha ao deslogar'], 403);
        }

        return response()->json('ok');
    }
}
