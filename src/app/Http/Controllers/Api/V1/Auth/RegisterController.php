<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Services\AuthServices\RegisterService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{
    public function __construct(private RegisterService $registerService)
    {
    }

    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function __invoke(RegisterRequest $request): JsonResponse
    {
        //creation d'un administrateur
        $device = substr($request->userAgent() ?? '', 0, 255);
        $user = $this->registerService->createNewAdministrator($request);
        return response()->json([
            'access_token' => $user->createToken($device)->plainTextToken,
        ], Response::HTTP_CREATED);

    }
}
