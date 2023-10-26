<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use App\Models\VerifyToken;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\MailVerification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{


public function sent_otp(Request $request)
  {
    //  generate_randome otp in and expire otp function
    //diffrence in seconds
    $validator = Validator::make($request->all(),[
      'email' => 'required|email|unique:users,email',
      'name' => 'required'
    ]);

    if($validator->fails()){
        return response()->json(['message'=> $validator->errors()], 401);       
    }

    try{
      $valid_token =  rand(10, 100..'2023');
      //before sending we inserted in table
      $verify_token_ob = new VerifyToken();
      $verify_token_ob->token = $valid_token;
      $verify_token_ob->email = $request->email;
      // $verify_token_ob->password = bcrypt($request->password);
      $verify_token_ob->save();
      $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone_no' => $request->phone_no,
        'gender' =>$request->gender,
        'password' => bcrypt($request->password),
        'is_activated' => 0
      ]);
      $user_mail =  $request->email;
      $user_name = $request->name;
  
      $mailMessage = new MailVerification($user_mail, $user_name, $valid_token);
      Mail::to($request->email)->send($mailMessage);
  
      return response()->json(['otp' => $valid_token, 'message'=>"Passcode Sent To Your Mail..."], 200);
      }catch(Exception $th){
      return response()->json(['message' => $th->getMessage()], 500);
      }
  }


  public function verify_otp(Request $request)
  {
    $validator = Validator::make($request->all(),[
      
      'email' => 'required|email',
      'token' => 'required'
    ]);

    if($validator->fails()){
        return response()->json(['message'=> $validator->errors()], 401);       
    }
    
    $getToken = VerifyToken::where('token', $request->token)->first();

    if($getToken){
    
      $getToken->is_activated = 1;
      $getToken->save();

      $user = User::where('email', $request->email)->first();

      if($user)
      {
        $user->is_activated = 1;
        $user->email_verified_at = time();
        $user->save();   
        return response()->json(['user'=>$user, 'message' => 'Verified Successfully!'], 200);
      }else{             
        return response()->json(['message' => 'Incorrect Otp!'], 401);
      }

    }

  }


}