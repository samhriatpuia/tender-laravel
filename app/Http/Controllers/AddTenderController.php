<?php
/*
 * Name: LALTHANPUIA CHHANGTE
 * DATE: 24 SEPT 2019
 */
namespace App\Http\Controllers;
use App\Download;
use App\Myuser;
use App\temp;
use App\Tender_main;
use App\TenderDepartment;
use App\TenderSupplierUser;
use Cassandra\Exception\TruncateException;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Subscribe;
use Illuminate\Support\Facades\Auth;

class AddTenderController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {

        $this->middleware('IsLogin');

    }


    public function index()
    {

        $departmentAll = TenderDepartment::all()->sortBy("name");

        return view ('tender.create', compact('departmentAll') );
    }

    public function create(){  }

    public function store(Request $request)
    {

        $rules=[

            'issue_date' => 'required',
            'last_date_of_submission' => 'required',
            'opening_date' => 'required',
            'tender_number' => 'required',
            'department' => 'required',
            'subject' => 'required',
            'detail' => 'required',
        ];

        $this->validate($request,$rules);


        $tenderMain = new Tender_main();
        $tenderMain->issue_date                 = strtotime($request['issue_date']) ;
        $tenderMain->last_date_of_submission    = strtotime($request['last_date_of_submission']) ;;
        $tenderMain->opening_date               = strtotime($request['opening_date']);
        $tenderMain->tender_number = $request['tender_number'];
        $tenderMain->department = $request['department'];
        $tenderMain->subject = $request['subject'];
        $tenderMain->detail = $request['detail'];

        $tenderMain->author =   Auth::user()->id;

        $attachment="";

        $lastRowId = Tender_main::latest('id')->first();
        $lastRowId = ($lastRowId->id)+1;

        error_log("before if");
        $files = $request->file('file');
        if($request->hasFile('file')){
            error_log("inside if");

            foreach($files as $file)
            {
                 $name = $lastRowId.'_'.$file->getClientOriginalName();
              //  $name = $lastRowId.'_'.$file->getClientOriginalExtension();



                // $url=$file->storeAs('tender', $name);     //original
                //$url2 = $file->storeAs ('uploads/tender', $name);   // after original



                $url=$file->move('uploads/tender',$name);    //move function // move to public
                //$file->move('storage/app/public/uploads/tender',$name);  // move to storage/app/public/
              //  Storage::move($name, 'storage/app/public/uploads/tender/er'.$name);
                $completeUrlForDownload = Storage::url($url); //THIS TAKE THE WHOLE URL
                $data[] = $name;

                //TODO: UPLOAD TO DOWNLOAD TABLE
                $download = new Download;
                $download->title = $file->getClientOriginalName();
                $download->author =  Auth::user()->id;
                $download->url = '/'.$url;
                $download->download_count = 0;

                $download->save();

                $attachmentArr[] = $download->id;

            }
            $tenderMain->attachment= implode(",",$attachmentArr);
        }


        $tenderMain->save();

        //TODO: STEPS TO SEND SMS TO THE SUBSCRIBE USER
        $userWhoSubscribeToTheUploadDepartment=[];

        //1. GET THE DEPARTMENT ID
        $myCurrentDepartment =  $request['department'];

        //2. GET tender_supplier_user . Search each row the department id in column "department_subscription";
        // OLD : $tenderSupplierUserAll = TenderSupplierUser::all();
        $subscriberAll = Subscribe::all(); //NEW
        $subscribe = array();

        $test=0;
        foreach ($subscriberAll as $subscribes){

            $allSubByUserStr = $subscribes->department_subscription;

            $singleSubByUserArr = preg_split ("/\,/", $allSubByUserStr);

            //SEARCH FOR THE DEPT

            //3. Match the dept and if TRUE put the user id in array
            for($i = 0; $i < count($singleSubByUserArr); $i++){
                if ($singleSubByUserArr[$i] == $myCurrentDepartment){

                    //OLD: array_push($userWhoSubscribeToTheUploadDepartment,$subscribes->user_id);
                    array_push($userWhoSubscribeToTheUploadDepartment,$subscribes->phone_number); //NEW
                }
            }
        }
        //4. putt all selected phone number in array

        //WE ASSUMNE THAT WE HAVE THE USER IDS
        $phoneNumbers = array();

        for($z=0; $z < count($userWhoSubscribeToTheUploadDepartment); $z++) {
//  OLD:           $usersss= Myuser::find($userWhoSubscribeToTheUploadDepartment[$z]);
//             $phoneNumbers[$z] = $usersss->user_phone;

                $phoneNumbers[$z] = $userWhoSubscribeToTheUploadDepartment[$z]; // NEW //userWhoSubscribeToTheUploadDepartment TAH HIAN PHONE NUMBER CU AWM TAWH , phoneNumbers ah sawn ka sawn leh mai2 , a hnu lam a ka hman a vang in
        }

        //5. SENT SMS

        $myPhoneNumberArrayChunk = array_chunk($phoneNumbers, 30, true);

        //dd($myPhoneNumberArrayChunk);


        $tempName = ' Subject: '. $request['subject'];


        //$message= 'New Tender from '. $departmentName->name. '. Opening Date: '. $request['opening_date']. '. Last Date: '. $request['last_date_of_submission']. '. Subject: '. $request['subject'];
      // $message= $departmentName->name.'New Tender from ';//. $departmentName->name;
       $message = ' New tender uploaded. Subject: '. $request['subject']. '. For more details, visit http://tender.mizoram.gov.in';

      //$me = $request['department'];
        foreach ($myPhoneNumberArrayChunk as $phoneArr){

         $phones=implode(",",$phoneArr);

                    $client = new Client();
                    $response=$client->request ('POST','https://sms.mizoram.gov.in/api', [
                        'form_params' => [
                            'api_key' => 'b53366c91585c976e6173e69f6916b2d',
                            'number' => $phones,
                           // 'number' => "7810911046",
                            'message' => $message,
                        ]
                    ]);



//         foreach ($phoneNumbers as $phone){
//             $client = new Client();
//             $response=$client->request ('POST','https://sms.mizoram.gov.in/api', [
//                 'form_params' => [
//                     'api_key' => 'b53366c91585c976e6173e69f6916b2d',
//                     'number' =>
//                     'message' => 'This is the day that the Lord has made.'
//                 ]
//             ]);


            error_log("Aye aye");

            $response = $response->getBody()->getContents();
            error_log($response);
        }

        //we have the phone number in $phoneNumnber


        return redirect("/index")->with(['msg' => '<i class="glyphicon glyphicon-ok"></i> &nbsp;Tender Successfully Submitted','status' => 'alert-success']);

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


        for($i=0;$i<10;$i++) {

            $thisIsMyArr[$i] = $i;

        }

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
       // dd($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}


