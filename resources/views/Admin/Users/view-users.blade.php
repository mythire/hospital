<x-app-layout>

	@section('heading','All Users')
	
	<div class="card shadow-sm mb-5">
	    <div class="card-body">
	    	<div class="button-group d-flex justify-content-end" >
		    	<a class="btn btn-primary" href="{{route('users.create')}}">Add User</a>
		    </div>  
		    <div class="table-responsive">
		        <table class="table app-table-hover mb-0 text-left">
					<thead>
						<tr>
							<th>Role</th>
							<th>Name</th>
							<th>Email</th>
							<th>Joined at</th>												
							<th></th>
						</tr>
					</thead>
					<tbody>
						@forelse($users as $user)
						<tr> 
							<td class="cell">{{$user->roles->pluck('name')[0]}}</td>
							<td class="cell">
								{{$user->first_name}} {{$user->last_name}}

								@if($user->roles->pluck('name')[0] == 'Doctor' && $user->hasPermissionTo('Chief Doctor'))
									<b>(Chief Doctor)</b>
								@endif
							</td>							
							<td class="cell">{{$user->email}}</td>	
							<td class="cell">{{ \Carbon\Carbon::parse($user->created_at)->toDateTimeString()  }}</td>		
							<td class="cell">
								<div class="button-group">
									<a href="{{route('users.show', ['user' => $user->id])}}" class="btn btn-primary "><i class="lni lni-eye"></i></a>
									<a class="btn  btn-info" href="{{route('users.edit', ['user' => $user->id])}}"><i class="lni lni-pencil-alt"></i></a>
								</div>
							</td>

						</tr>
						@empty
						<tr>
							<span>No Doctors found</span>
						</tr>
						@endforelse											
	
					</tbody>
				</table>
	        </div><!--//table-responsive-->
	        {{ $users->links() }}
	       
	       
	    </div><!--//app-card-body-->		
	</div><!--//app-card-->

	
	

</x-app-layout>	
