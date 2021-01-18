<?php

namespace App\Http\Controllers;

use App\Models\Data\Data;
use App\Models\Data\File;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;

class DataController extends Controller
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

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function fileUpload(Request $request) {
        $files = $request->file('files');
        $categoryId = $request->input('category');

        foreach ((array)$files as $file) {
            $newFile = new File();
            $newFile->name = $file->getClientOriginalName();
            $newFile->file_path = Storage::putFile('storage', $file);
            $newFile->category_id = $categoryId;
            $newFile->save();

            $newData = new Data();
            $newData->data_type = "App\Models\Data\File";
            $newData->data_id = $newFile->id;
            $newData->save();
        }

        return new JsonResponse([
            'success' => true,
            'file' => $newFile
        ]);
    }

    public function fileDelete(Request $request){
        $dataId = $request->id;
        $data = Data::where('data_id', $dataId)
            ->firstOrFail();
        $file = File::where('id', $dataId)
            ->firstOrFail();
        $filepath =  $file->file_path;



        $success = (bool) $file->delete();
        if (!$success) {
            throw new RuntimeException('Invalid state: could not delete a file object');
        }
        $success = (bool) $data->delete();
        if (!$success) {
            throw new RuntimeException('Invalid state: could not delete a file object');
        }

        Storage::delete('storage', $filepath);


        return redirect()->route('file-manager')->with('success', 'File deleted');
    }
}


