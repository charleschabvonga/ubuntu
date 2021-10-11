<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * @var userService
     */
    private $userService;

    /**
     * PostController Constructor
     *
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $users = $this->userService->all();
        return response()->json(['users' => $users]);
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
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        }

        $data = $request->only([
            'first_name',
            'last_name',
            'username',
            'email',
            'password',
            'confirm_password',
        ]);
        $email = $this->userService->findByEmail($data['email']);
        if ($email) {
            return response()->json(['message' => 'Email already exists.'], Response::HTTP_NOT_ACCEPTABLE);
        }

        $user = $this->userService->save($data);
        return response()->json(
            ['message' => 'Successfully created user!', 'user' => $user],
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
        $user = $this->userService->find($id);
        return response()->json(['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return JsonResponse
     */
    public function update(Request $request, User $user): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        }

        $data = $request->only([
            'first_name',
            'last_name',
            'username',
            'email',
            'password',
            'confirm_password',
        ]);

        /** @var User $user */
        $user = $this->userService->update($user, $data);

        return response()->json(['message' => 'Successfully updated user!', 'user' => $user]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(User $user): JsonResponse
    {
        if ($this->userService->delete($user)) {
            return response()->json(['message' => 'Successfully deleted user!'], Response::HTTP_NO_CONTENT);
        }

        return response()->json(['message' => 'Failed to delete the user!'], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
