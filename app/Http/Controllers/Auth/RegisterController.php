<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Attribute;
use App\Models\Group;
use App\Models\User_dataset;
use DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */



    /**
     * Where to redirect users after registration.
     *
     * @var string
     */


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'name' => ['required', 'string', 'max:255'],

    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'password' => ['required', 'string', 'min:8', 'confirmed'],
    //     ]);
    // }
      /**
     * ユーザ登録画面の表示
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
        public function getRegister()
    {
        $users = User::all();
        $groups = Group::where('status', '=', 0)
                ->orderBy('id', 'desc')
                ->get();
        $grouplists = Attribute::leftjoin('users','attributes.user_id', '=', 'users.id')
                                ->where('users.status', '=', 0)
                                ->get();
        return view('auth.register', compact('users', 'groups', 'grouplists'));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(Request $data)
    {
        $GLOBALS['id'] = 0;
       DB::transaction(function() use($data){
           $id = User::insertGetId([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
           ]);
           Attribute::insert(['user_id' => $id]);
           //User_dataset::insert(['user_id' => $id]);
           $GLOBALS['id'] = $id;
       });
       return redirect('/list/'. $GLOBALS['id'] );
    }
}
