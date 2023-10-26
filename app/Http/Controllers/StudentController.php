<?php

namespace App\Http\Controllers;
use App\Models\Student;
use App\Models\StudentMeta;
use App\Models\Mark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use Storage;
class StudentController extends Controller
{

    public function add_student(Request $request)
    {
        
      // error null pass in validator
        $rules = [
            'name' => 'required',
            'email' => 'required|email|users,email',
            'password' => 'required|min:8',
            'gender' => 'required'
        ];
       
        try{
            
            $student = Student::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'phone_no' =>$request->phone_no,
                'gender' => $request->gender
            ]);

            $student = Student::latest()->first();
            $student->add_marks($request->hindi, $request->english, $request->math, $request->drawing);
            $student->add_student_meta();
            return response()->json(['student'=>$student,   'message' => "Added Successfull!"], 200);  
        }catch(Exception $th){
                return response()->json([
                    'message' => $th->getMessage()
                ], 500);
            }

        }

    public function edit(Request $request, $id)
    {
        $student = Student::find($id);
        if($student)
        {
            $student = Student::find($request->id);
            $student->name = $request->name;
            $student->password = $request->password;
            $student->save();
            return response()->json(['message' => "Updated Successfull!"], 200);  
        }else{
            return response()->json(['message' => "Student not found!"], 404);  
        }
        
    }

    public function destroy(Request $request, $id)
    {
        try{
            $student = Student::find($id);
            if($student)
            {
                $student->delete();
                return response()->json(['message' => "Deleted Successfull!"], 200);;
            }else{
                return response()->json(['message' => "Student not found!"], 404);
            }
        }catch(Exception $th){
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }

    }
}
