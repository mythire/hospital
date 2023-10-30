<?php

namespace App\Http\Controllers;

use App\Notifications\Appointment\NotifyPatient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Speciality;
use App\Models\Appointment;
use App\Models\User;
use App\Models\DoctorSession;
use Carbon\CarbonPeriod;
use Carbon\Carbon;
use Auth;
use App\Http\Requests\CreateBookingRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Payment\InvoicePaid;
use Illuminate\Support\Facades\Storage;


class MainPagesController extends Controller
{
    private $member;


    public function showHomePage()
    {

        return view('static-pages.homepage');
    }

    public function showBookingPage(Request $request)
    {
        $specializations = ['Chest Specialist','Cardiologist','Dentist','Dermatologist','General Physician'];

        $doctors = User::role('doctor')
                    ->when($request->doctor_name, function($query) use ($request) {
                         return $query->where('first_name', 'LIKE', "%". $request->doctor_name. "%")
                         ->orWhere('last_name', 'LIKE', "%". $request->doctor_name . "%");
                    })
                    ->whereHas('doctor', function($query) use ($request) {
                        $query->when($request->specialization, function($query) use ($request) {
                            if ($request->specialization == 'Any') {
                                return $query;
                            }
                            else {
                                return $query->where('speciality', $request->specialization);
                            }

                        });

                    })
                    ->paginate(10);


        return view('static-pages.booking-static')->with(['specializations' => $specializations, 'results' => $doctors]);
    }


    public function showBookingForm()
    {

        if(Auth::check() && Auth::user()->hasAnyRole(['Doctor'])) {
            abort(403, 'You cannot continue while in this role, Please login as a Patient and continue!');
        }

        $specializations = ['Chest Specialist','Cardiologist','Dentist','Dermatologist','General Physician'];

        $doctors = User::role('doctor')
            ->paginate(10);


        return view('static-pages.booking-form')
                ->with([
                    'specializations' => $specializations,
                    'doctors' => $doctors
                ]);
    }

    public function success($ref)
    {

        $appointment_exists = Appointment::where('reference_no', $ref)->exists();
        if ($appointment_exists) {

            $appointment = Appointment::where('reference_no', $ref)->first();

            return view('static-pages.success')->with(['appointment' => $appointment]);
        }

    }



}
