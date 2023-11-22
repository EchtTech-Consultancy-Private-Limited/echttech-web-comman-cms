<?php
namespace App\Http\Controllers\CMSControllers;

use App\Http\Controllers\Controller;

use App\Models\CMSModels\WebsiteCoreSettings;
use App\Models\CMSModels\FooterManagement;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use App\Http\Traits\AccessModelTrait;
use DB;

class WebsiteCoreSettingsController extends Controller
{
    use AccessModelTrait;

    public function __construct()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexLogo(Request $request,$id=null)
    {

       $crudUrlTemplate = array();
       // xxxx to be replaced with ext_id to create valid endpoint
       if(isset($this->abortIfAccessNotAllowed()['read']) && $this->abortIfAccessNotAllowed()['read'] !=''){
            $crudUrlTemplate['list'] = route('logo-list');
       }
       
       if(isset($this->abortIfAccessNotAllowed()['update']) && $this->abortIfAccessNotAllowed()['update'] !=''){
            $crudUrlTemplate['edit'] = route('websitecoresetting.edit', ['id' => 'xxxx']);
       }
       
       if(isset($this->abortIfAccessNotAllowed()['delete']) && $this->abortIfAccessNotAllowed()['delete'] !=''){
            $crudUrlTemplate['delete'] = route('cws-delete', ['id' => 'xxxx']);
       }
       //$crudUrlTemplate['view'] = route('websitecoresetting.websitecoresetting-list');

       return view('cms-view.website-core-settings.websitelogo_list',
            ['crudUrlTemplate' =>  json_encode($crudUrlTemplate)
        
        ]);
    }
    public function indexFooterContent(Request $request,$id=null)
    {

       $crudUrlTemplate = array();
       // xxxx to be replaced with ext_id to create valid endpoint
       if(isset($this->abortIfAccessNotAllowed()['read']) && $this->abortIfAccessNotAllowed()['read'] !=''){
            $crudUrlTemplate['list'] = route('footercontent-list');
       }
       
       if(isset($this->abortIfAccessNotAllowed()['update']) && $this->abortIfAccessNotAllowed()['update'] !=''){
            $crudUrlTemplate['edit'] = route('websitecoresetting.edit', ['id' => 'xxxx']);
       }
       
       if(isset($this->abortIfAccessNotAllowed()['delete']) && $this->abortIfAccessNotAllowed()['delete'] !=''){
             $crudUrlTemplate['delete'] = route('cws-delete', ['id' => 'xxxx']);
       }
       //$crudUrlTemplate['view'] = route('websitecoresetting.websitecoresetting-list');

       return view('cms-view.website-core-settings.footercontent_list',
            ['crudUrlTemplate' =>  json_encode($crudUrlTemplate)
        
        ]);
    }
    public function indexSocialLink(Request $request,$id=null)
    {

       $crudUrlTemplate = array();
       // xxxx to be replaced with ext_id to create valid endpoint
       if(isset($this->abortIfAccessNotAllowed()['read']) && $this->abortIfAccessNotAllowed()['read'] !=''){
            $crudUrlTemplate['list'] = route('sociallink-list');
       }
       
       if(isset($this->abortIfAccessNotAllowed()['update']) && $this->abortIfAccessNotAllowed()['update'] !=''){
            $crudUrlTemplate['edit'] = route('websitecoresetting.edit', ['id' => 'xxxx']);
       }
       
       if(isset($this->abortIfAccessNotAllowed()['delete']) && $this->abortIfAccessNotAllowed()['delete'] !=''){
            $crudUrlTemplate['delete'] = route('cws-delete', ['id' => 'xxxx']);
       }
       //$crudUrlTemplate['view'] = route('websitecoresetting.websitecoresetting-list');

       return view('cms-view.website-core-settings.sociallink_list',
            ['crudUrlTemplate' =>  json_encode($crudUrlTemplate)
        
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $data=WebsiteCoreSettings::all(); 
       $crudUrlTemplate = array();
       // xxxx to be replaced with ext_id to create valid endpoint
       if(isset($this->abortIfAccessNotAllowed()['create']) && $this->abortIfAccessNotAllowed()['create'] !=''){
            $crudUrlTemplate['create_headerlogo'] = route('headerLogo-save');
            $crudUrlTemplate['create_footerContent'] = route('footer-save');
            $crudUrlTemplate['create_sociallink'] = route('socialLink-save');
            $crudUrlTemplate['create_popupadvertising'] = route('popupadvertising-save');
       }else{
            $accessPermission = $this->checkAccessMessage();
        }
       return view('cms-view.website-core-settings.websitecoresetting_add',
            ['crudUrlTemplate' =>  json_encode($crudUrlTemplate),    
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
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WebsiteCoreSettings  $websiteCoreSettings
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, WebsiteCoreSettings $websiteCoreSettings)

    {
        $data=WebsiteCoreSettings::all();
        $totalRecords = WebsiteCoreSettings::where('soft_delete',0)->count();
     

        $resp = new \stdClass;

        $resp->iTotalRecords = $totalRecords;
        $resp->iTotalDisplayRecords = $totalRecords;
        $resp->sEcho = (int)$request->input('draw');
        $resp->aaData = $data;
        
        return response()->json($resp);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WebsiteCoreSettings  $websiteCoreSettings
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        if(isset($this->abortIfAccessNotAllowed()['update']) && $this->abortIfAccessNotAllowed()['update'] !=''){
            $crudUrlTemplate['update_headerlogo'] = route('headerLogo-update');
            $crudUrlTemplate['update_footerContent'] = route('footer-update');
            $crudUrlTemplate['update_sociallink'] = route('socialLink-update');
        }

       $datas = WebsiteCoreSettings::where('uid',$request->id)->first();
       $footerdatas = FooterManagement::where('uid',$request->id)->first();
       $sociallinkDatas = DB::table('social_links')->where('uid',$request->id)->first();
        if(isset($datas)){
            $Logodata = $datas;
            $formCall = 'websitecoresetting_edit';
        }elseif(isset($footerdatas)){
            $footerdata = $footerdatas;
            $formCall = 'footercontent_edit';
        }elseif(isset($sociallinkDatas)){
            $sociallinkData = $sociallinkDatas;
            $formCall = 'sociallink_edit';
        }else{
            abort(404);
        }
        return view('cms-view.website-core-settings.'.$formCall,
        [
            'crudUrlTemplate' =>  json_encode($crudUrlTemplate),
            'data'=> isset($Logodata)?$Logodata:'',
            'footerdata'=> isset($footerdata)?$footerdata:'',
            'sociallinkData'=> isset($sociallinkData)?$sociallinkData:'',
        ]);
    }

    public function update(Request $request, WebsiteCoreSettings $websiteCoreSettings)
    {
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WebsiteCoreSettings  $websiteCoreSettings
     * @return \Illuminate\Http\Response
     */
    public function destroy(WebsiteCoreSettings $websiteCoreSettings,Request $request)
    {
        if(websiteCoreSettings::where('id',$request->websiteCoreSettings_id)->exists())
        {
        WebsiteCoreSettings::find($request->websiteCoreSettings_id)->delete();
        return response()->json(['success'=>'Company Delete Successfully'],200);  
        }
        else{
            return response()->json(['success'=>'Record not exist.'],201);
        }
    }
}
