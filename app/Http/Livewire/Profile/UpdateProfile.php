<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

class UpdateProfile extends Component
{

    public $user;
    public $saluation;
    public $gender;
    public $dob;
    public $ph_no;
    public $nationality;
    public $currentRouteName;
    public $identification;


    public function mount()
    {
        $this->currentRouteName = Route::currentRouteName();

        $this->user = auth()->user();
        
        if ($this->user->patient !== null) {
            $this->saluation = $this->user->patient->saluation; 
            $this->gender = $this->user->patient->gender;
            $this->nationality = $this->user->patient->nationality;
            $this->ph_no = $this->user->patient->ph_no;
            $this->dob = Carbon::parse($this->user->patient->dob)->format('Y-m-d');
            $this->identification = $this->user->patient->nic;
        }        
    }

    public function render()
    {
        return view('livewire.profile.update-profile');
    }

    protected $rules = [
        'saluation' => ['required','string', 'max:255'],
        'dob' => ['required','date','before_or_equal:today'],
        'gender' => ['required','string', 'max:255'],
        'nationality' => ['required','string', 'max:255'],
        'ph_no' => ['required', 'phone:LK'],
        'identification' => ['required','max:255','string'],
    ];
 
    protected $messages = [
        'saluation.required' => 'The Saluation is required.',
        'dob.required' => 'The Date of Birth is required.',
        'gender.required' => 'Gender is required.',
        'ph_no.required' => 'Phone number is required.',
        'nationality.required' => 'Nationality is required.',
        'identification.required' => 'Identification is required',
    ];

    public function updateProfile()
    { 
        $this->validate();

        // Log::info($this->currentRouteName);
        
        // Log::info($this->user);

        $this->user->patient()->updateOrCreate([
            'user_id' => $this->user->id
        ],[    
            'user_id' => $this->user->id,
            'saluation' => $this->saluation,
            'nationality' => $this->nationality,
            'dob' => $this->dob,
            'gender' => $this->gender,
            'ph_no' => $this->ph_no,
            'nic' => $this->identification
        ])->save();

        // session()->flash('message','Saved');
        $this->emit('savedProfile');

        return redirect()->route('dashboard');
        
    }
}
