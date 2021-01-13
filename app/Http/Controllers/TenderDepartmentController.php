<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\TenderDepartment;

class TenderDepartmentController extends Controller
{



    public function __construct()
    {
        $this->middleware('IsAdmin');
    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departmentList = TenderDepartment::orderBy('id')->paginate();
        $departmentList1 = TenderDepartment::all()->sortBy("name");
        // $departmentAll = TenderDepartment::all()->sortBy('name');

        return view ('departmentList', compact('departmentList','departmentList1') );
    }

    public function register()
    {
        $departmentAll = TenderDepartment::all()->sortBy("name");
          return view('newDepartmentAdd', compact('departmentAll'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data)
    {
        //


       request()->validate([
       

            'name' => ['required', 'string', 'max:255'],
          
            ]);

        TenderDepartment::create([
            'name' => $data['name'],
            'color'=> 1,
            'parent'=> $data['parent'],
            'user_id'=> 1,
            'created'=>1574049888,
            'updated'=>1574049888                                                                                                                           
        ]);


        return redirect("/departmentList");
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $dept2 = TenderDepartment::find($request['id']);

      

            request()->validate([

                'name' => ['required', 'string', 'max:255'],
                
            ]);


        $dept2->name=$request['name'];
        $dept2->parent=$request['parent'];

        $dept2->update();
        return redirect('/departmentList')->with(['msg' => '<i class="glyphicon glyphicon-ok"></i> &nbsp; Updated Successfully ','status' => 'alert-success']);





    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // $user1 = User::find($id);
        $dept1 = TenderDepartment::find($request['id']);

        $dept1->delete();
        return redirect("/departmentList")->with(['msg' => '<i class="glyphicon glyphicon-ok"></i> &nbsp; Delete Successfully ','status' => 'alert-success']);
    }
}
