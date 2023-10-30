<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\DoctorSession;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Support\Arr;
use App\Models\Payment;
use App\Models\Prescription;
use Log;
use Auth;
use DataTables;
use Carbon\Carbon;

class AppointmentController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {


            $data = Appointment::whereDate('session_datetimestamp', '>=', Carbon::now())
                            ->where('doctor_id', Auth::user()->doctor->id)
                            ->get();

            // dd($data);

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = "<a href='" . route('appointments.type-ind', ['id' => $row->reference_no]) . "' class='edit btn btn-primary btn-sm text-white'>View</a>";
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->editColumn('session_datetimestamp', function($row) {
                        return Carbon::parse($row->session_datetimestamp)->toDateTimeString();
                    })
                    ->make(true);
        }

        return view('Doctor.Appointments.view-appointments');
    }



    public function viewIndAppointment($id)
    {

        $appointment = Appointment::where(['doctor_id' => Auth::user()->doctor->id, 'reference_no' => $id])
                            ->first();


        return view('Doctor.Appointments.view-appointment-ind')->with(['appointment' => $appointment ]);

    }

    public function viewAppointmentsAdmin(Request $request)
    {
       $appointments = Appointment::whereDate('session_datetimestamp', '>=', Carbon::now())->paginate(10);

        return view('Admin.view-appointments')->with(['appointments' => $appointments]);
    }



}
