<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Carbon;
date_default_timezone_set("Europe/Paris");

class ExampleController extends Controller
{
    public function index(){
        $results = DB::select("SELECT * FROM users");

        return view('index',[
            'users'=> $results
        ]);
    }

    public function show($args){
        $results = DB::table('users')->WHERE('id',$args)->first();
        $results->updated_at = Carbon::createFromDate($results->updated_at)->diffForHumans();
        $results->password = Crypt::decrypt($results->password);
        return view('user',[
            'user'=> $results
        ]);
    }

    public function edit($args){
        $results = DB::table('users')->WHERE('id',$args)->first();
        $results->password = Crypt::decrypt($results->password);
        return view('edit',[
            'infoUser'=> $results
        ]);
    }

    public function update(Request $request, $args){
        $update_at = Carbon::now()->toDateTimeString();
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $password = Crypt::encrypt($request->input('password'));
        $email = $request->input('email');
        $id = $args;
        DB::update('update users set first_name = ?,last_name=?,password=?,email=?, updated_at=? where id = ?',[$first_name,$last_name,$password,$email,$update_at,$id]);

        return redirect('/users/'.$args);
    }

    public function destroy($args){
        DB::delete('delete from users where id = ?',[$args]);
        return redirect('/users');
    }

    public function create(Request $request){
        $errors = $request->session()->get('errors');
        return view('create', ['errors'=>$errors]);
    }

    public function store(Request $request){
        $validation = Validator::make($request->all(), [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        if (!$validation->fails()) {
            $update_at = Carbon::now()->toDateTimeString();
            $created_at = Carbon::now()->toDateTimeString();
            $first_name = $request->input('first_name');
            $last_name = $request->input('last_name');
            $password = Crypt::encrypt($request->input('password'));
            $email = $request->input('email');

            $data = array('first_name' => $first_name, "last_name" => $last_name, "password" => $password, "email" => $email, "updated_at" => $update_at, "created_at" => $created_at);
            DB::table('users')->insert($data);
            return redirect('/users');
        }
        else{
            $request->session()->flash('errors', $validation->errors()->all());
            return redirect('/users/create');
        }
    }
}
