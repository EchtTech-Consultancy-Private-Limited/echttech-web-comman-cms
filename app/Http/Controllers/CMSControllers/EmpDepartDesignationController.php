<?php
namespace App\Http\Controllers\CMSControllers;

use App\Http\Controllers\Controller;

use App\Models\CMSModels\EmpDepartDesignation;
use Illuminate\Http\Request;
use App\Http\Traits\AccessModelTrait;
use DB;

class EmpDepartDesignationController extends Controller
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
            $crudUrlTemplate['list'] = route('departmentdesignation-list');
        }
        if(isset($this->abortIfAccessNotAllowed()['update']) && $this->abortIfAccessNotAllowed()['update'] !=''){
            $crudUrlTemplate['edit'] = route('departmentdesignation.edit', ['id' => 'xxxx']);
        }
        if(isset($this->abortIfAccessNotAllowed()['delete']) && $this->abortIfAccessNotAllowed()['delete'] !=''){
            $crudUrlTemplate['delete'] = route('departmentdesignation-delete', ['id' => 'xxxx']);
        }
        //$crudUrlTemplate['view'] = route('websitecoresetting.websitecoresetting-list');
        return view('cms-view.department-designation.list',
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
        $data=EmpDepartDesignation::where([['soft_delete','0'],['parent_id','0']])->get(); 
        $crudUrlTemplate = array();
        // xxxx to be replaced with ext_id to create valid endpoint
        if(isset($this->abortIfAccessNotAllowed()['create']) && $this->abortIfAccessNotAllowed()['create'] !=''){
            $crudUrlTemplate['create_deptDesig'] = route('departmentdesignation-save');
        }
        else{
            $accessPermission = $this->checkAccessMessage();
        }
       return view('cms-view.department-designation.create-deptDesg',
            ['crudUrlTemplate' =>  json_encode($crudUrlTemplate),
                'department'=>$data,    
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmpDepartDesignation  $empDepartDesignation
     * @return \Illuminate\Http\Response
     */
    public function show(EmpDepartDesignation $empDepartDesignation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmpDepartDesignation  $empDepartDesignation
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, EmpDepartDesignation $empDepartDesignation)
    {
        if(isset($this->abortIfAccessNotAllowed()['update']) && $this->abortIfAccessNotAllowed()['update'] !=''){
            $crudUrlTemplate['update'] = route('departmentdesignation-update');
        }
        $results = EmpDepartDesignation::where('uid', $request->id)->first();
        if($results){
            $result = $results;
        }else{
            abort(404);
        }
        //dd($result);
        return view('cms-view.department-designation.edit',
        ['crudUrlTemplate' =>  json_encode($crudUrlTemplate),
            'data'=> $result,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmpDepartDesignation  $empDepartDesignation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmpDepartDesignation $empDepartDesignation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmpDepartDesignation  $empDepartDesignation
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmpDepartDesignation $empDepartDesignation)
    {
        //
    }
}
