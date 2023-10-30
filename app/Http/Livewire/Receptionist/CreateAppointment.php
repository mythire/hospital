<?php

namespace App\Http\Livewire\Receptionist;

use Livewire\Component;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Speciality;
use App\Models\DoctorSession;
use App\Models\Appointment;
use Carbon\CarbonPeriod;
use Carbon\Carbon;
use Log;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Payment\InvoicePaid;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Response;

class CreateAppointment extends Component
{

    public $doctor;
    public $doctors = [''];
    public $speciality;
    public $specialities = [''];
    public $session_dates = [];
    public $session_date;
    public $period;
    public $days = [];
    public $available_date;
    public $appointment_time;
    public $appointment_no;
    public $first_name;
    public $last_name;
    public $display_name;
    public $city;
    public $ph_no;
    public $email_address;
    public $identification_type;
    public $identification_number;
    public $title;
    public $member_type;
    

    public function mount()
    {
        $this->doctors = User::role('Doctor')->orderBy('id','asc')->get();
        $this->specialities = Speciality::orderBy('speciality','asc')->get();
        // dd($this->specialities);
    }

    public function render()
    {
        return view('livewire.receptionist.create-appointment');
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
                    

        $this->session_dates = DoctorSession::where(['doctor_id' => $doctor->id])->get();
        
          
        

    }

    public function updatedSessionDate()
    {
        // get session id
        $doctor_session = DoctorSession::find((int)$this->session_date);
        // dd($doctor_session);

        $today = Carbon::parse($doctor_session->day_of_week)->toDateString();
        $end_date = Carbon::today()->addMonth()->toDateString();
        $period = CarbonPeriod::create($today, '1 week', $end_date); 
        

        $doctor = User::role('Doctor')
                    ->whereHas('doctor', function($query) {
                        return $query->where('id', (int)$this->doctor);
                    })->first();

        // Log::info($doctor);
        
        foreach ($period as $key => $value) {

            $day = $value->format('Y-m-d');
            $this->days[] = $day;
           
            if($doctor->doctor->leaves !== null) {

                foreach ($doctor->doctor->leaves as $leave) {
           
                    $startDateLeave = Carbon::parse($leave->start_date)->toDateString();
                    $endDateLeave = Carbon::parse($leave->end_date)->toDateString();
                    

                    $day_in_between = Carbon::parse($value)->between($startDateLeave,$endDateLeave);

                    if ($day_in_between == true) {
                       
                       unset($this->days[array_search($day, $this->days)]);
                    }
                    

                }                                           

            }

        }

        
    }

    public function updatedAvailableDate()
    {

        $doctor_session = DoctorSession::find((int)$this->session_date);
        $doctor = User::role('Doctor')
                    ->whereHas('doctor', function($query) {
                        return $query->where('id', (int)$this->doctor);
                    })->first();

        // check for appointment number for selected session
        // appointment number check
                    // $test = new Carbon($this->available_date);
        $current_appointments = Appointment::whereDate('session_datetimestamp', '=', Carbon::parse($this->available_date))
        // ->where([            
        //     'doctor_id' => $doctor->doctor->id,
        //     'session_id' => $doctor_session->id,
        // ])
        ->count();

        // dd(Carbon::parse($this->available_date));
            

        
        // calculate appointment time based on doctor's schedule

        $doctors_session_start_time = Carbon::parse($doctor_session->start_time)->format('h:i A');      
        $minutes_to_be_added_to_start_time = $doctor_session->doctor->estimated_time_for_a_patient * $current_appointments;
        $this->appointment_time = Carbon::parse($doctors_session_start_time)->addMinutes($minutes_to_be_added_to_start_time)->format('h:i A');
        $this->appointment_no = $current_appointments + 1;
    }


    protected $rules = [
        "speciality" => 'required',
        "doctor" => "required",
        "session_date" => 'required',
        "available_date" => 'required',
        'member_type' => 'required',
        "title" => 'required|string|max:255',
        "first_name" => 'required|string|max:255',
        "last_name" => 'required|string|max:255',
        "display_name" => 'required|string|max:255',
        "ph_no" => 'required|string|phone:LK',
        "email_address" => 'required|string|email',
        "city" => 'required|string',        
        "identification_type" => 'required',
        "identification_number" => 'required_with:identification_type'
    ];

    protected $messages = [
        "speciality.required" => 'Speciality is required',
        "doctor.required" => "Doctor is required",
        "session_date.required" => 'Session date isrequired',
        "available_date.required" => 'Booking date is required',
        'member_type.required' => 'Member type is required',
        'title.required' => 'Saluation is required',
        'first_name.required' => 'First name is required',
        'last_name.required' => 'Last name is required',
        'display_name.required' => 'Display name is required',
        'ph_no.required' => 'Phone number is required',
        'email_address.required' => 'Email is required',
        'city.required' => 'City is required',
        'identification_type.required' => 'Identification is required',
        'identification_number.required_with' => 'An Identification number is required',
    ];

    public function save()
    {

        // $validatedData = $this->validate();

        $identification = [
            'type' => $this->identification_type,
            'number' => $this->identification_number
        ];

        $appointment_metadata = [
            'appointment_time' => $this->appointment_time,
            'appointment_no' => $this->appointment_no
        ];

        //unique reference number create
        // 8 character
        $reference_no = strtoupper(substr(uniqid(),-8));

        $doctor = User::role('Doctor')
                    ->whereHas('doctor', function($query) {
                        return $query->where('id', (int)$this->doctor);
                    })->first();
        // dd($this->doctor);

        $check_membership = null;
        if ($this->member_type == 'member') {

             //check for membership
            $check_membership = User::role('Member')
                                    ->whereHas('patient', function($query) {
                                        return $query->where('nic', $this->identification_number);
                                    })->exists();

            Log::info($check_membership);                        

            if ($check_membership == true) {

                $member_id = User::role('Member')
                                    ->whereHas('patient', function($query) {
                                        return $query->where('nic', $this->identification_number);
                                    })->first();
            }                 
        }
              

        $appointment = Appointment::create([
            'reference_no' => $reference_no,
            'doctor_id' => $doctor->doctor->id,
            'session_id' => $this->session_date,
            'appointment_type' => 'physical',
            'appointment_metadata' => $appointment_metadata,
            'session_datetimestamp' => Carbon::parse($this->available_date)->format('Y-m-d'),
            'member_type' => $this->member_type, 
            'user_id' => $check_membership !== null ? $member_id->id : null,
            'saluation' => $this->title,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'display_name' => $this->display_name,
            'ph_no' => $this->ph_no,
            'email_address' => $this->email_address,
            'geo_location' => null,
            'city' => $this->city,
            'identification' => $identification
        ]);

        // handle pdf
        $appointment_time = $this->appointment_time;
        $appointment_no = $this->appointment_no;

        $pdf = PDF::loadView('receipt', compact('appointment', 'appointment_time', 'appointment_no'))->setPaper('a4', 'portrait');

        Storage::put('invoices/Receipt-'. $appointment->reference_no .'.pdf', $pdf->output());
        
        Notification::route('mail', [
            $appointment->email_address => $appointment->display_name
        ])->notify(new InvoicePaid($pdf, $appointment, $this->appointment_time, $this->appointment_no));

        session()->flash('success','Clinical Record updated successfully!');

        $this->reset();

        return redirect()->route('appointments.show-appointment-receipt-recep', [
            'reference_no' => $appointment->reference_no, 
            'title' => 'Receipt-'.$appointment->reference_no. '.pdf'
        ]);
              

    }

    
}
