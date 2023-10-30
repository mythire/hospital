<?php

namespace App\Http\Livewire\Receptionist;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Appointment;
use App\Models\Payment;
use Auth;
use Log;
use Illuminate\Support\Facades\Storage;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Support\Arr;

class UpdateAppointmentStatus extends Component
{
    public $status;
    public $appointment;
    public array $status_values;
    
    public function mount($appointment_id)
    {

        $user = Auth::user();

       
        $this->status_values = [               
            'Cancelled' => 'Cancel Appointment',
            'Incomplete' => 'Incomplete',
            'Pending' => 'Pending'
        ];
       

        $this->appointment = Appointment::where(['reference_no' => $appointment_id])->first();
        if ($this->appointment->status !== null) {
            $this->status = $this->appointment->status;
        } else {
            $this->status = 'Pending';
        }
        
    }

    public function render()
    {   
        return view('livewire.receptionist.update-appointment-status')->extends('layouts.app');
    }

    public function updateStatus()
    {   
        
        Appointment::where(['reference_no' => $this->appointment->reference_no])
            ->update([
                'status' => $this->status
            ]);

        if ($this->status == 'Cancelled') {            

            $receipt_path = 'invoices/Receipt-'. $this->appointment->reference_no . '.pdf';
            $receipt_path_check = Storage::disk('local')->exists($receipt_path);
            if ($receipt_path == true) {
                Storage::disk('local')->delete($receipt_path);
            }

            // delete appointment
            Appointment::destroy($this->appointment->id);
        }    

        session()->flash('message', 'Appointment successfully updated.');  

       

       return redirect()->route('dashboard');

            
    }
}
