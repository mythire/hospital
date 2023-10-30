<?php

namespace App\Http\Livewire;


use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Livewire\Component;

class CreateAppointment extends Component
{

    public $doctor;
    public $doctors = [''];
    public $speciality;
    public $specialities = [''];
    public $session_dates;
    public $session_date;
    public $time;
    public $fee;
    public $period;
    public $days = [];
    public $available_date;
    public $name;
    public $address;


    public function mount()
    {
        $this->doctors = User::role('Doctor')->orderBy('id','asc')->get();
        $this->specialities = ['Chest Specialist','Cardiologist','Dentist','Dermatologist','General Physician'];

    }

    public function render()
    {
        return view('livewire.create-appointment')->layout('layouts.staticmain');
    }

    public function updatedSpeciality()
    {
        $this->doctors = User::role('Doctor')
                                ->whereHas('doctor', function($query) {
                                    return $query->where('speciality', $this->speciality);
                                })
                                ->orderBy('id','asc')->get();
    }

    public function updatedDoctor()
    {
        $doctor = Doctor::where('id', (int)$this->doctor)->first();


        $this->session_dates =  $doctor->day;;
        $this->time = Carbon::parse($doctor->time)->format('h:i a');
        $this->fee = $doctor->fees;


        $this->updatedSessionDate();



    }

    public function updatedSessionDate()
    {

        $this->days = [];

        $today = Carbon::parse($this->session_dates)->toDateString();
        $end_date = Carbon::today()->addMonth()->toDateString();
        $period = CarbonPeriod::create($today, '1 week', $end_date);


        $doctor = User::role('Doctor')
                    ->whereHas('doctor', function($query) {
                        return $query->where('id', (int)$this->doctor);
                    })->first();


        foreach ($period as $key => $value) {

            $day = $value->format('Y-m-d');
            $this->days[] = $day;

        }


    }


    protected $rules = [
        "speciality" => 'required',
        "doctor" => "required",
        "available_date" => 'required',
        "name" => 'required|string|max:255',
        "address" => 'required|string'
    ];

    protected $messages = [
        "speciality.required" => 'Speciality is required',
        "doctor.required" => "Doctor is required",
        "session_date.required" => 'Session date isrequired',
        "available_date.required" => 'Booking date is required',
        'name.required' => 'First name is required',
        'address.required' => 'City is required',
    ];

    public function save()
    {

        $validatedData = $this->validate();


        //unique reference number create
        // 8 character
        $reference_no = strtoupper(substr(uniqid(),-8));

        $doctor = User::role('Doctor')
                    ->whereHas('doctor', function($query) {
                        return $query->where('id', (int)$this->doctor);
                    })->first();

        $doctors_time_h = Carbon::parse($doctor->doctor->time)->format('h');
        $doctors_time_m = Carbon::parse($doctor->doctor->time)->format('i');


        $appointment = Appointment::create([
            'reference_no' => $reference_no,
            'doctor_id' => $doctor->doctor->id,
            'session_datetimestamp' => Carbon::parse($this->available_date)->addHours($doctors_time_h)->addMinutes($doctors_time_m),
            'name' => $this->name,
            'address' => $this->address,
            'status' => 'Pending'
        ]);


        $this->reset();

        return redirect()->route('success', [
            'ref' => $appointment->reference_no
        ]);


    }




}
