<?php

namespace App\Http\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

use App, Route, DB;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;

// Call Helper

class CommonComposer
{
    protected $request;

    /**
     * Create a new common composer.
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
       
        $menuData = array('Home', 'Contact US');
        $userLogin = Auth()->user();
        //dd($userLogin->role_id);
        if(isset($userLogin->role_id) && $userLogin->role_id !=1){
            $modelName = DB::table('roles_and_permissions')->where('role_id',$userLogin->role_id)->orderBy('sort_order','asc')->get();
        }else{
            $modelName = DB::table('module_management')->where('soft_delete','0')->orderBy('sort_order','asc')->get();
        }
        
        //dd($modelName);
            $view->with([
                'menu' => $menuData, 
                'modelname' => $modelName
            ]);

    }

    
}
