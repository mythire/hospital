<x-app-layout>

	@push('styles')
	 <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">

	@endpush

	@section('heading', 'Appointment Details')


	<div class="row">
		<div class="col-lg-8">
			<div class="card shadow-sm">
				<div class="card-body">
					<div class="row g-2 justify-content-center  align-items-center mb-3">
					    <div class="col-auto">
						    @if($appointment->status == 'Started')
							   <p class="text-primary text-uppercase"><strong>Ongoing Appointment</strong></p>
							@endif
					    </div>
				    </div><!--//row-->

					<div class="table-responsive">
						<table class="table  table-bordered w-100">
							<tbody>
								<tr>
									<th>Reference No</th>
									<td><strong>{{ $appointment->reference_no }}</strong></td>
								</tr>
								<tr>
									<th>Session Time and Date</th>
									<td>{{ \Carbon\Carbon::parse($appointment->session_datetimestamp)->toDateTimeString() }}</td>
								</tr>
								<tr>
									<th>Display Name</th>
									<td>{{ $appointment->name }}</td>
								</tr>

								<tr>
									<th>Address</th>
									<td>{{ $appointment->address }}</td>
								</tr>


								<tr>
									<th>Status</th>
									<td>
										@livewire('doctor.update-appointment-status', ['appointment_id' => $appointment->reference_no])
									</td>
								</tr>
							</tbody>
						</table>
					</div>

				</div>
			</div>

		</div>



	</div>

@push('scripts')


@endpush

</x-app-layout>
