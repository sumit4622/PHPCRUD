<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\UserRequest;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Services\Auth\AuthService;
use App\Services\Auth\RegisterService;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class UsersController extends Controller
{
    protected $authService;
    protected $registerService;

    public function __construct(AuthService $authService, RegisterService $registerService)
    {
        $this->authService = $authService;
        $this->registerService = $registerService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('authentication.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // for register
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegistrationRequest $request)
    {
        $userdetails = $request->validated();

        try {
            //code...
            $this->registerService->Register($userdetails);

            return $this->success($userdetails, 'User register Successfully.', 201);
        } catch (ValidationException $th) {
            return $this->error('Validation Error', $th->errors(), 422);
        } catch (\Throwable $th) {
            //throw $th;
            return $this->error($th->getMessage(), 'server Error', 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('authentication.register');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function login(UserRequest $request)
    {
        $cred = $request->validated();

        try {
            //code...
            $user = $this->authService->login($cred);

            return $this->success($user, 'User logged in successfully.', 200);
        } catch (ValidationException $e) {
            return $this->error('Validation Error', $e->errors(), 422);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 'Server Error', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function logout(request $request)
    {
        try {
            //code...
            $request->user()->currentAccessToken()->delete();

            return $this->success(null, 'Logged out successfully. Token revoked.');
        } catch (\Throwable $th) {
            //throw $th;
            return $this->error($th->getMessage(), 'logout failed', 500);
        }
    }
}
