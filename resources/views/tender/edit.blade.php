@extends('layouts.layout_timepicker')
@section('title','Add Tender')

@section('content')



    <div>
        <div>
            <div class="container" style="padding-top: 10px;">
                 <div class="border-white rounded-top bt-5 container" style="background-color: #2c6ac6;color: white; height: 3em; padding-top: 10px;">
                    Edit Tender
                 </div>

                <div style="padding-left: 20px; padding-right: 20px;background-color: white; padding-top:10px;padding-bottom: 10px;">
                    {!! Form::open(['route' => ['indexedit.update','mySelectedTender'],'files' => 'true','multiple' => true,'method'=>'put']) !!}
                    {{ Form::hidden('id',$mySelectedTender[0]->id) }}
                    <div class="form-group">
                        <b>{{ Form::label('Tender Number') }}</b>
                        {{ Form::text('tender_number',$mySelectedTender[0]->tender_number,['class' => 'form-control','rows' => 4]) }}
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



                   <input type="hidden" name="department" value="{{$department}}"><br>



                    @endif


                    <br>
                    <div class="form-group">
                        <b>{{ Form::label('subject') }}</b>
                        {{ Form::text('subject',$mySelectedTender[0]->subject,['class' => 'form-control','rows' => 4]) }}
                        @if($errors->has('subject'))
                            <span class="text-danger red">{{$errors->first('subject')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <b>{{ Form::label('detail') }}</b>
                        {{ Form::textarea('detail',$mySelectedTender[0]->detail,['class' => 'form-control','rows' => 4]) }}
                        @if($errors->has('detail'))
                            <span class="text-danger red">{{$errors->first('detail')}}</span>
                        @endif
                    </div>

                    <!-- Date picker -->
                    <div class="row">
                        {{-- <div class="col-md-4 col-lg-4 col-sm-12">
                            <b>{{ Form::label('issue_date') }}</b> <br>
                            {{ Form::date('issue_date',date('Y-m-d', $mySelectedTender[0]->issue_date),['class' => 'form-group','rows' => 4]) }}
                            @if($errors->has('issue_date'))
                                <span class="text-danger red">{{$errors->first('issue_date')}}</span>
                            @endif
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-12">
                            <b>{{ Form::label('opening_date') }}</b><br>
                            {{ Form::date('opening_date',date('Y-m-d', $mySelectedTender[0]->opening_date),['class' => 'form-group','rows' => 4]) }}
                            @if($errors->has('opening_date'))
                                <span class="text-danger red">{{$errors->first('opening_date')}}</span>
                            @endif
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-12">
                            <b>{{ Form::label('last_date_of_submission') }}</b><br>
                            {{ Form::date('last_date_of_submission',date('Y-m-d', $mySelectedTender[0]->last_date_of_submission),['class' => 'form-group','rows' => 4]) }}
                            @if($errors->has('last_date_of_submission'))
                                <span class="text-danger red">{{$errors->first('last_date_of_submission')}}</span>
                            @endif
                        </div> --}}


                        <div class="col-md-4 col-lg-4 col-sm-12">
                                <b>{{ Form::label('issue_date') }}</b><br>

                                <div class="input-group date form_date" data-date-format="dd MM yyyy" data-link-field="dtp_input1" style="width:200px;">
                                <input class="form-control" size="16" type="text" value="{{ date('d M Y',$mySelectedTender[0]->issue_date) }}" name="issue_date" readonly style="height: 30px;">

                                <span class="input-group-addon" style="width: 40px;"><span class="glyphicon glyphicon-th"></span></span>
                                    @if($errors->has('issue_date'))
                                    <span class="text-danger red">{{$errors->first('issue_date')}}</span>
                                    @endif
                                </div>
                                <input type="hidden" id="dtp_input1" value="" /><br/>
                        </div>

                        <div class="col-md-4 col-lg-4 col-sm-12">
                                <b>{{ Form::label('opening_date') }}</b><br>

                                <div class="input-group date form_datetime" data-date-format="dd MM yyyy HH:ii p" data-link-field="dtp_input1"
                                        style="width:200px;">
                                    <input  class="form-control" size="16" type="text" value="{{date ('d M Y H:i:s a',$mySelectedTender[0]->last_date_of_submission) }}" name="opening_date" readonly style="height: 30px;">
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
                                <input class="form-control" size="16" type="text" value="{{ date('d M Y H:i:s a',$mySelectedTender[0]->opening_date) }}" name="last_date_of_submission" readonly style="height: 30px;">
                                <span class="input-group-addon" style="width: 40px;"><span class="glyphicon glyphicon-th"></span></span>
                                @if($errors->has('last_date_of_submission'))
                                    <span class="text-danger red">{{$errors->first('last_date_of_submission')}}</span>
                                @endif
                            </div>
                            <input type="hidden" id="dtp_input1" value="" /><br/>
                        </div>
                    </div>

                    @foreach($mySelectedTender as $tender)

                    <div style="padding-bottom: 20px; padding-left: 10px;">
                        <b>Download: </b><br>
                        @foreach($tender->downloads as $download)
                                <a href="/{{('storage'.$download->url)}}" target="_blank"><img src={{ asset('images/download.svg') }} style="height: 2%;width: 2%;margin-right: 8px">{{$download->title}}</a><br>
                        @endforeach
                    </div>
                    @endforeach

                    <!-- ends here -->
                    <div class="field  files form-group" >
                        <b>{{ Form::label('Attachment') }}</b>
                        {{ Form::file('file[]', array('multiple'=>true,'accept'=>'image/*,.pdf,.doc,.docx'))  }}
                        <br />
                        <ul class="fileList"></ul>
                    </div>

                    <p style="color:#747474;"><i>*Any attachment upload here will override the previous </i></p>

                    <div>
                        <button class="btn btn-lg" style="background-color: #05B18B;color: white;">Submit</button>
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>

<br>
@endsection
