<x-app-layout>


	@section('heading', 'User Details')
	   

	<div class="row">
		<div class="col-lg-6">
			<div class="card shadow-sm">
				<div class="card-body">
					<div class="button-group d-flex justify-content-end" >
				    	<a class="btn btn-primary" href="{{route('users.edit', ['user' => $user->id])}}">
						    Edit User
						</a>
				    </div>  
					<h6>Doctor Details</h6>
					<div class="table-responsive mt-2">
				        <table class="table app-table-hover mb-0 text-left">
							<tbody>
								<tr> 
									<th class="cell">Role</th>
									<td class="cell">{{$user->roles->pluck('name')[0]}}</td>					
								</tr>
								@if($user->roles->pluck('name')[0] == 'Doctor' && $user->hasPermissionTo('Chief Doctor'))
								<tr> 
									<th class="cell">Doctor Role</th>
									<td class="cell">Chief Doctor</td>					
								</tr>
								@endif
								<tr> 
									<th class="cell">Name</th>
									<td class="cell">{{$user->first_name}} {{$user->last_name}}</td>					
								</tr>
								<tr> 
									<th class="cell">Email</th>
									<td class="cell"><a href="mailto:{{$user->email}}" class="text-primary">{{$user->email}}</a></td>	
								</tr>
								<tr>
									<th>Joined At</th>
									<td class="cell">{{ \Carbon\Carbon::parse($user->created_at)->toDateTimeString()  }}</td>		
								</tr>								
														
							</tbody>
						</table>
			        </div>
				</div>
			</div>			
		</div>
		
	</div>


</x-app-layout>	
