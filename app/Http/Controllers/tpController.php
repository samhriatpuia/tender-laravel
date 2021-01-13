<?php

namespace App\Http\Controllers;
use App\Download;
use App\Tender_main;
use App\TenderDepartment;
use App\Test;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;
class tpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $testAll = Test::paginate()->sortBy('issue_date');
        $index = 1;
        return view('test.index',compact('testAll','index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

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

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //TODO: THIS IS USED AS A FUNCTION FOR FILTER
        //IF $id=1, then show valid, if $id=2, then show invalid, if $id=3, then show all.

        $todayEpoch = time();
        $departments= TenderDepartment::all()->sortBy("name");

        switch ($id){
            case 1:
                $tenders = Tender_main:: where('last_date_of_submission','>', $todayEpoch)->get()->sortByDesc('issue_date');
            break;

            case 2:
                $tenders = Tender_main:: where('last_date_of_submission','<', $todayEpoch)->get()->sortByDesc('issue_date');
            break;

            case 3:
                $tenders = Tender_main::all()->sortBy('issue_date');
            break;

        }
        return view ('viewTender_ltp_test.viewTender_ltp_test',compact('tenders','departments'));

//        if($id==1){
//
//            $tenders = Tender_main:: where('last_date_of_submission','>', $todayEpoch)->get()->sortByDesc('issue_date');
//            $departments= TenderDepartment::all()->sortBy("name");
//
//            return view ('viewTender_ltp_test.viewTender_ltp_test',compact('tenders','departments'));
//        }
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
        //
    }

//    public function departmentFilter(Request $request){
//
//        //dd($request['1']);
//        $valid = $request['1'];
//        $invalid = $request['2'];
//        $all = $request['3'];
//        $departmentId = $request['department'];
//        $todayEpoch = time();
//
//        //VALID = CHECK ,INVALID = UNCHECK,  ALL DEPARTMENT
//        if ($valid=="true" && $invalid==null && $departmentId =='0'){
//            $tenders = Tender_main:: where('last_date_of_submission','>', $todayEpoch)->get()->sortByDesc('issue_date');
//        }
//
//        //VALID = CHECK ,INVALID = UNCHECK, DEPARTMENT SELECT
//        if ($valid=="true" && $invalid==null && $departmentId != "0"){
//            $tenders = Tender_main::where([["department",$departmentId],['last_date_of_submission','>', $todayEpoch]])->get();
//        }
//
//        //VALID = UNCHECK, INVALID = CHECK, ALL DEPARTMENT
//        if ($invalid=="true" && $valid==null && $departmentId =='0'){
//            $tenders = Tender_main:: where('last_date_of_submission','<', $todayEpoch)->get()->sortByDesc('issue_date');
//        }
//
//        //VALID = UNCHECK, INVALID = CHECK, DEPARTMENT SELECT
//        if ($invalid=="true"  && $valid==null && $departmentId != "0"){
//            $tenders = Tender_main::where([["department",$departmentId],['last_date_of_submission','<', $todayEpoch]])->get();
//        }
//
//        //VALID = UNCHECK, INVALID = UNCHECK, DEPARTMENT ALL
//        if ($invalid==null && $valid ==null & $departmentId =='0'){
//            $tenders = Tender_main::all()->sortBy('issue_date');
//        }
//
//        //VALID = UNCHECK, INVALID = UNCHECK, DEPARTMENT SELECT
//        if ($invalid==null && $valid ==null & $departmentId !='0'){
//            $tenders = Tender_main::where('department',$departmentId)->get();
//        }
//
////        if($departmentId == '0')
////            $tenders = Tender_main::all()->sortBy('issue_date');
////        else
////            $tenders = Tender_main::where("department",$departmentId)->get();
//
//        $departments= TenderDepartment::all()->sortBy("name");
//
//        return view ('viewTender_ltp_test.viewTender_ltp_test',compact('tenders','departments'));
//
//    }
}
