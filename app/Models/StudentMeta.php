<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentMeta extends Model
{
    use HasFactory;
    protected $table = "student_meta";
    protected $fillable = ['id', 'stu_id', 'marks_id'];
}
