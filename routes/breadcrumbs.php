<?php

use Rawilk\Breadcrumbs\Facades\Breadcrumbs;
use Rawilk\Breadcrumbs\Support\Generator;
use Illuminate\Support\Str;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Breadcrumbs::for('dashboard', function (Generator $trail) {
    $trail->push('Dashboard', route('dashboard'));
});

// Dashboard > Appointments
Breadcrumbs::for('appointments.index', function (Generator $trail)  {
    $trail->parent('dashboard')->push('Appointments', route('appointments.index'));
});

// Dashboard > Appointments > Appointments by Type
Breadcrumbs::for('appointments.type-all', function (Generator $trail, $type)  {
    $trail->parent('dashboard')
        ->push('Appointments', route('appointments.index'))
        ->push(Str::headline($type) . ' Appointments', route('appointments.type-all', ['type' => $type]));
});


// Dashboard > Appointments > Individual Appointment
Breadcrumbs::for('appointments.type-ind', function (Generator $trail,$appointment_id)  {
    $trail->parent('dashboard')
        ->push('Appointments', route('appointments.index'))       
        ->push('Individual Appointment', route('appointments.type-ind', ['id' => $appointment_id]));
});

// Dashboard > Patients
Breadcrumbs::for('patients.index', function (Generator $trail)  {
    $trail->parent('dashboard')->push('Patients', route('patients.index'));
});

// Dashboard > Patients > View Patient
Breadcrumbs::for('patients.show', function (Generator $trail, $patient)  {
    $trail->parent('dashboard')
        ->push('Patients', route('patients.index'))
        ->push("Patient's Details", route('patients.show', ['patient' => $patient]));
});

// leaves

// Leaves
Breadcrumbs::for(
    'leaves.index',
    fn (Generator $trail) => $trail->parent('dashboard')->push('Leaves', route('leaves.index'))
);

// Leaves > Create Leave
Breadcrumbs::for(
    'leaves.create',
    fn (Generator $trail) => $trail->parent('leaves.index')->push('Create Leave', route('leaves.create'))
);

// Reports
Breadcrumbs::for(
    'reports.view',
    fn (Generator $trail) => $trail->parent('dashboard')->push('Generate Report', route('reports.view'))
);

