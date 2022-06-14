<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Useraccess;
use Auth;

class HelpersController extends Controller
{
    public function getListMenu(){
    	$listmenu = '{
    "data": [{
        "dropdown":"0",
        "url":"dashboard",
        "name":"Dashboard",
        "class":"",
        "icon":"fa fa-tachometer-alt",
        "list_child":[]
    }, { 
        "dropdown":"1",
        "url":"",
        "name":"Master",
        "class":"",
        "icon":"clr-red fa fa-database",
        "list_child":[{
            "dropdown":"0",
            "url":"users",
            "name":"Users",
            "class":"",
            "icon":"clr-blue fa fa-users",
            "list_child":[]
        }, { 
            "dropdown":"0",
            "url":"division",
            "name":"Customers",
            "class":"",
            "icon":"clr-blue bi bi-person-bounding-box",
            "list_child":[]
        },{ 
            "dropdown":"0",
            "url":"divisions",
            "name":"Division",
            "class":"",
            "icon":"clr-blue bi bi-person-bounding-box",
            "list_child":[]
        }, { 
            "dropdown":"0",
            "url":"listaccess",
            "name":"List Access",
            "class":"",
            "icon":"clr-blue bi bi-person-bounding-box",
            "list_child":[]
        }]
    }, { 
        "dropdown":"1",
        "url":"",
        "name":"Transaction",
        "class":"",
        "icon":"clr-green fa fa-cogs",
        "list_child":[{
            "dropdown":"0",
            "url":"orders",
            "name":"Orders",
            "class":"",
            "icon":"clr-blue fa fa-tasks",
            "list_child":[]
        }, { 
            "dropdown":"0",
            "url":"invoice",
            "name":"Invoice",
            "class":"",
            "icon":"clr-blue fa fa-tasks",
            "list_child":[]
        }]
    }, { 
        "dropdown":"1",
        "url":"",
        "name":"Utility",
        "class":"",
        "icon":"clr-coklat fa fa-wrench",
        "list_child":[{
            "dropdown":"0",
            "url":"settings",
            "name":"Settings",
            "class":"",
            "icon":"clr-blue fa fa-tasks",
            "list_child":[]
        }, { 
            "dropdown":"0",
            "url":"options",
            "name":"Options",
            "class":"",
            "icon":"clr-blue fa fa-tasks",
            "list_child":[]
        }]
    }]
}';
    	return json_decode($listmenu);
    }

    public function checkaccess($name_access = '', $key_access = ''){
        if(Auth::user()->id_role == 99) return true;
        if($name_access != '' && $key_access != ''){

            $checkaccess = Useraccess::select('val_access')->where('id_users', Auth::user()->id)->where('name_access', $name_access)->where('key_access', $key_access)->first();
            if(isset($checkaccess->val_access) && $checkaccess->val_access == 1) return true;
        }
        return false;
    }

    public function access_crudList(){
        return array('view', 'add', 'edit', 'delete', 'import', 'export');
    }

    // public function changeDate($tdate = date('d/m/Y'), $sparate = '/', $format = 'dmY' ){

    // }
}
