<?php

namespace App\Http\Controllers;

use App\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Auth;


class HomeController extends Controller
{


    public function index() {

        $uploads = Upload::where('user_id',auth()->user()->id)->get();

        $user_settings = ["default_layout"=>"layout-grid"];
        return view('welcome',compact('uploads','user_settings'));
    }

    public function store(Request $request)
    {
        //upload file
        $uploaded = $request->file('upload');
        Storage::put('uploads/'.$uploaded->getClientOriginalName(),  File::get($uploaded));

        function size_format($uploaded_size)
        {
            if ($uploaded_size < 100000) {
                $upload_size = round(($uploaded_size/1000),0)."kb";
            } else if ($uploaded_size < 100000000) {
                $upload_size = round(($uploaded_size/1000000))."mb";
            } else if ($uploaded_size <100000000000) {
                $upload_size = ($uploaded_size/1000000000)."gb";
            }

            return $upload_size;
        }

        //add to database
        $upload = new Upload();
        $upload->user_id = auth()->user()->id;
        $upload->url = $uploaded->getClientOriginalName();
        $upload->media_file_size = size_format($uploaded->getSize());
        $upload->save();
        return redirect()->back()->with('success','File uploaded successfully');
    }

    public function destroy($id)
    {
        $task = Upload::findOrFail($id);

        //delete file
        Storage::delete('uploads/'.$task->url);

        //delete file from database
        $task->delete();

        return redirect()->back()->with('success','File deleted');
    }
}
