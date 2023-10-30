<x-app-layout>

	@push('css')
	 <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">

	@endpush

	@section('heading', 'Appointments')



	    @if(Session::has('status'))
	    <div class="alert alert-success">
	    	{{Session::get('status')}}
	    </div>

	    @endif


	{!! Breadcrumbs::render('appointments.index') !!}

	<div class="row">
		<div class="col-lg-12">
			<div class="card shadow-sm">
				<div class="card-header">
					<h6 class="card-title mt-2">Your Appointments</h6>
				</div>
				<div class="card-body">
					<table class="table table-responsive table-bordered data-table">
						<thead>
							<th>Reference No</th>
                            <th>Doctor</th>
							<th>Patient Name & Address</th>
							<th>No, Date & Time</th>
                            <th>Status</th>
						</thead>
                        <tbody>
                        @foreach($appointments as $appointment)
                            <tr>
                                <td>{{$appointment->reference_no}}</td>
                                <td>{{$appointment->viewDoctor->saluation}} {{ $appointment->viewDoctor->user->first_name }} {{ $appointment->viewDoctor->user->last_name }}</td>
                                <td>{{$appointment->name}} - {{ $appointment->address }}</td>
                                <td>{{ \Carbon\Carbon::parse($appointment->session_datetimestamp)->toDateTimeString() }}</td>
                                <td>{{$appointment->status}}</td>
                            </tr>
                        @endforeach
                        </tbody>

					</table>
				</div>
			</div>
		</div>

	</div>

</x-app-layout>
