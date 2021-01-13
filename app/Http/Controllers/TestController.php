<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Test;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $testAll = Test::where('name','nam');
        // $testAll->where('body','bod');
        // $testAll->get();
        $index = 1;
        
        $testAll = Test::orderBy('id')->where(function($q){
            $q->where('name','nam');
            $q->where('body','bod');

        })->get();

        return view('test.index',compact('testAll','index'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $rules=[
            'phone_no' => 'required|numeric',
            'name' => 'required',
            'body' => 'required',
        ];
        $this->validate($request,$rules);
        $test = new Test;
        $test->phone_no = $request['phone_no'];
        $test->name = $request['name'];
        $test->body = $request['body'];
        $test->save();
        return redirect("/tests")->with(['msg' => '<i class="glyphicon glyphicon-ok"></i> &nbsp;Application Successfully Submitted','status' => 'alert-success']);

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
        return 'edit';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return 'destroy';
    }




}
