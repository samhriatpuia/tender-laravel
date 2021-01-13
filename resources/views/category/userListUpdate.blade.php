<div class="form-group">
		        	<label for="name">User Name</label>
		        	<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name">
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
	        		<label for="des">Email</label>
	        		<input type="text" name="email" id="email" cols="20" rows="5" class="form-control @error('email') is-invalid @enderror">

					@error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
	        	</div>


			

				