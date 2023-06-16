<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class RegistrationController extends Controller
{
    /**
     * @param RegistrationRequest $request
     * @return JsonResponse
     */
    public function store(RegistrationRequest $request): JsonResponse
    {
        User::create($request->validated());

        return response()->json([], 204);
    }
}
