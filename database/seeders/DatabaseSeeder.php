<?php

namespace Database\Seeders;

use App\Functions\AccessFn;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\Insurance;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $tables = DB::select('SHOW TABLES');
        foreach ($tables as $table) {
            $_ = array_values((array) $table)[0];
            if (!str_contains($_, '_') && !in_array($_, ['permissions', 'migrations']))
                Permission::create(['name' => $_]);
        }

        $department = Department::create([
            'name' => 'administration',
            'location' => 'current',
        ]);

        $designation = Designation::create([
            'name' => 'admin',
        ]);

        $insurance = Insurance::create([
            'name' => 'basic',
            'company' => 'company',
            'fees' => 0,
        ]);

        Employee::create([
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'department' => $department->id,
            'designation' => $designation->id,
            'insurance' => $insurance->id,
            'email' => 'admin@test.com',
            'phone' => '212000000000',
            'identity' => '00000000',
            'firstName' => 'john',
            'lastName' => 'doe',
            'address' => 'address',
            'state' => 'state',
            'city' => 'city',
            'zipcode' => '00000',
            'identityType' => 'CIN',
            'nationality' => 'world',
            'birthDate' => '2000-01-01',
            'gender' => 'male',
            'status' => 1,
        ]);

        AccessFn::super($designation->id);
    }
}
