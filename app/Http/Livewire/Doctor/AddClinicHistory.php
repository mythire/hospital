<?php

namespace App\Http\Livewire\Doctor;

use Livewire\Component;
use App\Models\Appointment;
use App\Models\ClinicalHistory;
use Carbon\Carbon;

class AddClinicHistory extends Component
{
    public $appointment_id;
    public $identification;
    public $display_name;
    public $appointment;
    public $clinical_history;
    public $member_type;
    public $gender;
    public $dob;
    public $ph_no;
    public $maritial_status;
    public $prev_physician;
    public $referring_physician;
    public $reason_for_visit;
    public $disableEditing;
    public $conditions = [];
    public $condition_cancer;
    public $cancer_type;
    public $other;
    public $surgical_history;
    public $prescription_medications;
    public $non_prescription_medications;
   


    public function mount($appointment_id)
    {
       

        $this->disableEditing = true;
        $this->appointment_id = $appointment_id;
        $this->appointment = Appointment::where(['reference_no' => $this->appointment_id])->first();
        $check_clinical_history = ClinicalHistory::where(['identification' => $this->appointment->identification['number']])->orderBy('created_at','desc')->exists();
        // dd()
        if ($check_clinical_history == true) {
            $this->clinical_history = ClinicalHistory::where(['identification' => $this->appointment->identification['number']])->orderBy('created_at','desc')->first();
            $this->identification = $this->clinical_history->identification;
            $this->display_name = $this->clinical_history->display_name;
            $this->dob = Carbon::parse($this->clinical_history->dob)->format('Y-m-d');
            $this->ph_no = $this->clinical_history->ph_no;
            $this->member_type = $this->clinical_history->member_type;
            $this->gender = $this->clinical_history->gender;
            $this->maritial_status = $this->clinical_history->maritial_status;
            $this->prev_physician = $this->clinical_history->previous_physician;
            $this->referring_physician = $this->clinical_history->referring_physician;
            $this->reason_for_visit = $this->clinical_history->reason_for_visit;
            $this->conditions = $this->clinical_history->past_medical_history;
            $this->surgical_history = $this->clinical_history->apst_surgical_history;
            $this->prescription_medications = $this->clinical_history->prescription_medications;
            $this->non_prescription_medications = $this->clinical_history->non_prescription_medications;
        }

        
    }


    public function render()
    {
       
        return view('livewire.doctor.add-clinic-history');
    }

    public function save()
    {

        $validatedData = $this->validate([
            'identification' => 'required|string|max:255',
            'display_name' => 'required|string|max:255',
            'ph_no' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'maritial_status' => 'required|string|max:255',
            'dob' => 'required|date',
            'prev_physician' => 'nullable|max:255',
            'referring_physician' => 'nullable|max:255',
            'reason_for_visit' => 'required|max:255',
            'conditions' => 'nullable',
            'condition_cancer' => 'nullable',
            'cancer_type' => 'required_with:condition_cancer|nullable',
            'other' => 'nullable',
            'surgical_history' => 'nullable',
            'prescription_medications' => 'nullable',
            'non_prescription_medications' => 'nullable',

        ],[
            'identification.required' => 'Identification cannot be empty',
            'display_name.required' => 'Display name cannot be empty',
            'ph_no.required' => 'Phone Number cannot be empty',
            'gender.required' => 'Gender cannot be empty',
            'maritial_status.required' => 'Maritial Status cannot be empty',
            'dob.required' => 'Date of Birth cannot be empty',
            'prev_physician' => 'nullable|max:255',
            'referring_physician' => 'nullable|max:255',
            'reason_for_visit.required' => 'You must list a reason for visit',
            'conditions' => 'nullable',
            'cancer_type.required_with' => 'Specify the cancer type or treatment',
            'surgical_history' => 'nullable',
            'prescription_medications' => 'nullable',
            'non_prescription_medications' => 'nullable',

        ]);

        $history = ClinicalHistory::where(['identification' => $this->appointment->identification['number']])->first();

       
        $history = ClinicalHistory::where(['identification' => $this->appointment->identification['number']])
                        ->updateOrCreate([
            'identification' => $this->identification,
            'display_name' => $this->display_name,
            'member_type' => $this->member_type,
            'ph_no' => $this->ph_no,
            'gender' => $this->gender,
            'maritial_status' => $this->maritial_status,
            'dob' => Carbon::parse($this->dob)->format('Y-m-d'),
            'previous_physician' => $this->prev_physician,
            'referring_physician' => $this->referring_physician,
            'reason_for_visit' => $this->reason_for_visit,
            'past_medical_history' => $this->conditions,
            'past_surgical_history_cancer' => $this->cancer_type,
            'past_surgical_history_other' => $this->other,
            'past_surgical_history' => $this->surgical_history,
            'prescription_medications' => $this->prescription_medications,
            'non_prescription_medications' => $this->non_prescription_medications
        ]);

        session()->flash('success','Clinical Record upddated successfully!');              
    }

    public function fillField($field)
    {
        // dd($field);
        if ($field == 'identification') {
            $this->identification = $this->appointment->identification['number'];
        } elseif ($field == 'display_name') {
            $this->display_name = $this->appointment->display_name;
        } elseif ($field == 'ph_no') {
            $this->ph_no = $this->appointment->ph_no;
        } elseif ($field == 'member_type') {
            $this->member_type = $this->appointment->member_type;
        }
    }
}
