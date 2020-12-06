<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;

class ImportController extends Controller
{
    public function importFile() {
        return view('excel');
    }

    public function importExcel(Request $request){
        $validator = Validator::make($request->all(), [
            'file' => 'required|max:5000|mimes:xlsx,xls,csv'
        ]);

        if ($validator->passes()) {

            $dateTime = date('Ymd_His');
            $file = $request->file('file');
            $fileName = $dateTime . '-' . $file->getClientOriginalName();
            $savePath = public_path('/upload/');
            $file->move($savePath,$fileName);

            return redirect()->back()
                ->with(['success' =>'File uploaded successfully.']);
        }else{
            return redirect()->back()
                ->with(['errors' =>$validator->errors()->all()]);
        }
    }

    public function fileUpload(Request $request){

        $file = $request->file('file');

        return redirect()->route('file-manager')->with('success', 'File uploaded successfully');
    }
}


