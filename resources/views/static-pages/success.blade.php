@extends('layouts.staticmain')

@section('title', 'Book an Appointment')


@section('content')

<div class="error-area ptb-100">
    <div class="container">
        <div class="error-content">

                <img src="{{ asset('images/success.png') }}" alt="image" style="height: 380px;">
                <h3>Appointment Placed successfully!</h3>
            <div class="row justify-content-center text-start">
                <div class="col-lg-6">
                    <table class="table table-responsive table-bordered ">
                        <tr>
                            <th>Reference No</th>
                            <td>{{ $appointment->reference_no }}</td>
                        </tr>
                        <tr>
                            <th>Date & Time</th>
                            <td>{{ \Carbon\Carbon::parse($appointment->session_datetimestamp)->format('d/m/y h:i a') }}</td>
                        </tr>
                        <tr>
                            <th>Patient</th>
                            <td>{{ $appointment->name }} - {{$appointment->address}}</td>
                        </tr>
                        <tr>
                            <th>Doctor</th>
                            <td>{{ $appointment->viewDoctor->saluation }} {{ $appointment->viewDoctor->user->first_name }} {{ $appointment->viewDoctor->user->last_name }}</td>
                        </tr>
                        <tr>
                            <th>Speciality</th>
                            <td>{{ $appointment->viewDoctor->speciality  }}</td>
                        </tr>
                        <tr>
                            <th>Fees</th>
                            <td>{{ $appointment->viewDoctor->fees  }} LKR</td>
                        </tr>
                    </table>
                </div>
            </div>




                <p>Thank you for being with Medicare. Wish you good health!</p>
            <a href="/" class="default-btn">Back To Homepage<i class="fas fa-chevron-right"></i></a>
        </div>
    </div>
</div>
@endsection
