<?php
namespace App\Http\Controllers\CMSControllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Models\CMSModels\WebsiteMenuManagement;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Validator;
use Carbon\Carbon;

class WebsiteMenuManagementAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $data=WebsiteMenuManagement::where('soft_delete','0')->get();
        $totalRecords = WebsiteMenuManagement::where('soft_delete','0')->count();
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
        $exitValue = WebsiteMenuManagement::where('name_en', $request->name_en)->count() > 0;
       // $max_size = $document->getMaxFileSize() / 1024 / 1024;
        if($exitValue == 'false'){
            //DB::rollback();
            $notification =[
                'status'=>201,
                'message'=>'This is duplicate value.'
            ];
        }else{
            try{
                $validator=Validator::make($request->all(),
                    [
                    'name_en'=>'required',
                    'sort_order'=>'required',
                // 'url'=>'required'
                ]);
                if($validator->fails())
                {
                    $notification =[
                        'status'=>201,
                        'message'=> $validator->errors()
                    ];
                }
                else{
                    $result= WebsiteMenuManagement::insert([
                            'uid' => Uuid::uuid4(),
                            'name_en' => $request->name_en,
                            'name_hi' => $request->name_hi,
                            'menu_place' => isset($request->menu_place)?$request->menu_place:'0',
                            'sort_order' => $request->sort_order,
                            'tab_type' => $request->tab_type,
                            'url' => preg_replace('/\s+/', '-', isset($request->url)?strtolower($request->url):'0'),
                            'footer_url' => preg_replace('/\s+/', '-', isset($request->footer_url)?strtolower($request->footer_url):'0'),
                            'is_parent' => isset($request->is_parent)?$request->is_parent:'0',
                            'parent_id' => isset($request->parent_id)?$request->parent_id:'0',
                        ]);
                    
                if($result == true)
                {
                    $notification =[
                        'status'=>200,
                        'message'=>'Added successfully.'
                    ];
                }
                else{
                   // DB::rollback();
                    $notification = [
                            'status'=>201,
                            'message'=>'some error accoured.'
                        ];
                    } 
                }      
            }catch(Throwable $e)
            {
                report($e);
                return false;
            }
        }
        return response()->json($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(WebsiteMenuManagement $websiteMenuManagement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data=WebsiteMenuManagement::where('uid',$id)->first();
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
         //dd($request->all());
        try{
            $validator=Validator::make($request->all(),
                [
                'name_en'=>'required',
                'sort_order'=>'required',
            // 'url'=>'required'
            ]);
            if($validator->fails())
            {
                $notification =[
                    'status'=>201,
                    'message'=> $validator->errors()
                ];
            }
            else{
                $result= WebsiteMenuManagement::where('uid',$request->id)->update([
                        'name_en' => $request->name_en,
                        'name_hi' => $request->name_hi,
                        'menu_place' => isset($request->menu_place)?$request->menu_place:'0',
                        'sort_order' => $request->sort_order,
                        'tab_type' => $request->tab_type,
                        'url' => preg_replace('/\s+/', '-', isset($request->url)?strtolower($request->url):'0'),
                        'footer_url' => preg_replace('/\s+/', '-', isset($request->footer_url)?strtolower($request->footer_url):'0'),
                        //'is_parent' => isset($request->is_parent)?$request->is_parent:'0',
                        //'parent_id' => isset($request->parent_id)?$request->parent_id:'0',
                    ]);
                
            if($result == true)
            {
                $notification =[
                    'status'=>200,
                    'message'=>'Added successfully.'
                ];
            }
            else{
               // DB::rollback();
                $notification = [
                        'status'=>201,
                        'message'=>'some error accoured.'
                    ];
                } 
            }      
        }catch(Throwable $e)
        {
            report($e);
            return false;
        }
        return response()->json($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data=WebsiteMenuManagement::where('uid',$id)->first();
        if($data)
        {
         WebsiteMenuManagement::where('uid',$id)->update(['soft_delete'=>1]);
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
