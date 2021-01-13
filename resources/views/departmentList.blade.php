@extends('layouts.layout')
@section('title','Department List')

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
                                <th scope="col">Id</th>
                                <th scope="col"> Name</th>
                                <!-- <th scope="col" width="23%">Password</th> -->
                                <th scope="col" width="15%">Parent ID</th>
                        
                                <th scope="col" width="13%">  Action</th>
                              
                            </tr>


                        </thead>
                        <tbody id="myTable">
                        @foreach($departmentList as $department)
                            <tr class="table-light">
                                <td scope="row">{{ $department->id }}</td>
                                <td>{{ $department->name }}</td>
                                <td>{{ $department->parent}}</td>
                            <td>
                                <a class="" data-departmentid={{$department->id}} data-departmentname="{{$department->name}}"  data-parent={{$department->parent}} data-toggle="modal" data-target="#editDept"><img src={{ asset('images/001-edit.svg') }} class="line-close" style="height: 18%;width: 18%"></a>

                                <a class="" data-departmentid={{$department->id}} data-toggle="modal" data-target="#deleteDept"><img src={{ asset('images/001-delete.svg') }} class="line-close" style="height: 18%;width: 18%;margin-left: 10px;"></a>

                            </td>          
                            </tr>


<!-- Modal Delete-->
<div class="modal modal-danger fade" id="deleteDept" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title text-center" id="myModalLabel">Delete Confirmation</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        
      </div>
      <form action="{{route('deptList.destroy',array($department->id))}}" method="post">
      		{{method_field('delete')}}
      		{{csrf_field()}}
	      <div class="modal-body">
				<p class="text-center">
					Are you sure you want to delete this user?
				</p>
	      		<input type="hidden" name="id" id="mydepartmentid" value="">

	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
	        <button type="submit" class="btn btn-danger">Delete</button>
	      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Edit-->
<div class="modal fade" id="editDept" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title" id="myModalLabel">Edit Category</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        
      </div>
      <form action="{{route('deptList.update',array($department->id))}}" method="POST" >
      		{{method_field('PUT')}}
      		{{csrf_field()}}
	      <div class="modal-body">
	      		<input type="hidden" name="id" id="mydepartmentid" value="">
				@include('category.deptListUpdate')
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Save Changes</button>
	      </div>
      </form>
    </div>
  </div>
</div>


                        @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="paginator container">

                    {{ $departmentList->appends($_GET)->onEachSide(1)->links() }}

                </div>
            </div>
        </div>

    </div>

	

   <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
   <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>



<script type="text/javascript">

	
    </script>

@stop
