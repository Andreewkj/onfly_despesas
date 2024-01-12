<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;
use App\Http\Controllers\Controller;
use App\Models\Expenditure;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ExpenditureController extends Controller
{
    private $expenditure;

    public function __construct(Expenditure $expenditure)
    {
        $this->expenditure = $expenditure;
    }

    public function index()
    {
        $expenditures = auth('api')->user()->expenditure()->paginate('10');

        return Response()->json($expenditures, 200);
    }

    public function show($id)
    {
        try {
            $expenditure = $this->expenditure->findOrfail($id);

            $this->authorize('update', [$expenditure]);

            return response()->json([
                'data' => $expenditure
            ], 200);
        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json([$message->getMessage()], 401);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->all();

            $data['user_id'] = auth('api')->user()->id;

            $this->expenditure->create($data);

            return response()->json([
                'data' => [
                    'msg' => 'Despesa cadastrada com sucesso!'
                ]
            ], 200);
        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json([$message->getMessage()], 401);
        }
    }

    public function update($id, Request $request)
    {
        $data = $request->all();

        try {
            $expenditure = $this->expenditure->findOrfail($id);

            $this->authorize('update', [$expenditure]);

            $expenditure->update($data);

            return response()->json([
                'data' => [
                    'msg' => 'Despesa atualizada com sucesso!'
                ]
            ], 200);
        } catch (\Illuminate\Auth\Access\AuthorizationException $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json([$message->getMessage()], 403);
        } catch (ModelNotFoundException $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json([$message->getMessage()], 404);
        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json([$message->getMessage()], 401);
        }
    }

    public function delete($id)
    {
        try {
            $expenditure = $this->expenditure->findOrfail($id);

            $this->authorize('delete', [$expenditure]);

            $expenditure->delete();

            return response()->json([
                'data' => [
                    'msg' => 'Despesa removida com sucesso!'
                ]
            ], 200);
        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json([$message->getMessage()], 401);
        }
    }
}
