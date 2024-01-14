<?php

namespace App\Http\Controllers\Api\Auth;

use App\Api\ApiMessages;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginJwtController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/v1/login",
     *     summary="User Authentification with jwt",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                   @OA\Property(
     *                       property="email",
     *                       type="required|string|email",
     *                   ),
     *                   @OA\Property(
     *                       property="password",
     *                       type="required|string",
     *                   ),
     *                 example={
     *                      "email": "fulano@gmail.com",
     *                      "password": "123456"
     *                  }
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="OK",
     *          content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     @OA\Property(
     *                         property="msg",
     *                         type="string",
     *                     ),
     *                     example={
     *                      "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2FwaS92MS9sb2dpbiIsImlhdCI6MTcwNTE3NTMzNCwiZXhwIjoxNzA1MTc4OTM0LCJuYmYiOjE3MDUxNzUzMzQsImp0aSI6IlNWSGRFOUVUSk5tdVRBa1IiLCJzdWIiOiIyIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.mT1p1XydDbI7dZusSdWlyoXrO1SM6C4assK5xsJCyKo",
     *                      "token_type": "bearer"
     *                     }
     *                 )
     *             )
     *         }
     *     ),
     *     @OA\Response(
     *          response="401", 
     *          description="Unauthorized"
     *      ),
     * )
     */
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|string'
        ])->validate();

        $token = auth('api')->attempt($credentials);

        if (!$token) {
            $message = new ApiMessages('Unauthorized');
            return response()->json([$message->getMessage()], 401);
        }

        return response()->json([
            'token' => $token,
            'token_type' => 'bearer'
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/logout",
     *     summary="User Logout",
     *     tags={"Auth"},
     *     security={{ "apiAuth": {} }},
     *     @OA\Response(
     *          response="200",
     *          description="OK",
     *          content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     @OA\Property(
     *                         property="message",
     *                         type="string",
     *                     ),
     *                     example={
     *                             "message": "Usuário deslogado!"
     *                     }
     *                 )
     *             )
     *         }
     *     ),
     * )
     */
    public function logout()
    {
        auth('api')->logout();

        $message = new ApiMessages('Usuário deslogado!');
        return response()->json([$message->getMessage()], 200);
    }
}
