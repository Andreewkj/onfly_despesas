<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate('10');

        return Response()->json($users, 200);
    }

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
                    'msg' => 'Usuário cadastrado com sucesso!'
                ]
            ], 200);
        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json([$message->getMessage()], 401);
        }
    }
}
