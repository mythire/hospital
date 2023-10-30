@extends('layouts.staticmain')

@section('title', 'Book an Appointment')


@push('styles')
<style type="text/css">
    .filter .appointment-input {
        width: 100%;
        background: #fff;
        border-radius: 5px;
        border: 1px solid #eee;
        padding: 0 25px;
        height: 55px;
        appearance: none;
        font-size: 14px;
        color: #888;
        font-weight: 400;
    }
</style>
@endpush

@section('content')


<div class="services-area ptb-100">
    <div class="container">

        <div class="row  justify-content-center">
            <div class="col-lg-8 col-sm-12 col-md-12">
                <h4 class="mb-3">Doctor Availability Chart</h4>
                <div class="card p-3 shadow rounded ">
                    <div class="card-body ">
                        <table class="table table-bordered">
                            <thead>
                                <th>Doctor No</th>
                                <th>Doctor Name</th>
                                <th>Speciality</th>
                                <th>Date</th>
                                <th>Time</th>
                            </thead>
                            <tbody>
                                @forelse($results as $result)
                                    <tr>
                                        <td>{{$result->doctor->id}}</td>
                                        <td>{{$result->doctor->saluation}} {{ $result->first_name }} {{ $result->last_name }}</td>
                                        <td>{{$result->doctor->speciality}} </td>
                                        <td>{{$result->doctor->day}} </td>
                                        <td>{{\Carbon\Carbon::parse($result->doctor->time)->format('h:i a')}} </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>

                <a href="{{ route('booking.form') }}" class="default-btn mt-3">Book Now <i class="fas fa-chevron-right"></i></a>
            </div>


        </div>
    </div>
</div>

@endsection
