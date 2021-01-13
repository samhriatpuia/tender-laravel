@extends('layouts.layout')
@section('title','Subscribe')

@section('content')
<div class="container" style="padding-top: 15px;">
    <div class="border-white rounded-corners bt-5 text-center " style="background-color: #2c6ac6;color: white; height: 3em; padding-top: 10px;padding-left: 15px;">
                Subscription
    </div>
    <div class="container" style="padding-top: 1%; padding-bottom: 13%; background-color: white">

        @if($first == 1)
            {!! Form::open(['route' => ['subscribe.otp'],]) !!}

            <div class="container card-body text-center" style="background-color: white; width: 23rem;height: 15rem;border:1px solid #ececec;">

                <div class="form-group">

                    <b>{{ Form::label('Enter your phone number') }}</b><br>
                    {{ Form::number('phone_number',$phone_number ?? '',array('maxlength'=>10,'minlength'=>10)) }}
                </div>

                <div >
                    <div>
                        <a style="opacity: 0.5;color:black" href="{{ route ('index') }}">Cancel</a> &nbsp
                        <button class="btn btn-primary" style="border:none">Verify</button>
                    </div>
                </div>
                <br><br>
                <small style="opacity: 0.5;color:black">By tapping verify, an SMS may be sent. Message & data rates may apply</small>
                {!! Form::close() !!}
            </div>
        @endif



        @if($first == 2)
            {!! Form::open(['route' => ['subscribe.otpVerify'],]) !!}
            <div class="container card-body text-center" style=" background-color: white; width: 23rem;height: 15rem;border:1px solid #ececec;">
                <div class="form-group">
                    {{ Form::label('OTP') }}
                    {{ Form::number('userOTP') }}
                </div>


                {{ Form::hidden('realOTP', $mOTP) }}
                {{ Form::hidden('phone_number', $phone_number ?? '') }}

                <div >
                    <div >
                        <button class="btn btn-primary">Submit</button>
                    </div>

                
              
                {!! Form::close() !!}

                        {!! Form::open(['route' => ['subscribe.otp'],]) !!}
                            {{ Form::hidden('phone_number', $phone_number ?? '') }}
                            <div >
                            <button style="color:#707070" class="btn btn-link">Resend OTP</button>
                            
                                
                            </div>                 
                    {!! Form::close() !!}
                
          
                                           <!-- <span id="countdown"></span> -->

                 
                    </div>
                <br>
                <small style="opacity: 0.5;color:black">Check your phone for SMS, then enter the one time password in the text field</small>

            </div>
        @endif





        @if($first == 3)
            {!! Form::open(['route' => ['subscribe.store']]) !!}
            <div class="form-group">
                {{ Form::label('Phone Number: ') }}
                {{ Form::text('phone_number',$phone_number,['readonly']) }}
            </div>
            @foreach($departmentAll as $department)
                <div class="form-group container">

                    {{ Form::checkbox('subscribed[]', $department->id) }}

                    <small>{{ Form::label($department->name) }}</small>

                </div>
            @endforeach
            <div>
                <div >
                    <button class="btn btn-primary">Subscribe</button>
                </div>
            </div>
            {!! Form::close() !!}

        @endif

        @if($first == 4)

            Incorrect otp!
            <a href="{{ route ('subscribe.index') }}">re-enter number</a>

        @endif

    </div>

<br>
<br>
</div>


<script>

var seconds = 3, $seconds = document.querySelector('#countdown');
(function countdown() {
    $seconds.textContent = seconds + ' second' + (seconds == 1 ?  '' :  's')
    if(seconds --> 0) setTimeout(countdown, 1000)
    if(seconds < 1) {

        
    }
}
)();



	var newHTML = "<span style='color:#ffffff'>" + oldHTML + "</span>";
	document.getElementById('para').innerHTML = newHTML;

</script>

@endsection
