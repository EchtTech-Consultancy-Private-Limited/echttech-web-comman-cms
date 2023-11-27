<?php
namespace App\Http\Controllers\CMSControllers;

use App\Http\Controllers\Controller;

use App\Models\CMSModels\EmployeeDirectory;
use App\Models\CMSModels\EmpDepartDesignation;
use Illuminate\Http\Request;
use App\Http\Traits\AccessModelTrait;
use DB;

class EmployeeDirectoryController extends Controller
{
    use AccessModelTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd(config('checkduplicate.mobile'));

        $crudUrlTemplate = array();
        // xxxx to be replaced with ext_id to create valid endpoint
        if(isset($this->abortIfAccessNotAllowed()['view']) && $this->abortIfAccessNotAllowed()['view'] !=''){
            $crudUrlTemplate['list'] = route('employeedirectory-list');
        }
        if(isset($this->abortIfAccessNotAllowed()['update']) && $this->abortIfAccessNotAllowed()['update'] !=''){
            $crudUrlTemplate['edit'] = route('employeedirectory.edit', ['id' => 'xxxx']);
        }
        if(isset($this->abortIfAccessNotAllowed()['delete']) && $this->abortIfAccessNotAllowed()['delete'] !=''){
            $crudUrlTemplate['delete'] = route('employeedirectory-delete', ['id' => 'xxxx']);
        }
        //$crudUrlTemplate['view'] = route('websitecoresetting.websitecoresetting-list');
        return view('cms-view.employee-directory.list-employee',
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
        $department=EmpDepartDesignation::where([['soft_delete','0'],['parent_id','0']])->get(); 
        $designation=EmpDepartDesignation::where([['soft_delete','0'],['parent_id','!=','0']])->get(); 
        //dd($designation);
        $crudUrlTemplate = array();
        // xxxx to be replaced with ext_id to create valid endpoint
        if(isset($this->abortIfAccessNotAllowed()['create']) && $this->abortIfAccessNotAllowed()['create'] !=''){
            $crudUrlTemplate['create'] = route('employeedirectory-save');
        }else{
            $accessPermission = $this->checkAccessMessage();
           // $accessPermission = "You don't have permission to perform this action!";
        }

       return view('cms-view.employee-directory.create-employee',
       ['crudUrlTemplate' =>  json_encode($crudUrlTemplate),
        'department'=>$department,
        'designation'=> $designation,
        'textMessage' =>$accessPermission??''
    
        ]);
    }
    public function fetchDesignation(Request $request)
    {
       // dd($request->department_id);
        $data['designation'] = EmpDepartDesignation::where("parent_id", $request->department_id)
                                    ->get(["name_en", "uid"]);
                                      
        return response()->json($data);
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
     * @param  \App\Models\EmployeeDirectory  $employeeDirectory
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeeDirectory $employeeDirectory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmployeeDirectory  $employeeDirectory
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $datas=EmpDepartDesignation::where([['soft_delete','0'],['parent_id','0']])->get(); 
        $crudUrlTemplate = array();
        if(isset($this->abortIfAccessNotAllowed()['update']) && $this->abortIfAccessNotAllowed()['update'] !=''){
            $crudUrlTemplate['update'] = route('employeedirectory-update');
        }

        $results = EmployeeDirectory::where('uid', $request->id)->first();
        if($results){
            $result = $results;
        }else{
            abort(404);
        }
        return view('cms-view.employee-directory.edit-employee',
        ['crudUrlTemplate' =>  json_encode($crudUrlTemplate),
            'data'=> $result,
            'department'=>$datas]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmployeeDirectory  $employeeDirectory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmployeeDirectory $employeeDirectory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmployeeDirectory  $employeeDirectory
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployeeDirectory $employeeDirectory)
    {
        //
    }
}
