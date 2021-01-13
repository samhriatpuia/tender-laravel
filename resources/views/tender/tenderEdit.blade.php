{{--@extends('layouts.layout')--}}
{{--@section('content')--}}


{{--    <div class="row">--}}
{{--        <div class="col-md-9">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">--}}
{{--                    Add--}}
{{--                </div>--}}
{{--                <div class="card-body">--}}
{{--                    {!! Form::model($mySelectedTender,['route' => ['indexedit.update',$mySelectedTender],'files' => 'true','multiple' => true,'method'=>'patch']) !!}--}}
{{--                    {!! Form::open($mySelectedTender, ['action' => 'AddTenderController@store']) !!}--}}
{{--                        {!! Form::model($mySelectedTender,['route' => ['addtender.update',$mySelectedTender[0]->id]]) !!}--}}


{{--                    <div class="form-group">--}}
{{--                        {{ Form::label('Tender Number') }}--}}
{{--                        {{ Form::text('tender_number',null,['class' => 'form-control','rows' => 4]) }}--}}
{{--                        @if($errors->has('tender_number'))--}}
{{--                            <span class="text-danger red">{{$errors->first('tender_number')}}</span>--}}
{{--                        @endif--}}
{{--                    </div>--}}

{{--                    <div class="form-group">--}}
{{--                        {{ Form::label('issue_date') }}--}}
{{--                        {{ Form::text('issue_date',null,['class' => 'date form-control','rows' => 4]) }}--}}
{{--                        @if($errors->has('issue_date'))--}}
{{--                            <span class="text-danger red">{{$errors->first('issue_date')}}</span>--}}
{{--                        @endif--}}
{{--                    </div>--}}

{{--                    --}}{{--                <input class="date form-control" type="text">--}}

{{--                    <div class="form-group">--}}
{{--                        {{ Form::label('last_date_of_submission') }}--}}
{{--                        {{ Form::text('last_date_of_submission',null,['class' => 'date form-control','rows' => 4]) }}--}}
{{--                        @if($errors->has('last_date_of_submission'))--}}
{{--                            <span class="text-danger red">{{$errors->first('last_date_of_submission')}}</span>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        {{ Form::label('opening_date') }}--}}
{{--                        {{ Form::text('opening_date',null,['class' => 'date form-control','rows' => 4]) }}--}}
{{--                        @if($errors->has('opening_date'))--}}
{{--                            <span class="text-danger red">{{$errors->first('opening_date')}}</span>--}}
{{--                        @endif--}}
{{--                    </div>--}}


{{--                    {{ Form::label('department') }}<br>--}}
{{--                    <select name ="department" class="form-control">--}}
{{--                        @foreach($departmentAll as $department)--}}
{{--                            @if($department->id ==$mySelectedTender[0]->department )--}}
{{--                                <option value="{{$department->id}}" selected="{{$mySelectedTender[0]->department}}">{{$department->name}}</option>--}}
{{--                            @endif--}}
{{--                            <option value="{{$department->id}}">{{$department->name}}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}

{{--                    <div class="form-group">--}}
{{--                        {{ Form::label('subject') }}--}}
{{--                        {{ Form::text('subject',$mySelectedTender[0]->subject,['class' => 'form-control','rows' => 4]) }}--}}
{{--                        @if($errors->has('subject'))--}}
{{--                            <span class="text-danger red">{{$errors->first('subject')}}</span>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        {{ Form::label('detail') }}--}}
{{--                        {{ Form::textarea('detail',$mySelectedTender[0]->detail,['class' => 'form-control','rows' => 4]) }}--}}
{{--                        @if($errors->has('detail'))--}}
{{--                            <span class="text-danger red">{{$errors->first('detail')}}</span>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        {{ Form::label('author') }}--}}
{{--                        {{ Form::text('author',$mySelectedTender[0]->author,['class' => 'form-control','rows' => 4]) }}--}}
{{--                        @if($errors->has('author'))--}}
{{--                            <span class="text-danger red">{{$errors->first('author')}}</span>--}}
{{--                        @endif--}}
{{--                    </div>--}}


{{--                    <div class="field  files form-group" >--}}
{{--                        {{ Form::label('Attachment') }}--}}
{{--                        {{ Form::file('file[]', array('multiple'=>true,'accept'=>'image/*,.pdf,.doc,.docx'))  }}--}}
{{--                        <br />--}}
{{--                        <ul class="fileList"></ul>--}}
{{--                    </div>--}}


{{--                </div>--}}
{{--                <div class="card-footer bg-transparent">--}}
{{--                    <div class="pull-right">--}}
{{--                        <button class="btn btn-primary">Submit</button>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                {!! Form::close() !!}--}}
{{--            </div>--}}
{{--        </div>--}}

{{--    </div>--}}


{{--    <script type="text/javascript">--}}
{{--        $('.date').datepicker({--}}
{{--            format: 'dd-mm-yyyy'--}}
{{--        });--}}

{{--    </script>--}}





{{--@endsection--}}
