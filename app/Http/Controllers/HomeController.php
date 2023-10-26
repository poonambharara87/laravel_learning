<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone_no' => 'required|unique:users,phone_no',
            'password' => 'required|min:8',
            'gender' => 'required'
        ]);

        if($validator->fails()){
            return response()->json(['message'=> $validator->errors()], 401);       
        }

            try{
              
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone_no' => $request->phone_no,
                'password' => bcrypt($request->password),
                'gender' => $request->gender,
            ]);
            return Redirect::route('export_marksheet', $id);
        }catch(Exception $th){
           \Log::info($th);
           return response()->json(['message'=>$th->getMessage()]);
        }

        \Log::info($user);
        if($user)
        {
             //generate and return token for registered users-token')->plainTextToken;
            return response()->json(['users'=> $user, 'token' => $user->createToken('user-access-token')->plainTextToken]);
        }
        return response()->json(['error' => 'Registration failed'], 500);
    }


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
            if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password]))
            {
                $user = Auth::user();
                $success['token'] = $user->createToken('user-access-token')->plainTextToken;
                $sucess['name'] = $user->name;
                $response = [
                    'success' => true,
                    'data' => $success,
                    'message' => 'user login successfully'
                ];
                return response()->json([$response, 200]);
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

    public function update_profile(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'profile_pic' => 'required|mimes:jpg,png',
            'name' => 'required',
            'gender' => 'required'
        ]);
        if($validator->fails()){
            return response()->json(['message'=> $validator->errors()], 401);       
        }

        try{
            $user = User::find($id);
            // Handle file upload and store the file in the desired location
            $path = time().'-profile_pic.'.$request->file('profile_pic')->getClientOriginalExtension();
            $file_name = $request->file('profile_pic')->getClientOriginalName();
            $photo = $request->file('profile_pic')->storeAs('public/profile_pic', $file_name);
            $user->path = 'profile_pic/'.$path;
            $user->file_name = $file_name;
            $user->name = $request->name;
            $user->save();
        
            return response()->json(['message' => 'Profile photo updated successfully']);
        }catch(Exception $th){
            return response()->json(['message'=>$th->getMessage()], 500);
        }
    }


    public function logout(){
        $user = Auth::user();
        $user->currentAccessToken()->delete();

        return response()->json(['data' => "User Logged Out Successfully!"]);
    }
}
