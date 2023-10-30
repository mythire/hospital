<x-app-layout>

	@section('heading','Create User')

		<div class="row g-4 ">		  
		    <div class="col-lg-5 col-md-8">
		        <div class="card shadow-sm p-4">
				    
				    <div class="card-body">	
				    	<h5 class="card-title">User Account Creation</h5>
				    	<p class="mb-2">A User account will be generated for the user with autogenerated password</p>

				    	<form method="POST" action="{{route('users.store')}}">
						@csrf		    
							<div class="mb-3">
							    <label class="form-label">First Name</label>
							    <input type="text" class="form-control @error('first_name') is-invalid  @enderror" name="first_name">
							    @error('first_name')
							    <div class="invalid-feedback">{{$message}}</div>
							    @enderror
							</div>
							<div class="mb-3">
							    <label  class="form-label">Last Name</label>
							    <input type="text" class="form-control @error('last_name') is-invalid  @enderror" name="last_name">
							    @error('last_name')
							    <div class="invalid-feedback">{{$message}}</div>
							    @enderror
							</div>
							<div class="mb-3">
							    <label class="form-label">Email Address</label>
							    <input type="email" class="form-control @error('email') is-invalid  @enderror" name="email">
							    @error('email')
							    <div class="invalid-feedback">{{$message}}</div>
							    @enderror
							</div>
							<div class="mb-3">
							    <label class="form-label">User Role</label>
							    <select class="form-control @error('role') is-invalid @enderror" name="role">
							    	<option disabled selected>Select</option>
							    	@foreach($roles as $role)
							    	<option>{{$role}}</option>
							    	@endforeach
							    </select>
							    @error('role')
							    <div class="invalid-feedback">{{$message}}</div>
							    @enderror
							</div>

							<button class="btn btn-primary text-white" type="submit">Create Account</button>

						</form>  

				    </div><!--//app-card-body-->
				    
				</div><!--//app-card-->
		    </div>

    	</div>
    

</x-app-layout>	