<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\User;
use App\Models\Attribute;
use App\Models\Group;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class TagController extends Controller
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
        $tags = Tag::orderBy('display_order', 'ASC')->get();

        //dd($groups);
        return view('conf-tag', compact('groups', 'users', 'grouplists', 'tags'));
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

         Tag::insert(['name'=> $posts['get_name'], 'display_order' => $posts['get_order'], 'color'=> $posts['get_color'],'user_id' => \Auth::id()]);

         return redirect('conf-tag')->with('flash_message', '登録が完了しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
         $posts = $request->all();


         Tag::where('id', $posts['id'] )
         ->update(['name' => $posts['name'], 'display_order' => $posts['order'], 'status' => $posts['status'], 'color' => $posts['color'], ]);

        return redirect('conf-tag')->with('flash_message', '更新が完了しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        //
    }
}
