<?php
namespace App\Http\Controllers\CMSControllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

use App\Models\CMSModels\TenderManagement;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use App\Http\Traits\PdfImageSizeTrait;
use DB, Validator;
use Carbon\Carbon;

class TenderManagementAPIController extends Controller
{
    use PdfImageSizeTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=TenderManagement::where('soft_delete','0')->get();
        $totalRecords = TenderManagement::where('soft_delete','0')->count();
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
    public function store(Request $request)
    {
        $exitValue = TenderManagement::where('title_name_en', $request->title_name_en)->count() > 0;
        if($exitValue == 'false'){
            $notification =[
                'status'=>201,
                'message'=>'This is duplicate value.'
            ];
        }else{
        try{
            $validator=Validator::make($request->all(),
                [
                'tabtype'=>'required',
                'title_name_en'=>'required',
            ]);
            if($validator->fails())
            {
                $notification =[
                    'status'=>201,
                    'message'=> $validator->errors()
                ];
            }
            else{
                $extId =  Uuid::uuid4();
                $lastInsertID= TenderManagement::insertGetId([
                        'uid' => $extId,
                        'tab_type' => $request->tabtype,
                        'title_name_en' => $request->title_name_en,
                        'title_name_hi' => $request->title_name_hi,
                        'description_en' => $request->kt_description_en,
                        'description_hi' => $request->kt_description_hi,
                        
                    ]);
                if(!empty($request->kt_tender_add_multiple_options)){
                    foreach($request->kt_tender_add_multiple_options as $key=>$value)
                        {
                            if(!empty($value['pdfname'])){
                            $size = $this->getFileSize($value['pdfname']->getSize());
                            $extension = $value['pdfname']->getClientOriginalExtension();
                            $name = time().rand(10,99).'.'.$value['pdfname']->getClientOriginalExtension();
                            $value['pdfname']->move(resource_path().'/uploads/TenderManagement', $name);
                            
                        $result= DB::table('tender_details')->insert([
                                'uid' => Uuid::uuid4(),
                                'tender_id' => $extId,
                                'pdf_title' => $value['pdftitle'],
                                'start_date'=> $value['startdate'],
                                'end_date' => $value['enddate'],
                                'pdfimage_size' => $size,
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
    public function show(TenderManagement $tenderManagement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
      $data=TenderManagement::where('uid',$id)->first();
      if($data)
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
    public function update(Request $request)
    {
        
        try{
            $validator=Validator::make($request->all(),
                [
                'tabtype'=>'required',
                'title_name_en'=>'required',
            ]);
            if($validator->fails())
            {
                $notification =[
                    'status'=>201,
                    'message'=> $validator->errors()
                ];
            }
            else{
                $result=TenderManagement::where('uid',$request->id)->update([
               // $lastInsertID= TenderManagement::insertGetId([
                        'tab_type' => $request->tabtype,
                        'title_name_en' => $request->title_name_en,
                        'title_name_hi' => $request->title_name_hi,
                        'description_en' => $request->kt_description_en,
                        'description_hi' => $request->kt_description_hi,
                    ]);

                if(!empty($request->kt_tender_add_multiple_options)){
                foreach($request->kt_tender_add_multiple_options as $key=>$value)
                {
                if(!empty($value['uid'])){
                    $uid=DB::table('tender_details')->where('uid',$value['uid'])->first();
                    if(!empty($value['uid']) && !empty($value['image'])){
                        $size = $this->getFileSize($value['pdfname']->getSize());
                        $extension = $value['pdfname']->getClientOriginalExtension();
                        $name = time().rand(10,99).'.'.$value['pdfname']->getClientOriginalExtension();
                        $value['pdfname']->move(resource_path().'/uploads/TenderManagement', $name);

                        $result= DB::table('tender_details')->where('uid',$value['uid'])->update([
                            'pdf_title' => $value['pdftitle'],
                            'start_date'=> $value['startdate'],
                            'end_date' => $value['enddate'],
                            'public_url' => isset($name)?$name:$uid->public_url,
                            'private_url' => isset($name)?$name:$uid->public_url,
                            'pdfimage_size' => isset($size)?$size:$uid->pdfimage_size,
                            'file_extension' => isset($extension)?$extension:$uid->file_extension,
                            'archivel_date' => Carbon::createFromFormat('Y-m-d',$value['enddate'])->addDays(env('TENDER_ARCHIVEL')),
                        ]);
                    }   
                    $result= DB::table('tender_details')->where('uid',$value['uid'])->update([
                            'pdf_title' => $value['pdftitle'],
                            'start_date'=> $value['startdate'],
                            'end_date' => $value['enddate'],
                            // 'public_url' => isset($name)?$name:$uid->public_url,
                            // 'private_url' => isset($name)?$name:$uid->public_url,
                            // 'pdfimage_size' => isset($size)?$size:$uid->pdfimage_size,
                            // 'file_extension' => isset($extension)?$extension:$uid->file_extension,
                            'archivel_date' => Carbon::createFromFormat('Y-m-d',$value['enddate'])->addDays(env('TENDER_ARCHIVEL')),
                        ]);
                    }else{
                        if(!empty($value['pdfname'])){
                            $size = $this->getFileSize($value['pdfname']->getSize());
                            $extension = $value['pdfname']->getClientOriginalExtension();
                            $name = time().rand(10,99).'.'.$value['pdfname']->getClientOriginalExtension();
                            $value['pdfname']->move(resource_path().'/uploads/TenderManagement', $name);
                            
                        $result= DB::table('tender_details')->insert([
                                'uid' => Uuid::uuid4(),
                                'tender_id' => $request->id,
                                'pdf_title' => $value['pdftitle'],
                                'start_date'=> $value['startdate'],
                                'end_date' => $value['enddate'],
                                'pdfimage_size' => $size,
                                'file_extension' => $extension??'',
                                'public_url' => $name,
                                'private_url' => $name,
                                'archivel_date' => Carbon::createFromFormat('Y-m-d',$value['enddate'])->addDays(env('TENDER_ARCHIVEL')),
                            ]);
                        }
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
            return response()->json($notification);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data=TenderManagement::where('uid',$id)->first();
        if($data)
        {
         TenderManagement::where('uid',$id)->update(['soft_delete'=>1]);
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
    public function deletePDFIMG(Request $request)
    {
        //dd($request->id);
        $data=DB::table('tender_details')->where('uid',$request->id)->first();
        //dd($data);
        if($data !='null')
        {
            DB::table('tender_details')->where('uid',$request->id)->update(['soft_delete'=>1]);
            return response()->json([
                'status'=>200,
                'message'=>'deleted successfully.'
            ],200);
        }
        else{
            abort(404);
        }
    }
}
