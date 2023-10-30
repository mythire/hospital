<x-app-layout>

    @push('css')
     <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
     <link rel="stylesheet" href="{{asset('/css/dashboard/pages/simple-datatables.css')}}">
    @endpush


                @section('heading', 'Dashboard')
                {!! Breadcrumbs::render('dashboard') !!}

@role('Admin')
    <section class="row">
        <div class="col-12 col-lg-9">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon purple">
                                        <i class="iconly-boldShow"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Total Doctors</h6>
                                    <h6 class="font-extrabold mb-0">{{$doctor_count}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon green">
                                        <i class="iconly-boldAdd-User"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Weekly Appointments</h6>
                                    <h6 class="font-extrabold mb-0">{{$weekly_appointment_count}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>
    @endrole

                @role('Member')

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card  shadow-sm">
                            <div class="card-body p-3 border-bottom-0">
                                <h4 class="card-title">My Appointments</h4>

                                @forelse($appointments as $appointment)
                                <div class="card shadow-lg">

                                        <div class="card-body">
                                            <div class="card-title"><strong>{{$appointment->viewDoctor->saluation}} {{$appointment->viewDoctor->user->first_name}} {{$appointment->viewDoctor->user->last_name}}</strong> ({{$appointment->viewDoctor->speciality}})</div>
                                            <p>
                                                Patient Name: {{$appointment->display_name}} <br>
                                                Reference No: <strong>{{$appointment->reference_no}}</strong> <br>
                                                Appointment: No {{$appointment->appointment_metadata['appointment_no']}} on {{\Carbon\Carbon::parse($appointment->session_datetimestamp)->format('d/m/Y')}} at {{\Carbon\Carbon::parse($appointment->appointment_metadata['appointment_time'])->format('h:i A') }} <br>
                                                Clinic: {{$appointment->viewDoctorSession->clinic->name}}
                                            </p>
                                             <div class="button-group" role="group" >
                                                <a class=" btn btn-outline-primary " type="button" href="{{ route('download.receipt', ['file' => $appointment->reference_no, 'appointment_id' => $appointment->id]) }}" target="_blank">Download Receipt</a>
                                                <button class=" btn btn-danger text-white" type="button" onclick="openCancelModal({{$appointment}});" >Cancel Appointment</button>
                                            </div>
                                        </div><!--//col-->

                                </div><!--//item-->
                                @empty
                                <p>You have no appointments</p>
                                @endforelse
                                <a class="btn mt-3 mb-3 btn-primary" href="{{route('search.doctors')}}">Place an Appointment</a>
                            </div><!--//app-card-body-->

                        </div>
                    </div>

                </div>
                @endrole


                @role('Doctor')
                <div class="alert alert-light alert-dismissible show fade">
                    <strong>Welcome, {{Auth::user()->doctor->saluation}} {{Auth::user()->first_name}} {{Auth::user()->last_name}}!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-6 col-lg-3">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon blue">
                                            <i class="iconly-boldProfile"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Weekly Revenue</h6>
                                        <h6 class="font-extrabold mb-0">LKR {{ $weekly_revenue }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--//col-->

                    <div class="col-6 col-lg-3">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon red">
                                            <i class="iconly-boldProfile"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Total Patients</h6>
                                        <h6 class="font-extrabold mb-0">{{ $patients_count }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--//col-->

                     <div class="col-6 col-lg-4">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon purple">
                                            <i class="iconly-boldProfile"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Todays' Appointments</h6>
                                        <h6 class="font-extrabold mb-0">{{ $apoointment_count }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--//col-->

                </div><!--//row-->



                <div class="row">



                </div>
                @endrole




       @role('Member')

       @push('modals')
       <div class="modal" id="cancel-appointment">
          <div class="modal-dialog">
            <div class="modal-content">

              <div class="modal-header">
                <h4 class="modal-title">Do you want to cancel this Appointment?</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>

              <div class="modal-body">
                <div class="alert alert-warning">You are about to cancel this appointment. Are you sure want to proceed? Please note that this action is can be recovered.</div>

                <form method="POST" action="{{ route('appointments.delete')}}">
                    @csrf

                    <input type="hidden" name="appointment_id"  id="delete-appointment-id">

                    <div class="button-group text-right mt-3">
                        <button type="button" class="btn btn-primary text-white" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger text-white ">Cancel Appointment</button>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>
       @endpush



       <script type="text/javascript">
           function openCancelModal(value)
           {

            console.log(value);
            $('#cancel-appointment').modal('show');
            $('#delete-appointment-id').val(value.id);


           }
       </script>
       @endrole





</x-app-layout>
