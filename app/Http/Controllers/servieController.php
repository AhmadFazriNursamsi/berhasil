<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Division;
use App\Models\Role;
use Illuminate\Support\Facades\Session;
use App\Models\Useraccess;
use App\Models\Listaccess;
use App\Http\Controllers\HelpersController as Helpers;
use Auth;
use Illuminate\Support\Facades\Validator;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class servieController extends Controller
{

    public function index(Request $request){

        // $db = Division::all();
        $divisions = Division::where('active', 1)->get();
        $user_access = Listaccess::where('flag_delete', 0)->get();

        return view("division.divi.index",["lolo" => $user_access], array(
            'datas'  => array(
                // 'users' => array(),
                'title' => 'Division',
                // 'roles' => $roles,
                'divisions' => $divisions,
                'user_access' => $user_access,
                // 'urls' => 'store',
            ),
        ));
    }
    public function index2(Request $request){

        $this->access = Helpers::checkaccess('users', 'view');
        if(!$this->access) {
            Session::flash('message', "you don't have permission to access");
            return redirect('/dashboard');  
        }

    	$datas = User::get();
    

        $divisions = Division::where('active', 1)->get();
        $roles = Role::where('active', 1)->where('id_role', '!=', 99)->get();
        $user_access = Listaccess::where('flag_delete', 0)->get();

        return view("division.index2",["lolo" => $user_access], array(
            'datas'  => array(
                // 'users' => array(),
                'title' => 'Division',
                // 'roles' => $roles,
                'divisions' => $divisions,
                'user_access' => $user_access,
                // 'urls' => 'store',
            ),
        ));
    
    }

    public function index2create(){

    	$this->access = Helpers::checkaccess('users', 'add');
        if(!$this->access) {
            Session::flash('message', "you don't have permission to access");
            return redirect('/dashboard');  
        }

        $divisions = Division::where('active', 1)->get();
        $roles = Role::where('active', 1)->where('id_role', '!=', 99)->get();
        $user_access = Listaccess::where('flag_delete', 0)->get();

    	return view('division.create', array(
            'datas'  => array(
                'users' => array(),
                'divisions' => $divisions,
                'roles' => $roles,
                'title' => 'Create',
                'user_access' => $user_access,
                'urls' => 'store',
            ),
            'id' => ''
        ));
    }
    public function index2store(Request $request){
        $this->access = Helpers::checkaccess('users', 'add');
        if(!$this->access) {
            Session::flash('message', "you don't have permission to access");
            return redirect('/dashboard');  
        }
        $json = json_encode($request->eCheck1);
        $id = '';
        $divi = New Division();
        $divi->division_name = $request->division_name;
        $divi->active = $request->active;
        $divi->default_access = $json;
        if($divi->save()){
            Session::flash('message', "Data has been added");
            return redirect('/division2')->with("eror", "Data Berhasil Disimpan");  
        }
        else {
            Session::flash('message', "Upps Something Wrong ... please try again !!!");
            return redirect("/division2/create");
        }

    }

    public function index2edit($id, Request $request){

    	dd( "sadsadsadsad");
    }
    

	public function apiStore(Request $request){
		$this->access = Helpers::checkaccess('divisions', 'create');
        if(!$this->access) return response()->json(['data' => [], 'status' => '401'], 200);

        
        $divisions = Division::where('active', 1)->get();
        $roles = Role::where('active', 1)->where('id_role', '!=', 99)->get();
        $user_access = Listaccess::where('flag_delete', 0)->get();

    	// return view('users.create', array(
        //     'datas'  => array(
        //         'users' => array(),
        //         'divisions' => $divisions,
        //         'roles' => $roles,
        //         'user_access' => $user_access,
        //         'urls' => 'store',
        //     ),
        // ));
        //     'id' => ''
		// $validatedData = $request->validateWithBag('post', [
		// 	'division_name' => ['required','unique:division'],
		// 	'active' => ['required'],
		// ]);

        // Division::updateOrCreate($validatedData); 
        
		// return response()->json(['success', 'Data Berhasil Disimpan']);
        $validator = Validator::make($request->all(), [
            'division_name' => 'required|unique:division',
            'user_access' => $user_access,
            'active' => 'required',
        ]);
         
        if ($validator->fails()) {
         return response()->json(['data' => ['fails'], 'status' => '401'], 200);
        }
     
         $tatas = new Division();
         $tatas->division_name = $request->division_name;
         $tatas->active = $request->active;
        //  $tatas->flag_delete = $request->flag_delete;
         if($tatas->save())
             return response()->json(['data' => ['success'], 'status' => '200'], 200);
         else 
             return response()->json(['data' => ['false'], 'status' => '200'], 200);

             if($request->eCheck1){
                $id = $tatas->id;
                foreach($request->eCheck1 as $key => $userc){
                    foreach($userc as $key2 => $ls) {
                        $users_access = Useraccess::where('id_users', $id)->where('name_access', $key)->where('key_access', $key2)->first();
                        if(!isset($users_access->id_access)) $users_access = new Useraccess;
                        $users_access->id_users = $id;
                        $users_access->name_access = $key; 
                        $users_access->key_access = $key2;
                        $users_access->val_access = $ls;
                        $users_access->save();
                    }
                }
            }
         }

         
    
	public function apiDetail($id, Request $request){

        $datas  = Division::where('id_division', $id)->first();
      
        return response()->json(['data' => $datas, 'status' => '200'], 200);

	
    }
	public function apiEdit($id, Request $request)
    {
		// dd($request->division_name,$request->active);
		$this->access = Helpers::checkaccess('users', 'delete');
        if(!$this->access) return response()->json(['data' => ['false'], 'status' => '401'], 200);

		$datas  = Division::where('id_division', $id)->first();

        $divisions = Division::where('active', 1)->get();
        $roles = Role::where('active', 1)->where('id_role', '!=', 99)->get();
        $user_access = Listaccess::where('flag_delete', 0)->get();
        $users = Division::where('id_division', $id)->first();

        return response()->json(['data' => $datas, 'status' => '200'], 200);;
    }

	public function apiUpdate($id, Request $request)
    {
		// dd($request->request);
		$this->access = Helpers::checkaccess('users', 'delete');
        if(!$this->access) return response()->json(['data' => ['false'], 'status' => '401'], 200);

        $datas_banding = Division::where('division_name', $request->division_name)->first();

        // if($datas_banding->id_division != $id) {
        // }
        $datas = Division::where('id_division', $id)->first();
        $datas->division_name = $request->division_name;
        $datas->active = $request->active;

        if($datas->save())
            return response()->json(['data' => ['success'], 'status' => '200'], 200);
        else 
            return response()->json(['data' => ['fails'], 'status' => '200'], 200);
	
	}
	public function apiDestroy($id, Request $request)
    {
		$this->access = Helpers::checkaccess('users', 'delete');
        if(!$this->access) return response()->json(['data' => ['false'], 'status' => '401'], 200);

		$datas = Division::where('id_division',$id)->first();
        $datas->flag_delete = 1;

        if(isset($request->undeleted)) $datas->flag_delete = 0;
        $datas->save();
    
        return response()->json(['data' => $datas, 'status' => '200'], 200);;
    }
}
