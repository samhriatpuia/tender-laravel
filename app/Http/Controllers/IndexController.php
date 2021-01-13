<?php
/*
 * Created by: Lalthanpuia Chhangte
 * Date Oct 2019
 * */
namespace App\Http\Controllers;

use App\Tender_main;
use Illuminate\Http\Request;
use App\Download;
use App\TenderDepartment;
use function Psy\debug;

class IndexController extends Controller
{
    public function index()
    {
        $tenders = Tender_main::orderBy('issue_date','desc')->paginate();
        $download = 0;
        foreach($tenders as $tender)
        {
            $test = explode(',',$tender->attachment);
            $download_path = Download::wherein('id',$test)->get();
            $tender->downloads = $download_path;
        }
        $departments=\App\TenderDepartment::all()->sortBy("name");

        return view ('/index',compact('tenders','departments'));
    }

    public function downloadcount($id)
    {

    
        $download = Download::find($id);
       if($download->download_count == null){
           $download->download_count = 0;
       }
        $download->download_count= $download->download_count + 1;
        $download->save();

        return redirect($download->url);
        
    }





    public function download()
    {
        $tenders = Tender_main::orderBy('issue_date','desc')->paginate();
        $download = 0;
        foreach($tenders as $tender)
        {
            $test = explode(',',$tender->attachment);
            $download_path = Download::wherein('id',$test)->get();
            $tender->downloads = $download_path;
        }
        $departments=\App\TenderDepartment::all()->sortBy("name");

        return view ('/download',compact('tenders','departments'));
    }





    public function filterByAllCombination(Request $request){
        $search_keyword = $request['search_keyword'];
        $validity = $request['validity'];
        $departmentId = $request['department'];
        $dateRange = $request['dateRange'];
        $order = $request['order'];

        $todayEpoch = time();

  /*       VALIDITY = 1, then Valid   *  VALIDITY = 2, then Invalid    *  VALIDITY = 3, then All  */

        $mOrder='DESC';
        if($order == 1)
            $mOrder='DESC';
        else
            $mOrder = 'ASC';

        $tenders = Tender_main::orderBy('issue_date',$mOrder)->where(function($q) use($dateRange,$order,$search_keyword,$validity,$departmentId,$todayEpoch){

            if($search_keyword!=null)
                $q->where('subject','LIKE','%'.$search_keyword.'%')
                ->orWhere('detail','LIKE','%'.$search_keyword.'%');

            switch ($validity){
                case 1: $q->where("last_date_of_submission",">", $todayEpoch);  break;
                case 2: $q->where("last_date_of_submission","<", $todayEpoch);  break;
                default:break;
            }

            //If departmentId is 0, then all department is selected. else particular department is selected
            if($departmentId != 0){
                $q->where("department",$departmentId);
            }

            $sortKey='issue_date';
            switch($dateRange){
                case 1: $q->where($sortKey,'>', date("U",strtotime("-1 Months")) );break;
                case 2: $q->where($sortKey,'>', date("U",strtotime("-3 Months")) );break;
                case 3: $q->where($sortKey,'>', date("U",strtotime("-6 Months")) );break;
                case 4: $q->where($sortKey,'>', date("U",strtotime("-1 Years")) );break;
                case 5: $q->where($sortKey,'>', date("U",strtotime("-3 Years")) );break;
            }

        })->paginate();

        $empty = false;
        if($tenders->isEmpty())
            $empty = true;

        foreach($tenders as $tender)
        {
            $test = explode(',',$tender->attachment);
            $download_path = Download::wherein('id',$test)->get();
            $tender->downloads = $download_path;
        }
        $departments= TenderDepartment::all()->sortBy("name");

        return view ('/index',compact('tenders','departments','empty'));

    }
}



