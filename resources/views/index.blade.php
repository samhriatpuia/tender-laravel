@extends('layouts/layout')
@section('title','e-Tender')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-9 col-sm-12">

				<div class="border-white rounded-corners bt-5" style="background-color: #2c6ac6;color: white; height: 3em; padding-top: 10px;padding-left: 15px;">Tenders</div>
				<br>

				@if($empty ?? '')
						<div>

							<img  src={{ asset('images/searcherror.svg') }}>

						</div>
				@endif

				@foreach($tenders as $tender)
				<div class="container" style="background-color: white; margin-bottom: 30px; padding-left: 20px">
					<div style="padding-top: 30px;">
						 {{ $tender->tender_number }}
					</div>

					<div >
						@foreach($departments as $dept)

							@if($tender->department==$dept->id)
								 <i style="color: #2c6ac6;">{{ $dept->name }}</i><br>
							@endif
						@endforeach

			            <br>
			            <h3 style="font-size: 25px; ">{{ $tender->subject }}</h3><br>

					</div>

					<div style="padding-bottom: 24px; font-weight: 700px; color: rgba(0,0,0,.7);  text-align: justify; padding-left: 10px; padding-right: 10px;">
						{{$tender->detail }}
					</div>



					<div style="padding-bottom: 20px; padding-left: 10px;">

					<a href="#"   data-toggle="modal" data-target="#download{{$tender->id}}" style="color:rgba(0,0,0,.7);">
					<img src={{ asset('images/download.svg') }} style="height: 2%;width: 2%;margin-right: 8px">
					Download<br>
                    </a>
					</div>


						<!-- Modal Download-->
					<div class="modal fade" id="download{{$tender->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header" style="background-color:#2c6ac6; color:white;">
									<h4 class="modal-title text-center"  id="myModalLabel">Download</h4>

									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>

								</div>
								@include('category.downloadIndex')
							</div>
						</div>
					</div>

					<hr>
						<div class="container" style="padding-bottom: 20px; font-size: 80%;">

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
									echo $dt->format('d-m-Y h:i a');

								?>
								</div>
								<div class="col">Last Date:
									<?php
										$epoch = $tender->last_date_of_submission;
										$dt = new DateTime("@$epoch");
										echo $dt->format('d-m-Y h:i a');
									?>
								</div>
							</div>
						</div>

				</div>

					@endforeach



			</div>





			<div class="col-md-3 col-sm-12 container">
				<div class="border-white rounded-corners bt-5" style="background-color: #2c6ac6;color: white; height: 3em; padding-top: 10px;padding-left: 15px;">Filters</div>
				<br>

				<div style="background-color: white; padding-bottom:25px;">
					<div style="padding-top: 22px;">
						<div class="container">


		 				{!! Form::open(['route' => ['index.filterByAllCombination'],'method'=>"GET"]) !!}

						{{ Form::text('search_keyword',null,['class' => 'form-control','rows' => 4,'placeholder'=>'Search by keyword']) }}



					    </div>
					</div>
				</div>


				<div style="background-color: white; padding-bottom:15px;">
					<div >
						<div class="container" style="padding-bottom:11px;">
					        <select name="validity" class="form-control custom-select" style="margin-bottom: 5px;">

								<option value="3">All Tenders</option>
					            <option value="1">Valid</option>
					            <option value="2">Invalid</option>

					        </select>

					        <select name ="department" class="form-control custom-select" style="margin-bottom: 5px;">
					            <option value="0">All Department</option>
					            @foreach($departments as $department)
					                <option value="{{$department->id}}">{{$department->name}}</option>
					            @endforeach
					        </select>

					    </div>
					</div>

				    <h4 style="padding-left: 17px;"></h4>
				    <div class="container " >
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


   <div class="paginator">
				{{ $tenders->appends($_GET)->onEachSide(1)->links() }}
		</div>



    </div>


@endsection
