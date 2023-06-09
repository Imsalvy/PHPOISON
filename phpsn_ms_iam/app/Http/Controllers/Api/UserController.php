<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Http\Responses\ApiSuccessResponse;
use App\Http\Responses\ApiErrorResponse;
use Throwable;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(): ApiSuccessResponse|ApiErrorResponse
    {
        try {
            $users = UserResource::collection(User::all());
            return new ApiSuccessResponse($users, ['message' => 'Users listed successfully.']);
        } catch (Throwable $e) {
            return new ApiErrorResponse($e, ['message' => 'Users were not listed.']);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request): ApiSuccessResponse|ApiErrorResponse
    {
        try {
            $user = User::create($request->only('email', 'name', 'password'));
            return new ApiSuccessResponse($user, ['message' => 'User ' . $user->name . ' created.'], 201);
        } catch (Throwable $e) {
            return new ApiErrorResponse($e, ['message' => 'User not created.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(user $user): ApiSuccessResponse|ApiErrorResponse
    {
        try {
            return new ApiSuccessResponse(['id:' => $user->id, 'name' => $user->name, 'email' => $user->email], ['message' => 'Data retrived successfully'],);
        } catch (Throwable $e) {
            return new ApiErrorResponse($e, ['message' => 'User not found.']);
        }
    }

    /**
     * Delete the specified resource.
     */
    public function delete(user $user): ApiSuccessResponse|ApiErrorResponse
    {
        try {
            $user->delete();
            return new ApiSuccessResponse($user, ['message' => 'User deleted.']);
        } catch (Throwable $e) {
            return new ApiErrorResponse($e, ['message' => 'User not deleted.']);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, user $user)
    {
        try {
            $user->update($request->only('name', 'email'));
            return new ApiSuccessResponse($user, ['message' => 'User updated.'], 202);
        } catch (Throwable $e) {
            return new ApiErrorResponse($e, ['message' => 'User not updated']);
        }

    }

}
