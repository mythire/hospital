<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Doctor;
use App\Models\DoctorSession;
use App\Models\Speciality;
use App\Models\Clinic;
use App\Models\Leave;
use App\Models\Vendor;
use App\Models\ProductCategory;
use App\Models\Product;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'Admin']);

        $user = User::create([
            'first_name' => 'Mankind',
            'last_name' => 'Administrator',
            'email' => 'admin@mankind.io',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
        ]);

        $user->markEmailAsVerified();
        $user->assignRole('Admin');

        Role::create(['name' => 'Doctor']);
        Role::create(['name' => 'Member']);


        $doctors = User::factory()->count(6)->create()->each(function ($user) {

            $user->assignRole('Doctor');

            Doctor::factory()->create([
               'user_id' => $user->id

            ])->each(function($doctor) {

                // set first doctor details and update password

                if ($doctor->id == 1) {

                    $doctor->user->markEmailAsVerified();
                    $doctor->user->update([
                        'email' => 'doctor@mankind.io',
                        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi' // password
                    ]);
                }

            });
        });





    }
}
