<?php

namespace App\Http\Controllers;

use App\Models\Work_location;
use App\Models\User;
use App\Models\Attribute;
use App\Models\Group;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class WorkLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //左カラム社員一覧用
        $grouplists = Attribute::leftjoin('users','attributes.user_id', '=', 'users.id')
                                ->where('users.status', '=', 0)
                                ->get();
        $groups = Group::where('status', '=', 0)
                ->orderBy('display_order', 'ASC')
                ->get();

        //メインコンテンツ
        $users = User::all();
        $work_locations = Work_location::orderBy('display_order', 'ASC')
        ->get();

        //dd($groups);

        return view('conf-worklocation', compact('groups', 'users', 'grouplists', 'work_locations'));

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
         $posts = $request->all();
         //dd($posts);

         Work_location::insert(['name'=> $posts['get_name'], 'display_order' => $posts['get_order'], 'user_id' => \Auth::id()]);

         return redirect('conf-worklocation')->with('flash_message', '登録が完了しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Work_location  $work_location
     * @return \Illuminate\Http\Response
     */
    public function show(Work_location $work_location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Work_location  $work_location
     * @return \Illuminate\Http\Response
     */
    public function edit(Work_location $work_location)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Work_location  $work_location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Work_location $work_location)
    {
         $posts = $request->all();
         //dd($posts);

         Work_location::where('id', $posts['id'] )
         ->update(['name' => $posts['name'], 'display_order' => $posts['order'], 'status' => $posts['status'], ]);

        return redirect('conf-worklocation')->with('flash_message', '更新が完了しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Work_location  $work_location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Work_location $work_location)
    {
        //
    }
}
