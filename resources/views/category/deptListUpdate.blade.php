<div class="form-group">
		        	<label for="Deptname">Department Name:</label>
		        	<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="mydepartmentname">
					@error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
	        	</div>

	        	<!-- <div class="form-group">
	        		<label for="des">Password</label>
	        		<input type="password" name="email" id="password" cols="20" rows="5" class="form-control">
	        	</div> -->

				<div class="form-group">
                            <label for="parent">{{ __('Parent Department:') }}</label>

                             
                                    <select name = "parent" class="form-control" id="myparent">

                    
                                  
                                        @foreach($departmentList1 as $department)
                                            <option value="{{$department->id}}">{{$department->name}}</option>
                                        @endforeach
                                            <option value=0>No Parent</option>
                                    </select>
                                
                       </div>


			

				