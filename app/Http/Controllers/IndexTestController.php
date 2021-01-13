<?php
/*
 * Created by: Lalthanpuia Chhangte
 * Date 4 oct 2019
 *
 * */
namespace App\Http\Controllers;

use App\Download;
use App\Tender_main;
use App\TenderDepartment;
use Illuminate\Http\Request;
use function Psy\debug;

class IndexTestController extends Controller
{

    public function index()
    {

        $tenders = Tender_main::orderBy('issue_date','desc')->paginate();

        $departments=\App\TenderDepartment::all()->sortBy('name');
        foreach($tenders as $tender)
        {

            $test = explode(',',$tender->attachment);
            $download_path = Download::wherein('id',$test)->get();
            $tender->downloads = $download_path;
        }
        error_log("inside index ");
        // First day of this month


       // return view ('viewTender_ltp_test.viewTender_ltp_test',compact('tenders','departments'));
        return view ('index',compact('tenders','departments'));

    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }

    public function filters(Request $request){

        $validity = $request['validity'];
        $departmentId = $request['department'];
        $dateRange = $request['dateRange'];
        $order = $request['order'];

        $todayEpoch = time();

        error_log("inside filters");

        $tenders = Tender_main::orderBy('issue_date','desc')->where(function($q) use($validity,$departmentId,$todayEpoch,$dateRange,$order){


            /*
             *  VALIDITY = 1, then Valid
             *  VALIDITY = 2, then Invalid
             *  VALIDITY = 3, then All
             *
             */

            if ($validity=="1"  && $departmentId =='0'){
                $q->where('last_date_of_submission','>', $todayEpoch);
            }
            if ($validity=="1" && $departmentId != "0"){
                $q->where([["department",$departmentId],['last_date_of_submission','>', $todayEpoch]])->orderBy('issue_date','desc');
            }
            if ($validity=="2" && $departmentId =='0'){
                $q->where('last_date_of_submission','<', $todayEpoch)->orderBy('issue_date','desc');
            }
            if ($validity=="2" && $departmentId != "0"){
                $q->where([["department",$departmentId],['last_date_of_submission','<', $todayEpoch]])->orderBy('issue_date','desc');
            }
            //VALID = CHECK, INVALID = CHECK, DEPARTMENT ALL
            if ($validity=="3" & $departmentId =='0'){
                $q->orderBy('issue_date','desc');
            }
            //VALID = CHECK, INVALID = CHECK, DEPARTMENT SELECT
            if ($validity=="3" & $departmentId !='0'){
                $q->where('department',$departmentId)->orderBy('issue_date','desc');
            }


            $sortKey='issue_date';
            /*
             * DATE RANGE
             *  1 = PASS 30 DAYS
             * 2 = LAST 3 MONTHS
             * 3 = LAST 6 MONTHS
             * 4 = THIS YEAR
             * 5 = LAST 3 YEARS
             *
             * ORDER
             * 1 = NEWEST FIRST
             * 2 = OLDEST FIRST
             *
             */

        })->paginate();
        error_log("inside filters");


        foreach($tenders as $tender)
        {

            $test = explode(',',$tender->attachment);
            $download_path = Download::wherein('id',$test)->get();
            $tender->downloads = $download_path;
        }


        $departments= TenderDepartment::all()->sortBy("name");


        //$tenders = Tender_main::paginate();



       //return view ('viewTender_ltp_test.viewTender_ltp_test',compact('tenders','departments'));
        return view ('index',compact('tenders','departments'));
    }



    public function filterByDate(Request $request){

        //dd("fileter by date");
        $validity = $request['validity'];
        $departmentId = $request['department'];
        $dateRange = $request['dateRange'];
        $order = $request['order'];

        $todayEpoch = time();

        /*
         * DATE RANGE
         *  1 = PASS 30 DAYS
         * 2 = LAST 3 MONTHS
         * 3 = LAST 6 MONTHS
         * 4 = THIS YEAR
         * 5 = LAST 3 YEARS
         *
         * ORDER
         * 1 = NEWEST FIRST
         * 2 = OLDEST FIRST
         *
         */
        // dd( date("U",strtotime("-1 Years")) );

        if ($order == 1){
            $tenders = Tender_main::orderBy('issue_date','desc')->where(function($q) use($dateRange,$order){
                $sortKey='issue_date';
                if ($dateRange == 0 && $order == 1){
                }
                if ($dateRange == 1 && $order == 1){
                    $q->where($sortKey,'>', date("U",strtotime("-1 Months")) );

                }
                if ($dateRange == 2 && $order == 1){
                    $q->where($sortKey,'>', date("U",strtotime("-3 Months")) );

                }
                if ($dateRange == 3 && $order == 1){
                    $q->where($sortKey,'>', date("U",strtotime("-6 Months")) );

                }
                if ($dateRange == 4 && $order == 1){
                    $q->where($sortKey,'>', date("U",strtotime("-1 Years")) );

                }
                if ($dateRange == 5 && $order == 1){
                    $q->where($sortKey,'>', date("U",strtotime("-3 Years")) );

                }
            })->paginate();

            error_log("inside filters");
            foreach($tenders as $tender)
            {

                $test = explode(',',$tender->attachment);
                $download_path = Download::wherein('id',$test)->get();
                $tender->downloads = $download_path;
            }
            $departments= TenderDepartment::all()->sortBy("name");
           // return view ('viewTender_ltp_test.viewTender_ltp_test',compact('tenders','departments'));
            return view ('index',compact('tenders','departments'));

        }

        if ($order == 2) {
            $tenders = Tender_main::orderBy('issue_date')->where(function($q) use($dateRange,$order){
                $sortKey='issue_date';

            if ($dateRange == 0 && $order == 2){
            }
            if ($dateRange == 1 && $order == 2){
                $q->where($sortKey,'>', date("U",strtotime("-1 Months")) );

            }
            if ($dateRange == 2 && $order == 2){
                $q->where($sortKey,'>', date("U",strtotime("-3 Months")) );

            }
            if ($dateRange == 3 && $order == 2){
                $q->where($sortKey,'>', date("U",strtotime("-6 Months")) );

            }
            if ($dateRange == 4 && $order == 2){
                $q->where($sortKey,'>', date("U",strtotime("-1 Years")) );

            }
            if ($dateRange == 5 && $order == 2){
                $q->where($sortKey,'>', date("U",strtotime("-3 Years")) );

            }
            })->paginate();

            error_log("inside filters");
            foreach($tenders as $tender)
            {
                $test = explode(',',$tender->attachment);
                $download_path = Download::wherein('id',$test)->get();
                $tender->downloads = $download_path;
            }
            $departments= TenderDepartment::all()->sortBy("name");

            //return view ('viewTender_ltp_test.viewTender_ltp_test',compact('tenders','departments'));
            return view ('index',compact('tenders','departments'));

        }
    }
}
