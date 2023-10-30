<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Speciality;
use App\Models\Appointment;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\StoreDoctorRequest;
use App\Http\Requests\Admin\UpdateDoctorRequest;
use sirajcse\UniqueIdGenerator\UniqueIdGenerator;
use Auth;
use App\Events\AppointmentDeleteDoctor;
use DataTables;


class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $doctors = User::role('Doctor')->paginate(10);

        if ($request->ajax()) {

            $data = User::role('Doctor')->get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = "<a href='" . route('doctors.show', ['doctor' => $row->id]) . "' class='edit btn btn-primary btn-sm text-white'><i class='lni lni-eye'></i></a>";

                        $btn =  $btn. "<a href='" . route('doctor.schedule-edit', ['user_id' => $row->id]) . "' class='edit btn btn-primary btn-sm text-white ml-1'><i class='lni lni-pencil'></i></a>";

                        $btn = $btn." <a href='javascript:void(0)'  data-toggle='tooltip' class='edit btn btn-danger btn-sm text-white deleteDoctor' data-id='". $row->id ."' data-firstname='" . $row->first_name . "'><i class='lni lni-trash-can'></i></a>";
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->addColumn('name', function($row) {
                        return $row->first_name . " " . $row->last_name;
                    })
                    ->addColumn('speciality', function($row) {
                        return $row->doctor->speciality;
                    })
                    ->addColumn('day', function($row) {
                        return $row->doctor->day;
                    })
                    ->editColumn('time', function($row) {
                        return Carbon::parse($row->doctor->time)->format('h:i A');
                    })
                    ->addColumn('fees', function($row) {
                        return $row->doctor->fees;
                    })
                    ->make(true);
        }

        return view('Admin.Users.Doctors.showDoctorsYajra');

        // return view('Admin.Users.Doctors.showDoctors')->with(['doctors' => $doctors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $specialities = ['Chest Specialist','Cardiologist','Dentist','Dermatologist','General Physician'];

        return view('Admin.Users.Doctors.createDoctor')->with('specialities', $specialities);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDoctorRequest $request)
    {

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make('password'),
        ]);



        $user->doctor()->create([
            'day' => $request->day,
            'time' => $request->time,
            'speciality' => $request->speciality,
            'fees' => $request->fees,
            'ph_no' => $request->ph_no
        ]);

        $user->assignRole('Doctor');

        event(new \Illuminate\Auth\Events\Registered($user));


        return redirect()->route('doctors.index')->with('success', 'Doctor created successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $doctor = User::role('Doctor')->where('id', $id)->first();

        // $user = User::find(10);
        // $user->givePermissionTo('Test');

        $appointments = null;
        if ($doctor->doctor !== null) {
            $appointments =  Appointment::where([
                'doctor_id' => $doctor->doctor->id
            ])
            ->get()
            ->groupBy(function($appointment) {
                 return $appointment->session_datetimestamp->format('Y-m-d');
            });
        }


        return view('Admin.Users.Doctors.viewDoctor')->with(['doctor' => $doctor, 'appointments' => $appointments]);
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user = User::find($request->id);
        if ($user->hasRole('Doctor')) {
            $user->removeRole('Doctor');
        }

        // delete appointments
        Appointment::where('doctor_id', $user->doctor->id)->delete();

        // delete trigger

        $user->delete();


        return redirect()->route('doctors.index')->with('success', 'Doctor deleted successfully!');
    }
}
