<?php

namespace App\Http\Livewire\Doctor;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Appointment;
use Auth;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Models\Payment;
use Illuminate\Support\Facades\Notification;
use Log;
use Illuminate\Support\Facades\Storage;

class UpdateAppointmentStatus extends Component
{
    public $status;
    public $appointment;
    public array $status_values;

    public function mount($appointment_id)
    {

        $user = Auth::user();

        if ($user->hasRole('Doctor')) {
            $this->status_values = [
                'Applied' => 'Waiting',
                'Started' => 'Start Appointment',
                'Completed' => 'Appointment Completed',
                'Cancelled' => 'Cancel Appointment',
                'Incomplete' => 'Incomplete',
                'Pending' => 'Pending'
            ];
        }

        $this->appointment = Appointment::where(['reference_no' => $appointment_id])->first();
        if ($this->appointment->status !== null) {
            $this->status = $this->appointment->status;
        } else {
            $this->status = 'Pending';
        }

    }

    public function render()
    {
        return view('livewire.doctor.update-appointment-status')->extends('layouts.app');
    }

    public function updateStatus()
    {

        Appointment::where(['reference_no' => $this->appointment->reference_no])
            ->update([
                'status' => $this->status
            ]);

        $appointment = Appointment::find($this->appointment->id);

        if ($this->status == 'Cancelled') {
            // delete appointment
            $this->appointment->delete();
        }


       session()->flash('success','Appointment Status updated successfully!');

       return redirect()->route('appointments.index');


    }
}
