<?php

namespace App\Http\Controllers;

use App\Download;
use App\Myuser;
use App\Tender_main;
use App\TenderDepartment;
use App\TenderSupplierUser;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class TenderEdit extends Controller
{




    public function __construct()
    {

        $this->middleware('IsLogin');

    }


    public function index()
    {

        $tenderDepartmentId = Auth::user()->tender_department_id;
        $roleID = Auth::user()->role_id;

        if($roleID == 1){

            $tenderAll = Tender_main::orderBy('id','desc')->paginate();
            $departments = TenderDepartment::all()->sortBy('name');

            for($i=0;$i<sizeof($tenderAll);$i++){

                for($j=0;$j<sizeof($departments);$j++){
                    if($departments[$j]->id == $tenderAll[$i]->department){

                        $tenderAll[$i]->departmentName =  $departments[$j]->name;

                    }
                }
            }

        }else{

            $tenderAll = Tender_main::orderBy('id','desc')->where('department',$tenderDepartmentId)->paginate();
            $departments = TenderDepartment::all()->sortBy('name');

            for($i=0;$i<sizeof($tenderAll);$i++){

                for($j=0;$j<sizeof($departments);$j++){
                    if($departments[$j]->id == $tenderAll[$i]->department){

                    $tenderAll[$i]->departmentName =  $departments[$j]->name;

                    }
                }
            }
        }

        return view('tender.tenderEditList',compact('tenderAll','departments'));
    }

    public function create() { }
    public function store(Request $request) {  }
    public function show($id){  }

    public function edit($id)
    {
        $mySelectedTender = Tender_main::where('id', $id)->get();
        $download = 0;
        foreach($mySelectedTender as $tender)
        {
            $test = explode(',',$tender->attachment);
            $download_path = Download::wherein('id',$test)->get();
            $tender->downloads = $download_path;
        }
        $departmentAll = TenderDepartment::all()->sortBy('name');

        return view('tender.edit',compact('mySelectedTender','departmentAll'));
    }

    public function update(Request $request, $id)
    {
        $tenderMain = Tender_main::find($request['id']);

        $tenderMain->tender_number = $request['tender_number'];

        $tenderMain->issue_date                 = strtotime($request['issue_date']) ;
        $tenderMain->last_date_of_submission    = strtotime($request['last_date_of_submission']) ;;
        $tenderMain->opening_date               = strtotime($request['opening_date']);

        $tenderMain->department = $request['department'];
        $tenderMain->subject = $request['subject'];
        $tenderMain->detail = $request['detail'];

        $tenderMain->author=  Auth::user()->id;

        $attachment="";

        $files = $request->file('file');

         if($files){
            error_log("inside if");

            foreach($files as $file)
            {
                $name=$tenderMain->id.'-'.$file->getClientOriginalName();

               // $url=$file->storeAs('tender', $name);
               $url=$file->move('uploads/tender',$name);    //move function // move to public

                $completeUrlForDownload=Storage::url($url); //THIS TAKE THE WHOLE URL
                $data[] = $name;

                //TODO: UPLOAD TO DOWNLOAD TABLE
                $download = new Download;
                $download->title = $file->getClientOriginalName();
                $download->author =  Auth::user()->id;
                $download->url = '/'.$url;

                $download->save();

                $attachmentArr[] = $download->id;
            }

            error_log("outside if");
            $tenderMain->attachment= implode(",",$attachmentArr);
        }

        $tenderMain->save();
        //TODO: STEPS TO SEND SMS TO THE SUBSCRIBE USER
        $userWhoSubscribeToTheUploadDepartment=[];

        //1. GET THE DEPARTMENT ID
        $myCurrentDepartment =  $request['department'];

        //2. GET tender_supplier_user . Search each row the department id in column "department_subscription";
        $tenderSupplierUserAll = TenderSupplierUser::all();
        $subscribe = array();

        $test=0;
        foreach ($tenderSupplierUserAll as $tenderSupplerUser){

            $allSubByUserStr = $tenderSupplerUser->department_subscription;

            $singleSubByUserArr = preg_split ("/\,/", $allSubByUserStr);

            //SEARCH FOR THE DEPT
            //3. Match the dept and if TRUE put the user id in array
            for($i = 0; $i < count($singleSubByUserArr); $i++){
                if ($singleSubByUserArr[$i] == $myCurrentDepartment){
                    array_push($userWhoSubscribeToTheUploadDepartment,$tenderSupplerUser->user_id);
                }
            }
        }
        //4. putt all selected phone number in array

        //WE ASSUMNE THAT WE HAVE THE USER IDS
        $phoneNumbers = array();

        for($z=0; $z < count($userWhoSubscribeToTheUploadDepartment); $z++) {
            $usersss= Myuser::find($userWhoSubscribeToTheUploadDepartment[$z]);
            $phoneNumbers[$z] = $usersss->user_phone;

            error_log("end");
        }

        //5. SENT SMS

        foreach ($phoneNumbers as $phone){
            $client = new Client();
            $response=$client->request ('POST','https://sms.mizoram.gov.in/api', [
                'form_params' => [
                    'api_key' => 'b53366c91585c976e6173e69f6916b2d',
                    'number' => $phone,
                    'message' => ''
                ]
            ]);
            $response = $response->getBody()->getContents();
            error_log($response);
        }

        //we have the phone number in $phoneNumnber
        return redirect("/indexedit")->with(['msg' => '<i class="glyphicon glyphicon-ok"></i> &nbsp;Tender Successfully Updated','status' => 'alert-success']);
        $tender->save();

    }

    public function destroy($id)
    {

        $selectedTender = Tender_main::find($id);

        $selectedTender->delete();
        return redirect("/indexedit")->with(['msg' => '<i class="glyphicon glyphicon-ok"></i> &nbsp; Delete Successfully ','status' => 'alert-danger']);

    }

    public function filterByAllCombination(Request $request){
        $search_keyword = $request['search_keyword'];
        $validity = $request['validity'];
        $departmentId = $request['department'];
        $dateRange = $request['dateRange'];
        $order = $request['order'];

        $todayEpoch = time();

        $tenderDepartmentId = Auth::user()->tender_department_id;

  /*       VALIDITY = 1, then Valid   *  VALIDITY = 2, then Invalid    *  VALIDITY = 3, then All  */

        $mOrder='DESC';
        if($order == 1)
            $mOrder='DESC';
        else
            $mOrder = 'ASC';

        $tenderAll = Tender_main::orderBy('issue_date',$mOrder)->where(function($q) use($dateRange,$order,$search_keyword,$validity,$tenderDepartmentId,$todayEpoch){

            if($search_keyword!=null)
                $q->where('subject','LIKE','%'.$search_keyword.'%')
                ->orWhere('detail','LIKE','%'.$search_keyword.'%');


            switch ($validity){
                case 1: $q->where("last_date_of_submission",">", $todayEpoch);  break;
                case 2: $q->where("last_date_of_submission","<", $todayEpoch);  break;
                default:break;
            }



            $sortKey='issue_date';
            switch($dateRange){
                case 1: $q->where($sortKey,'>', date("U",strtotime("-1 Months")) );break;
                case 2: $q->where($sortKey,'>', date("U",strtotime("-3 Months")) );break;
                case 3: $q->where($sortKey,'>', date("U",strtotime("-6 Months")) );break;
                case 4: $q->where($sortKey,'>', date("U",strtotime("-1 Years")) );break;
                case 5: $q->where($sortKey,'>', date("U",strtotime("-3 Years")) );break;
            }

            $q->where("department",$tenderDepartmentId);

        })->paginate();

        $empty = false;
        if($tenderAll->isEmpty())
            $empty = true;

        foreach($tenderAll as $tender)
        {
            $test = explode(',',$tender->attachment);
            $download_path = Download::wherein('id',$test)->get();
            $tender->downloads = $download_path;
        }

        $departments= TenderDepartment::all()->sortBy("name");

        for($i=0;$i<sizeof($tenderAll);$i++){

            for($j=0;$j<sizeof($departments);$j++){
                if($departments[$j]->id == $tenderAll[$i]->department){

                $tenderAll[$i]->departmentName =  $departments[$j]->name;

                }
            }
        }

        return view ('/tender.tenderEditList',compact('tenderAll','departments','empty'));

    }
}
