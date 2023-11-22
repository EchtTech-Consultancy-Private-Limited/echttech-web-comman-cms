<?php
namespace App\Http\Controllers\CMSControllers;

use App\Http\Controllers\Controller;

use App\Models\CMSModels\RolesAndPermission;
use Illuminate\Http\Request;
use App\Http\Traits\AccessModelTrait;
use DB;

class RolesAndPermissionController extends Controller
{
    use AccessModelTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function permissionIndex()
    {
        $crudUrlTemplate = array();
        // xxxx to be replaced with ext_id to create valid endpoint
        if(isset($this->abortIfAccessNotAllowed()['read']) && $this->abortIfAccessNotAllowed()['read'] !=''){
            $crudUrlTemplate['list'] = route('news-list');
        }
        if(isset($this->abortIfAccessNotAllowed()['update']) && $this->abortIfAccessNotAllowed()['update'] !=''){
            $crudUrlTemplate['edit'] = route('news-edit', ['id' => 'xxxx']);
        }
        if(isset($this->abortIfAccessNotAllowed()['delete']) && $this->abortIfAccessNotAllowed()['delete'] !=''){
            $crudUrlTemplate['delete'] = route('news-delete', ['id' => 'xxxx']);
        }
        //$crudUrlTemplate['view'] = route('websitecoresetting.websitecoresetting-list');

        return view('cms-view.roles-and-permission.permission_list',
            ['crudUrlTemplate' =>  json_encode($crudUrlTemplate)
        
        ]);
    }

    public function roleIndex()
    {
        $crudUrlTemplate = array();
        // xxxx to be replaced with ext_id to create valid endpoint
        if(isset($this->abortIfAccessNotAllowed()['read']) && $this->abortIfAccessNotAllowed()['read'] !=''){
            $crudUrlTemplate['list'] = route('news-list');
        }
        
        if(isset($this->abortIfAccessNotAllowed()['update']) && $this->abortIfAccessNotAllowed()['update'] !=''){
            $crudUrlTemplate['edit'] = route('news-edit', ['id' => 'xxxx']);
        }
        
        if(isset($this->abortIfAccessNotAllowed()['delete']) && $this->abortIfAccessNotAllowed()['delete'] !=''){
            $crudUrlTemplate['delete'] = route('news-delete', ['id' => 'xxxx']);
        }
        
        //$crudUrlTemplate['view'] = route('websitecoresetting.websitecoresetting-list');
        
        $typeUserName=DB::table('role_type_users')->select('*')->where([['soft_delete','=','0']])->get();
        $datas = [];
        foreach($typeUserName as $typeUserNames){
            $newData = new \stdClass;
            $newData->roleTypeName = $typeUserNames;
            $modulePermission=DB::table('roles_and_permissions')->select('*')->where([['role_id','=',$typeUserNames->uid]])->where([['soft_delete','=','0']])->get();
            if($modulePermission){
                $newData->permissionAllow = $modulePermission;
            }
            $datas[] = $newData;
        }
        $objectpass = new \stdclass;
        $objectpass->permissionAllows = $datas;

        return view('cms-view.roles-and-permission.role-list',['permissionAllow' =>$objectpass ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createRoles()
    {
        $crudUrlTemplate = array();
        if(isset($this->abortIfAccessNotAllowed()['create']) && $this->abortIfAccessNotAllowed()['create'] !=''){
            $crudUrlTemplate['create_role'] = route('role-save');
        }else{
            $accessPermission = $this->checkAccessMessage();
        }

        $moduleName=DB::table('module_management')->select('name_en','name_hi','uid','sort_order','prefix')->where([['soft_delete','=','0']])->orderby('sort_order','Asc')->get();
        $roleType=DB::table('role_type_users')->select('role_type','uid')->where([['soft_delete','=','0']])->orderby('uid','Asc')->get();
        
        
        return view('cms-view.roles-and-permission.role-add',
          ['crudUrlTemplate' =>  json_encode($crudUrlTemplate),
           'module'=>$moduleName,
           'roleType' =>$roleType,    
           'textMessage' =>$accessPermission??''
    
         ]);
    }
    public function createPermission()
    {
        return view('cms-view.roles-and-permission.role-add');
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
     * @param  \App\Models\RolesAndPermission  $rolesAndPermission
     * @return \Illuminate\Http\Response
     */
    public function show(RolesAndPermission $rolesAndPermission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RolesAndPermission  $rolesAndPermission
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $crudUrlTemplate = array();
        if(isset($this->abortIfAccessNotAllowed()['update']) && $this->abortIfAccessNotAllowed()['update'] !=''){
            $crudUrlTemplate['update'] = route('role-update');
        }

       $datas = RolesAndPermission::where('role_id',$request->id)->get();
       $moduleName=DB::table('module_management')->select('name_en','name_hi','uid','sort_order','prefix')->where([['soft_delete','=','0']])->orderby('sort_order','Asc')->get();
       $roleType=DB::table('role_type_users')->select('role_type','uid')->where([['soft_delete','=','0']])->orderby('uid','Asc')->get();
       
        if(isset($datas)){
            $data = $datas;
        }else{
            abort(404);
        }
        //dd($datas);
        return view('cms-view.roles-and-permission.role-edit',
        [
            'crudUrlTemplate' =>  json_encode($crudUrlTemplate),
            'datases' => $datas,
            'module'=>$moduleName,
            'roleType' =>$roleType
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RolesAndPermission  $rolesAndPermission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RolesAndPermission $rolesAndPermission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RolesAndPermission  $rolesAndPermission
     * @return \Illuminate\Http\Response
     */
    public function destroy(RolesAndPermission $rolesAndPermission)
    {
        //
    }
}
