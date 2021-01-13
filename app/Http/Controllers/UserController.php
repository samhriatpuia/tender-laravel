<?php

namespace App\Http\Controllers;

use App\User;
use App\TenderDepartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('IsAdmin');
    }


    public function index()


    {

        $userList = User::orderBy('id')->paginate();
        // $departmentAll = TenderDepartment::all()->sortBy('name');

        return view ('userList', compact('userList') );
    }



    public function create()
    {
        //
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



    public function changePassword(Request $request)
    {
        $user1 = User::find($request['id']);

        if(Hash::check($request['password'], $user1->password))
       
        {
           
            return redirect("/userList")->with(['msg' => '<i class="glyphicon glyphicon-ok"></i> &nbsp;New password cannot be old Password','status' => 'alert-danger']);
        }


        else

        {
        request()->validate([

           // 'name' => ['required', 'string', 'max:255'],
          //  'email' => ['required', 'string', 'email', 'max:255'],   //, 'unique:users'
           'password' => ['required', 'string', 'min:8'],    //, 'confirmed'
           //'tender_department_id' => ['required'],
        ]);


        }



        $user1->password = Hash::make($request['password']);

        $user1->update();
        return redirect('/userList')->with(['msg' => '<i class="glyphicon glyphicon-ok"></i> &nbsp;Password Change Successfully','status' => 'alert-success']);
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

        $user1 = User::find($request['id']);

        if($user1->email==$request['email'])
        {

            request()->validate([

                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],   //, 'unique:users'
                // 'password' => ['required', 'string', 'min:8', 'confirmed'],
                // 'tender_department_id' => ['required'],
            ]);

        }

        else
        
        {

            request()->validate([

                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255','unique:users'],   //, 'unique:users'
                // 'password' => ['required', 'string', 'min:8', 'confirmed'],
                // 'tender_department_id' => ['required'],
            ]);

        }




       // $user1 = User::find($request['id']);
      // $user1->id=$request['id'];
        $user1->name=$request['name'];
        $user1->email=$request['email'];

        $user1->update();
        return redirect('/userList');








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
            $user1 = User::find($request['id']);

        $user1->delete();
        return redirect("/userList")->with(['msg' => '<i class="glyphicon glyphicon-ok"></i> &nbsp; Delete Successfully ','status' => 'alert-success']);

    }
}
