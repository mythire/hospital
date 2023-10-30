<x-app-layout>


		@section('heading', 'All Doctors')

		@push('css')
		 <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">

		@endpush

	    @if(Session::has('status'))
	    <div class="alert alert-success">
	    	{{Session::get('status')}}
	    </div>

	    @endif


	<div class="card">
	    <div class="card-body">
		    <div class="table-responsive">
		        <table class="table table-lg table-striped data-table">
					<thead>
						<tr class="text-uppercase">
							<th >Name</th>
							<th >Speciality</th>
							<th >Day</th>
							<th >Time</th>
							<th >Fees</th>
							<th ></th>
						</tr>
					</thead>
					<tbody>

					</tbody>
				</table>
	        </div><!--//table-responsive-->
	    </div><!--//app-card-body-->
	</div><!--//app-card-->

	@push('modals')
	<div class="modal" id="delete-doctor">
	  <div class="modal-dialog">
	    <div class="modal-content">

	      <div class="modal-header">
	        <h4 class="modal-title">Delete Doctor</h4>
	        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
	      </div>

	      <div class="modal-body">
	      	<form method="POST" action="{{ route('doctors.destroy', 'id')}}">
	      		@csrf
	      		@method('DELETE')

		        <h6 id="delete-doctor-name"></h6>
		        <div class="alert alert-danger">
		        	By deleting the doctor, doctor sessions and appointments related will also be deleted
		        </div>
		        <input id="id" name="id" hidden value="">

		       	<div class="button-group text-right mt-3">
		       		<button type="button" class="btn btn-primary text-white" data-bs-dismiss="modal">Close</button>
	        		<button type="submit" class="btn btn-danger text-white ">Delete Doctor</button>
		       	</div>
	        </form>
	      </div>
	    </div>
	  </div>
	</div>
	@endpush

	@push('scripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
	<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

	<script>

	   	$(function () {

		  var table = $('.data-table').DataTable({
		      processing: true,
		      serverSide: true,
		      ajax: "{{ route('doctors.index') }}",
		      columns: [
		          {data: 'name', name: 'name'},
		          {data: 'speciality', name: 'speciality'},
		          {data: 'day', name: 'day'},
		          {data: 'time', name: 'time', searchable: false},
		          {data: 'fees', name: 'fees', searchable: false},
		          {data: 'action', name: 'action', orderable: false, searchable: false},
		      ]
		  });

		});

		$('body').on('click', '.deleteDoctor', function () {

	        var id = $(this).data("id");
	        $('#delete-doctor').modal('show');
	        $('#delete-doctor-name').text("Are you sure want to delete " + $(this).data('firstname') + "'s profile? Proceed with caution!");
	        $('#id').val(id);
	        // confirm("Are You sure want to delete this Post!");


	    });


	</script>
	@endpush


</x-app-layout>
