<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable 
{
    use HasFactory;


    protected $fillable = ['name', 'email', 'phone_no', 'password', 'gender', 'is_activated'];
    protected $appends = [];
  
 
  //admin can create user(teachers)
  //update
  //delete

  public function getIsActivated()
  {
      return $this->api_token;
  }
  public function getAuthPassword() 
  {
      return $this->password;
  }
}
