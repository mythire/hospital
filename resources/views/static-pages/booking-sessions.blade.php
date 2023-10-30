@extends('layouts.staticmain')

@section('title', 'Book an Appointment')


@push('styles')
<style type="text/css">
    
    .available-border {
        border-left: 5px solid  #0cc029;
        
    }
    .unavailable-border {
        border-left: 5px solid  #ffd21d;
        
    }
</style>
@endpush

@section('content')
<div class="services-area ptb-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-sm-12 col-md-12">
                <div class="card p-3 shadow rounded ">
                    <div class="card-body ">
                        <form class="row filter" method="GET" action="{{route('search.doctors')}}">

                            <div class=" form-group col-lg-6">
                                <label>Doctor Name</label>
                                <input type="text" name="doctor_name" class="form-control appointment-input" placeholder="Doctor's Name">
                            </div>                            
                            <div class=" form-group col-lg-3">
                                <label>Specialization</label>
                                <select name="specialization" class="form-control appointment-input" >
                                    <option selected>Any</option>
                                    @forelse($specializations as $specialization)
                                    <option value="{{$specialization->id}}" >{{$specialization->speciality}}</option>
                                    @empty
                                    <option disabled>No Records found</option>
                                    @endforelse
                                </select>
                            </div> 
                            <div class="form-group col-lg-3">
                                <label>&nbsp;</label> <br>                                
                                <button class="btn default-btn">Search</button>
                               
                            </div>

                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 col-sm-12 col-md-12">
                <div class="card mt-3 p-3 shadow rounded ">
                    <div class="card-body ">
                        <h5 class="card-title">{{$doctor->doctor->saluation}} {{$doctor->first_name}} {{$doctor->last_name}} <small class="text-muted">({{ $doctor->doctor->gender}} Doctor)</small></h5>
                            <small class="text-uppercase">{{$doctor->doctor->viewSpeciality->speciality}}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="services-area ptb-50">
    <div class="container">
        <div class="section-title">
            <h3>Available Dates</h3>
        </div>
        <div class="row justify-content-center">
           

            @foreach($period as $carbon_day)
                @foreach($session_dates as $session_date)

                    @isset($doctor->doctor->leaves)

                       @foreach($doctor->doctor->leaves as $leave)

                       @php

                       $startDate = \Carbon\Carbon::parse($leave->start_date)->toDateString();
                       $endDate = \Carbon\Carbon::parse($leave->end_date)->toDateString();

                       $day_in_between = \Carbon\Carbon::parse($carbon_day)->between($startDate,$endDate);

                       @endphp

                       @endforeach

                    @endisset 

                    @if($session_date->day_of_week == \Carbon\Carbon::parse($carbon_day)->format('l'))
                        <div class="col-lg-8 col-md-8 col-sm-8">
                            <div class="features-box @if(isset($day_in_between)) {{$day_in_between ==! true ? 'available-border' : 'unavailable-border'}} @else available-border @endif" style="text-align: unset;">
                                <div class="row g-0">
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h6 class="card-title text-primary mb-0">{{\Carbon\Carbon::parse($carbon_day)->format('l, jS F Y')}} </h6>
                                            <p class="mb-0"><b>{{$session_date->clinic->name}}</b></p>
                                            <p>Time: <b>{{\Carbon\Carbon::parse($session_date->start_time)->format('h:i A')}}</b></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card-body ">
                                            @isset($day_in_between) 
                                                @if($day_in_between ==! true)

                                                    @php
                                                        $data_arr = [
                                                            'doctor_id' => $doctor->doctor->id,
                                                            'period' => $carbon_day,
                                                            'session_id' => $session_date->id
                                                        ];
                                                    @endphp

                                                @else
                                                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Doctor is on Holiday Leave">
                                                      <button class="btn default-btn" style="pointer-events: none;" type="button" disabled>Unavailable</button>
                                                    </span>
                                                @endif 
                                            @endisset  

                                            @empty($day_in_between)
                                                @php
                                                    $data_arr = [
                                                        'doctor_id' => $doctor->doctor->id,
                                                        'period' => $carbon_day,
                                                        'session_id' => $session_date->id
                                                    ];
                                                @endphp

                                                <a href="{{route('booking.form', ['data' => Crypt::encrypt($data_arr)])}}" class="btn default-btn">Schedule</a>
                                            @endempty                                                             
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    @else  
                    @endif
                @endforeach 
            @endforeach
            
           
        </div>
    </div>
</div>




@endsection