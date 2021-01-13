@extends('layouts.layout_timepicker')
@section('title','Add Tender')

@section('content')

<div class="container mt-2" style="padding-top: 14px;">
        <div >
            <div>
                <div class="">
                    <div class="header-texts rounded-corners">
                        Add Tender
                    </div>
                    <div class="tenderfile" style="padding-top: 1px;">

                        {!! Form::open(['route' => ['addtender.store'],'files' => 'true','multiple' => true]) !!}

                        <div class="form-group mt-5">
                            <b>{{ Form::label('Tender Number') }}</b>
                            {{ Form::text('tender_number',null,['class' => 'form-control','rows' => 4]) }}
                            @if($errors->has('tender_number'))
                                <span class="text-danger red">{{$errors->first('tender_number')}}</span>
                            @endif
                        </div>

                         @if(Auth::user()->role_id == 1)

                        {{ Form::label('department') }}<br>
                        <select name ="department" class="form-control">
                            @foreach($departmentAll as $department)
                                <option value="{{$department->id}}">{{$department->name}}</option>
                            @endforeach
                        </select>
                        @else
                        @php
                            {{$user1=Auth::user();
                                $tendName=$user1->departmentCon();

                                $department = $user1->tender_department_id;

                            }}
                        @endphp
                        <br>
                            <p><b>Department:</b> {{$tendName}}

                       <!-- {{ Form::label('department') }} -->

                       <input type="hidden" name="department" value="{{$department}}"><br>

                        <!-- <select name ="department" class="form-control">
                            @foreach($departmentAll as $department)
                                <option value="{{$user1->tender_department_id}}">{{$tendName}}</option>
                             @endforeach
                        </select>  -->


                        @endif



                        <div class="form-group mt-5">
                            <b>{{ Form::label('subject') }}</b>
                            {{ Form::text('subject',null,['class' => 'form-control','rows' => 4]) }}
                            @if($errors->has('subject'))
                                <span class="text-danger red">{{$errors->first('subject')}}</span>
                            @endif
                        </div>
                        <div class="form-group mt-5">
                            <b>{{ Form::label('detail') }}</b>
                            {{ Form::textarea('detail',null,['class' => 'form-control','rows' => 4]) }}
                            @if($errors->has('detail'))
                                <span class="text-danger red">{{$errors->first('detail')}}</span>
                            @endif
                        </div>



                        {{-- <div class="row">
                            <div class="col-md-4 col-lg-4 col-sm-12">
                                <b>{{ Form::label('issue_date') }}</b> <br>
                                {{ Form::date('issue_date',null,['class' => 'form-group','rows' => 4]) }}
                                @if($errors->has('issue_date'))
                                    <span class="text-danger red">{{$errors->first('issue_date')}}</span>
                                @endif
                            </div>

                            <div class="col-md-4 col-lg-4 col-sm-12">
                                <b>{{ Form::label('last_date_of_submission') }}</b><br>
                                {{ Form::date('last_date_of_submission',null,['class' => 'form-group','rows' => 4]) }}
                                @if($errors->has('last_date_of_submission'))
                                    <span class="text-danger red">{{$errors->first('last_date_of_submission')}}</span>
                                @endif
                            </div>
                            <div class="col-md-4 col-lg-4 col-sm-12">
                                <b>{{ Form::label('opening_date') }}</b><br>
                                {{ Form::date('opening_date',null,['class' => 'form-group','rows' => 4]) }}
                                @if($errors->has('opening_date'))
                                    <span class="text-danger red">{{$errors->first('opening_date')}}</span>
                                @endif
                            </div>
                        </div> --}}

                        {{-- <div class="row">
                                <div class="col-md-4 col-lg-4 col-sm-12">
                                    <b>{{ Form::label('issue_date') }}</b> <br>
                                    {{ Form::date('issue_date',null,['class' => 'form-group','rows' => 4]) }}
                                    @if($errors->has('issue_date'))
                                        <span class="text-danger red">{{$errors->first('issue_date')}}</span>
                                    @endif
                                </div>

                                <div class="col-md-4 col-lg-4 col-sm-12">
                                    <b>{{ Form::label('last_date_of_submission') }}</b><br>
                                    {{ Form::date('last_date_of_submission',null,['class' => 'form-group','rows' => 4]) }}
                                    @if($errors->has('last_date_of_submission'))
                                        <span class="text-danger red">{{$errors->first('last_date_of_submission')}}</span>
                                    @endif
                                </div>
                                <div class="col-md-4 col-lg-4 col-sm-12">
                                    <b>{{ Form::label('opening_date') }}</b><br>
                                    {{ Form::date('opening_date',null,['class' => 'form-group','rows' => 4]) }}
                                    @if($errors->has('opening_date'))
                                        <span class="text-danger red">{{$errors->first('opening_date')}}</span>
                                    @endif
                                </div>
                            </div> --}}

                            <div class="row">
                                <div class="col-md-4 col-lg-4 col-sm-12">
                                        <b>{{ Form::label('issue_date') }}</b><br>

                                        <div class="input-group date form_date" data-date-format="dd MM yyyy" data-link-field="dtp_input1" style="width:200px;">

                                            <input class="form-control" size="16" type="text" value="" name="issue_date" readonly style="height: 30px;">
                                            <!-- <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span> -->
                                            <span class="input-group-addon" style="width: 40px;"><span class="glyphicon glyphicon-th"></span></span>
                                            @if($errors->has('issue_date'))
                                            <span class="text-danger red">{{$errors->first('issue_date')}}</span>
                                            @endif
                                        </div>
                                        <input type="hidden" id="dtp_input1" value="" /><br/>
                                </div>

                                <div class="col-md-4 col-lg-4 col-sm-12">
                                        <b>{{ Form::label('opening_date') }}</b><br>

                                        <div class="input-group date form_datetime " data-date-format="dd MM yyyy HH:ii p" data-link-field="dtp_input1"
                                                style="width:200px;">
                                            <input  class="form-control" size="16" type="text" value="" name="opening_date" readonly style="height: 30px;">
                                            <!-- <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span> -->
                                            <span class="input-group-addon" style="width: 40px;"><span class="glyphicon glyphicon-th"></span></span>

                                            @if($errors->has('opening_date'))
                                                <span class="text-danger red">{{$errors->first('opening_date')}}</span>
                                            @endif
                                        </div>
                                        <input type="hidden" id="dtp_input1" value="" /><br/>
                                </div>

                                <div class="col-md-4 col-lg-4 col-sm-12">
                                        <b>{{ Form::label('last_date_of_submission') }}</b><br>

                                        <div class="input-group date form_datetime" data-date-format="dd MM yyyy HH:ii p" data-link-field="dtp_input1"
                                             style="width:200px;">
                                            <input class="form-control" size="16" type="text" value="" name="last_date_of_submission" readonly style="height: 30px;">
                                            <!-- <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span> -->
                                            <span class="input-group-addon" style="width: 40px;"><span class="glyphicon glyphicon-th"></span></span>
                                            @if($errors->has('last_date_of_submission'))
                                                <span class="text-danger red">{{$errors->first('last_date_of_submission')}}</span>
                                            @endif
                                        </div>
                                        <input type="hidden" id="dtp_input1" value="" /><br/>
                                        </div>
                            </div>

                        <div class="field  files form-group" >
                            <b>{{ Form::label('Attachment') }}</b>
                            {{ Form::file('file[]', array('multiple'=>true,'accept'=>'image/*,.pdf,.doc,.docx'))  }}
                            <br />
                            <ul class="fileList"></ul>
                        </div>
                        <button class="btn mt-2 btn-lg" style="background-color: #05B18B;color: white;">Add Tender</button>
                         {!! Form::close() !!}
                    </div>
                </div>
            </div>

        </div>
    </div>


@endsection





