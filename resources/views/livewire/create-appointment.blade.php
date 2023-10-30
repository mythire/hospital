<div>
    <div class="table-responsive" style="overflow: hidden;">
         <form wire:submit.prevent="save">

            @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

        <table class="table  table-bordered w-100">


                <tbody>
                    <tr>
                        <th>Speciality</th>
                        <td>
                            <select class="form-control @error('speciality') is-invalid @enderror" wire:model="speciality">
                                <option value="">Select</option>
                                @foreach($specialities as $speciality)
                                <option value="{{ $speciality }}">{{ $speciality }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Doctor</th>
                        <td>
                            <select class="form-control  @error('doctor') is-invalid @enderror" wire:model="doctor">
                                <option value="">Select</option>
                                @foreach($doctors as $doctor)
                                <option value="{{ $doctor->doctor->id }}">{{ $doctor->doctor->saluation }} {{ $doctor->first_name }} {{ $doctor->last_name }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                     <tr>
                        <th>Session Date</th>
                        <td>
                            {{ $session_dates }}
                        </td>
                    </tr>
                    <tr>
                        <th>Available Date</th>
                        <td>
                            <select class="form-control @error('available_date') is-invalid @enderror" wire:model="available_date">
                                <option value="">Select</option>
                                @foreach($days as $day)
                                <option value="{{ $day }}">{{$day }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <th>Session Date</th>
                        <td>
                            {{ $time }}
                        </td>
                    </tr>

                    <tr>
                        <th>Fees</th>
                        <td>
                            {{ $fee }} LKR
                        </td>
                    </tr>

                    <tr>
                        <th>Patient Name</th>
                        <td>
                            <div class="row">
                                <div class="col-lg-12">
                                    <input type="text" wire:model.defer="name" class="form-control @error('name') is-invalid @enderror"  placeholder="Name">
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td><input type="text" wire:model.defer="address" class="form-control @error('address') is-invalid @enderror" placeholder="Address"></td>
                    </tr>

            </tbody>


    </table>
    <div class="button-group">
        <button class="default-btn " type="submit">Create Appointment</button>
    </div>
    </form>
</div>
</div>
