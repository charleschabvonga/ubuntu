<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Services\AgentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class AgentController extends Controller
{
    /**
     * @var AgentService agentService
     */
    private $agentService;

    /**
     * AgentController constructor.
     * @param AgentService $agentService
     */
    public function __construct(AgentService $agentService)
    {
        $this->agentService = $agentService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $agents = $this->agentService->all();
        return response()->json(['agents' => $agents]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        }

        $data = $request->only(['first_name', 'last_name', 'email', 'phone_number']);
        $agent = $this->agentService->save($data);

        return response()->json(
            ['message' => 'Successfully created an agent!', 'agent' => $agent],
            Response::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $agent = $this->agentService->find($id);
        return response()->json(['agent' => $agent]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Agent $agent
     * @return JsonResponse
     */
    public function update(Request $request, Agent $agent): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        }

        $data = $request->only([
            'first_name',
            'last_name',
            'email',
            'phone_number',
        ]);
        $agent = $this->agentService->update($agent, $data);

        return response()->json(['message' => 'Successfully updated an agent!', 'agent' => $agent]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Agent $agent
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(Agent $agent): JsonResponse
    {
        if ($this->agentService->delete($agent)) {
            return response()->json(['message' => 'Successfully deleted the an agent!'], Response::HTTP_NO_CONTENT);
        }

        return response()->json(['message' => 'Failed to delete the an agent!'], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
