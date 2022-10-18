<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('name')
        ->get();

        $pass = [
            "users"=>$users,
        ];
        
        return view('user/index', $pass);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $pass = [
            "user"=> new User,
            "roles"=>$roles
        ];

        return view('user/input', $pass);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users',
            'name' => 'required|min:2',
            'password' => [
                'required', 
                'min:8',
                'confirmed'
            ],
            'role_radio' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('users/new')
            ->withErrors($validator)
            ->withInput();
        }


        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role_radio;

        try {
            $user->save();
        } catch (\Throwable $e) {
            print_r($e);
            return;
        }
        return redirect()->route('users_show', $user->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        $pass = [
            "user"=>$user,
        ];
        
        if(!$user){
            return view('user/detail_404', $pass);
        }

        return view('user/detail', $pass);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();

        $pass = [
            "user"=> $user,
            "roles"=>$roles
        ];
        
        if(!$user){
            return view('user/detail_404', $pass);
        }

        return view('user/edit', $pass);
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
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users,id',
            'name' => 'required|min:2',
        ]);

        if ($validator->fails()) {
            return redirect("users/$id/edit")
            ->withErrors($validator)
            ->withInput();
        }

        $user = User::find($id);
        
        $user->name = $request->name;
        $user->email = $request->email;

        if($request->password){
            if($request->password!=$request->password_confirmation){
                return redirect("users/$id/edit")
                ->withErrors("Password confirmed tidak sama")
                ->withInput();
            }
            $user->password = Hash::make($request->password);
        }

        if(Auth::user()->id != $user->id){
            $user->role_id = $request->role_radio;
        }

        try {
            $user->save();
        } catch (\Throwable $e) {
            print_r($e);
            return;
        }
        return redirect()->route('users_show', $user->id);
    }

    public function disableToggle(Request $request, $id)
    {
        $user = User::find($id);

        if(Auth::user()->id == $user->id){
            return response()->json(["message"=>"dilarang merubah diri sendiri"]);
        }

        if($user->active==0){
            $user->active=1;
        }else{
            $user->active=0;
        }

        try {
            $user->save();
        } catch (\Throwable $e) {
            return response()->json($e->getMessage());
        }

        return response()->json($user);
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
