<?php
namespace App\Http\Controllers\CMSControllers;

use App\Http\Controllers\Controller;

use App\Models\CMSModels\WebsiteMenuManagement;
use Illuminate\Http\Request;
use App\Http\Traits\AccessModelTrait;

class WebsiteMenuManagementController extends Controller
{
    use AccessModelTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $crudUrlTemplate = array();
        // xxxx to be replaced with ext_id to create valid endpoint
        if(isset($this->abortIfAccessNotAllowed()['read']) && $this->abortIfAccessNotAllowed()['read'] !=''){
            $crudUrlTemplate['list'] = route('menu-list');
        }
        
        if(isset($this->abortIfAccessNotAllowed()['update']) && $this->abortIfAccessNotAllowed()['update'] !=''){
            $crudUrlTemplate['edit'] = route('menu.edit', ['id' => 'xxxx']);
        }
        
        if(isset($this->abortIfAccessNotAllowed()['delete']) && $this->abortIfAccessNotAllowed()['delete'] !=''){
            $crudUrlTemplate['delete'] = route('menu-delete', ['id' => 'xxxx']);
        }
        //$crudUrlTemplate['view'] = route('websitecoresetting.websitecoresetting-list');

        $data=WebsiteMenuManagement::all();

        return view('cms-view.website-menu-management.menu-list',
            ['crudUrlTemplate' =>  json_encode($crudUrlTemplate) ],compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $crudUrlTemplate = array();
        if(isset($this->abortIfAccessNotAllowed()['create']) && $this->abortIfAccessNotAllowed()['create'] !=''){
            $crudUrlTemplate['create'] = route('menu-save');
        }else{
            $accessPermission = $this->checkAccessMessage();
        }
        
        $menu=WebsiteMenuManagement::select('name_en','name_hi','uid')->where([['soft_delete','=','0']])->where('parent_id','0')->get();
        $Submenu=WebsiteMenuManagement::select('name_en','name_hi','uid')->where([['soft_delete','=','0']])->whereNot('parent_id', '0')->get();
        return view('cms-view.website-menu-management.menu-add',
        ['crudUrlTemplate' =>  json_encode($crudUrlTemplate),
            'menuList'=>$menu, 
            'Submenu'=>$Submenu,    
            'textMessage' =>$accessPermission??''
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //   // 'logo_title'=>'required'              
        // ]);       
        //     $data=new WebsiteMenuManagement;
        //     $data->menu=$request->menu;
        //     $data->menu_id=$request->menu_id;
        //     $data->sub_menu_id=$request->sub_menu_id;
        //     $data->sub_menu=$request->sub_menu;
        //     $data->sub_sub_menu=$request->sub_sub_menu;
        //     $data->save();
        //     if($data)
        //     {
        //         return response()->json([
        //         'status'=>200,
        //         'message'=>'Added successfully.'
        //     ],200);
        //     }
        //     else{
        //         return response()->json([
        //         'status'=>201,
        //         'message'=>'some error accoured.'
        //     ],201);
        //     }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WebsiteMenuManagement  $websiteMenuManagement
     * @return \Illuminate\Http\Response
     */
    public function show(WebsiteMenuManagement $websiteMenuManagement)
    {
        $crudUrlTemplate = array();
       // xxxx to be replaced with ext_id to create valid endpoint
       $crudUrlTemplate['read'] = route('menu.menu-list');
       $crudUrlTemplate['list'] = route('websitecoresetting-list');
       $crudUrlTemplate['delete'] = route('websitecoresetting-list');
       $crudUrlTemplate['view'] = route('websitecoresetting-list');
       

        return view('cms-view.website-menu-management.menu-list', 
        ['crudUrlTemplate' =>  json_encode($crudUrlTemplate)
        
    ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WebsiteMenuManagement  $websiteMenuManagement
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $crudUrlTemplate = array();
        if(isset($this->abortIfAccessNotAllowed()['update']) && $this->abortIfAccessNotAllowed()['update'] !=''){
            $crudUrlTemplate['update'] = route('menu-update');
        }

        $Editmenus=WebsiteMenuManagement::select('*')->where('uid',$request->id)->first();

        $menu=WebsiteMenuManagement::select('name_en','name_hi','uid')->where([['soft_delete','=','0']])->where('parent_id','0')->get();
        $Submenu=WebsiteMenuManagement::select('name_en','name_hi','uid')->where([['soft_delete','=','0']])->whereNot('parent_id', '0')->get();
        //dd($Editmenu);
        if($Editmenus){
            $Editmenu = $Editmenus;
        }else{
            abort(404);
        }
        return view('cms-view.website-menu-management.menu-edit',
        ['crudUrlTemplate' =>  json_encode($crudUrlTemplate),
            'menu'=> $menu,
            'Submenu'=>$Submenu,
            'Editmenu' =>$Editmenu
        ]);
    }
    // function getMenuTree($menus,$parentId){
    //         $branch = array();
    //         foreach ($menus as $menu){
    //             if($menu->parent_id == $parentId) {
    //                 $children = $this->getMenuTree($menus,$menu->uid);
    //                 if ($children) {
    //                     $menu->children = $children;
    //                 }
    //                 $branch[] = $menu;
    //             }
    //         }
    //         return $branch;
    //     }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WebsiteMenuManagement  $websiteMenuManagement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WebsiteMenuManagement $websiteMenuManagement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WebsiteMenuManagement  $websiteMenuManagement
     * @return \Illuminate\Http\Response
     */
    public function destroy(WebsiteMenuManagement $websiteMenuManagement)
    {
        //
    }
}
