<?php

namespace App\Http\Src\v1\Services;

use Illuminate\Http\Request;

interface AuthService
{
    public function addStudent(Request $request);

    public function getStudents();

    public function getProfile($id);

    public function updateProfile(Request $request);

    public function deleteStudent($id);
}
