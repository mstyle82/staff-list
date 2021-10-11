<?php

namespace App\Http\Controllers;

use App\Models\Title;
use App\Models\User;
use App\Models\Attribute;
use App\Models\Group;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class TitleController extends Controller
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
        $titels = Title::orderBy('display_order', 'ASC')->get();

        return view('conf-title', compact('groups', 'users', 'grouplists', 'titels'));
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

         Title::insert(['name'=> $posts['get_name'], 'display_order' => $posts['get_order'], 'user_id' => \Auth::id()]);

         return redirect('conf-title');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Title  $title
     * @return \Illuminate\Http\Response
     */
    public function show(Title $title)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Title  $title
     * @return \Illuminate\Http\Response
     */
    public function edit(Title $title)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Title  $title
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Title $title)
    {
         $posts = $request->all();
         //dd($posts);

         Title::where('id', $posts['id'] )
         ->update(['name' => $posts['name'], 'display_order' => $posts['order'], 'status' => $posts['status'], ]);


        return redirect('conf-title');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Title  $title
     * @return \Illuminate\Http\Response
     */
    public function destroy(Title $title)
    {
        //
    }
}
