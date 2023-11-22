<?php
namespace App\Http\Controllers\CMSControllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

use App\Models\CMSModels\GalleryManagement;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use DB,Validator;
use App\Http\Traits\PdfImageSizeTrait;
use Carbon\Carbon;

class GalleryManagementAPIController extends Controller
{
    use PdfImageSizeTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $data=GalleryManagement::where('soft_delete','0')->get();
      $totalRecords = GalleryManagement::where('soft_delete','0')->count();
     $resp = new \stdClass;
     $resp->iTotalRecords = $totalRecords;
        $resp->iTotalDisplayRecords = $totalRecords;
        $resp->aaData = $data;
        if($resp)
            {
                return response()->json($resp,200);
            }
            else{
                return response()->json([
                'status'=>201,
                'message'=>'some error accoured.'
            ],201);
        }  
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storePhoto(Request $request)
    {
        $exitValue = GalleryManagement::where('title_name_en', $request->title_name_en)->count() > 0;
       // $max_size = $document->getMaxFileSize() / 1024 / 1024;
        if($exitValue == 'false'){
            $notification =[
                'status'=>201,
                'message'=>'This is duplicate value.'
            ];
        }else{
                try{
                $validator=Validator::make($request->all(),
                        [
                        'title_name_en'=>'required|unique:gallery_management',
                        //'type'=>'required',
                        //'public_url'=>'required'
                        ]);
                    if($validator->fails()){
                        $notification =[
                            'status'=>201,
                            'message'=> $validator->errors()
                        ];
                    }
                    else{
                        $extId =  Uuid::uuid4();
                        $result= GalleryManagement::insert([
                            'uid' => $extId,
                            'title_name_en' => $request->title_name_en,
                            'title_name_hi' => $request->title_name_hi,
                            'type' => isset($request->type)?$request->type:'1',
                            //'archivel_date' => Carbon::createFromFormat('Y-m-d',$request->enddate)->addDays(env('TENDER_ARCHIVEL')),
                        ]);
                        if(!empty($request->kt_photo_add_multiple_options)){
                            foreach($request->kt_photo_add_multiple_options as $key=>$value)
                            {
                                if(!empty($value['image'])){
                                    $size = $this->getFileSize($value['image']->getSize());
                                    $extension = $value['image']->getClientOriginalExtension();
                                    $name = time().rand(10,99).'.'.$value['image']->getClientOriginalExtension();
                                    $value['image']->move(resource_path().'/uploads/GalleryManagement', $name);
                                    $imgData[] = $name;
                                
                                $result= DB::table('gallery_details')->insert([
                                    'uid' => Uuid::uuid4(),
                                    'gallery_id' => $extId,
                                    'title' => $value['imagetitle'],
                                    'start_date'=> $value['startdate']??'',
                                    'end_date' => $value['enddate']??'',
                                    'pdfimage_size' => $size??'',
                                    'file_extension' => $extension??'',
                                    'public_url' => $name,
                                    'private_url' => $name,
                                    'archivel_date' => Carbon::createFromFormat('Y-m-d',$value['enddate'])->addDays(env('TENDER_ARCHIVEL')),
                                ]);
                                }
                                
                            }
                        }
                            if($result == true)
                            {
                                $notification =[
                                    'status'=>200,
                                    'message'=>'Added successfully.'
                                ];
                            }
                            else{
                                $notification = [
                                        'status'=>201,
                                        'message'=>'some error accoured.'
                                    ];
                                } 
                            }
                    }catch(Throwable $e){report($e);
                        return false;
                    }
                }
                return response()->json($notification);
    }

