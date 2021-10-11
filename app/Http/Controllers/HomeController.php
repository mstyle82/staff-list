<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attribute;
use App\Models\Group;
use App\Models\Title;
use App\Models\Team;
use App\Models\Work_location;
use App\Models\Tag;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //左カラム社員一覧用
        $attribute = Attribute::where('user_id', '=', \Auth::id())
                                ->first();
        $groups = Group::where('status', '=', 0)
                        ->orderBy('display_order', 'ASC')
                        ->get();

        $users = User::all();
        $list = User::where('id', '=', \Auth::id())
               ->first();

        $titles = Title::where('status', '=', 0)->get();
        $teams = Team::where('status', '=', 0)->get();
        $work_locations = Work_location::where('status', '=', 0)->get();
        $grouplists = Attribute::leftjoin('users','attributes.user_id', '=', 'users.id')
                                ->where('users.status', '=', 0)
                                ->get();
        //年齢算出
        $age_data = User::where('id', '=', \Auth::id())
                        ->select('birthday')
                        ->first();
            if (strlen($age_data->birthday)>0) {
                $age_str = str_replace('-', '', $age_data->birthday);
                $age_str_1 = intval($age_str);
                $age = floor ((date('Ymd') - $age_str_1)/10000);
            }else
                $age = 0;
        //勤続年数算出
        $los_data = User::where('id', '=', \Auth::id())
                     ->select('first_day')
                     ->first();
            if (strlen($los_data->first_day)>0) {
                $los_str = str_replace('-', '', $los_data->first_day);
                $los_str_1 = intval($los_str);
                $los = floor ((date('Ymd') - $los_str_1)/10000);
            }else
                $los = 0;
        //タグ
        $owned_tags = Tag::leftjoin('owned_tags','tags.id', '=', 'owned_tags.tag_id')
             ->where('owned_tags.user_id', '=', \Auth::id())->get();

        return view('mypage', compact('list', 'users', 'attribute','groups','titles', 'teams', 'work_locations', 'grouplists', 'age', 'los', 'owned_tags'));
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //左カラム社員一覧用
        $grouplists = Attribute::leftjoin('users','attributes.user_id', '=', 'users.id')
                                ->where('users.status', '=', 0)
                                ->get();
        $groups = Group::where('status', '=', 0)
                         ->orderBy('display_order', 'ASC')
                         ->get();


        $users = User::all();
        $edit_data = user::where('id', '=', \Auth::id())
                         ->first();

        return view('edit-myprof', compact('edit_data', 'users','groups', 'grouplists'));

    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $edit_data)
    {
        $post = $request->all();
        $id = $request->id;
        // $imagedata = $request->imagefileobj;
        // $data = explode(',', $imagedata); // 三嶋追加
        // $image = base64_decode($data[1]); // 三嶋変更
        // $filename= $request->file('profile_image')->getClientOriginalName();

            User::where('id', '=', $post['id'])
                ->update(['id' => $post['id'],
                    'name' => $post['name'],
                    'kana' => $post['kana'] ,
                    'gender' => $post['gender'],
                    'birthday' => $post['birthday'],
                    'post_code' => $post['post_code'],
                    'address' => $post['address'],
                    'home_tell' => $post['home_tell'] ,
                    'office_tell' => $post['office_tell'],]);

        //     if($request->hasfile('profile_image')){
        //     $path = \Storage::put('public/'.$filename, $image);
        //     $path = explode('/', $path);
        //     $user = user::find($id);
        //     $user->profile_image = $filename;
        //     $user->save();
        // }else{
        //     $path = null;
    // }
        return redirect('/')->with('flash_message', '更新が完了しました');

    }
        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    $post = $request->all();
        $id = $request->id;
        $imagedata = $request->imagefileobj;
        $data = explode(',', $imagedata); // 三嶋追加
        $image = base64_decode($data[1]); // 三嶋変更
        $filename = $request->file('profile_image')->getClientOriginalName();

        if($request->hasfile('profile_image')){
            $path = \Storage::put('public/'.$filename, $image);
            $path = explode('/', $path);
            $user = user::find($id);
            $user->profile_image = $filename;
            $user->save();
        }else{
            $path = null;
            $image = null;
        }
        return redirect('/');
    }
}
