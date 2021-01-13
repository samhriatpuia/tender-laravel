@extends('layouts/layout')

@section('content')

    <h1>Index Page</h1>

{{--    <a href="{{ route('temp.show',1) }}">Show Valid</a> <br>--}}
{{--    <a href="{{ route('temp.show',2) }}">Show InValid</a> <br>--}}
{{--    <a href="{{ route('temp.show',3) }}">Show All</a><br>--}}


    <div class="card-body">

        {!! Form::open(['route' => ['indextest.filters'],'method'=>"GET"]) !!}

        <select name="validity" class="form-control">
            <option value="">Status</option>
            <option value="1">Valid</option>
            <option value="2">Invalid</option>
            <option value="3">All Tenders</option>
        </select>

        <select name ="department" class="form-control">
                <option value="0">All Department</option>
            @foreach($departments as $department)
                <option value="{{$department->id}}">{{$department->name}}</option>
            @endforeach
        </select>

        <div class="card-footer bg-transparent">
            <div class="pull-right">
                <button class="btn btn-primary">Submit</button>
            </div>
        </div>
    {!! Form::close() !!}
    </div>
 <br>



    Filter by date
    <div class="card-body">
        {!! Form::open(['route' => ['indextest.filterByDate'],'method'=>"GET"]) !!}
        <select name="dateRange" class="form-control">
            <option value="">Filter by date...</option>
            <option value="1">Pass 30 days</option>
            <option value="2">Last 3 months</option>
            <option value="3">Last 6 months</option>
            <option value="4">This year</option>
            <option value="5">Last 3 years</option>
        </select>
        <select name="order" class="form-control">
            <option value="1">Newest first</option>
            <option value="2">Oldest first</option>
        </select>
        <div class="card-footer bg-transparent">
            <div class="pull-right">
                <button class="btn btn-primary">Submit</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    <div class="container">
        @foreach($tenders as $tender)
            <div class="card">
                <div class="card-header">
                    Tender Number: {{ $tender->tender_number }}
                </div>

                <div class="card-body">
                    <h5 class="card-title">
                        <div class="container">
                            Subject: {{ $tender->subject }}
                            <br>
                            @foreach($departments as $dept)
                                @if($tender->department==$dept->id)
                                    Department Name: {{ $dept->name }}
                                @endif
                            @endforeach
                        </div>
                    </h5>

                    <p class="card-text">{{$tender->detail }}</p>
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                Issue date:
                                <?php
                                $epoch = $tender->issue_date;
                                $dt = new DateTime("@$epoch");
                                echo $dt->format('d-m-Y');
                                ?>
                            </div>

                            <div class="col">
                                Opening Date:
                                <?php
                                $epoch = $tender->opening_date;
                                $dt = new DateTime("@$epoch");
                                echo $dt->format('d-m-Y');
                                ?>
                            </div>

                            <div class="col">Last Date:
                                <?php
                                $epoch = $tender->last_date_of_submission;
                                $dt = new DateTime("@$epoch");
                                echo $dt->format('d-m-Y');
                                ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <br>
        @endforeach
    </div>

    {{ $tenders->appends($_GET)->links() }}
{{--    {{ $tenders->appends(['filters' => Request::get('page')])->links() }}--}}

@endsection