    public function storeVideo(Request $request)
    {
        $exitValue = GalleryManagement::where('title_name_en', $request->title_name_en1)->count() > 0;
       // $max_size = $document->getMaxFileSize() / 1024 / 1024;
        if($exitValue == 'false'){
            $notification =[
                'status'=>201,
                'message'=>'This is duplicate value.'
            ];
        }else{
                try{
                $validator=Validator::make($request->all(),
                        [
                        //'title_name_en1'=>'required|unique:gallery_management',
                        //'type'=>'required',
                        'title_name_en1'=>'required'
                        ]);
                    if($validator->fails()){
                        $notification =[
                            'status'=>201,
                            'message'=> $validator->errors()
                        ];
                    }
                    else{
                        $extId =  Uuid::uuid4();
                        $result= GalleryManagement::insert([
                            'uid' => $extId,
                            'title_name_en' => $request->title_name_en1,
                            'title_name_hi' => $request->title_name_hi1,
                            'type' => isset($request->type)?$request->type:'1',
                            //'archivel_date' => Carbon::createFromFormat('Y-m-d',$request->enddate)->addDays(env('TENDER_ARCHIVEL')),
                        ]);
                        if(!empty($request->kt_video_add_multiple_options)){
                            foreach($request->kt_video_add_multiple_options as $key=>$value)
                            {
                                if(!empty($value['image'])){
                                    $size = $this->getFileSize($value['Video']->getSize());
                                    $extension = $value['Video']->getClientOriginalExtension();
                                    $name = time().rand(10,99).'.'.$value['Video']->getClientOriginalExtension();
                                    $value['Video']->move(resource_path().'/uploads/GalleryManagement', $name);
                                    $imgData[] = $name;
                                
                                $result= DB::table('gallery_details')->insert([
                                    'uid' => Uuid::uuid4(),
                                    'gallery_id' => $extId,
                                    'title' => $value['videotitle'],
                                    'start_date'=> $value['startdate']??'',
                                    'end_date' => $value['enddate']??'',
                                    'pdfimage_size' => $size??'',
                                    'file_extension' => $extension??'',
                                    'public_url' => $name,
                                    'private_url' => $name,
                                    'archivel_date' => Carbon::createFromFormat('Y-m-d',$value['enddate'])->addDays(env('TENDER_ARCHIVEL')),
                                ]);
                            }
                        }
                    }
                    if($result == true)
                    {
                        $notification =[
                            'status'=>200,
                            'message'=>'Added successfully.'
                        ];
                    }
                    else{
                        $notification = [
                                'status'=>201,
                                'message'=>'some error accoured.'
                            ];
                        } 
                    }
            }catch(Throwable $e){report($e);
                return false;
            }
        }
        return response()->json($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(GalleryManagement $galleryManagement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data=GalleryManagement::where('uid',$id)->first();
      if($data->soft_delete==0)
            {
                return response()->json(['data'=>$data],200);
            }
            else{
                return response()->json([
                'status'=>201,
                'message'=>'some error accoured.'
            ],201);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data=GalleryManagement::where('uid',$id)->first();
        if($data)
        {
         $validator=Validator::make($request->all(),
            [
            'title'=>'required','type'=>'required','public_url'=>'required'
            ]);
        if($validator->fails()){
            $notification =[
                'status'=>201,
                'message'=> $validator->errors()
            ];
        }
        else{
            if($request->hasFile('public_url')){    
                $file=$request->file('public_url');
                $newname=time().rand(10,99).'.'.$file->getClientOriginalExtension();
                $path=resource_path('uploads/GalleryManagement');
                $file->move($path,$newname);
            }
            $data=new GalleryManagement();
            $result= GalleryManagement::where('uid',$id)->update([
                    'uid' => Uuid::uuid4(),
                    'title' => $request->title,
                    'type' => $request->type,
                    'public_url' => $newname,
                    'private_url' => $newname
                ]);
        if($result == true)
        {
            $notification =[
                'status'=>200,
                'message'=>'Added successfully.'
            ];
        }
        else{
            $notification = [
                    'status'=>201,
                    'message'=>'some error accoured.'
                ];
            } 
        }
        return response()->json($notification);
            }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
      $data=GalleryManagement::where('uid',$id)->first();
        if($data)
        {
         GalleryManagement::where('id',$id)->update(['soft_delete'=>1]);
            return response()->json([
                'status'=>200,
                'message'=>'deleted successfully.'
            ],200);
        }
        else{
                return response()->json([
                'status'=>201,
                'message'=>'some error accoured.'
            ],201);
        } 
    }
}
