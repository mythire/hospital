<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Speciality;
use App\Models\Clinic;

class UpdateDoctorProfile extends Component
{

    public $user;
    public $saluation;
    public $day;
    public $time;
    public $fees;
    public $currentRouteName;
    public $specialities = [];
    public $speciality;

    public function mount($user_id)
    {
        $this->specialities = ['Chest Specialist','Cardiologist','Dentist','Dermatologist','General Physician'];

        $this->user = User::find($user_id);
        // dd($this->user->doctor);

        if ($this->user->doctor !== null) {

            $this->saluation = $this->user->doctor->saluation ?? null;
            $this->speciality = $this->user->doctor->speciality ?? null;
            $this->fees = $this->user->doctor->fees ?? null;
            $this->day = $this->user->doctor->day ?? null;
            $this->time = Carbon::parse($this->user->doctor->time)->format('h:i') ?? null;
        }
    }

    public function render()
    {
        return view('livewire.profile.update-doctor-profile');
    }


    public function updateProfile()
    {
        $validatedData = $this->validate([
            'saluation' => ['required','string', 'max:255'],
            'fees' => ['required','numeric'],
            'speciality' => ['required'],
            'day' => ['required'],
            'time' => ['required'],
        ]);

        $this->user->doctor()->updateOrCreate([
            'user_id' => $this->user->id
        ],[
            'user_id' => $this->user->id,
            'saluation' => $this->saluation,
            'day' => $this->day,
            'time' => Carbon::parse($this->time),
            'fees' => $this->fees,
            'speciality' => $this->speciality,
        ])->save();

        session()->flash('message-notify','Information updated successfully.');
        // $this->emit('savedProfile');

        // return redirect()->route('dashboard');

    }

}
