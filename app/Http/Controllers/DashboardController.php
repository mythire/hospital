<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Appointment;
use App\Models\Clinic;
use App\Models\Leave;
use App\Models\User;
use App\Models\Stock;
use App\Models\Prescription;
use App\Models\DoctorSession;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Stock\StockLevel;

class DashboardController extends Controller
{
    public function showDashboard(Request $request)
    {



        if (Auth::user()->hasRole('Member') == true) {

            $appointments = Appointment::where([
                'member_type' => 'member',
                'user_id' => Auth::id(),
            ])
            ->orderBy('created_at', 'desc')
            ->paginate(5);

            return view('dashboard')->with(['appointments' => $appointments]);

        } else if (Auth::user()->hasRole('Doctor') == true) {


            $apoointment_count = Appointment::whereDate('session_datetimestamp','=', Carbon::today())->where('doctor_id', Auth::user()->doctor->id)->count();



            $weekly_revenue_appointment_count = Appointment::where(['doctor_id' => Auth::user()->doctor->id])
                ->whereDate('session_datetimestamp', '>=', Carbon::now()->startOfWeek())
                ->whereDate('session_datetimestamp', '<=', Carbon::now()->endOfWeek())
                ->count();

            $patients_count = Appointment::where('doctor_id', Auth::user()->doctor->id)->count();

            $doctor_fee = Auth::user()->doctor->fees;
            $weekly_revenue = $weekly_revenue_appointment_count * $doctor_fee;

            return view('dashboard')->with([
                'weekly_revenue' => number_format($weekly_revenue),
                'patients_count' => $patients_count,
                'apoointment_count' => $apoointment_count
            ]);

        } else if (Auth::user()->hasRole('Admin') == true) {

            $doctor_count = User::role('Doctor')->count();
            $patient_count = User::role('Member')->count();
            $weekly_appointment_count = Appointment::whereDate('session_datetimestamp', '>=', Carbon::now()->startOfWeek())
                ->whereDate('session_datetimestamp', '<=', Carbon::now()->endOfWeek())
                ->count();

            $appointment_type_user_member =  Appointment::withTrashed()->count();

            return view('dashboard')->with([
                'doctor_count' => $doctor_count,
                'patient_count' => $patient_count,
                'weekly_appointment_count' => $weekly_appointment_count,
                'appointment_type_user_member' => $appointment_type_user_member
            ]);
        }

    }

}
