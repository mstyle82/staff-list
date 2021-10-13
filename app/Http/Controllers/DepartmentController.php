<?php

namespace App\Http\Controllers;

use App\Models\department;
use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
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
        $users = User::all();
        $grouplists = Attribute::leftjoin('users','attributes.user_id', '=', 'users.id')
                                ->where('users.status', '=', 0)
                                ->get();
        $lists =  User::all();
        $groups = Group::where('status', '=', 0)
                ->orderBy('id', 'desc')
                ->get();
        $departments = Group::orderBy('id', 'DESC')
        ->get();

        //dd($groups);

        return view('conf-group', compact('groups', 'users','grouplists', 'departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

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

         Group::insert(['name'=> $posts['get_name'],'user_id' => \Auth::id()]);

         return redirect('conf-group')->with('flash_message', '登録が完了しました');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        // $posts = $group->all();
        // //$posts = Group::select('id', 'name', 'status','deleted_at', 'created_at')
        // //           ->get();

        // dd($posts);

        // Group::where('id', $posts['id'] )
        // ->update(['name' => $posts['name'],'status' => $posts['status'], ]);


        // return redirect( route('conf-group') );

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
         $posts = $request->all();
         //dd($posts);

         Group::where('id', $posts['id'] )
         ->update(['name' => $posts['name'],'status' => $posts['status'], ]);


        return redirect('conf-group')->with('flash_message', '更新が完了しました');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        //
    }
}
