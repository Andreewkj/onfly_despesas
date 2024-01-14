<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/user",
     *     summary="View all users",
     *     tags={"User"},
     *     @OA\Response(
     *          response="200",
     *          description="OK",
     *          content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                   @OA\Property(
     *                       property="name",
     *                       type="required|string",
     *                   ),
     *                   @OA\Property(
     *                       property="email",
     *                       type="required|string|email",
     *                   ),
     *                   @OA\Property(
     *                       property="password",
     *                       type="required|string",
     *                   ),
     *                   @OA\Property(
     *                       property="created_at",
     *                       type="required|string|dateTime",
     *                   ),
     *                   @OA\Property(
     *                       property="updated_at",
     *                       type="required|string|dateTime",
     *                   ),
     *                     example={
     *                             "data": {
     *                              {
     *                          	    "id": 1,
     *				                     "name": "Andreew",
     *			                         "email": "andreew.k.januario@outlook.com",
     *			                         "email_verified_at": null,
     *			                         "created_at": "2024-01-11T15:19:20.000000Z",
     *				                     "updated_at": "2024-01-11T15:19:20.000000Z"
     *                              },
     *                              {
     *                          	    "id": 4,
     *				                     "name": "Bill",
     *			                         "email": "bill.k.januario@outlook.com",
     *			                         "email_verified_at": null,
     *			                         "created_at": "2024-01-11T15:19:20.000000Z",
     *				                     "updated_at": "2024-01-11T15:19:20.000000Z"
     *                              },
     *                          }
     *                     }
     *                 )
     *             )
     *         }
     *     ),
     *     @OA\Response(
     *          response="403", 
     *          description="Unauthorized"
     *      ),
     *     @OA\Response(
     *          response="400", 
     *          description="Bad Request"
     *      ),
     * )
     */
    public function index()
    {
        $users = User::paginate('10');

        return Response()->json($users, 200);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/user",
     *     summary="Create User",
     *     tags={"User"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                   @OA\Property(
     *                       property="name",
     *                       type="required|string",
     *                   ),
     *                   @OA\Property(
     *                       property="email",
     *                       type="required|string|email",
     *                   ),
     *                   @OA\Property(
     *                       property="password",
     *                       type="required|string",
     *                   ),
     *                 example={
     *                      "name": "fulano",
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
     *                         property="message",
     *                         type="string",
     *                     ),
     *                     example={
     *                      "data": {
     *                          "message": "Usuário cadastrado com sucesso!"
     *                       }
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
    public function store(Request $request)
    {
        $data = $request->all();

        if (!$request->has('password') || $request->getPassword('password')) {
            $message = new ApiMessages('Password required');
            return response()->json([$message->getMessage()], 401);
        }

        try {
            $data['password'] = bcrypt($data['password']);
            User::create($data);

            return response()->json([
                'data' => [
                    'message' => 'Usuário cadastrado com sucesso!'
                ]
            ], 200);
        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json([$message->getMessage()], 401);
        }
    }
}
