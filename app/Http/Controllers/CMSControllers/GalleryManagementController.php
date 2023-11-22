<?php
namespace App\Http\Controllers\CMSControllers;

use App\Http\Controllers\Controller;

use App\Models\CMSModels\GalleryManagement;
use Illuminate\Http\Request;
use App\Http\Traits\AccessModelTrait;

class GalleryManagementController extends Controller
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
            $crudUrlTemplate['list'] = route('photovideo-list');
        }
       // $crudUrlTemplate['edit'] = route('event.edit', ['id' => 'xxxx']);
        //$crudUrlTemplate['delete'] = route('event-delete', ['id' => 'xxxx']);
        //$crudUrlTemplate['view'] = route('websitecoresetting.websitecoresetting-list');
        //$data=GalleryManagement::where('')->where()->get();

        return view('cms-view.photo-video-gallery-management.list',
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
        $crudUrlTemplate = array();
        if(isset($this->abortIfAccessNotAllowed()['create']) && $this->abortIfAccessNotAllowed()['create'] !=''){
            $crudUrlTemplate['create_photo'] = route('photo-save');
            $crudUrlTemplate['create_video'] = route('video-save');
        }else{
            $accessPermission = $this->checkAccessMessage();
        }

        return view('cms-view.photo-video-gallery-management.gallery-management-add',
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
    public function photoStore(Request $request)
    {
        $request->validate([
          'logo_title'=>'required'              
        ]);
            $data=new WebsiteCoreSettings;   
            if($request->hasFile('header_logo')){
                $file=$request->file('header_logo');
                $newname=time().rand(10,99).'.'.$file->getClientOriginalExtension();
                $path=public_path('uploads/websitesetting_logo');
                $file->move($path,$newname);
                $data->header_logo=$newname;
            }
            $data->id=Uuid::uuid4();
            $data->logo_title=$request->logo_title;
            $data->save();
            if($data)
            {
                return response()->json([
                'status'=>200,
                'message'=>'Added successfully.'
            ],200);
            }
            else{
                return response()->json([
                'status'=>201,
                'message'=>'some error accoured.'
            ],201);
        }
    }
    public function videoStore(Request $request)
    {
        $request->validate([
          'logo_title'=>'required'              
        ]);
            $data=new WebsiteCoreSettings;   
            if($request->hasFile('header_logo')){
                $file=$request->file('header_logo');
                $newname=time().rand(10,99).'.'.$file->getClientOriginalExtension();
                $path=public_path('uploads/websitesetting_logo');
                $file->move($path,$newname);
                $data->header_logo=$newname;
            }
            $data->id=Uuid::uuid4();
            $data->logo_title=$request->logo_title;
            $data->save();
            if($data)
            {
                return response()->json([
                'status'=>200,
                'message'=>'Added successfully.'
            ],200);
            }
            else{
                return response()->json([
                'status'=>201,
                'message'=>'some error accoured.'
            ],201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GalleryManagement  $galleryManagement
     * @return \Illuminate\Http\Response
     */
    public function show(GalleryManagement $galleryManagement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GalleryManagement  $galleryManagement
     * @return \Illuminate\Http\Response
     */
    public function edit(GalleryManagement $galleryManagement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GalleryManagement  $galleryManagement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GalleryManagement $galleryManagement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GalleryManagement  $galleryManagement
     * @return \Illuminate\Http\Response
     */
    public function destroy(GalleryManagement $galleryManagement)
    {
        //
    }
}
