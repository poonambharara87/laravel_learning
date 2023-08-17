<?php

namespace App\Http\Controllers;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class FileUploadController extends Controller
{
    public function createForm(){
        return view('file-upload');
      }

    public function fileUpload(Request $req)
    {
        $req->validate([
            'file' => 'required|mimes:csv,docx,xlsx,txt,xls,pdf,png,jpeg,jpg|max:2048'
        ]);
        
        $fileModel = new File;
        if ($req->file()) {
            $uploadedFile = $req->file('file');
            // $fileName = time() . '_' . $uploadedFile->getClientOriginalName();
            $fileName = $uploadedFile->getClientOriginalName();
            $extension = $uploadedFile->getClientOriginalExtension();           
            $filePath = $uploadedFile->storeAs('public', $fileName);          
            $fileModel->name = $fileName;
            $fileModel->file_path = $filePath;           
            $extension = $req->file->getClientOriginalExtension();
            $fileModel->extension = $extension;
            $fileSizeBytes = $uploadedFile->getSize();               
            // Convert bytes to a human-readable format (KB, MB, GB, etc.)
            $sizeInFormat = $this->formatBytes($fileSizeBytes);           
            $fileModel->size = $sizeInFormat;           
            $fileModel->extension = $extension;
            $fileModel->save();          
            return redirect('list');        
        }
    }

    private function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= (1 << (10 * $pow));
        return round($bytes, $precision) . ' ' . $units[$pow];
    }



    public function update(Request $request, $id)
    {
        $fileRecord = File::find($id);
        return view('update')->with('fileRecord',$fileRecord);
    }

    public function updateForm(Request $req, $id)
    {
        $fileModel = File::find($id);
        if($req->file('file')){

          
            $uploadedFile = $req->file('file');
        
            // $fileName = time() . '_' . $uploadedFile->getClientOriginalName();
            $fileName = $uploadedFile->getClientOriginalName();
            $extension = $uploadedFile->getClientOriginalExtension();           
            $filePath = $uploadedFile->storeAs('public', $fileName);          
            $fileModel->name = $fileName;
            $fileModel->file_path = $filePath;           
            $extension = $req->file->getClientOriginalExtension();
            $fileModel->extension = $extension;
            $fileSizeBytes = $uploadedFile->getSize();
                
            // Convert bytes to a human-readable format (KB, MB, GB, etc.)
            $sizeInFormat = $this->formatBytes($fileSizeBytes);
            
            $fileModel->size = $sizeInFormat;

            
            $fileModel->extension = $extension;
            $fileModel->save();
            return redirect('list');
        }       
    }


    
    public function delete($id)
        {
            if($id){
                $file = File::findOrFail($id);                                   
                $name = $file->name; 
                $file_path = $file->file_path;
                if (Storage::exists($file_path)) 
                {                    
                    Storage::delete($file_path);
                    $file->delete();  
                }else{
                    return "file not found!";
                }
                return redirect()->back();
            }
           
        }

    public function list($id=''){
        
        $fileModel = File::all();
        $icon = [];
        $icons = [
            'pdf' => 'pdf',
            'doc' => 'word',
            'docx' => 'word',
            'xls' => 'excel',
            'xlsx' => 'excel',
            'ppt' => 'powerpoint',
            'pptx' => 'powerpoint',
            'txt' => 'text',
            'png' => 'image',
            'jpg' => 'image',
            'jpeg' => 'image',
            'csv' => 'excel'
        ];
        return view('list')->with('fileModel',$fileModel)->with('icons', $icons);    
    }

    

    }
