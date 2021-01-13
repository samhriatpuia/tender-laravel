@extends('layouts.layout')
@section('title','User List')

@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" type="text/css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <div >
        <div >
            <div >
                <!-- <div class="border-white rounded-top bt-5 container" style="background-color: #2c6ac6;color: white; height: 3em; padding-top: 10px;padding-left: 15px;">User List</div> -->
                <br>
                <div class="container table-responsive">


                <p>Type keywords in the input field to search:</p>  
<input id="myInput" type="text" placeholder="Search..">
<br><br>
                    <table class="table " id="datatable">
                        <thead style="background-color: #2c6ac6; color: white;">
                            <tr>
                                <th scope="col"  width="5%">Id</th>
                                <th scope="col" width="20%">Name</th>
                                <th scope="col">Email</th>
                                <!-- <th scope="col" width="23%">Password</th> -->
                                <th scope="col" width="35%">Department</th>
                                <th scope="col" width="15%">Role</th>
                                <th scope="col" width="20%">Action</th>
                                <th scope="col" style="text-align: center;" width="15%">Change Password</th>
                            </tr>


                        </thead>
                        <tbody id="myTable">
                        @foreach($userList as $user)
                            <tr class="table-light">
                                <td scope="row">{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}
                                <!-- <td>{{ $user->password }}</td> -->
                                @php
                                 {{      
                                         $user1 = $user;
                                        $departmentName = $user1->departmentCon();

                                        $roleName = $user1->roleScan();

                                 }}
                                @endphp

                                <td>{{ $departmentName }}</td>
                                <td>{{ $roleName }}</td>
                                <td>

                                <!-- {!! Form::open(array('url'=>route('userList.destroy', array($user1->id)),'method'=>'delete')) !!} -->

                                <!-- <a href="{{ route('userList.update',$user->id) }}" class="btn btn-primary"> 
                                <i class="fa fa-edit" data-content="Add customers to your feed" ></i></a> -->

                                <a class="" data-userid={{$user->id}} data-myname="{{$user->name}}" data-myrole={{$roleName}}   data-myemail={{$user->email}} data-toggle="modal" data-target="#edit"><img src={{ asset('images/001-edit.svg') }} class="line-close" style="height: 18%;width: 18%"></a>

                                <a class="" data-userid={{$user->id}} data-toggle="modal" data-target="#delete"><img src={{ asset('images/001-delete.svg') }} class="line-close" style="height: 18%;width: 18%;margin-left: 10px;"></a>

<!-- 
                                <a href="/userList/{{$user->id}}"   class="D-E-D tenderEdtDel" style="margin-top: 20px;">
						
                                        <img  src="@{/images/002-delete.svg}">Delete
                                    </a> -->

                                <!-- <button class="btn btn-danger" type="submit" onclick="return confirm ('<?php echo ('Are you sure you want to delete this user') ?>');"><i class="fa fa-trash"></i></button> -->

                                <!-- {!!Form::close() !!} -->
                                </td>
                                <td style="text-align: center;">
                                <a class="" data-userid={{$user->id}} data-password={{$user->password}} data-toggle="modal" data-target="#changePassword">
                                    <img src={{ asset('images/resetpass.svg') }} class="line-close" style="height: 25%;width: 25%">
                                </a>

                                </td>

                                
                                
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="paginator container">

                    {{ $userList->appends($_GET)->onEachSide(1)->links() }}

                </div>
            </div>
        </div>

    </div>

	

<!-- Modal Edit-->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title" id="myModalLabel">Edit Category</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        
      </div>
      <form action="{{route('userList.update','array($user->id)')}}" method="POST" id="edit1">
      		{{method_field('PUT')}}
      		{{csrf_field()}}
	      <div class="modal-body">
	      		<input type="hidden" name="id" id="myid" value="">
				@include('category.userListUpdate')
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Save Changes</button>
	      </div>
      </form>
    </div>
  </div>
</div>




<!-- Modal Delete-->
<div class="modal modal-danger fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title text-center" id="myModalLabel">Delete Confirmation</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        
      </div>
      <form action="{{route('userList.destroy',array($user->id))}}" method="post">
      		{{method_field('delete')}}
      		{{csrf_field()}}
	      <div class="modal-body">
				<p class="text-center">
					Are you sure you want to delete this user?
				</p>
	      		<input type="hidden" name="id" id="myid" value="">

	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
	        <button type="submit" class="btn btn-danger">Delete</button>
	      </div>
      </form>
    </div>
  </div>
</div>





<!-- Modal Change Password-->
<div class="modal modal-danger fade" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title text-center" id="myModalLabel">Change Password</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        
      </div>
      <form action="{{route('userList.changePassword',array($user->id))}}" method="post">
      {{method_field('PUT')}}
      		{{csrf_field()}}
	      <div class="modal-body">
				<!-- <p class="text-center">
					Enter Passsword for the Department User!
				</p> -->
	      		<input type="hidden" name="id" id="myid" value="">

            @include('category.changePassAdmin')

	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
	        <button type="submit" class="btn btn-warning">Change</button>
	      </div>
      </form>
    </div>
  </div>
</div>















   <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
   <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>



<script type="text/javascript">

	
    </script>

@stop
