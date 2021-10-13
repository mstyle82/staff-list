<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Group;
use App\Models\Staff_status;
use App\Models\Attribute;
use App\Models\Title;
use App\Models\Team;
use App\Models\Work_location;
use App\Models\Tag;
use App\Models\Owned_tag;
use App\Models\Has_file;
use App\Models\Owned_file;
use DB;

class UserController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        //左カラム社員一覧用
        $grouplists = Attribute::leftjoin('users','attributes.user_id', '=', 'users.id')
                                ->where('users.status', '=', 0)
                                ->get();
        $groups = Group::where('status', '=', 0)
                ->orderBy('display_order', 'ASC')
                ->get();
        //メイン情報
        $users = User::all();
        $id = $request->id;
        $lists = User::findOrFail($id);
        //勤務時間
        if(($lists->last_time - $lists->start_time) <= 5) {
            $work_time = $lists->last_time - $lists->start_time ;
        }else
            $work_time = ($lists->last_time - $lists->start_time)-1;

        $staff_status = Staff_status::where('id', '=', $lists->staff_status)->first();

        $attribute = Attribute::where('user_id', '=', $id)
                            ->first();
        $titles = Title::where('status', '=', 0)->get();
        $teams = Team::where('status', '=', 0)->get();
        $work_locations = Work_location::where('status', '=', 0)->get();

        //年齢算出
        $age_data = User::where('id', '=', $id )
                            ->select('birthday')
                            ->first();
            if (strlen($age_data->birthday)>0) {
                $age_str = str_replace('-', '', $age_data->birthday);
                $age_str_1 = intval($age_str);
                $age = floor ((date('Ymd') - $age_str_1)/10000);
            }else
                $age = 0;
        //勤続年数算出
        $los_data = User::where('id', '=', $id )
                         ->select('first_day')
                         ->first();
            if (strlen($los_data->first_day)>0) {
                $los_str = str_replace('-', '', $los_data->first_day);
                $los_str_1 = intval($los_str);
                $los = floor ((date('Ymd') - $los_str_1)/10000);
            }else
                $los = 0;
        //タグ出力
        $owned_tags = Tag::leftjoin('owned_tags','tags.id', '=', 'owned_tags.tag_id')
                 ->where('owned_tags.user_id', '=', $id)->get();
        //ファイル出力
        $owned_files = Has_file::leftjoin('owned_files','has_files.id', '=', 'owned_files.file_id')
                 ->where('owned_files.user_id', '=', $id)->get();
        $includefile_names = [];
        foreach($owned_files as $owned_file){
            array_push($includefile_names, $owned_file['name']);
        }

        return view('list', compact('id','lists','users', 'staff_status', 'attribute','groups','titles','teams','work_locations', 'grouplists', 'age', 'los','owned_tags', 'owned_files', 'work_time'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //画像登録
        $post = $request->all();
        $id = $request->id;

        if($request->hasfile('profile_image')){
            $imagedata = $request->imagefileobj;
            $data = explode(',', $imagedata); // 三嶋追加
            $image = base64_decode($data[1]); // 三嶋変更
            $filename = $request->file('profile_image')->getClientOriginalName();

            $path = \Storage::put('public/'.$filename, $image);
            $path = explode('/', $path);
            $user = user::find($id);
            $user->profile_image = $filename;
            $user->save();
        }else{
            $path = null;
            $image = null;

            return redirect('edit-list/'.$post['id'])->with('flash_message1', '画像が選択されていません');
        }

        return redirect('list/'.$post['id'])->with('flash_message', '画像を変更しました');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //ダッシュボード
        $users = User::all();
        //左カラム社員一覧用
        $grouplists = Attribute::leftjoin('users','attributes.user_id', '=', 'users.id')
                                ->where('users.status', '=', 0)
                                ->get();
        $groups = Group::where('status', '=', 0)
                        ->orderBy('display_order', 'ASC')
                        ->get();;
        $staff_statuses = Staff_status::where('status', '=', 0)->get();
        $sum_id = $users->count(); //社員数カウント

        // 社員区分ごとの人数算出
        $sum_staff_statuses = Staff_status::select('staff_statuses.*', DB::raw('count(staff_status) as count'))
             ->leftJoin('users', 'users.staff_status', '=', 'staff_statuses.id')
             ->groupBy('staff_statuses.id')
             ->where('staff_statuses.status', '=', 0)
             ->where('users.status', '=', 0)
             ->orderBy('staff_statuses.display_order')
             ->get();
        //人員換算
        $work_time = 0;
        foreach($sum_staff_statuses as $sum_staff_status) {
            $time = $sum_staff_status->work_time * $sum_staff_status->count;
            $work_time += $time;
        }
        //平均年齢算出
        $age_datas = User::select('birthday')->get();
        $sum = 0;
        $count = 0;
        foreach($age_datas as $age_data){
            if (strlen($age_data->birthday)>0) {
                $age_str = str_replace('-', '', $age_data->birthday);
                $age = intval ((date('Ymd') - intval($age_str))/10000);
                $sum += $age;
                $count++;
        }
        }
        $avg_age = $sum / $count;

        //平均勤続年数算出
        $los_datas = User::select('first_day')->get();
        $sum = 0;
        $count = 0;
        foreach($los_datas as $los_data){
            if (strlen($los_data->first_day)>0) {
                $los_str = str_replace('-', '', $los_data->first_day);
                $los = intval((date('Ymd') - intval($los_str))/10000);
                $sum += $los;
                $count++;
        }
        }
        $avg_los = intval($sum / $count);

        return view('dashboard', compact('users', 'sum_id','groups', 'grouplists',  'avg_age', 'avg_los', 'staff_statuses', 'sum_staff_statuses', 'work_time'));

    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_card(Request $request)
    {
        $search = "";
        if(isset($request->input_serch)){
        $search = $request->input_serch;
        }
        $users = User::all();
        //左カラム社員一覧用
        $grouplists = Attribute::leftjoin('users','attributes.user_id', '=', 'users.id')
                                ->where('users.status', '=', 0)
                                ->get();
        $groups = Group::where('status', '=', 0)
                        ->orderBy('display_order', 'ASC')
                        ->get();;
        //カード個人情報/検索用
        $grouplists1 = Attribute::select('*', 'users.id as users_id', 'users.name as users_name', 'users.user_id as staff_id'  ,'departments.name as groups_name', 'titles.name as titles_name', 'teams.name as teams_name')
                                ->leftjoin('users','attributes.user_id', '=', 'users.id')
                                ->leftjoin('departments','attributes.group_id', '=', 'departments.id')
                                ->leftjoin('titles','attributes.title_id', '=', 'titles.id')
                                ->leftjoin('teams','attributes.team_id', '=', 'teams.id')
                                ->where('users.name', 'like', "%{$search}%")
                                ->where('users.status', '=', 0)
                                ->orWhere('departments.name', 'like', "%{$search}%")
                                ->orderBy('users.user_id', 'asc')
                                ->get();

        $titles = Title::where('status', '=', 0)->get();
        $teams = Team::where('status', '=', 0)->get();
        $owned_tags = Tag::leftjoin('owned_tags','tags.id', '=', 'owned_tags.tag_id')->get();

        return view('list-card', compact('users','grouplists','groups','titles','teams', 'owned_tags', 'grouplists1'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //左カラム社員一覧用
        $grouplists = Attribute::leftjoin('users','attributes.user_id', '=', 'users.id')
                                ->where('users.status', '=', 0)
                                ->get();
        $groups = Group::where('status', '=', 0)
                ->orderBy('display_order', 'ASC')
                ->get();;

        //role判定用ログインユーザID
        $login_user = User::where('id', '=', \Auth::id())
                   ->first();
        //メイン情報
        $users = User::all();
        $edit_data = User::findOrFail($id);
        $edit2_data = Attribute::all();
        $staff_statuses = Staff_status::where('status', '=', 0)->get();
        $titles = Title::where('status', '=', 0)->get();
        $teams = Team::where('status', '=', 0)->get();
        $work_locations = Work_location::where('status', '=', 0)->get();
        $group_id = Attribute::leftjoin('departments','attributes.user_id', '=', 'departments.id')
                 ->where('attributes.user_id', '=', $id)
                 ->first();
        $title_id = Attribute::leftjoin('titles','attributes.user_id', '=', 'titles.id')
                 ->where('attributes.user_id', '=', $id)->first();
        $team_id = Attribute::leftjoin('teams','attributes.user_id', '=', 'teams.id')
                 ->where('attributes.user_id', '=', $id)->first();
        $work_location_id = Attribute::leftjoin('work_locations','attributes.user_id', '=', 'work_locations.id')
                 ->where('attributes.user_id', '=', $id)->first();
        //タグ
        $tags = Tag::where('status', '=', 0)->get();
        $owned_tags = Tag::leftjoin('owned_tags','tags.id', '=', 'owned_tags.tag_id')
                 ->where('owned_tags.user_id', '=', $id)
                 ->where('status', '=', 0)
                 ->get();
        $include_tags = [];
        foreach($owned_tags as $owned_tag){
            array_push($include_tags, $owned_tag['tag_id']);
        }


        return view('edit-list', compact('id','edit_data', 'users', 'edit2_data', 'staff_statuses', 'groups', 'titles', 'teams', 'work_locations','group_id','title_id','team_id','work_location_id', 'grouplists', 'tags','owned_tags', 'include_tags', 'login_user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $edit_data, Group $select_groups, Title $select_titles, Team $select_teams, Work_location $select_work_locations)
    {
            $post = $request->all();
                User::where('id', '=', $post['id'])
                    ->update(['user_id' => $post['user_id'],
                        'status' => $post['status'],
                        'role' => $post['role'],
                        'staff_status' => $post['staff_status'],
                        'name' => $post['name'],
                        'kana' => $post['kana'] ,
                        'gender' => $post['gender'],
                        'birthday' => $post['birthday'],
                        'email' => $post['email'],
                        'post_code' => $post['post_code'],
                        'address' => $post['address'],
                        'home_tell' => $post['home_tell'] ,
                        'office_tell' => $post['office_tell'],
                        'start_time' =>$post['start_time'],
                        'last_time' =>$post['last_time'],
                        'first_day' => $post['first_day'],
                        'last_day' => $post['last_day'],
                        'memo' => $post['memo'],]);
            //attribute紐つけ
            Attribute::where('user_id', '=', $post['id'])
                    ->update(['group_id' => $post['group_id'],
                       'title_id' => $post['title_id'],
                       'team_id' => $post['team_id'],
                       'work_location_id' => $post['work_location_id'],]);
            //タグ付け
            Owned_tag::where('user_id', '=', $post['id'])->delete();
                if(!empty($post['tag'])){
                foreach ($post['tag'] as $tag) {
            Owned_tag::insert(['user_id' => $post['id'],
                               'tag_id' => $tag ]);
                }
                }
            //ファイルアップロード
            $my_file = $request->file('my_file');
                if($request->hasfile('my_file') && $my_file->isvalid()){
                    //$filename = $request->file('my_file')->getClientOriginalName();
                    $filename = $request->name ."/".$request->file_name;
                    $path = $request->file('my_file')->storeAs('has_file', $filename);
                $id = Has_file::insertGetId(['user_id' => \Auth::id(),
                                         'name' => $filename]);
            Owned_file::insert(['user_id' => $post['id'],
                               'file_id' => $id]);
             };

            return redirect('list/'.$post['id'])->with('flash_message', '更新が完了しました');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}



