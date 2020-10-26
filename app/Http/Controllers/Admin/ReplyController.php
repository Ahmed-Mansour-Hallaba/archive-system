<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ReplyDataTable;
use App\Document;
use App\Http\Controllers\Controller;
use App\Reply;
use App\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class ReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ReplyDataTable $reply, Request $request)
    {

        //

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $document=Document::find($id);
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
        return view('admin.replies.create')->with('document',$document)
            ->with('unitsarr',$arr)
            ->with('units',Unit::all());
    }
    public function screate($id)
    {
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

        $document=Document::find($id);
        return view('admin.replies.screate')->with('document',$document)
            ->with('unitsarr',$arr)

            ->with('units',Unit::all());
        ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $replies = Reply::where([
            ['number', '=', Input::get('number')],
//            ['subject', '=', Input::get('subject')],
            ['sender', '=', Input::get('sender')],
//            ['reciever', '=', Input::get('reciever')],
            ['date', '=', Input::get('date')],
//            ['copy_to', '=', Input::get('copy_to')],

        ])->get();

        if (count($replies) > 0) {
            session()->flash('exist', 'هذه البيانات موجودة مسبقاّ');
            return redirect()->back();
        }
        $reply = new Reply;

        $images = array();
        if ($files = $request->file('image')) {
            foreach ($files as $file) {

                $name = time() . '_image_' . $file->getClientOriginalName();
                $file->move('replies', $name);
                $images[] = $name;
            }
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

        $reply->number = Input::get('number');
        $reply->subject = Input::get('subject');
        $reply->sender = Input::get('sender');
//        $reply->reciever = Input::get('reciever');
        $reply->reciever = $recievers;
        $reply->date = $newDate;
        $reply->copy_to = $copiers;
//        $reply->copy_to = Input::get('copy_to');
        $reply->image = implode("|", $images);
        $reply->document_id = $request->document_id;
        $reply->logged_user_id = Input::get('user_id');
        $reply->user_type = Input::get('user_type');

        $reply->save();

        // $document = new Document;
        // $document->number = Input::get('number');
        // $document->subject = Input::get('subject');
        // $document->sender = Input::get('sender');
        // $document->reciever = Input::get('reciever');
        // $document->date = Input::get('date');
        // $document->copy_to = Input::get('copy_to');
        // $document->image = implode("|", $images);
        // $document->logged_user_id = Input::get('user_id');
        // $document->user_type = Input::get('user_type');

        // $document->save();

        session()->flash('success_add', trans('admin.success_add'));
        return redirect(aurl('documents'));
    }
    public function smartstore(Request $request)
    {
        $replies = Reply::where([
            ['number', '=', Input::get('number')],
//            ['subject', '=', Input::get('subject')],
            ['sender', '=', Input::get('sender')],
//            ['reciever', '=', Input::get('reciever')],
            ['date', '=', Input::get('date')],
//            ['copy_to', '=', Input::get('copy_to')],

        ])->get();

        if (count($replies) > 0) {
            session()->flash('exist', 'هذه البيانات موجودة مسبقاّ');
            return redirect()->back();
        }
        $reply = new Reply;

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

        $reply->number = Input::get('number');
        $reply->subject = Input::get('subject');
        $reply->sender = Input::get('sender');
        $reply->reciever = $recievers;
//        $reply->reciever = Input::get('reciever');
        $reply->date = $newDate;
        $reply->copy_to = $copiers;
//        $reply->copy_to = Input::get('copy_to');
        $reply->image = implode("|", $images);
        $reply->document_id = $request->document_id;
        $reply->logged_user_id = Input::get('user_id');
        $reply->user_type = Input::get('user_type');

        $reply->save();

        // $document = new Document;
        // $document->number = Input::get('number');
        // $document->subject = Input::get('subject');
        // $document->sender = Input::get('sender');
        // $document->reciever = Input::get('reciever');
        // $document->date = Input::get('date');
        // $document->copy_to = Input::get('copy_to');
        // $document->image = implode("|", $images);
        // $document->logged_user_id = Input::get('user_id');
        // $document->user_type = Input::get('user_type');

        // $document->save();

        session()->flash('success_add', trans('admin.success_add'));
        return redirect(aurl('documents'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $document = Document::find($id);
        $reply=$document->replies->first();
        return  redirect("/admin/reply/display?&rep_id=$reply->id");
//        $logged_user_id = auth()->guard('admin')->user()->user_id;
//        $user_type = auth()->guard('admin')->user()->user_type;
//        $name = auth()->guard('admin')->user()->name;
//
//        $repliesArr = Reply::Where('document_id', $document->id)->where(
//            [
//                "logged_user_id" => $logged_user_id,
//                'user_type' => $user_type,
//            ]
//        )->orWhere('sender', 'LIKE', "%{$name}%")
//            ->orWhere('reciever', 'LIKE', "%{$name}%")
//            ->orWhere('copy_to', 'LIKE', "%{$name}%")
//            ->get();
//
//        $reply = $repliesArr->first();
//        $replies_count = count($repliesArr);
//        if ($replies_count > 0) {
//            $next = count($repliesArr) == 1 ? -1 : $repliesArr[1]->id;
//            $prev = -1;
//            $docID = $document->id;
//            $title = 'عرض الرد';
//            $images = explode('|', $reply->image);
//            return view('admin.replies.preview', compact(['docID', 'prev', 'next', 'reply', 'title', 'images', 'replies_count']));
//        } else {
//            return view('admin.replies.preview', compact(['replies_count']));
//        }

    }

    public function replySlider(Request $request)
    {
//        $status = $request->status;
//        $rep_id = $request->rep_id;
//        $cur_rep = $request->cur_rep_id;
//        $docID = $request->doc_id;
//        $title = 'عرض الرد';
//        $document = Document::find($request->doc_id);
//        $logged_user_id = auth()->guard('admin')->user()->user_id;
//        $user_type = auth()->guard('admin')->user()->user_type;
//        $name = auth()->guard('admin')->user()->name;
//        $replies = Reply::Where('document_id', $document->id)->where(
//            [
//                "logged_user_id" => $logged_user_id,
//                'user_type' => $user_type,
//            ]
//        )->orWhere('sender', 'LIKE', "%{$name}%")
//
//            ->orWhere('reciever', 'LIKE', "%{$name}%")
//
//            ->orWhere('copy_to', 'LIKE', "%{$name}%")
//
//            ->get();
//        $replies_count = count($replies);
//        if ($status == 'next') {
//            $prev = $cur_rep;
//            $reply = Reply::find($rep_id);
//            $next = -1;
//            foreach ($replies as $key => $rep) {
//                if ($rep->id > $rep_id) {
//                    $next = $rep->id;
//                    break;
//                }
//            }
//        } elseif ($status == 'prev') {
//
//            $next = $cur_rep;
//            $reply = Reply::find($rep_id);
//            $prev = -1;
//            foreach ($replies as $key => $rep) {
//                if ($rep->id < $rep_id) {
//                    $prev = $rep->id;
//                    break;
//                }
//            }
//        }
//        $images = explode('|', $reply->image);
//        return view('admin.replies.preview', compact(['docID', 'prev', 'next', 'reply', 'title', 'images', 'replies_count']));
        $rep_id=$request->rep_id;
        $reply=Reply::find($rep_id);
        $doc=$reply->document;
        $replies=$doc->replies;
        $images = explode('|', $reply->image);
        $replies_count = count($replies);
        $docID = $doc->id;
        $title = 'عرض الرد';

        for($i=0;$i<$replies_count;$i++)
        {
            if($replies[$i]->id==$rep_id)
            {
                if($i==0)
                {
                    $prev=-1;
                }else {
                    $prev=$replies[$i-1]->id;
                }
                if($i==$replies_count-1)
                {
                    $next=-1;
                }else{
                    $next=$replies[$i+1]->id;
                }
                break;
            }
        }
        return view('admin.replies.preview', compact(['docID', 'prev', 'next', 'reply', 'title', 'images', 'replies_count']))
            ->with('document',$doc);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $reply = Reply::find($id);
        $title = 'تعديل الرد';
        $images = explode('|', $reply->image);
        return
            view('admin.replies.edit', compact(['reply', 'title', 'images']))
                ->with('units',Unit::all());
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
                'copy_to' => 'sometimes|nullable',
                'image.*' => 'sometimes|nullable',

            ]
        );


        if (!empty($request->file('image'))) {
            $reply = Reply::findOrFail($id);
            $images = explode('|', $reply->image);
            foreach ($images as $image) {
                $image_path = public_path() . '\\replies\\' . $image;

                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }
        }



        $images = array();
        if ($files = $request->file('image')) {
            foreach ($files as $file) {

                $name = time() . '_image_' . $file->getClientOriginalName();
                $file->move('replies', $name);
                $images[] = $name;
            }
            $data['image'] = implode("|", $images);
        } else {
            $image = Reply::select('image')->Where('id', $id)->limit(1)->get();
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
        Reply::where('id', $id)->update($data);
        session()->flash('success_add', trans('admin.success_update'));
        return  redirect("/admin/reply/display?&rep_id=$id");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reply = Reply::findOrFail($id);
        $images = explode('|', $reply->image);
        foreach ($images as $image) {
            $image_path = public_path() . '\\replies\\' . $image;

            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }
        $reply->delete();
        session()->flash('success_add', trans('admin.success_delete'));
        return redirect(aurl('replies/all'));
    }

    // public function show_reply(Request $request, ReplyDataTable $reply)
    // {
    //     $title = 'عرض الردود';
    //     return $reply->render('admin.replies.index', compact('title'));

    // }
}
