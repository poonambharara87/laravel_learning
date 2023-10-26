<?php

namespace App\Http\Controllers;
use App\Exports\StudentMarksExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Cache;

class StudentMarksController extends Controller
{
    public function export_marks(Request $request) 
    {    
        $student = Cache::get('student');

        if($student)
        {   
            $stu_marks = $student->toArray();
          
              
            
            // return response()->json(['student' =>  $student]);
            $stu_marks = json_decode(json_encode($student), true);

             $studentExport = new StudentMarksExport($stu_marks);
            //  Excel::download($studentExport, 'marksheet.xlsx');
            return Excel::store($studentExport, 'm.xlsx', 'public');
        }else{
            return response()->json(['message' => 'Not found'], 404);
        }
        
    }
}
