<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Validation\ValidationException;
use Illuminate\support\Facades\Redirect;
use Illuminate\Support\Facades\Cache;


class StudentAuthController extends Controller
{
   
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if($validator->fails()){
            return response()->json(['message'=> $validator->errors()], 401);       
        }

        try{

           $student = Student::where('email', $request->email)->first();
            if($student)
            {
                Cache::put('student', $student);
                $student_data = Cache::rememberForever('student', function () {
                    return $student;
                });
                return Redirect::route('export_marksheet')->with('student', $student);
            }else{
                $response = [
                    'success' => false,
                    'message' => 'unauthorized'
                ];
    
                return response()->json([$response, 401]);
            }
        }catch(Exception $th){
            \Log::info($th);
            return response()->json(['message'=>$th->getMessage()], 500);
        }

    }
}
