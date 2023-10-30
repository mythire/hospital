<x-app-layout>



	<h1 class="app-page-title">Create Doctor</h1>
	<hr class="mb-4">

	<form method="POST" action="{{route('doctors.store')}}">
		@csrf
		<div class="row g-4 settings-section">
		    <div class="col-12 col-md-4">
		        <h3 class="section-title">User Account Creation</h3>
		        <div class="section-intro">A User account will be generated for the doctor with autogenerated password</div>
		    </div>


		    <div class="col-12 col-md-8">
		        <div class="app-card app-card-settings shadow-sm p-4">

				    <div class="app-card-body">
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
				    </div><!--//app-card-body-->

				</div><!--//app-card-->
		    </div>

		    <div class="col-12 col-md-4">
		        <h3 class="section-title">General Details</h3>
		        <div class="section-intro">General details of the doctor</div>
		    </div>
		    <div class="col-12 col-md-8">
		        <div class="app-card app-card-settings shadow-sm p-4">

				    <div class="app-card-body">
							<div class="mb-3">
							    <label class="form-label">Speciality</label>
							    <select class="form-control @error('speciality') is-invalid  @enderror" name="speciality" id="speciality">
							    	@foreach($specialities as $speciality)
							    	<option value="{{$speciality}}">{{$speciality}}</option>
							    	@endforeach
							    </select>
							    @error('speciality')
							    <div class="invalid-feedback">{{$message}}</div>
							    @enderror
							</div>

							<div class="mb-3">
							    <label class="form-label">Fees (Enter in Sri Lankan Rupees)</label>
							    <input type="text" name="fees" class="form-control @error('fees') is-invalid  @enderror">
							    @error('fees')
							    <div class="invalid-feedback">{{$message}}</div>
							    @enderror
							</div>

							<button type="submit" class="btn app-btn-primary">Save Changes</button>
				    </div><!--//app-card-body-->

				</div><!--//app-card-->
		    </div>

    	</div>
    </form>

    @push('scripts')
    <script type="text/javascript">
    	$(document).ready(function() {
		    $('#speciality').select2({
		    	tags: true
		    });
		});
    </script>
    @endpush

</x-app-layout>
