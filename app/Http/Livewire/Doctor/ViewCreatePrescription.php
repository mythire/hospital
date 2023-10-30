<?php

namespace App\Http\Livewire\Doctor;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Prescription;
use App\Models\Appointment;
use Illuminate\Support\Facades\Storage;


class ViewCreatePrescription extends Component
{
    use WithFileUploads;

    public $appointment;
    public $prescriptions;
    public $remarks;
    public $files = [];
    protected $listeners = ['refreshSection' => '$refresh'];

    public function mount($appointment_id)
    {
        $this->appointment = Appointment::where(['reference_no' => $appointment_id])->first();

        $this->prescriptions = Prescription::where(['appointment_id' => $this->appointment->id])
                            ->orWhere(['patient_reference' => $this->appointment->identification['number']])
                            ->orderBy('created_at', 'desc')
                            ->get();
    }

    public function render()
    {
        return view('livewire.doctor.view-create-prescription');
    }

    public function save()
    {
        $this->validate([
            'files.*' => 'mimes:jpeg,png,pdf|max:5096', // 5MB Max
            'remarks' => 'nullable'
        ]);

        $filenames = [];

        foreach($this->files as $key => $file) {

            $file_path = 'patients/' . $this->appointment->identification['number'] . '/prescriptions';
            $saving_filename = $this->appointment->reference_no . '_' . ($key + 1). '.' . $file->getClientOriginalExtension();
            $file->storeAs($file_path, $saving_filename, 'local');
            array_push($filenames, $file_path . '/' . $saving_filename);
        }

        Prescription::updateOrCreate([
            'patient_reference' => $this->appointment->identification['number']
        ],[
            'appointment_id' => $this->appointment->id,
            'files' => count($filenames) > 0 ? $filenames : null,
            'remarks' =>  $this->remarks
        ]);

        $this->emit('refreshSection');

        session()->flash('success','Prescription uploaded successfully!');      

        return redirect(request()->header('Referer'));


    }

   
}
