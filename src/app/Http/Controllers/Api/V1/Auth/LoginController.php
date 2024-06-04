<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Services\AuthServices\LoginService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    public function __construct(private LoginService $loginService)
    {

    }

    public function __invoke(LoginRequest $request)
    {
        $email = trim($request->email);
        $administrator = $this->loginService->logIn($email);
        if (!$administrator || !Hash::check($request->password, $administrator->password)) {
            throw ValidationException::withMessages([
                'message' => ['Email et/ou mot de passe incorrect.'],
            ]);
        }
        $device = substr($request->userAgent() ?? '', 0, 255);
        $expiresAt = $request->remember ? null : now()->addMinutes(config('session.lifetime'));

        return response()->json([
            'access_token' => $administrator->createToken($device, expiresAt: $expiresAt)->plainTextToken,

        ], Response::HTTP_CREATED);
    }
}
