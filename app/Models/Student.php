<?php

namespace App\Models;
use App\Models\File;
use App\Models\Mark;
use DB;
use App\Models\StudentMeta;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $appends = ['Marks'];

    protected $fillable = ['id', 'name', 'email', 'password', 'phone_no', 'gender'];


    public function marks()
    {
        return hasOne(Mark::class);
    }
    // public function files()
    // {
    //     return $this->hasMany(File::class);
    // }

    public function add_marks($hindi, $english, $math, $drawing)
    {
        $marks = Mark::create([
            'stu_id' => $this->id,
            'hindi' => $hindi,
            'english' => $english,
            'math' => $math,
            'drawing' => $drawing,
        ]);
       
    }

    public function add_student_meta()
    {
        $student_marks = Mark::latest()->first();
        StudentMeta::create([
            'stu_id' => $this->id,
            'marks_id' => $student_marks->id,
        ]);
    }

    public function getMarksAttribute()
    {
        if($this->id)
        {
           return DB::table('marks')->where('stu_id', $this->id)->first();
        }else{
            return null;
        }
    }




}
