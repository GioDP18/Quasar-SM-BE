<?php

namespace App\Http\Src\v1\Implementations;


use App\Http\Src\v1\Services\AuthService;
use App\Models\Student;
use Illuminate\Http\Request;

Class AuthServiceImpl implements AuthService
{
    public function addStudent(Request $request){
        $result = Student::create([
            'name' => $request->name,
            'student_number' => $request->student_number
        ]);

        if(!$result){
            return response()->json([
               'success' => false,
               'message' => 'Student could not be added'
            ], 401);
        }

        return response()->json([
            'success' => true,
            'message' => 'Student added successfully',
            'data' => $result
        ], 200);
    }

    public function getStudents(){
        try{
            $result = Student::all();

            if(!$result){
                return response()->json([
                'success' => false,
                'message' => 'Students could not be fetched'
                ], 401);
            }

            return response()->json([
                "success" => true,
                "message" => "Students fetched successfully",
                "students" => $result
            ], 200);
        }
        catch (\Exception $error) {
            return response()->json([
                "success" => false,
                "message" => $error->getMessage()
            ], 500);
        }
    }


    public function getProfile($id){
        try{
            $result = Student::where('id', $id)->get();

            if(!$result){
                return response()->json([
                'success' => false,
                'message' => 'Student could not be fetched'
                ], 401);
            }

            return response()->json([
                "success" => true,
                "message" => "Student info fetched successfully",
                "data" => $result
            ], 200);
        }
        catch (\Exception $error) {
            return response()->json([
                "success" => false,
                "message" => $error->getMessage()
            ], 500);
        }
    }

    public function updateProfile(Request $request){
        try{
            $result = Student::where('id', $request->id)->update([
                "name" => $request->name,
                "student_number" => $request->student_number
            ]);

            if(!$result){
                return response()->json([
                'success' => false,
                'message' => 'Cannot update stident info'
                ], 401);
            }

            return response()->json([
                "success" => true,
                "message" => "Student info updated successfully",
                "data" => $result
            ], 200);
        }
        catch (\Exception $error) {
            return response()->json([
                "success" => false,
                "message" => $error->getMessage()
            ], 500);
        }
    }

    public function deleteSTudent($id){
        try{
            $result = Student::where('id', $id)->delete();

            if(!$result){
                return response()->json([
                'success' => false,
                'message' => 'Cannot delete student'
                ], 401);
            }

            return response()->json([
                "success" => true,
                "message" => "Student deleted successfully",
                "data" => $result
            ], 200);
        }
        catch (\Exception $error) {
            return response()->json([
                "success" => false,
                "message" => $error->getMessage()
            ], 500);
        }
    }
}
