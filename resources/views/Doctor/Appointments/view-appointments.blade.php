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

	</div>

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
							<th>Name</th>
							<th>No, Date & Time</th>
                            <th>Status</th>
							<th>Action</th>
						</thead>

					</table>
				</div>
			</div>
		</div>

	</div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

<script type="text/javascript">
  $(function () {

    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('appointments.index') }}",
        columns: [
            {data: 'reference_no', name: 'reference_no'},
            {data: 'name', name: 'name'},
            {data: 'session_datetimestamp', name: 'session_datetimestamp', orderable: true},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

  });
</script>
@endpush

</x-app-layout>
