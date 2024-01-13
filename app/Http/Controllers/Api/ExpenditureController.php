<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;

use App\Http\Controllers\Controller;
use App\Http\Resources\ExpenditureCollection;
use App\Http\Resources\ExpenditureResource;
use App\Models\Expenditure;
use App\Notifications\NewExpenditure;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class ExpenditureController extends Controller
{
    private ?Expenditure $expenditure;

    public function __construct(?Expenditure $expenditure = null)
    {
        $this->expenditure = $expenditure;
    }

    public function index()
    {
        try {
            $expenditures = auth('api')->user()->expenditure()->paginate('10');
            $expenditureResources = new ExpenditureCollection($expenditures);

            return Response()->json($expenditureResources, 200);

        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json([$message->getMessage()], 400);
        }
    }

    public function show($id)
    {
        try {
            $expenditure = $this->expenditure->findOrfail($id);

            $this->authorize('view', [$expenditure]);

            $expenditureResource = new ExpenditureResource($expenditure);

            return response()->json([
                'data' => $expenditureResource
            ], 200);
        } catch (\Illuminate\Auth\Access\AuthorizationException $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json([$message->getMessage()], 403);
        } catch (ModelNotFoundException $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json([$message->getMessage()], 404);
        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json([$message->getMessage()], 400);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->all();
            
            Validator::make($data, [
                'description' => 'required|string|max:191',
                'value' => 'required|decimal:2|between:0,99999999.99'
            ])->validate();

            $user = auth('api')->user();

            $data['user_id'] = $user->id;

            $this->expenditure->create($data);

            Notification::send($user, new NewExpenditure($user));

            return response()->json([
                'data' => [
                    'msg' => 'Despesa cadastrada com sucesso!'
                ]
            ], 200);
        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json([$message->getMessage()], 400);
        }
    }

    public function update($id, Request $request)
    {
        try {
            $data = $request->all();

            Validator::make($data, [
                'description' => 'required|string|max:191',
                'value' => 'required|decimal:2|between:0,99999999.99'
            ])->validate();

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
            return response()->json([$message->getMessage()], 400);
        }
    }

    public function destroy($id)
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
        } catch (\Illuminate\Auth\Access\AuthorizationException $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json([$message->getMessage()], 403);
        } catch (ModelNotFoundException $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json([$message->getMessage()], 404);
        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json([$message->getMessage()], 400);
        }
    }
}
