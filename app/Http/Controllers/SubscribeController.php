<?php

namespace App\Http\Controllers;
use App\TenderDepartment;
use Illuminate\Http\Request;
use App\Download;
use App\Subscribe;
use Cassandra\Exception\TruncateException;
use GuzzleHttp\Client;

class SubscribeController extends Controller
{

    public function index()
    {
        $departmentAll = TenderDepartment::all()->sortBy("name");
        $first = 1;
        return view ('subscribe.create',compact('departmentAll','first'));
    }

    public function create() { }

    public function store(Request $request)
    {
        $rules=[
            'phone_number' => 'required',
        ];

       $this->validate($request,$rules);

       $checkIfAlreadySubscribe = Subscribe::where('phone_number',$request['phone_number'])->first();
        if($checkIfAlreadySubscribe == null){
        //NEW SUBSCRIBER

             $subscribe = new Subscribe();
             $subscribe->phone_number = $request['phone_number'];
             $subscribe->department_subscription = implode(',',$request['subscribed']);

             $subscribe->save();
        }else{
                $re_subscribe = Subscribe::find( $checkIfAlreadySubscribe->id);
                $re_subscribe->phone_number = $request['phone_number'];
                $re_subscribe->department_subscription = implode(',',$request['subscribed']);

                $re_subscribe->save();
        }
        return redirect("index")->with(['msg' => '<i class="glyphicon glyphicon-ok"></i> &nbsp;Successfully Subscribed','status' => 'alert-success']);

    }

    public function show($id){ }
    public function edit($id){ }
    public function update(Request $request, $id){}
    public function destroy($id) {   }

    public function otp(Request $request){

       $rules=[
                'phone_number' => 'required',
            ];
            error_log("papapappapapapa");
       $this->validate($request,$rules);

        $phone_number = $request['phone_number'];

        $mOTP = mt_rand(1000, 9999);
        //sent otp
           $client = new Client();
            $response=$client->request ('POST','https://sms.mizoram.gov.in/api', [
                'form_params' => [
                    'api_key' => 'b53366c91585c976e6173e69f6916b2d',
                    'number' => $phone_number,
                    'message' => $mOTP . ' is your OTP from eTender, MSeGS',
                ]
            ]);
            $response = $response->getBody()->getContents();
            
            error_log("OTP IS: ".$mOTP);
            error_log($response);
            $departmentAll = TenderDepartment::all()->sortBy("name");
            $first = 2;
           return view ('subscribe.create',compact('mOTP', 'phone_number', 'departmentAll','first'));
    }

    public function otpVerify(Request $request){
           $rules=[
                    'userOTP' => 'required',
                ];

           $this->validate($request,$rules);

        $userOTP = $request['userOTP'];
        $realOTP = $request['realOTP'];
        $phone_number = $request['phone_number'];
        $departmentAll = TenderDepartment::all()->sortBy("name");

        if($userOTP == $realOTP){
                    $first = 3;
        }
        else{
                   $first = 4;
        }

         return view ('subscribe.create',compact( 'phone_number', 'departmentAll','first'));

    }

}
