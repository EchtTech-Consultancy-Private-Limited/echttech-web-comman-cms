<?php
namespace App\Http\Controllers\CMSControllers;

use App\Http\Controllers\Controller;

use App\Models\CMSModels\UserManagement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Traits\AccessModelTrait;
use DB;

class UserManagementController extends Controller
{
    use AccessModelTrait;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $crudUrlTemplate = array();
        // xxxx to be replaced with ext_id to create valid endpoint
        if(isset($this->abortIfAccessNotAllowed()['create']) && $this->abortIfAccessNotAllowed()['create'] !=''){
            $crudUrlTemplate['create'] = route('user-save');
        }else{
            $accessPermission = $this->checkAccessMessage();
        }
        if(isset($this->abortIfAccessNotAllowed()['read']) && $this->abortIfAccessNotAllowed()['read'] !=''){
            $crudUrlTemplate['list'] = route('user-list');
        }
        if(isset($this->abortIfAccessNotAllowed()['update']) && $this->abortIfAccessNotAllowed()['update'] !=''){
            $crudUrlTemplate['edit'] = route('user.edit', ['id' => 'xxxx']);
        }
        if(isset($this->abortIfAccessNotAllowed()['delete']) && $this->abortIfAccessNotAllowed()['delete'] !=''){
            $crudUrlTemplate['delete'] = route('user-delete', ['id' => 'xxxx']);
        }
        
        //$crudUrlTemplate['view'] = route('websitecoresetting.websitecoresetting-list');
        $roleType=DB::table('role_type_users')->select('role_type','uid')->where([['soft_delete','=','0']])->orderby('sort_order','asc')->get();
        
        return view('cms-view.user-management.user-list',
            ['crudUrlTemplate' =>  json_encode($crudUrlTemplate),
            'roleType' =>$roleType
        
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms-view.user-management.user-add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserManagement  $userManagement
     * @return \Illuminate\Http\Response
     */
    public function show(UserManagement $userManagement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserManagement  $userManagement
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $crudUrlTemplate = array();
        if(isset($this->abortIfAccessNotAllowed()['update']) && $this->abortIfAccessNotAllowed()['update'] !=''){
            $crudUrlTemplate['update'] = route('user-update');
        }

        $results = DB::table('users')->where('id', $request->id)->first();
        $roleType=DB::table('role_type_users')->select('role_type','uid')->where([['soft_delete','=','0']])->orderby('sort_order','asc')->get();
        if($results){
            $result = $results;
        }else{
            abort(404);
        }
        return view('cms-view.user-management.user-edit',
        ['crudUrlTemplate' =>  json_encode($crudUrlTemplate),
        'data'=> $result,
        'roleType' =>$roleType
    ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserManagement  $userManagement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserManagement $userManagement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserManagement  $userManagement
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserManagement $userManagement)
    {
        //
    }
}
