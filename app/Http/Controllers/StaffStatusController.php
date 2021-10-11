<?php

namespace App\Http\Controllers;

use App\Models\Staff_status;
use App\Models\User;
use App\Models\Attribute;
use App\Models\Group;
use Illuminate\Http\Request;

class StaffStatusController extends Controller
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
        $staff_statuses = Staff_status::orderBy('display_order', 'ASC')
        ->get();

        return view('conf-staff', compact('groups', 'users','grouplists', 'staff_statuses'));
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
        //$worktime = preg_replace("/\.?0+$/","",$posts['get_worktime']);

         Staff_status::insert(['name'=> $posts['get_name'], 'display_order' => $posts['get_order'],  'work_time' => $posts['get_worktime'], 'user_id' => \Auth::id()]);

         return redirect('conf-staff');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\staff_status  $staff_status
     * @return \Illuminate\Http\Response
     */
    public function show(staff_status $staff_status)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\staff_status  $staff_status
     * @return \Illuminate\Http\Response
     */
    public function edit(staff_status $staff_status)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\staff_status  $staff_status
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, staff_status $staff_status)
    {
        $posts = $request->all();
        //$worktime = preg_replace("/\.?0+$/","",$posts['worktime']);
        //dd($posts);

         Staff_status::where('id', $posts['id'] )
                     ->update(['name' => $posts['name'], 'display_order' => $posts['order'], 'work_time' => $posts['worktime'], 'status' => $posts['status'], ]);


        return redirect('conf-staff');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\staff_status  $staff_status
     * @return \Illuminate\Http\Response
     */
    public function destroy(staff_status $staff_status)
    {
        //
    }
}
