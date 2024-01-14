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

    /**
     * @OA\Get(
     *     path="/api/v1/expenditure",
     *     summary="View an Expenditure",
     *     tags={"Expenditures"},
     *     security={{ "apiAuth": {} }},
     *     @OA\Response(
     *          response="200",
     *          description="OK",
     *          content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     @OA\Property(
     *                         property="id",
     *                         type="string",
     *                     ),
     *                     @OA\Property(
     *                         property="description",
     *                         type="string",
     *                     ),
     *                     @OA\Property(
     *                         property="value",
     *                         type="string|decimal",
     *                     ),
     *                     @OA\Property(
     *                         property="data_cadastro",
     *                         type="string|dateTime('Y-m-d')",
     *                     ),
     *                     example={
     *                     	    {
     *                             "data": {
     *                                  "id": 1,
     *                                  "description": "Creatina",
     *                                  "value": "28.89",
     *                                  "data_cadastro": "2024-01-12",
     *                              },
     *                              {
     *                                  "id": 1,
     *                                  "description": "Creatina",
     *                                  "value": "28.89",
     *                                  "data_cadastro": "2024-01-12",
     *                              }
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
        try {
            $expenditures = auth('api')->user()->expenditure()->paginate('10');
            $expenditureResources = new ExpenditureCollection($expenditures);

            return Response()->json($expenditureResources, 200);

        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json([$message->getMessage()], 400);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/v1/expenditure/{id}",
     *     summary="View an Expenditure",
     *     tags={"Expenditures"},
     *     security={{"bearer": {}}},
     *     @OA\Parameter(
     *         description="Expenditue Id",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string"),
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="OK",
     *          content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     @OA\Property(
     *                         property="id",
     *                         type="string",
     *                     ),
     *                     @OA\Property(
     *                         property="description",
     *                         type="string",
     *                     ),
     *                     @OA\Property(
     *                         property="value",
     *                         type="string|decimal",
     *                     ),
     *                     @OA\Property(
     *                         property="data_cadastro",
     *                         type="string|dateTime('Y-m-d')",
     *                     ),
     *                     example={
     *                     	    {
     *                             "data": {
     *                                  "id": 1,
     *                                  "description": "Creatina",
     *                                  "value": "28.89",
     *                                  "data_cadastro": "2024-01-12",
     *                              }
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

    /**
     * @OA\Post(
     *     path="/api/v1/expenditure",
     *     summary="Create an Expenditure",
     *     tags={"Expenditures"},
     *     security={{ "apiAuth": {} }},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                   @OA\Property(
     *                       property="description",
     *                       type="required|string|max:191",
     *                   ),
     *                   @OA\Property(
     *                       property="value",
     *                       type="required|decimal:2|numeric|between:0,99999999.99",
     *                   ),
     *                 example={"description": "Creatina 300gr", "value": 123456.78}
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
     *                     	    {
     *                             "data": {
     *                                  "message": "Despesa cadastrada com sucesso!",
     *                              }
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
    public function store(Request $request)
    {
        try {
            $data = $request->all();
            
            Validator::make($data, [
                'description' => 'required|string|max:191',
                'value' => 'required|decimal:2|numeric|between:0,99999999.99'
            ])->validate();

            $user = auth('api')->user();

            $data['user_id'] = $user->id;

            $this->expenditure->create($data);

            Notification::send($user, new NewExpenditure($user));

            return response()->json([
                'data' => [
                    'message' => 'Despesa cadastrada com sucesso!'
                ]
            ], 200);
        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage(), $e->errors());
            return response()->json([$message->getMessage()], 400);
        }
    }

     /**
     * @OA\Put(
     *     path="/api/v1/expenditure/{id}",
     *     summary="Updates a Expenditure",
     *     tags={"Expenditures"},
     *     security={{ "apiAuth": {} }},
     *     @OA\Parameter(
     *         description="Expenditue Id",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                   @OA\Property(
     *                       property="description",
     *                       type="required|string|max:191",
     *                   ),
     *                   @OA\Property(
     *                       property="value",
     *                       type="required|decimal:2|numeric|between:0,99999999.99",
     *                   ),
     *                 example={"description": "Creatina 300gr", "value": 123456.78}
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
     *                     	    {
     *                             "data": {
     *                                  "message": "Despesa atualizada com sucesso!",
     *                              }
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
    public function update($id, Request $request)
    {
        try {
            $data = $request->all();

            Validator::make($data, [
                'description' => 'required|string|max:191',
                'value' => 'required|decimal:2|numeric|between:0,99999999.99'
            ])->validate();

            $expenditure = $this->expenditure->findOrfail($id);

            $this->authorize('update', [$expenditure]);

            $expenditure->update($data);

            return response()->json([
                'data' => [
                    'message' => 'Despesa atualizada com sucesso!'
                ]
            ], 200);
        } catch (\Illuminate\Auth\Access\AuthorizationException $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json([$message->getMessage()], 403);
        } catch (ModelNotFoundException $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json([$message->getMessage()], 404);
        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage(), $e->errors());
            return response()->json([$message->getMessage()], 400);
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/expenditure/{id}",
     *     summary="Delete an Expenditure",
     *     tags={"Expenditures"},
     *     security={{ "apiAuth": {} }},
     *     @OA\Parameter(
     *         description="Expenditue Id",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string"),
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
     *                     	    {
     *                             "data": {
     *                                  "message": "Despesa removida com sucesso!",
     *                              }
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
    public function destroy($id)
    {
        try {
            $expenditure = $this->expenditure->findOrfail($id);

            $this->authorize('delete', [$expenditure]);

            $expenditure->delete();

            return response()->json([
                'data' => [
                    'message' => 'Despesa removida com sucesso!'
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
