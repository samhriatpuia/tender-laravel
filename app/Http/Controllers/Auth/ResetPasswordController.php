<?php

namespace App\Http\Controllers\Auth;


use Illuminate\Support\Facades\Hash;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('IsLogin');
    }

    public function index()
    {
            return view('auth.passwords.reset');

    }

    public function reset(Request $data)
    {
        $rules=[ 
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'new-password' => ['required', 'string', 'min:8'],
        ];

        $this->validate($data,$rules);

        $user1=Auth::user();

        $pass=Hash::make($data['password']);

        // if($user1->email != $data['email'])
        // {
        //     flash('You have successfully edited your profile');
        // }



error_log($pass);

        // if(!password_verify($pass,$user1->password))

        if(!Hash::check($data['password'], $user1->password))
       
        {
           
            return redirect("/changePass")->with(['msg' => '<i class="glyphicon glyphicon-ok"></i> &nbsp;Old Password entered is Wrong','status' => 'alert-danger']);
        }

        else
        {

           // $tenderMain = Tender_main::find($request['id']);

            // User::update([
            //     'id' => $user1->id,
            //     // 'role_id' => $user1->role_id,
            //     // // 'tender_department_id' => 1,
            //     // 'tender_department_id' => $user1->tender_department_id,
            //     // 'name' => $user1->name,
            //     // 'email' => $user1->email,
            //     'password' => Hash::make($data['new-password']),
            // ]);
            error_log("else");
            $obj = User::find($user1->id);
            $obj->password = Hash::make($data['new-password']);
            $obj->save();


            error_log("Password: ". $obj->password);

           return view('passwordsuccess');
    
            
        }

  
        // return redirect("/index");











    }

}
