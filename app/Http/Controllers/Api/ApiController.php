<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Carbon;
date_default_timezone_set("Europe/Paris");
class ApiController extends Controller
{
    public function index(){
        $results = DB::select("SELECT * FROM users");
        return json_encode($results,true);
    }

    public function show($args){
        $res = new \stdClass();
        $results = DB::table('users')->WHERE('id',$args)->first();

        if ($results){
            $results->updated_at = Carbon::createFromDate($results->updated_at)->diffForHumans();
            $results->password = Crypt::decrypt($results->password);
            $res->results = $results;
        }
        else{
            $res->message = 'Utilisateur inconnu';
        }
        return json_encode($res,true);
    }

    public function destroy($args){
        $res = new \stdClass();
        $results = DB::delete('delete from users where id = ?',[$args]);
        if ($results){
            $res->success = 'Utilisateur N°'.$args.' supprimé';
        }
        else{
            $res->failed = 'Utilisateur inconnu';
        }
        return json_encode($res,true);
    }

    public function store(Request $request){
        $validation = Validator::make($request->all(), [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);
        $res = new \stdClass();

        if (!$validation->fails()) {
            $update_at = Carbon::now()->toDateTimeString();
            $created_at = Carbon::now()->toDateTimeString();
            $first_name = $request->post('first_name');
            $last_name = $request->post('last_name');
            $password = Crypt::encrypt($request->post('password'));
            $email = $request->post('email');

            $data = array('first_name' => $first_name, "last_name" => $last_name, "password" => $password, "email" => $email, "updated_at" => $update_at, "created_at" => $created_at);
            DB::table('users')->insert($data);
            $res->success = 'Utilisateur crée';
        }
        else{
            $res->failed = $validation->errors()->all();
        }
        return json_encode($res,true);
    }

    public function update(Request $request, $args){

        $update_at = Carbon::now()->toDateTimeString();
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $password = Crypt::encrypt($request->input('password'));
        $email = $request->input('email');
        $id = $args;
        $results = DB::update('update users set first_name = ?,last_name=?,password=?,email=?, updated_at=? where id = ?',[$first_name,$last_name,$password,$email,$update_at,$id]);

        $res = new \stdClass();
        if ($results){
            $res->success = 'Mise à jour avec succès';
        }
        else{
            $res->failed = 'Echec de la mise à jour';
        }
        return json_encode($res,true);
    }
}
