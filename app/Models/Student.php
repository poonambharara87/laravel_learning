<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = ['profile_pic_path', 'stu_name', 'roll_no', 'email',
                        'phone','documents_path'];

}
