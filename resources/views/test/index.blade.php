@extends('layouts.layout')
@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                TEST LIST
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <th>#</th>
                        <th>Phone No</th>
                        <th>Name</th>
                        <th>Body</th>
                        <th>Control</th>
                    </thead>
                    @foreach($testAll as $test)
                    <tr>
                        <td>{{ $index++ }}</td>
                        <td>{{ $test->phone_no }}</td>
                        <td>{{ $test->name }}</td>
                        <td>{{ $test->body }}</td>
                        <td>
							 {!! Form::open(array('url'=>route('tests.destroy', array($test->id)),'method'=>'delete')) !!}
			                	<a href="{{ route('tests.edit',$test->id) }}" class="btn btn-success btn-xs"><i class="fa fa-edit" data-content="Add customers to your feed"></i></a>
				               	<button class="btn btn-danger btn-xs" type="submit" onclick="return confirm ('<?php echo ('Are you sure') ?>');"><i class="fa fa-trash"></i></button>
                             {!!Form::close() !!}
						</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                Add
            </div>
            <div class="card-body">
                {!! Form::open(['route' => ['tests.store'],'files' => 'true']) !!}

                    <div class="form-group">
                        {{ Form::label('phone_no') }}
                        {{ Form::text('phone_no',null,['class' => 'form-control','rows' => 4]) }}
                        @if($errors->has('phone_no'))
                            <span class="text-danger red">{{$errors->first('phone_no')}}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        {{ Form::label('Name') }}
                        {{ Form::text('name',null,['class' => 'form-control','rows' => 4]) }}
                        @if($errors->has('name'))
                            <span class="text-danger red">{{$errors->first('name')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        {{ Form::label('Body') }}
                        {{ Form::textarea('body',null,['class' => 'form-control','rows' => 4]) }}
                        @if($errors->has('body'))
                            <span class="text-danger red">{{$errors->first('body')}}</span>
                        @endif
                    </div>


            </div>
            <div class="card-footer bg-transparent">
                <div class="pull-right">
                    <button class="btn btn-primary">Submit</button>
                </div>
            </div>
            {!! Form::close() !!}

        </div>
    </div>
</div>
@stop
