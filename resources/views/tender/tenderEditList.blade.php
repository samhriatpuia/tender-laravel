@extends('layouts.layout')
@section('title','Tender List')

@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" type="text/css">



                <div class="container table-responsive rounded-corners">
                    <div class="row">
                                    <div>
                                        @if($empty ?? '')
                                                <div>

                                                    <img  src={{ asset('images/searcherror.svg') }}>

                                                </div>
                                        @endif
                                    </div>

        <div class="limiter">
		<div class="container-table100">
			<div class="wrap-table100">
					<div class="tableT">

						<div class="rowT headerT">
							<div class="cellT">
								Sl No.
							</div>
							<div class="cellT">
								 Subject
							</div>
							<div class="cellT">
								Department
							</div>
							<div class="cellT">
								Issue Date
							</div>
							<div class="cellT">
								Actions
							</div>
						</div>
						<?php
                            $n=1+$tenderAll->perPage() * ($tenderAll->currentPage() -1);
                        ?>

                        @foreach($tenderAll as $key=> $tender)
						<div class="rowT">

							<div class="cellT" data-title="Name">
								<?php
                                     echo $n++;
                                ?>


							</div>
							<div class="cellT" data-title="Subscription">
								{{ $tender->subject }}
							</div>
							<div class="cellT" data-title="Phone">
								{{ $tender->departmentName }}
							</div>

							<div class="cellT" data-title="Email">
								<?php
                                    $epoch = $tender->issue_date;
                                    $dt = new DateTime("@$epoch");
                                    echo $dt->format('d-m-Y');
                                ?>
							</div>
							<div class="cellT" data-title="Action">

                                <a href="{{ route('indexedit.edit',$tender ->id) }}">
                                	<img src={{ asset('images/001-edit.svg') }}  style="height: 23px;width: 23px">
                                </a>

                                <a class="" data-tenderid={{$tender->id}} data-toggle="modal" data-target="#delete1{{$tender->id}}"><img src={{ asset('images/001-delete.svg') }} class="line-close" style="height: 30%;width: 30%;margin-left: 10px;"></a>


							</div>




						</div>


                        <!-- Modal Delete-->
<div class="modal modal-danger fade" id="delete1{{$tender->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title text-center" id="myModalLabel">Delete Confirmation</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

      </div>
      <form action="{{route('indexedit.destroy',array($tender->id))}}" method="post">
      		{{method_field('delete')}}
      		{{csrf_field()}}
	      <div class="modal-body">
				<p class="text-center">
					Are you sure you want to delete this Tender?
				</p>
	      		<input type="hidden" name="id" id="myid1" value="">

	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
	        <button type="submit" class="btn btn-danger">Delete</button>
	      </div>
      </form>
    </div>
  </div>
</div>


						 @endforeach

					</div>
			</div>
		</div>
	</div>



                                    <!-- FILTER START -->

                                    <div class="col-md-3 col-sm-12" style=" padding-top:10px; ">
                                        <div class="border-white rounded-corners bt-5" style="background-color: #2c6ac6;color: white; height: 3em; padding-top: 10px;padding-left: 15px;">Filters</div>

                                        <div style="background-color: white; padding-bottom:7px;">
                                            <div style="padding-top: 22px;">
                                                <div class="container">
                                                {!! Form::open(['route' => ['indexedit.filterByAllCombination'],'method'=>"GET"]) !!}
                                                {{ Form::text('search_keyword',null,['class' => 'form-control','rows' => 4,'placeholder'=>'Search by keyword']) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div style="background-color: white; padding-bottom:15px;">
                                            <div style="padding-top: 22px;">
                                                <div class="container">
                                                    <select name="validity" class="form-control custom-select" style="margin-bottom: 5px;">
                                                        <option value="3">All Tenders</option>
                                                        <option value="1">Valid</option>
                                                        <option value="2">Invalid</option>
                                                    </select>


                                                   @if (Auth::user()->role_id==1)
                                                  <select name ="department" class="form-control custom-select" style="margin-bottom: 5px;">
                                                        <option value="0">All Department</option>
                                                        @foreach($departments as $department)
                                                            <option value="{{$department->id}}">{{$department->name}}</option>
                                                        @endforeach
                                                    </select>
                                                @endif
                                                </div>
                                            </div>
                                       <!--  </div>
                                        <div style="background-color: white; padding-bottom:15px;"> -->
                                            <h4 style="padding-left: 17px;"></h4>
                                            <div class="container mt-3 pt-2" >
                                                <select name="dateRange" class="form-control custom-select" style="margin-bottom: 5px;">
                                                    <option selected>Filter by time</option>
                                                        <option value="1">Past 30 days</option>
                                                        <option value="2">Last 3 months</option>
                                                        <option value="3">Last 6 months</option>
                                                        <option value="4">This year</option>
                                                        <option value="5">Last 3 years</option>
                                                </select>
                                                <select name="order" class="form-control custom-select" style="margin-bottom: 5px;">
                                                    <option value="1">Latest first</option>
                                                    <option value="2">Oldest first</option>
                                                </select>
                                                <div>
                                                    <div>
                                                        <br>
                                                        <button class="btn btn-primary btn-block" style="background-color: #05B18B;border:none;">Search</button>
                                                    </div>
                                                </div>
                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>

                                    <!-- FILTER ENDS -->


                    </div>
                </div>
                <div class="paginator container">

                    {{ $tenderAll->appends($_GET)->onEachSide(1)->links() }}

                </div>






@stop
