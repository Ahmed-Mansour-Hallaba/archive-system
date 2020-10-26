<?php

namespace App\Http\Controllers\Admin;

use App\Branch;
use App\DataTables\DocumentDataTable;
use App\Document;
use App\Folder;
use App\Http\Controllers\Controller;
use App\Master;
use App\Reply;
use App\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DocumentDataTable $document, Request $request)
    {
//        $title = 'المكاتبات';
//        return $document->render('admin.documents.index', compact('title'));

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
        return view('admin.masters.master', compact('title', 'documents_ids'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user=auth()->guard('admin')->user();
        $folders = Folder::where(
            [
                'user_type' => $user->user_type,
                'logged_user_id' => $user->user_id,
            ]
        )->get();


        return view('admin.documents.create', ['title' => trans('admin.add_document')])
            ->with('folders',$folders);
    }
    public function smartCreate()
    {
        $user=auth()->guard('admin')->user();
        $folders = Folder::where(
            [
                'user_type' => $user->user_type,
                'logged_user_id' => $user->user_id,
            ]
        )->get();

        return view('admin.documents.smartcreate', ['title' => trans('admin.add_document')])
            ->with('folders',$folders);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $this->validate(
            request(),
            [
                'number' => 'required',
                'subject' => 'required',
                'sender' => 'required',
//                'reciever' => 'required',
                'date' => 'required',
//                'copy_to' => 'sometimes|nullable',
                'type' => 'required',
                'image.*' => 'required|mimes:jpeg,png,jpg,gif,svg,pdf,doc,docx',

            ]
        );

        $document = new Document;
        $document->user_type = Input::get('user_type');
        $document->logged_user_id = Input::get('user_id');

        // check if records exist before

		$date=Carbon::createFromDate($request->date);
		$date=$date->format("Y-m-d");
        $documents = Document::where('number', '=', $request->number)
            ->where('sender', '=', $request->sender)
            ->where('date', '=', $date)
        ->get();
		// dd($documents);
		//dd([Input::get('number'),Input::get('sender'),Input::get('date')]);
        if (count($documents) > 0) {
            session()->flash('exist', 'هذه البيانات موجودة مسبقاً');
            foreach ($documents as $document) {
                $document = Document::find($document->id);
                $title = 'عرض المكاتبة';
                $images = explode('|', $document->image);
                // return view('admin.documents.edit', compact(['document', 'title', 'images']));
                return redirect("/admin/documents/$document->id");
            }

            return redirect()->back();
        }

        $images = array();
        if ($files = $request->file('image')) {
            foreach ($files as $file) {

                $name = time() . '_image_' . $file->getClientOriginalName();
                $file->move('uploads', $name);
                $images[] = $name;
            }
        }
        $newDate = date("Y-m-d", strtotime(Input::get('date')));
        if($request->rep_date!=null)
            $newRepDate = date("Y-m-d", strtotime(Input::get('rep_date')));
        $items = $request->recievers;
        $recievers="";
        if(empty($items))
            $items=[];
        foreach ($items as $item)
        {
            $recievers.=$item.'; ';
        }
        $items2=$request->copiers;
        if(empty($items2))
            $items2=[];
        $copiers="";
        foreach ($items2 as $item)
        {
            $copiers.=$item.'; ';
        }

        $recievers=substr($recievers, 0, strlen($recievers)-2) ;
        $copiers=substr($copiers, 0, strlen($copiers)-2) ;
        if($recievers=='0')
            $recievers=' ';
        if($copiers=='0')
            $copiers=' ';
        $document->number = Input::get('number');
        $document->subject = Input::get('subject');
        $document->sender = Input::get('sender');
        $document->reciever = $recievers;
        $document->date = $newDate;
        if($request->rep_date!=null)
            $document->rep_date = $newRepDate;
        $document->copy_to = $copiers;
        $document->folder=Input::get('folder');
        $document->type = Input::get('type');
        $document->image = implode("|", $images);
        $document->save();

        session()->flash('success_add', trans('admin.success_add'));
        return redirect(aurl('documents'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function smartStore(Request $request)
    {
//        dd($request);
        $data = $this->validate(
            request(),
            [
                'number' => 'required',
                'subject' => 'required',
                'sender' => 'required',
//                'reciever' => 'required',
                'date' => 'required',
//                'copy_to' => 'sometimes|nullable',
                'type' => 'required',
//                'image.*' => 'required|mimes:jpeg,png,jpg,gif,svg,pdf',
                'count'=>'required:min=1'
            ]
        );

        $document = new Document;
        $document->user_type = Input::get('user_type');
        $document->logged_user_id = Input::get('user_id');

        // check if records exist before

        $documents = Document::where([
            ['number', '=', Input::get('number')],
            ['sender', '=', Input::get('sender')],
            ['date', '=', Input::get('date')],
        ])->get();

        if (count($documents) > 0) {
            session()->flash('exist', 'هذه البيانات موجودة مسبقاً');
            foreach ($documents as $document) {
                $document = Document::find($document->id);
                $title = 'عرض المكاتبة';
                $images = explode('|', $document->image);
                return view('admin.documents.edit', compact(['document', 'title', 'images']));
            }

            return redirect()->back();
        }

//        $images = array();
//        if ($files = $request->file('image')) {
//            foreach ($files as $file) {
//
//                $name = time() . '_image_' . $file->getClientOriginalName();
//                $file->move('uploads', $name);
//                $images[] = $name;
//            }
//        }
        $count=$request->count;
        $images = array();
        for($i=0;$i<$count;$i++)
        {
            $image=$request["img_$i"];

            $image = str_replace('data:image/jpeg;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = time()."_$i".'.'.'jpg';
            file_put_contents(public_path().'/uploads/'.$imageName, base64_decode($image));
            $images[] = $imageName;
        }

        $newDate = date("Y-m-d", strtotime(Input::get('date')));
        $items = $request->recievers;
        $recievers="";
        if(empty($items))
            $items=[];
        foreach ($items as $item)
        {
            $recievers.=$item.'; ';
        }
        $items2=$request->copiers;
        if(empty($items2))
            $items2=[];
        $copiers="";
        foreach ($items2 as $item)
        {
            $copiers.=$item.'; ';
        }

        $recievers=substr($recievers, 0, strlen($recievers)-2) ;
        $copiers=substr($copiers, 0, strlen($copiers)-2) ;
        if($recievers=='0')
            $recievers=' ';
        if($copiers=='0')
            $copiers=' ';
        $document->number = Input::get('number');
        $document->subject = Input::get('subject');
        $document->sender = Input::get('sender');
        $document->folder=Input::get('folder');

        $document->reciever = $recievers;
        $document->date = $newDate;
        $document->copy_to = $copiers;
        $document->type = Input::get('type');
        $document->image = implode("|", $images);
        $document->save();

        session()->flash('success_add', trans('admin.success_add'));
        return redirect(aurl('documents'));
    }
    public function show($id)
    {
        $document = Document::find($id);
        $title = 'عرض المكاتبة';
        $images = explode('|', $document->image);
        return view('admin.documents.preview', compact(['document', 'title', 'images']));

        session()->flash('exist', 'مسار خاطئ لهذا الإيميل');
        return redirect(aurl('documents'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $document = Document::find($id);
        $title = 'تعديل المكاتبة';
        $images = explode('|', $document->image);
        $user=auth()->guard('admin')->user();
        $arr=array();
        $units=DB::table('units')->distinct()->get('name');

//        array_push($arr,$units);
        $user = auth()->guard('admin')->user();
        if($user->user_type==0)
        {
            $branches=DB::table('branches')->where('master_id',$user->getUnit->id)->get('name');
            $departments=DB::table('departments')->whereIn('branch_id',$user->getUnit->departments)->get('name');

            array_push($arr,$branches);
            array_push($arr,$departments);
        }
        else if($user->user_type==1)
        {
            $departments=DB::table('departments')->where('branch_id',$user->getUnit->id)->get('name');
            array_push($arr,$departments);
        }
        array_push($arr,array());

        $folders = Folder::where(
            [
                'user_type' => $user->user_type,
                'logged_user_id' => $user->user_id,
            ]
        )->get();
        return view('admin.documents.edit', compact(['document', 'title', 'images']))
            ->with('unitsarr',$arr)
            ->with('units',$units)
            ->with('folders',$folders);

        session()->flash('exist', 'مسار خاطئ لهذا الإيميل');
        return redirect(aurl('documents'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $data = $this->validate(
            request(),
            [
                'number' => 'required',
                'subject' => 'required',
//                'sender' => 'required',
//                'reciever' => 'required',
                'date' => 'required',
//                'copy_to' => 'sometimes|nullable',
                'image.*' => 'sometimes|nullable',

            ]
        );

        if (!empty($request->file('image'))) {
            $document = Document::findOrFail($id);
            $images = explode('|', $document->image);
            foreach ($images as $image) {
                $image_path = public_path() . '\\uploads\\' . $image;
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }
        }


        $images = array();
        if ($files = $request->file('image')) {
            foreach ($files as $file) {

                $name = time() . '_image_' . $file->getClientOriginalName();
                $file->move('uploads', $name);
                $images[] = $name;
            }
            $data['image'] = implode("|", $images);
        } else {
            $image = Document::select('image')->Where('id', $id)->limit(1)->get();
            $data['image'] = $image[0]->image;
        }
        $newDate = date("Y-m-d", strtotime(Input::get('date')));
        $items = $request->recievers;
        $recievers="";
        if(empty($items))
            $items=[];
        foreach ($items as $item)
        {
            $recievers.=$item.'; ';
        }
        $items2=$request->copiers;
        if(empty($items2))
            $items2=[];
        $copiers="";
        foreach ($items2 as $item)
        {
            $copiers.=$item.'; ';
        }

        $recievers=substr($recievers, 0, strlen($recievers)-2) ;
        $copiers=substr($copiers, 0, strlen($copiers)-2) ;
        if($recievers=='0')
            $recievers=' ';
        if($copiers=='0')
            $copiers=' ';

        $data['copy_to']=$copiers;
        $data['reciever']=$recievers;
        $data['date']=$newDate;
        $data['folder']=Input::get('folder');


        Document::where('id', $id)->update($data);
        session()->flash('success_add', trans('admin.success_update'));
        return redirect(aurl('documents'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $document = Document::findOrFail($id);
        if (count($document->replies) > 0) {
            $replies_array = $document->replies;
            foreach ($replies_array as $reply) {

                $img_del = Reply::findOrFail($reply->id);
                $images = explode('|', $img_del->image);
                //dd($images);
                foreach ($images as $image) {
                    $image_path = public_path() . '\\replies\\' . $image;

                    if (file_exists($image_path)) {
						//dd($image_path);
                        unlink($image_path);
                    }
                }

            }
        }

        $images = explode('|', $document->image);
        foreach ($images as $image) {
            $image_path = public_path() . '\\uploads\\' . $image;

            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }
        $document->delete();
        session()->flash('success_add', trans('admin.success_delete'));
        return redirect(aurl('documents'));
    }

    public function getBranches(Request $request)
    {
        $master_logged_id = auth()->guard('admin')->user()->user_id;
        $branches = Master::findOrfail($master_logged_id);
        if (count($branches->branches) > 0) {

            $branches_count = $branches->branches;
            $document = [];
            $documents_ids = [];

            foreach ($branches_count as $item) {
                $documents = Document::where(
                    [
                        'logged_user_id' => $item->id,
                        'user_type' => '1',
                    ]
                )->orWhere('sender', 'LIKE', "%{$item->name}%")
                    ->orWhere('reciever', 'LIKE', "%{$item->name}%")
                    ->orWhere('copy_to', 'LIKE', "%{$item->name}%")
                    ->get();
                array_push($documents_ids, $documents);
            }

            $title = ' المكاتبات الخاصة بالأفرع';
            return view('admin.masters.master_branches', compact('title', 'documents_ids'));
        } else {
            session()->flash('exist', 'لا يوجد أفرع  خاصة بهذه الشعبة');
            return redirect(aurl('documents'));
        }
    }
    public function getDepartments(Request $request)
    {
        $master_logged_id = auth()->guard('admin')->user()->user_id;
        $departments = Master::findOrfail($master_logged_id);
        if (count($departments->departments) > 0) {

            $departments_count = $departments->departments;
            $document = [];
            $documents_ids = [];

            foreach ($departments_count as $item) {
                $document = Document::where(
                    [
                        'logged_user_id' => $item->id,
                        'user_type' => '2',
                    ]
                )->orWhere('sender', 'LIKE', "%{$item->name}%")
                    ->orWhere('reciever', 'LIKE', "%{$item->name}%")
                    ->orWhere('copy_to', 'LIKE', "%{$item->name}%")
                    ->get();
                array_push($documents_ids, $document);
            }

            $title = ' المكاتبات الخاصة بالأقسام';
            return view('admin.masters.master_departments', compact('title', 'documents_ids'));
        } else {
            session()->flash('exist', 'لا يوجد أقسام خاصة بهذه الشعبة');
            return redirect(aurl('documents'));
        }

    }

    public function getBranchesDepartments(Request $request)
    {
        $branch_logged_id = auth()->guard('admin')->user()->user_id;
        $departments = Branch::findOrfail($branch_logged_id);
        if (count($departments->departments) > 0) {

            $departments_count = $departments->departments;
            $document = [];
            $documents_ids = [];

            foreach ($departments_count as $item) {
                $document = Document::where(
                    [
                        'logged_user_id' => $item->id,
                        'user_type' => '2',
                    ]
                )->orWhere('sender', 'LIKE', "%{$item->name}%")
                    ->orWhere('reciever', 'LIKE', "%{$item->name}%")
                    ->orWhere('copy_to', 'LIKE', "%{$item->name}%")
                    ->get();
                array_push($documents_ids, $document);
            }

            $title = ' المكاتبات الخاصة بالأقسام';
            return view('admin.branches.branches_departments', compact('title', 'documents_ids'));
        } else {
            session()->flash('exist', 'لا يوجد أقسام خاصة بهذا الفرع ');
            return redirect(aurl('documents'));
        }
    }

    public function getRelatedDocument($id)
    {
        $document = Document::find($id);
        $title = 'عرض المكاتبة';
        $images = explode('|', $document->image);
        return view('admin.documents.preview', compact(['document', 'title', 'images']));

    }

    public function getExports()
    {
        // get exported if logged user is master
//        if (auth()->guard('admin')->user()->user_type == 0) {
//            $master_logged_id = auth()->guard('admin')->user()->user_id;
//            $branches = Master::findOrfail($master_logged_id);
//            $document = [];
//            $documents_ids = [];
//            if (count($branches->branches) > 0) {
//
//                $branches_count = $branches->branches;
//
//                foreach ($branches_count as $item) {
//                    $documents = Document::where(
//                        [
//                            'logged_user_id' => $item->id,
//                            'user_type' => '1',
//                            'type' => '0',
//                        ]
//                    )->orWhere('sender', 'LIKE', "%{$item->name}%")
//                        ->orWhere('reciever', 'LIKE', "%{$item->name}%")
//                        ->orWhere('copy_to', 'LIKE', "%{$item->name}%")
//                        ->get();
//                    array_push($documents_ids, $documents);
//                }
//            }
//            if (count($branches->departments) > 0) {
//
//                $departments_count = $branches->departments;
//
//                foreach ($departments_count as $item) {
//                    $documents = Document::where(
//                        [
//                            'logged_user_id' => $item->id,
//                            'user_type' => '2',
//                            'type' => '0',
//                        ]
//                    )->orWhere('sender', 'LIKE', "%{$item->name}%")
//                        ->orWhere('reciever', 'LIKE', "%{$item->name}%")
//                        ->orWhere('copy_to', 'LIKE', "%{$item->name}%")
//                        ->get();
//                    array_push($documents_ids, $documents);
//                }
//            }
//
//            $documents = Document::where(
//                [
//                    'user_type' => '0',
//                    'logged_user_id' => $master_logged_id,
//                    'type' => '0',
//                ]
//            )->get();
//            array_push($documents_ids, $documents);
//            $title = 'بحث المكاتبات الصادره';
//            return view('admin.masters.master_branches', compact('title', 'documents_ids'));
//        }
//
//        // end exports if logged user is master
//
//        // get exported if logged user is branch
//        if (auth()->guard('admin')->user()->user_type == 1) {
//            $branch_logged_id = auth()->guard('admin')->user()->user_id;
//            $departments = Branch::findOrfail($branch_logged_id);
//            $documents_ids = [];
//            if (count($departments->departments) > 0) {
//
//                $departments_count = $departments->departments;
//                $document = [];
//                foreach ($document as $item) {
//                    $documents = Document::where(
//                        [
//                            'logged_user_id' => $item->id,
//                            'user_type' => '2',
//                            'type' => '0',
//                        ]
//                    )->orWhere('sender', 'LIKE', "%{$item->name}% ")
//                        ->orWhere('reciever', 'LIKE', "%{$item->name}%" || "جميع الوحدات" || "طبقاً لمعدل التوزيع")
//                        ->orWhere('copy_to', 'LIKE', "%{$item->name}%" || "جميع الوحدات" || "طبقاً لمعدل التوزيع")
//                        ->get();
//                    array_push($documents_ids, $documents);
//                }
//            }
//
//            $documents = Document::where(
//                [
//                    'user_type' => '1',
//                    'logged_user_id' => $branch_logged_id,
//                    'type' => '0',
//                ]
//            )->get();
//            array_push($documents_ids, $documents);
//            $title = 'بحث المكاتبات الصادره';
//            return view('admin.masters.master_branches', compact('title', 'documents_ids'));
//
//            // end exports if logged user is master
//        }
//        // end exports if logged user is branch
//
//        // get exported if logged user is department
//        if (auth()->guard('admin')->user()->user_type == 2) {
//
//            $department_logged_id = auth()->guard('admin')->user()->user_id;
//            $documents_ids = [];
//            $documents = Document::where(
//                [
//                    'user_type' => '2',
//                    'logged_user_id' => $department_logged_id,
//                    'type' => '0',
//                ]
//            )->get();
//            array_push($documents_ids, $documents);
//            $title = 'بحث المكاتبات الصادره';
//            return view('admin.masters.master_branches', compact('title', 'documents_ids'));
//        }
        // end exports if logged user is department

        $user=auth()->guard('admin')->user();
        $unit_name=$user->getUnit->name;
        $documents_ids = [];

        $documents = Document::where(
                [
                    'user_type' => $user->user_type,
                    'logged_user_id' => $user->user_id,
                    'sender'=>"$unit_name"
                ]
            )
            ->orWhere('sender','like',"%$unit_name%")

            ->get();
            array_push($documents_ids, $documents);
            $title = 'بحث المكاتبات الصادره';
            return view('admin.masters.master', compact('title', 'documents_ids'));
    }
    public function getImports()
    {
//        if (auth()->guard('admin')->user()->user_type == 0) {
//            $master_logged_id = auth()->guard('admin')->user()->user_id;
//            $branches = Master::findOrfail($master_logged_id);
//            $document = [];
//            $documents_ids = [];
//            if (count($branches->branches) > 0) {
//
//                $branches_count = $branches->branches;
//
//                foreach ($branches_count as $item) {
//                    $documents = Document::where(
//                        [
//                            'logged_user_id' => $item->id,
//                            'user_type' => '1',
//                            'type' => '1',
//                        ]
//                    )->orWhere('sender', 'LIKE', "%{$item->name}%")
//                        ->orWhere('reciever', 'LIKE', "%{$item->name}%")
//                        ->orWhere('copy_to', 'LIKE', "%{$item->name}%")
//                        ->get();
//                    array_push($documents_ids, $documents);
//                }
//            }
//            if (count($branches->departments) > 0) {
//
//                $departments_count = $branches->departments;
//
//                foreach ($departments_count as $item) {
//                    $documents = Document::where(
//                        [
//                            'logged_user_id' => $item->id,
//                            'user_type' => '2',
//                            'type' => '1',
//                        ]
//                    )->orWhere('sender', 'LIKE', "%{$item->name}%")
//                        ->orWhere('reciever', 'LIKE', "%{$item->name}%")
//                        ->orWhere('copy_to', 'LIKE', "%{$item->name}%")
//                        ->get();
//                    array_push($documents_ids, $documents);
//                }
//            }
//
//            $documents = Document::where(
//                [
//                    'user_type' => '0',
//                    'logged_user_id' => $master_logged_id,
//                    'type' => '1',
//                ]
//            )->get();
//            array_push($documents_ids, $documents);
//            $title = 'بحث المكاتبات الوارده';
//            return view('admin.masters.master_branches', compact('title', 'documents_ids'));
//        }
//        // get imports if logged user is branch
//        if (auth()->guard('admin')->user()->user_type == 1) {
//            $branch_logged_id = auth()->guard('admin')->user()->user_id;
//            $departments = Branch::findOrfail($branch_logged_id);
//            $documents_ids = [];
//            if (count($departments->departments) > 0) {
//
//                $departments_count = $departments->departments;
//                $document = [];
//
//                foreach ($document as $item) {
//                    $documents = Document::where(
//                        [
//                            'logged_user_id' => $item->id,
//                            'user_type' => '2',
//                            'type' => '1',
//                        ]
//                    )->orWhere('sender', 'LIKE', "%{$item->name}%")
//                        ->orWhere('reciever', 'LIKE', "%{$item->name}%")
//                        ->orWhere('copy_to', 'LIKE', "%{$item->name}%")
//                        ->get();
//                    array_push($documents_ids, $documents);
//                }
//            }
//
//            $documents = Document::where(
//                [
//                    'user_type' => '1',
//                    'logged_user_id' => $branch_logged_id,
//                    'type' => '1',
//                ]
//            )->get();
//            array_push($documents_ids, $documents);
//            $title = 'بحث المكاتبات الوارده';
//            return view('admin.masters.master_branches', compact('title', 'documents_ids'));
//
//            // end exports if logged user is master
//        }
//        // end imports if logged user is branch
//
//        // get imports if logged user is department
//        if (auth()->guard('admin')->user()->user_type == 2) {
//
//            $department_logged_id = auth()->guard('admin')->user()->user_id;
//            $documents_ids = [];
//            $documents = Document::where(
//                [
//                    'user_type' => '2',
//                    'logged_user_id' => $department_logged_id,
//                    'type' => '1',
//                ]
//            )->get();
//            array_push($documents_ids, $documents);
//            $title = 'بحث المكاتبات الوارده';
//            return view('admin.masters.master_branches', compact('title', 'documents_ids'));
//        }
        // end imports if logged user is department

        $user=auth()->guard('admin')->user();
        $unit_name=$user->getUnit->name;
        $documents_ids = [];

        $documents = Document::where(
            [
                'user_type' => $user->user_type,
                'logged_user_id' => $user->user_id,

            ]
        )
            ->Where('sender',"!=","$unit_name")
            ->orWhere('reciever','like',"%$unit_name%")
            ->orWhere('copy_to','like',"%$unit_name%")
        ->get();
//        dd($documents);
        array_push($documents_ids, $documents);
        $title = 'بحث المكاتبات الواردة';
        return view('admin.masters.master', compact('title', 'documents_ids'));
    }
    public function getReplySoon()
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
            ->where('rep_date','>',now()->subtract('1 day'))

            ->orWhere('sender', 'LIKE', "%{$name}%")
            ->where('rep_date','>',now()->subtract('1 day'))
            ->orWhere('reciever', 'LIKE', "%{$name}%")
            ->where('rep_date','>',now()->subtract('1 day'))
            ->orWhere('copy_to', 'LIKE', "%{$name}%")
            ->where('rep_date','>',now()->subtract('1 day'))

            ->get();

        array_push($documents_ids, $documents);
        $title = 'بحث المكاتبات الواردة';
        return view('admin.masters.master', compact('title', 'documents_ids'));
    }
    public function getReplyEnd()
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
            ->where('rep_date','<',now()->subtract('1 day'))
            ->orWhere('sender', 'LIKE', "%{$name}%")
            ->where('rep_date','<',now()->subtract('1 day'))
            ->orWhere('reciever', 'LIKE', "%{$name}%")
            ->where('rep_date','<',now()->subtract('1 day'))
            ->orWhere('copy_to', 'LIKE', "%{$name}%")
            ->where('rep_date','<',now()->subtract('1 day'))

            ->get();

        array_push($documents_ids, $documents);
        $title = 'بحث المكاتبات الواردة';
        return view('admin.masters.master', compact('title', 'documents_ids'));
    }
}
