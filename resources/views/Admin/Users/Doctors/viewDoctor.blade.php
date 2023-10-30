<x-app-layout>


	@section('heading', 'Doctor Details')



	    @if(Session::has('status'))
	    <div class="alert alert-success">
	    	{{Session::get('status')}}
	    </div>

	    @endif



	<div class="row">
		<div class="col-lg-6">
			<div class="accordion" id="doctor-details">
				<div class="accordion-item bg-white">
					<h2 class="accordion-header" id="general">
					  	<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
					    Doctor Details
					  	</button>
					</h2>
				  	<div id="collapseOne" class="accordion-collapse collapse " aria-labelledby="general" data-bs-parent="#doctor-details">
				    	<div class="accordion-body">
				      		<table class="table table-responsive">
								<tbody>
									<tr>
										<th class="cell">Name</th>
										<td class="cell">{{$doctor->doctor->saluation ?? 'Not Updated'}} {{$doctor->first_name}} {{$doctor->last_name}}</td>
									</tr>
									<tr>
										<th class="cell">Speciality</th>
										<td class="cell"><b>{{$doctor->doctor->speciality ?? 'Not Updated'}}</b></td>
									</tr>
									<tr>
										<th class="cell">Day</th>
										<td class="cell">{{$doctor->doctor->day ?? 'Not Updated'}}</td>
									</tr>
                                    <tr>
                                        <th class="cell">Time</th>
                                        <td class="cell">{{ \Carbon\Carbon::parse($doctor->doctor->time)->format('h:i') ?? 'Not Updated'}}</td>
                                    </tr>
									<tr>
										<th class="cell">Fees</th>
										<td class="cell">{{$doctor->doctor->fees ?? 'Not Updated'}} LKR</td>
									</tr>
									<tr>
										<th class="cell">Joined</th>
										<td class="cell">{{\Carbon\Carbon::parse($doctor->created_at)->diffForHumans()}}</td>
									</tr>
								</tbody>
							</table>
				    	</div>
				  	</div>
				</div>
			</div>


			<div class="card shadow-sm mt-3">
				<div class="card-body">
					<h6 class="card-title">Appointments</h6>
					<div class="table-responsive mt-2">
				        <table class="table app-table-hover mb-0 text-left">
							<thead>
								<th>Date</th>
								<th>No of Appointments</th>
							</thead>
							<tbody>
								@isset($appointments)
									@foreach($appointments as $date => $appointment)
										<tr>
											<td>{{ $date }}</td>
											<td>{{$appointment->count()}}</td>
										</tr>
									@endforeach
								@endisset
							</tbody>
						</table>
			        </div>

				</div>
			</div>
		</div>

	</div>


</x-app-layout>
