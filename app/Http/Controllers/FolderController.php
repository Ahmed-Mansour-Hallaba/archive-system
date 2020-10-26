<?php

namespace App\Http\Controllers;

use App\Document;
use App\Folder;
use Illuminate\Http\Request;
use Response;

class FolderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=auth()->guard('admin')->user();
        $folders = Folder::where(
            [
                'user_type' => $user->user_type,
                'logged_user_id' => $user->user_id,
            ]
        )->get();

        return  view('admin.folders.index')
            ->with('folders',$folders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.folders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $folder=new Folder();
        $folder->name=$request->name;
        $folder->user_type=$request->user_type;
        $folder->logged_user_id=$request->logged_user_id;
        $folder->save();
        session()->flash('success_add', 'تم اضافة ملف متابعة جديد');
        return redirect('/folders');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function show($folderName)
    {
        $documents_ids = [];

        $user_id = auth()->guard('admin')->user()->user_id;
        $user_type = auth()->guard('admin')->user()->user_type;
        $name = auth()->guard('admin')->user()->getUnit->name;
        $documents= Document::where(
            [
                "logged_user_id" => $user_id,
                'user_type' => $user_type,
                'folder'=>$folderName
            ])
            ->orWhere('sender', 'LIKE', "%{$name}%")
            ->where('folder',$folderName)

            ->orWhere('reciever', 'LIKE', "%{$name}%")
            ->where('folder',$folderName)

            ->orWhere('copy_to', 'LIKE', "%{$name}%")
            ->where('folder',$folderName)
            ->get();


        array_push($documents_ids, $documents);
        $title = "بحث المكاتبات متابعة $folderName";
        return view('admin.masters.master', compact('title', 'documents_ids'));
    }
    public function setFolder($folderName)
    {
        $documents_ids = [];

        $user_id = auth()->guard('admin')->user()->user_id;
        $user_type = auth()->guard('admin')->user()->user_type;
        $name = auth()->guard('admin')->user()->getUnit->name;
        $documents= Document::where(
            [
                "logged_user_id" => $user_id,
                'user_type' => $user_type,
            ])
            ->orWhere('sender', 'LIKE', "%{$name}%")
            ->orWhere('reciever', 'LIKE', "%{$name}%")
            ->orWhere('copy_to', 'LIKE', "%{$name}%")
            ->get();

        array_push($documents_ids, $documents);
        $title = 'بحث المكاتبات الواردة';
        return view('admin.folders.master', compact('title', 'documents_ids','folderName'));
    }

    public function setFolderDoc($docId,$folderName)
    {
        $document=Document::find($docId);
        $document->folder=$folderName;
        $document->save();
        return Response::json('success');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function edit(Folder $folder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Folder $folder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Folder::destroy($id);
    }
}
