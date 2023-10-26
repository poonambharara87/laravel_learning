<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    public function add_teacher(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone_no' => 'required|min:10|unique:users,phone_no',
            'password' => 'required|min:8',
            'gender' => 'required',
            'image' => 'required|mimes:png,jpg'
        ]);

        if($validator->fails())
        {
            return response()->json(['message' => $validator->errors()], 401);
        }

        if($request->hasFile('image')){
            $image = $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('profile_pic', $image, 'public');
        }

        try{

            if(!Auth::user()->user_Type == 1){
                return response()->json('You Are Not Authorized To Add Teacher', 401);
            }
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone_no' => $request->phone_no,
                'gender' => $request->gender,
                'password' => $request->password,
                'path' => $image,
                'file_name' => $path
            ]);
            \Log::info(Auth::user());
            return response()->json(['user' => $user, 'message'=> 'User Created Successfully!'], 200);
        
        }catch(Exception $th){
            return response()->json(['message'=> $th->getMessage()], 200); 
        }
    }

    public function edit(Request $request, $id)
    {

        try{
         
            if(!Auth::user()->user_Type == 1){
                return response()->json('You Are Not Authorized To Add Teacher', 401);
            }

            if($request->hasFile('image')){
                $file_name = $request->file('image')->getClientOriginalName();
                $path = $request->file('image')->storeAs('/profile_pic', $file_name, 'public');
            }
            $user = User::find($id);
            if($user){
                $user->name = $request->name;
                $user->email = $request->email;
                $user->phone_no = $request->phone_no;    
                $user->gender = $request->gender;
                $user->password = $request->password;
                $user->path = $request->path;
                $user->file_name = $request->file_name;
                $user->save();
                return response()->json(['user' => $user, 'message'=> 'User Updated Successfully!'], 200);
            }else{
                return response()->json(['message'=> 'User Not Found!'], 404);
            }
    }catch(Exception $th){
        return response()->json(['message' => $th->getMessage()], 500);
    }
    }
    public function list()
    {
        $users = User::all();
        if($users)
        {
            return response()->json(['users' => $users], 200);
        }else{
            return response()->json(['users' => 'No User!'], 404);
        }
    }
    public function destroy($id){
        
        if(!Auth::user()->user_Type == 1){
            return response()->json('You Are Not Authorized To Add Teacher', 401);
        }
        $user = User::find($id);
        if($user){
            $user->delete();
            return response()->json(['message' => 'Deleted Successfully!'], 200);
        }else{
            return response()->json(['message' => 'User Not Found!'], 404);
        }
       
    }
}