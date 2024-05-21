<?php

namespace App\Http\Src\v1\Controllers;

use App\Http\Src\v1\Services\AuthService;
use App\Http\Src\v1\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(public AuthService $authService)
    {
    }

    public function addStudent(Request $request)
    {
        return $this->authService->addStudent($request);
    }

    public function getStudents()
    {
        return $this->authService->getStudents();
    }

    public function getProfile($id)
    {
        return $this->authService->getProfile($id);
    }

    public function updateProfile(Request $request)
    {
        return $this->authService->updateProfile($request);
    }

    public function deleteStudent($id)
    {
        return $this->authService->deleteStudent($id);
    }
}
